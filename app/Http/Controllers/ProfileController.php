<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use SebastianBergmann\Diff\Exception;

class ProfileController extends Controller
{
    public function dashboard()
    {
        return view('profile.dashboard');
    }

    public function destroy(Request $request)
    {
        User::query()->where('id', Auth::user()->getAuthIdentifier())->delete();
        return redirect('/');
    }
    public function edit()
    {
       return view('profile.edit');
    }
    public function update(UpdateProfileRequest $request)
    {

        try {
            User::query()->where('id', Auth::user()->getAuthIdentifier())->update($request->validated());
            return redirect('dashboard')->with('success', 'your info updated successfully' );
        }catch (Exception $e){
            return redirect('dashboard')->with('fail', 'failed to update your info' );
        }
    }
}
