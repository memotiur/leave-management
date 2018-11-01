@extends('layouts.app')

@section('title', 'Create User')


@section('content')
    <div class="col-lg-4">
        <div class="panel widget">
            <div class="panel-body">
                <div href="#" class="media p mt0">
                    <div class="pull-left">
                        <img src="/images/user/{{$result->profile_pic}}" style="width: 100px; height: 100px;" alt="Image" class="media-object img-circle">
                    </div>
                    <div class="media-body">
                        <div class="media-heading">
                            <h3 class="mt0">{{$result->name}}</h3>
                            <ul class="list-unstyled">
                                <li class="mb-sm">
                                    <em class="fa fa-map-marker fa-fw"></em>{{$result->designation}}</li>
                                <li class="mb-sm">
                                    <em class="fa fa-envelope fa-fw"></em>{{$result->email}}</li>
                                </ul>
                        </div>
                        <a href="/user/profile/edit"  class="btn btn-primary btn-sm">Update Profile</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div data-toggle="portlet" class="">

            <div class="panel panel-primary">
                <div class="panel-heading portlet-handler">Profile
                    <a href="javascript:void(0);" data-perform="panel-dismiss" data-toggle="tooltip" title="" class="pull-right portlet-cancel" data-original-title="Close Panel">
                        <em class="fa fa-times"></em>
                    </a>
                </div>
                <div class="panel-body">
                    <p>Name: {{$result->name}}</p>
                    <p>Phone: {{$result->phone}}</p>
                    <p>Joining date: {{$result->dateofjoining}}</p>
                    <p>Date of Birth: {{$result->dateofbirth}}</p>
                </div>

            </div>

        </div>
    </div>
@endsection