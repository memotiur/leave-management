<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check()) {
                return Redirect::to('/login');
            } else {
                if (!Session::get('id')) {
                    return Redirect::to('/logout');
                }
            }
            return $next($request);
        });
    }

    public function profile()
    {
        $id = Session::get('id');

        if (Session::get('designation') == "DC/AC") {
            $unseen_notifications = \App\Leave::join('users', 'users.id', '=', 'leaves.user_id')
                ->where('users.authority_id', Session::get('id'))
                ->where('leaves.grant_officers_decision', 0)
                ->get();

        } elseif (Session::get('designation') == "Commissioner"
            OR Session::get('designation') == "ADC/JC") {
            $unseen_notifications = \App\Leave::join('users', 'users.id', '=', 'leaves.user_id')
                ->where('leaves.grant_officers_decision', 0)
                ->get();
        } else {
            $unseen_notifications = null;
        }
        $unseen_replacement_notifications = \App\Leave::join('users', 'users.id', '=', 'leaves.replacement_person_id')->where('leaves.replacement_person_id', Session::get('id'))->where('replacement_person_agreement', 0)->get();

        return view('pages.profile.index')->with('result', User::where('id', $id)->first())
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications);


    }

    public function editProfile()
    {
        $id = Session::get('id');
        //return User::where('id',$id)->first();
        if (Session::get('designation') == "DC/AC") {
            $unseen_notifications = \App\Leave::join('users', 'users.id', '=', 'leaves.user_id')
                ->where('users.authority_id', Session::get('id'))
                ->where('leaves.grant_officers_decision', 0)
                ->get();

        } elseif (Session::get('designation') == "Commissioner"
            OR Session::get('designation') == "ADC/JC") {
            $unseen_notifications = \App\Leave::join('users', 'users.id', '=', 'leaves.user_id')
                ->where('leaves.grant_officers_decision', 0)
                ->get();
        }else{
            $unseen_notifications=null;
        }
        $unseen_replacement_notifications = \App\Leave::join('users', 'users.id', '=', 'leaves.replacement_person_id')->where('leaves.replacement_person_id', Session::get('id'))->where('replacement_person_agreement', 0)->get();

        return view('pages.profile.edit')->with('result', User::where('id', $id)->first())
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications);

    }

    public function updateProfile(Request $request)
    {

        unset($request['_token']); //Remove Token
        unset($request['id']); //Remove id

        $id = Session::get('id');
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            ]);
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/user');
            $image->move($destinationPath, $image_name);
            $request->request->add(['profile_pic' => $image_name]);
            $request->request->add(['password' => Hash::make($request['password'])]);
            $data = $request->except('image');
            Session::put('profile_pic', $image_name);
        } else {
            $request->request->add(['password' => Hash::make($request['password'])]);
            $data = $request->all();
        }

        unset($request['profile_pic']);

        //return $request->all();
        try {
            User::where('id', $id)->update($data);
            return back()->with('success', "Profile Updated");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }

    }
}
