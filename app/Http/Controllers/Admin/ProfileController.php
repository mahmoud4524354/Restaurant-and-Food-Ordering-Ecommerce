<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilePasswordUpdateRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return view('admin.profile.index');
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        $user = Auth::user();

        $imagePath = $this->uploadImage($request, 'avatar');

        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = isset($imagePath) ? $imagePath : $user->avatar;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(ProfilePasswordUpdateRequest $request)
    {
        $user = Auth::user();

        $data['password'] = bcrypt($request['password']);
        $user->update($data);

        toastr()->success('Password updated successfully!');

        return redirect()->back();
    }
}
