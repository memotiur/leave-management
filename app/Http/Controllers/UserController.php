<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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

    public function create()
    {
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

        //$unseen_notifications;
        $unseen_replacement_notifications = \App\Leave::join('users', 'users.id', '=', 'leaves.replacement_person_id')->where('leaves.replacement_person_id', Session::get('id'))->where('replacement_person_agreement', 0)->get();

        return view('pages.user.create')
            ->with('unseen_notifications', $unseen_notifications)
            ->with('users', User::where('designation', 'DC/AC')->get())
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications);

    }


    public function store(Request $request)
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

        $request->request->add(['password' => Hash::make($request['password'])]);
        if ($request['designation2'] == null) {
            unset($request['designation2']);
        } else {
            $request->request->add(['designation' => $request['designation2']]);
            unset($request['designation2']);

        }
        // return $request->all();

        try {
            User::create($request->except('image'));
            return back()->with('success', "User created");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }


    public function show()
    {
        $result = User::get();

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

        return view('pages.user.show')->with('result', $result)
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications);
    }

    public function accountActivate()
    {
        $result = User:: where('users.authority_id', Session::get('id'))->get();

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

        return view('pages.user.show')->with('result', $result)
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications);
    }

    public function edit($id)
    {
        //$id = Session::get('id');
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
        } else {
            $unseen_notifications = null;
        }


        $unseen_replacement_notifications = \App\Leave::join('users', 'users.id', '=', 'leaves.replacement_person_id')->where('leaves.replacement_person_id', Session::get('id'))->where('replacement_person_agreement', 0)->get();

        return view('pages.user.edit')->with('result', User::where('id', $id)->first())
            ->with('unseen_notifications', $unseen_notifications)
            ->with('users', User::where('designation', 'DC/AC')->get())
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications);


    }

    public function update(Request $request)
    {
        unset($request['_token']); //Remove Token
        $id = $request['id'];
        unset($request['id']); //Remove id

        if ($request['designation2'] == null) {
            unset($request['designation2']);
        } else {
            $request->request->add(['designation' => $request['designation2']]);
            unset($request['designation2']);

        }
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

        try {
            User::where('id', $id)->update($data);
            return back()->with('success', "Profile Updated");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete();
            return back()->with('success', "User Deleted");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function deactivate($id)
    {
        try {
            User::where('id', $id)->update(['active_status' => 2]);
            return back()->with('success', "User Deactivated");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function activate($id)
    {
        try {
            User::where('id', $id)->update(['active_status' => 1]);
            return back()->with('success', "User Activated");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
