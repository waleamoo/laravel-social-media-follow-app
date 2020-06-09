<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(){
        return \view('pages.index');
    }

    public function postUserRegister(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);

        $user = new User([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        Auth::login($user);
        return \redirect()->route('userDashboard');

    }

    public function postUserLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);

        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            return \redirect()->route('userDashboard');
        }
        return \redirect()->back()->with('error', 'Credentials does not match');
        //return view('home');
    }
    
    public function getAccount(){
        $user = Auth::user();
        return view('pages.account', ['user' => $user]);
    }

    public function postAccount(Request $request){
        $this->validate($request, [
            'first_name' => 'required|max:120'
        ]);

        $user = Auth::user();
        $user->name = $request['first_name'];
        $user->update();

        $file = $request->file('image');
        $filename = $request["first_name"] . '-' . $user->id . '.jpg';
        if($file){
            Storage::disk('local')->put($filename, File::get($file));
        }
        return \redirect()->route('account');
    }

    public function getUserImage($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}
