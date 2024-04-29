<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Address;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use function Laravel\Prompts\form;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request ): View
    {
        $user = auth()->user();

        $addresses = $user->addresses;

        $addressesWithPings = [];

        foreach ($addresses as $address) {
            $ping = $address->pings()->latest('last_activity')->first();
                if ($ping) {
                    $ping= $ping->toArray();
                    $minutesAgo = ceil((time() - $ping['last_activity']) / 60);
                }else{
                    $ping= false;
                    $minutesAgo = false;
                }

            $addressesWithPings[] = [
                'address' => $address->toArray(),
                'ping' => $ping,
                'minutesAgo' => $minutesAgo,
            ];
        }


        return view('profile.profile', [
            'user' => $request->user(),
            'addresses' => $addressesWithPings,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'], // Use 'ip' rule for validation
            'city' => ['string', 'max:50', 'nullable'],
            'country' => ['string', 'max:50', 'nullable'],

        ]);

        $user = auth()->user();
        $name = $request->input('name');
        $email = $request->input('email');
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        // Check for null values
        $city = $request->input('city') === null ? null : $request->input('city');
        $country = $request->input('country') === null ? null : $request->input('country');

        // Update address in database
        $user->name = $name;
        $user->email = $email;
        $user->city = $city;
        $user->country = $country;
        $user->save();


        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        if (Hash::check($request->input('current_password'), $user->password)) {
            $user->update([
                'password' => Hash::make($request->input('new_password')),
            ]);

            return response()->json([
                'message' => 'Password updated successfully',
            ]);
        } else {
            return response()->json([
                'error' => 'Incorrect current password',
            ], 401);
        }
    }

    /**
     * Update the user's profile information.
     */
    public function theme_update(Request $request): RedirectResponse
    {
        $user = $request->user();
        $user->theme = $request->input('theme');
        $user->save();
        return Redirect::route('dashboard');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function user_form(Request $request)
    {
        $subject = "Feedback from " . $request->input('name');
        $body = "Message: \n" . $request->input('message');
        $recipient = "leonardooleg2@gmail.com";
        $sent = mail($recipient, $subject, $body);
        if ($sent) {
            echo "Email sent successfully!";
        } else {
            echo "Error sending email.";
        }




        return Redirect::to('/');
    }
}
