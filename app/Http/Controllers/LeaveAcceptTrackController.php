<?php

namespace App\Http\Controllers;

use App\Leave;
use App\LeaveAcceptTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LeaveAcceptTrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function grantAccept($id)
    {
    

        $result = Leave::join('users', 'users.id', '=', 'leaves.user_id')->where('leaves.leave_id', $id)->first();
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

        $recommend_officer = Leave::join('leave_accept_tracks', 'leave_accept_tracks.leave_id', '=', 'leaves.leave_id')
            ->join('users', 'users.id', '=', 'leave_accept_tracks.recommend_officer_id')
            ->first();
        $grant_officer = Leave::join('leave_accept_tracks', 'leave_accept_tracks.leave_id', '=', 'leaves.leave_id')
            ->join('users', 'users.id', '=', 'leave_accept_tracks.grant_officer_id')
            ->first();
        return view('pages.leave.grant_accept')
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications)
            ->with('recommend_officer', $recommend_officer)
            ->with('grant_officer', $grant_officer)
            ->with('result', $result);


    }
    public function grantCancel($id)
    {
         $result = Leave::join('users', 'users.id', '=', 'leaves.user_id')->where('leaves.leave_id', $id)->first();
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

        $recommend_officer = Leave::join('leave_accept_tracks', 'leave_accept_tracks.leave_id', '=', 'leaves.leave_id')
            ->join('users', 'users.id', '=', 'leave_accept_tracks.recommend_officer_id')
            ->first();
        $grant_officer = Leave::join('leave_accept_tracks', 'leave_accept_tracks.leave_id', '=', 'leaves.leave_id')
            ->join('users', 'users.id', '=', 'leave_accept_tracks.grant_officer_id')
            ->first();
        return view('pages.leave.grant_cancel')
            ->with('unseen_notifications', $unseen_notifications)
            ->with('unseen_replacement_notifications', $unseen_replacement_notifications)
            ->with('recommend_officer', $recommend_officer)
            ->with('grant_officer', $grant_officer)
            ->with('result', $result);



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaveAcceptTrack  $leaveAcceptTrack
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveAcceptTrack $leaveAcceptTrack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveAcceptTrack  $leaveAcceptTrack
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveAcceptTrack $leaveAcceptTrack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaveAcceptTrack  $leaveAcceptTrack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveAcceptTrack $leaveAcceptTrack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveAcceptTrack  $leaveAcceptTrack
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveAcceptTrack $leaveAcceptTrack)
    {
        //
    }
}
