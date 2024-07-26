<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = User::findOrFail(Auth::user()->id);
        return view('admin.profile', [
            'profile' => $profile,
            'page_title' => 'Profile',
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'fullname' => 'nullable | min:6',
                'old_password' => 'nullable | string',
                'password' => 'nullable | required_with:old_password |string | confirmed | min:8',
                'foto' => 'nullable | image | mimes:jpg,jpeg,gif,png,svg | max:2048',
            ],
            [
                'foto.max' => 'Maksimal 2 MB',
                'foto.image' => 'File ekstensi harus jpg, jpeg, gif, png, svg',
            ]
        );
        $users = User::find($id);
        $users->name = $request->fullName;
        $users->nim = $request->nim;
        $users->email = $request->email;
        if ($request->hasFile('foto')) {
            // cara kedua
            // $fileName = $request->file('foto')->store('photo_users');
            // $path = $users->foto;
            // if ($path != null) {
            //     Storage::delete($path);
            // }
            // $pathPhoto = $request->file('foto')->store('photo_users');
            // $users->foto = $pathPhoto;

            // cara pertama
            $path = 'photo_user/' . $users->foto;
            if ($path != null) {
                Storage::delete($path);
            }
            $photo = $request->file('foto');
            $extension = $photo->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;

            $request->foto->move(storage_path('app/public/photo_user'), $fileName);
            $users->profile_photo_path = $fileName;
        }
        $users->save();

        return back()->with('status', 'profile Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
