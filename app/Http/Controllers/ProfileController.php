<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Address;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;



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
            $ping = $address->pings()->latest('last_activity')->first()->toArray();
            $minutesAgo = ceil((time() - $ping['last_activity']) / 60);
            if ($minutesAgo > 4) {
                $online = false;
            }else{
                $online = true;
            }
            $addressesWithPings[] = [
                'address' => $address->toArray(),
                'ping' => $ping,
                'online' => $online,
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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
}
