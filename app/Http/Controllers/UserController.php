<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::where('type' , 'client')->paginate(25);

        return view('dashboard.users' ,  compact('data'));
    }

    public function profile()
    {
        $user = User::find(auth()->user()->id);

//        $plans = Plan::get();

        return view('dashboard.profile' , compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        User::updateOrCreate(['id'=> $request->get('id')] ,
            [
                'name'=> $request->get('name'),
                'email'=> $request->get('email'),
            ]);

        flash('Updated Successfully');

        return redirect()->back();
    }

    public function update(Request $request, User $user)
    {
        $id = $request->get('userid');

        // Validation rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
        ];

        // Validate email if present
        if ($request->has('email')) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id];
        }

        // Validate password if present
        if ($request->has('password')) {
            $rules['password'] = 'required_with:password_confirmation|confirmed';
            $rules['password_confirmation'] = 'required_with:password';
        }

        $request->validate($rules);

        // Update user details
        $user = User::find($id);
        if (!$user) {
            flash()->error('User not found');
            return redirect()->back();
        }

        $user->name = $request->get('name');

        if ($request->has('email')) {
            $user->email = $request->get('email');
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->save();

        flash()->message('Data Updated Successfully');

        return redirect()->back();
    }


    public function destroy($id)
    {
        User::find($id)->delete();

        flash('User Deleted Successfully!');

        return redirect()->back();
    }
}
