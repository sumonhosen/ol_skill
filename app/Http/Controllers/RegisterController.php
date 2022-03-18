<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Jobs\UserEmailJob;
use App\Models\User;


class RegisterController extends Controller
{
    public function index(){
        return view('registration');
    }
    public function registration(Request $request){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:users',
                'phone' => 'required|numeric|min:11|unique:users'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
            // Mail::to($user->email)->send(new UserEmail($user));
            UserEmailJob::dispatch($user);
            return back()->with(['success'=>'Your registration successfull']);
    }
}
