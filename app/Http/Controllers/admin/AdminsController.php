<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
class AdminsController extends Controller
{
    function admins()
    {
        $data['getRecord'] = User::where('is_admin','=',1)
                    ->where('is_delete','=',1)
                    ->orderBy('id')->paginate(10);
        $data['header_title'] = 'ISISIA - Admins';
        return view('admin.admins.admins', $data);
    }
    function addAdmin()
    {
        $data['header_title'] = 'ISISIA - Admins';
        return view('admin.admins.create', $data);
    }
    function storeAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'status' => 'required|in:0,1',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/admins')->with('success', 'Admin successfully added');
    }


    function editAdmin($id)
    {
        $data['getRecord'] = User::getOneAdmin($id);
        $data['header_title'] = 'ISISIA - Admins';
        return view('admin.admins.edit', $data);
    }
    function updateAdmin($id, Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
            'status' => 'required|in:0,1',
        ]);
        $user = User::getOneAdmin($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->is_delete = 1;
        $user->save();
        return redirect('admin/admins')->with('success', 'Admin successfully updated');
    }

    function deleteAdmin($id){
        $user = User::getOneAdmin($id);
        $user->delete();
        return redirect('admin/admins')->with('success', 'Admin successfully deleted');
    }
}
