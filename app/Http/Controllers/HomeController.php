<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = DataUser::all();
        $add = false;
        return view('welcome', compact('users', 'add'));
    }

    public function add()
    {
        $users = DataUser::all();
        $add = true;
        return view('welcome', compact('users', 'add'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|string',
            'address' => 'required|string',
        ]);

        $data = new DataUser;
        $data->name = $request->name;
        $data->address = $request->address;
        $data->number = $request->phone;
        $data->email = $request->email;
        if ($data->save()) {
            return redirect()->route('welcome.hi')->with(
                [
                    'info' => [
                        'success' => true,
                        'message' => "User Added Successfully"
                    ]
                ]
            );
        }
    }

    public function delete($id)
    {
        $data = DataUser::where('id', $id)->delete();
        if ($data) {
            return  redirect()->back()->with(
                [
                    'info' => [
                        'success' => true,
                        'message' => "User Deleted Successfully"
                    ]
                ]
            );
        }
    }

    public function edit($id)
    {
        $data = DataUser::where('id', $id)->first();
        $users = DataUser::all();
        $add = false;
        return view('welcome', compact('users', 'add', 'data'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|string',
            'address' => 'required|string',
        ]);

        $data = DataUser::where('id', $id)->first();
        $data->name = $request->name;
        $data->address = $request->address;
        $data->number = $request->phone;
        $data->email = $request->email;

        if ($data->save()) {
            return redirect()->route('welcome.hi')->with(
                [
                    'info' => [
                        'success' => true,
                        'message' => "User Updated Successfully"
                    ]
                ]
            );
        }
    }
}
