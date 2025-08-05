<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfilePasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUploadTrait;

    function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Profile Updated Successfully');

        return redirect()->back();
    }


    function updatePassword(ProfilePasswordUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $data['password'] = bcrypt($request['password']);
        $user->update($data);

        toastr()->success('Password updated successfully!');

        return redirect()->back();
    }

    function updateAvatar(Request $request) {
        /** handle image file */
        $imagePath = $this->uploadImage($request, 'avatar');

        $user = Auth::user();
        $user->avatar = $imagePath;
        $user->save();

        return response(['status' => 'success', 'message' => 'Avatar Updated Successfully']);
    }

}
