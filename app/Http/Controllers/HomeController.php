<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        if (Auth::check()) {
            return Redirect::to('/admin-home');
        } else {
            return Redirect::to('/login');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {

        return view('login');
    }

    public function index()
    {

        return view('pages.home.index');
    }

    public function doLogin(Request $request)
    {
        $username = $request['username'];
        $password = $request['password'];
        $remember = true;

        // attempt to do the login
        if (Auth::attempt(['username' => $username, 'password' => $password], $remember)) {

            $user = User::where('username', $username)->first();
            Session::put('name', $user->name);
            Session::put('phone', $user->phone);
            Session::put('username', $user->username);
            Session::put('designation', $user->designation);
            Session::put('usertype', $user->usertype);
            Session::put('profile_pic', $user->profile_pic);
            Session::put('id', $user->id);
            if ($user->active_status != 1) {
                return back()->with('failed', "Your id is deactivated");
            }

            return Redirect::to('/admin-home');
        } else {
            return back()->with('failed', "Username or password does not match");

        }
        //Auth::logout(); // log the user out of our application
    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('/');
    }

    public function registration()
    {
        return view('register')->with('users', User::where('designation', 'DC/AC')->get());
    }

    public function confirmMail($id)
    {
        $id = $this->decrypt($id);
        try {
            User::where('id', $id)->update(['active_status' => 0]);
            return Redirect::to('/login')->with('success', "Email Confirmed");
        } catch (\Exception $exception) {
            return Redirect::to('/login')->with('failed', $exception->getMessage());
        }
    }


    public function registrationSave(Request $request)
    {
        unset($request['_token']); //Remove Token

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            ]);
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/user');
            $image->move($destinationPath, $image_name);
        } else {
            $image_name = $request['image'];
        }
        $request->request->add(['profile_pic' => $image_name]);
        if ($request['designation'] == "Commissioner") {
            $usertype = 1;
        } elseif ($request['designation'] == "ADC/JC") {
            $usertype = 2;
        } elseif ($request['designation'] == "DC/AC") {
            $usertype = 3;
        } elseif ($request['designation'] == "RO/ARO") {
            $usertype = 4;
        } else {
            $usertype = 5;
        }

        //return $usertype;

        $request->request->add(['usertype' => $usertype]);
        $request->request->add(['active_status' => 420]);

        $request->request->add(['password' => Hash::make($request['password'])]);
        if ($request['designation2'] == null) {
            unset($request['designation2']);
        } else {
            $request->request->add(['designation' => $request['designation2']]);
            unset($request['designation2']);

        }
        // return $request->all();

        try {
            $id = User::insertGetId($request->except('image'));
            $this->mailConfirm($request['email'], $id);
            return back()->with('success', "Successfully Registered. Check your Email");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }


    public function mailConfirm($email, $id)
    {
        $id = $this->encrypt($id);
        $url = "benapole.pixonlab.com/user/confirm/" . $id;
         $msg = "Please click on given Link:  \n " . $url;

        //echo $this->decrypt($id);
        mail($email, "Mail From Leave APP ", $msg);

    }

    function encrypt($input)
    {
        return strtr(base64_encode($input), '+/=', '._-');
    }

    function decrypt($input)
    {
        return base64_decode(strtr($input, '._-', '+/='));
    }

    public function forgetPass()
    {

    }
}
