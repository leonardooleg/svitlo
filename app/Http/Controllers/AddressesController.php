<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use App\Http\Requests\AddressesRequest;
use App\Models\Ping;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Resources\AddressesResource;
use Illuminate\Support\Facades\Cache;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AddressesResource::collection(Address::all());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ip_address' => ['nullable', 'ip','required_without:url_address'], // Use 'ip' rule for validation
            'url_address' => ['nullable', 'url','required_without:ip_address'], // Use 'url' rule for validation
            'public' => ['required', 'boolean'],
            'link' => ['nullable', 'string','unique:addresses,link','max:255'],
            'required_either' => ['required_either:ip_address,url_address'], // Custom rule

        ]);
        $url_address = $request->input('url_address');
        $userId = auth()->id(); // Get currently logged-in user's ID
        // Check for null values
        $publicLink = $request->input('link') === null ? null : $request->input('link');
        $url_address =$this->url_check($url_address);
        if($url_address===false){
            return response()->json([
                'message' => 'Error',
            ]);
        }
        $publicLink =$this->url_check($publicLink);
       if($publicLink===false){
            return response()->json([
                'message' => 'Error',
            ]);
        }
        $addresses_array= [
            'user_id' => $userId,
            'name' => $request->input('name'),
            'ip_address' => $request->input('ip_address'),
            'url_address' => $url_address,
            'public' => $request->input('public'),
            'link' => $publicLink,
        ];
        $addresses = Address::create($addresses_array);

        return response()->json([
            'message' => 'Record add successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($url_address)
    {
        $notificationHelper = new NotificationHelper();
        $cacheKey = "address:$url_address"; // Define a unique cache key

        // Check if request limit exceeded within the throttle period
        if (Cache::has($cacheKey)) {
            return response()->json([
                'message' => 'Too many requests. Please try again later.',
                'errors' => ['rate_limit' => 'Rate limit 30s. exceeded.'],
            ], 429); // HTTP 429 Too Many Requests
        }
        $id_address = Address::where('url_address', $url_address)->first();
        if (!$id_address) {
            return response()->json([
                'message' => 'Address not found',
            ], 404);
        }
        $pings = Ping::where('address_id', $id_address->id)->latest('last_activity')->get();
        $now_time = time();
        $status= false;
        if ($pings->count() > 0) {
            $last_ping = $pings->first();
            if ($last_ping->ping != 1) {
                $status = 'Онлайн';
                Ping::create([
                    'address_id' => $id_address->id,
                    'ping' => 1,
                    'last_activity' => $now_time,
                    'last_status' => $now_time,
                ]);
            }else{
                // оновити запис Ping
                $last_ping->update([
                    'last_status' => $now_time
                ]);
            }
        } else {
            $status = 'Онлайн';
            // Створити новий запис Ping, оскільки не знайдено попередніх записів
            Ping::create([
                'address_id' => $id_address->id,
                'ping' => 1,
                'last_activity' => $now_time,
                'last_status' => $now_time,
            ]);
        }
        // Store request timestamp in cache with desired throttle period
        Cache::put($cacheKey, true, 30); // Cache for 30 seconds
        if ($status){
            $notificationHelper->push_notification($id_address->user_id, $id_address->name, $status);

        }
        return response()->json(['address' => $url_address, 'status' => 'online']);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ip_address' => ['nullable', 'ip','required_without:url_address'], // Use 'ip' rule for validation
            'url_address' => ['nullable', 'url', 'unique:addresses,url_address' ,'required_without:ip_address'], // Use 'url' rule for validation
            'public' => ['required', 'boolean'],
            'link' => ['nullable', 'string', 'unique:addresses,link' ,'max:255'],
            'required_either' => ['required_either:ip_address,url_address'], // Custom rule

        ]);

        $address = Address::find($id);

        $addressName = $request->input('name');
        $ip_address = $request->input('ip_address');
        $url_address = $request->input('url_address');
        $isPublic = $request->input('public');

        // Check for null values
        $publicLink = $request->input('link') === null ? null : $request->input('link');
        $publicLink =$this->url_check($publicLink);
        if($publicLink===false){
            return response()->json([
                'message' => 'Error',
            ]);
        }
        $url_address =$this->url_check($url_address);
        if($url_address===false){
            return response()->json([
                'message' => 'Error',
            ]);
        }

        // Update address in database
        $address->name = $addressName;
        $address->ip_address = $ip_address;
        $address->url_address = $url_address;
        $address->public = (int)$isPublic;
        $address->link = $publicLink;
        $address->save();


        return response()->json([
            'message' => 'Record updated successfully',
        ]);
    }

    /*public function update(AddressesRequest $request, Address $addresses)
    {
        $addresses->update($request->validated());

        return new AddressesResource($addresses);
    }*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();

        return response()->json([
            'message' => 'Record deleted successfully',
        ]);
    }

    function url_check($url)
    {
        if (isset($url)) {
            $pattern = '/\/([^\/]+)$/';
            preg_match($pattern, $url, $matches);
            if (count($matches) > 1) {
                if (isset($matches[1])) {
                    $url = $matches[1];
                    $count_url_address = strlen($url);
                    if ($count_url_address != 13 && !is_int($url)) {
                        //return error
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }
        return $url;
    }
}
