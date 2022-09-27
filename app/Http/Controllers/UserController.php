<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    //Update User Account 
    public function update(Request $request, $id)
    {
        // $user->update($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'birthday' => 'required|date',
        ]);
    
        try {
            DB::beginTransaction();
            // Logic For Save User Data
    
            $update_user = User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'birthday' => $request->birthday,
            ]);
            // $update_user->save();
            if(!$update_user){
                DB::rollBack();
    
                return back()->with('error', 'Something went wrong while update user data');
            }
    
            DB::commit();
            return response(['success', 'User Updated Successfully.'],200);
    
    
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    

    //Delete User Account
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
    
            $delete_user = User::findOrFail($id)->delete();
    
            if(!$delete_user){
                DB::rollBack();
                return back()->with('error', 'There is an error while deleting user.');
            }
    
            DB::commit();
            return response(['success', 'User Deleted successfully.'],200);
    
    
    
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}