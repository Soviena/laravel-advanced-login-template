<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use App\Http\Requests\StoreUserDataRequest;
use App\Http\Requests\UpdateUserDataRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserData $userData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserData $userData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->user_data->first_name = $request->first_name;
        $user->user_data->last_name = $request->last_name;
        $user->user_data->date_of_birth = $request->tanggal_lahir;
        $user->user_data->phone_number = $request->phone_number;
        if ($request->hasFile('file_profile')) {
            if ($user->user_data->profile_picture != "") {
                Storage::delete('uploaded/user/'.$user->profilepic);
            }
            // Menambah foto profil
            $file_profile = $request->file('file_profile');
            $file_profile->storeAs('uploaded/user/',$file_profile->hashName());
            $user->user_data->profile_picture = $file_profile->hashName();
            // mengubah foto profil
        }
        if ($request->hasFile('cover_picture')) {
            if ($user->user_data->cover_picture != "") {
                Storage::delete('uploaded/user/'.$user->profilepic);
            }
            // Menambah foto profil
            $coverPicture = $request->file('cover_picture');
            $coverPicture->storeAs('uploaded/user/',$coverPicture->hashName());
            $user->user_data->cover_picture = $coverPicture->hashName();
            // mengubah foto profil
        }
        $user->user_data->save();
        return redirect()->back()->with(["EditSuccess" => "Data diri berhasil diubah"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserData $userData)
    {
        //
    }
}
