<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfilController extends Controller
{
    public function edit($id) {
        return view('userprofil_edit');
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'name' => 'required|max:100',
            'email'=> 'required|max:100',
            'password' => 'nullable|max:10',
        ]);
        if($request->password != '') {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }
        $user = auth()->user();
        $user->fill($data);
        $user->save();
        flash('Data berhasil diperbarui')->success();
        return back();
    }
}