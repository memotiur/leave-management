<?php

namespace App\Http\Controllers;

use App\Leave;
use App\LeaveAcceptTrack;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LeaveController extends Controller
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


    public function index()
    {
        //
    }


    public function create()
    {
        try {
            $result = User::where('id', Session::get('id'))->first();
            if (is_null($result)) {
                return Redirect::to('/logout');
            }
        } catch (\Exception $exception) {
            $result = null;
        }

        $cl_counter = Leave::where('user_id', Session::get('id'))
            ->where('applicant_leave_type', "CL")
            ->where('replacement_person_agreement', '1')
            ->where('grant_officers_decision', '1')
            ->sum('applicant_leave_duration');

        $last_leave = Leave::where('user_id', Session::get('id'))
            ->where('replacement_person_agreement', '1')
            ->where('grant_officers_decision', '1')
            ->orderBy('leave_id', 'DESC')
            ->first();

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
        return view('pages.leave.create')
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications)
            ->with('cl_counter', 20 - $cl_counter)
            ->with('last_leave', $last_leave)
            ->with('result', $result)->with('users', User::get());
    }


    public function store(Request $request)
    {

        unset($request['_token']); //Remove Token
        if ($request['applicant_leave_type'] == "CL") {
            $applicant_available_holidays = $request['applicant_available_holidays2'];

        } else {
            $applicant_available_holidays = $request['applicant_available_holidays'];
        }

        if ($request['applicant_leave_type'] == "Other") {
            $leave_type = $request['applicant_leave_type2'];

        } else {
            $leave_type = $request['applicant_leave_type'];
        }

        //return $request->all();

        if ($request->hasFile('attachment1')) {

            $attachment = $request->file('attachment1');
            $applicant_attachment1 = time() . '.' . $attachment->getClientOriginalExtension();
            $destinationPath = public_path('/attachment');
            $attachment->move($destinationPath, $applicant_attachment1);
        } else {
            $applicant_attachment1 = null;
        }

        if ($request->hasFile('attachment2')) {

            $attachment = $request->file('attachment2');
            $applicant_attachment2 = time() . '.' . $attachment->getClientOriginalExtension();
            $destinationPath = public_path('/attachment');
            $attachment->move($destinationPath, $applicant_attachment2);
        } else {
            $applicant_attachment2 = null;
        }


        $applicant_leave_from = $request['applicant_leave_from'];
        $applicant_leave_to = $request['applicant_leave_to'];

        $applicant_leave_from = Carbon::parse($applicant_leave_from)->format('Y-m-d');
        $applicant_leave_to = Carbon::parse($applicant_leave_to)->format('Y-m-d');


        $insert_array = array(
            'user_id' => $request['user_id'],
            'applicant_leave_from' => $applicant_leave_from,
            'applicant_leave_to' => $applicant_leave_to,
            'applicant_leave_duration' => $request['applicant_leave_duration'],
            'applicant_leave_reason' => $request['applicant_leave_reason'],
            'applicant_leave_type' => $leave_type,
            'applicant_available_holidays' => $applicant_available_holidays,
            'applicant_attachment1' => $applicant_attachment1,
            'applicant_attachment2' => $applicant_attachment2,
            'applicant_taken_leave_from' => $request['applicant_taken_leave_from'],
            'applicant_taken_leave_to' => $request['applicant_taken_leave_to'],
            'applicant_taken_leave_duration' => $request['applicant_taken_leave_duration'],
            'applicant_leave_time_location' => $request['applicant_leave_time_location'],
            'applicant_leave_time_phone' => $request['applicant_leave_time_phone'],
            'replacement_person_id' => $request['replacement_person_id'],
        );

        //return $insert_array;
        try {
            Leave::create($insert_array);
            return Redirect::to('/leave/show');
            return back()->with('success', "Leave application send");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }

    }


    public function show(Leave $leave)
    {

        $result = Leave::join('users', 'users.id', '=', 'leaves.replacement_person_id')->where('leaves.user_id', Session::get('id'))->orderBy('leave_id', 'DESC')->get();
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

        return view('pages.leave.show')
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications)
            ->with('result', $result);
    }


    public function details($id)
    {

        $result = Leave::join('users', 'users.id', '=', 'leaves.user_id')->where('leaves.leave_id', $id)->where('leaves.user_id', Session::get('id'))->first();
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

        $recommend_officer = Leave::join('leave_accept_tracks', 'leave_accept_tracks.leave_id', '=', 'leaves.leave_id')
            ->join('users', 'users.id', '=', 'leave_accept_tracks.recommend_officer_id')
            ->first();
        $grant_officer = Leave::join('leave_accept_tracks', 'leave_accept_tracks.leave_id', '=', 'leaves.leave_id')
            ->join('users', 'users.id', '=', 'leave_accept_tracks.grant_officer_id')
            ->first();
        return view('pages.leave.details')
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications)
            ->with('recommend_officer', $recommend_officer)
            ->with('grant_officer', $grant_officer)
            ->with('result', $result);
    }


    public function all(Leave $leave)
    {

        if (Session::get('designation') == "DC/AC") {
            $result = Leave::join('users', 'users.id', '=', 'leaves.user_id')
                ->where('users.authority_id', Session::get('id'))
                ->orderBy('leave_id', 'DESC')
                ->get();
        } else {
            $result = Leave::join('users', 'users.id', '=', 'leaves.user_id')->orderBy('leave_id', 'DESC')->get();
        }

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


        return view('pages.leave_all.show')
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications)
            ->with('result', $result);
    }

    public function search(Request $request)
    {

        // return $request->all();


        $applicant_leave_from = $request['applicant_leave_from'];
        $applicant_leave_to = $request['applicant_leave_to'];

        $applicant_leave_from = Carbon::parse($applicant_leave_from)->format('Y-m-d');
        $applicant_leave_to = Carbon::parse($applicant_leave_to)->format('Y-m-d');

        if (Session::get('designation') == "DC/AC") {
            $loadResult = Leave::join('users', 'users.id', '=', 'leaves.user_id')
                ->where('users.authority_id', Session::get('id'))
                ->where('applicant_leave_from', '>=', $applicant_leave_from)
                //->where('applicant_leave_to', '<=', $request['applicant_leave_to'])
                ->orderBy('leave_id', 'DESC')
                ->get();
        } else {
            $loadResult = Leave::join('users', 'users.id', '=', 'leaves.user_id')
                ->where('applicant_leave_from', '>=', $applicant_leave_from)
                //->where('applicant_leave_to', '<=', $request['applicant_leave_to'])
                ->orderBy('leave_id', 'DESC')
                ->get();
        }

        $result = [];
        foreach ($loadResult as $res) {
            if ($applicant_leave_to <= $res['applicant_leave_to']) {
                $result = array($res);
                array_push($result, $res);
            }
        }

        //return $result;

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


        return view('pages.leave_all.show')
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications)
            ->with('result', $result);
    }


    public function edit($id)
    {
        $result = Leave::where('leave_id', $id)->first();
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
        }
        $unseen_replacement_notifications = \App\Leave::join('users', 'users.id', '=', 'leaves.replacement_person_id')->where('leaves.replacement_person_id', Session::get('id'))->where('replacement_person_agreement', 0)->get();


        return view('pages.leave.edit')
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications)
            ->with('result', $result);
    }


    public function update(Request $request, Leave $leave)
    {
        //
    }


    public function destroy($id)
    {
        try {
            Leave::where('leave_id', $id)->delete();
            return back()->with('success', "Leave Deleted");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function replacement()
    {
        $id = Session::get('id');
        $result = Leave::join('users', 'users.id', '=', 'leaves.user_id')->where('leaves.replacement_person_id', $id)->orderBy('leave_id', 'DESC')->get();

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

        return view('pages.replacement.show')
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications)
            ->with('result', $result);
    }

    public function replacementAccept($id)
    {
        $user_id = Session::get('id');

        try {
            Leave::where('leave_id', $id)->where('replacement_person_id', $user_id)->update(array('replacement_person_agreement' => 1));
            return back()->with('success', "Request Accepted");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function replacementCancel($id)
    {
        $user_id = Session::get('id');

        try {
            Leave::where('leave_id', $id)->where('replacement_person_id', $user_id)->update(array('replacement_person_agreement' => 2));
            return back()->with('success', "Request Cancel");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    //Recommend

    public function recommendAccept($id)
    {
        $user_id = Session::get('id');
        try {
            Leave::where('leave_id', $id)->update(array('recommend_officers_decision' => 1));
            $exist = LeaveAcceptTrack::where('leave_id', $id)->first();
            if (is_null($exist)) {
                LeaveAcceptTrack::create(array('recommend_officer_id' => $user_id, 'leave_id' => $id));
            } else {
                LeaveAcceptTrack::where('leave_id', $id)->update(array('recommend_officer_id' => $user_id));
            }
            return back()->with('success', "Request Accepted");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function recommendCancel($id)
    {
        $user_id = Session::get('id');
        try {
            Leave::where('leave_id', $id)->update(array('recommend_officers_decision' => 2));
            $exist = LeaveAcceptTrack::where('leave_id', $id)->first();
            if (is_null($exist)) {
                LeaveAcceptTrack::create(array('recommend_officer_id' => $user_id, 'leave_id' => $id));
            } else {
                LeaveAcceptTrack::where('leave_id', $id)->update(array('recommend_officer_id' => $user_id));
            }
            return back()->with('success', "Request Canceled");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    //Grant Officer

    public function grantAccept(Request $request)
    {

        $user_id = Session::get('id');
        $id = $request['leave_id'];
        try {
            Leave::where('leave_id', $id)->update(array('grant_officers_decision' => 1, 'recommend_officer_comment' => $request['recommend_officer_comment']));
            $exist = LeaveAcceptTrack::where('leave_id', $id)->first();
            if (is_null($exist)) {
                LeaveAcceptTrack::create(array('grant_officer_id' => $user_id, 'leave_id' => $id));
            } else {
                LeaveAcceptTrack::where('leave_id', $id)->update(array('grant_officer_id' => $user_id));
            }

            return Redirect::to('/leave/all')->with('success', "Request Accepted");
            return back()->with('success', "Request Accepted");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function grantCancel(Request $request)
    {
        $user_id = Session::get('id');
        $id = $request['leave_id'];
        try {
            Leave::where('leave_id', $id)->update(array('grant_officers_decision' => 2, 'recommend_officer_comment' => $request['recommend_officer_comment']));
            $exist = LeaveAcceptTrack::where('leave_id', $id)->first();
            if (is_null($exist)) {
                LeaveAcceptTrack::create(array('grant_officer_id' => $user_id, 'leave_id' => $id));
            } else {
                LeaveAcceptTrack::where('leave_id', $id)->update(array('grant_officer_id' => $user_id));
            }
            return Redirect::to('/leave/all')->with('failed', "Request Canceled");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
