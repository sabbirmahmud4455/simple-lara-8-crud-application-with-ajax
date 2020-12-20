<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    //home view with Members data
    public function index()
    {
        $member_data=Member::all();
        return response()->json($member_data);
    }

    //create Member
    public function create_user(Request $form_data)
    {
       
        $form_data-> validate([
            'name'=>'required',
            'email'=>'required|unique:members',
            'cell'=>'numeric|unique:members'
        ]);
        Member::insert([
            'name'=>$form_data->name,
            'email'=>$form_data->email,
            'cell'=>$form_data->cell,
            'role'=>$form_data->role,
            'address'=>$form_data->address,
        ]);

    }

    //single user id
    public function edit_form($id)
    {
        $edit_member_data= Member::find($id);
        return response()->json($edit_member_data);
    }


    //update Member
    public function update_user(Request $form_data)
    {
        Member::find($form_data->id)->update([
            'name'=>$form_data->name,
            'email'=>$form_data->email,
            'cell'=>$form_data->cell,
            'role'=>$form_data->role,
            'address'=>$form_data->address,
        ]);

    }




    //delete Member
    public function delete_user($user_id)
    {
        Member::find($user_id)->delete();
    }





}

