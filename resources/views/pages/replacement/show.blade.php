@extends('layouts.app')

@section('title', 'All Replacement Request')


@section('content')
    <h3>My Replacement Request</h3>
    <hr>


    <div class="row">
        <div class="col-lg-12">
            @if(session('success'))

                <div class="alert alert-success">{{session('success')}}!</div>

            @endif
            @if(session('failed'))
                <div class="alert alert-danger">
                    {{session('failed')}}!
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Replacement Request Table
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                {{-- <th>#</th>--}}
                                <th>Requested BY</th>
                                <th>From - To</th>
                                <th>Duration</th>
                                <th>Reason</th>

                                <th>Replacement Officer Approval</th>
                                <th>Recommending Officer</th>
                                <th>Approving Authority</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($result as $res)
                                <tr class="gradeX">
                                    <td>{{$res->name}}</td>
                                    <td>{{$res->applicant_leave_from}} - {{$res->applicant_leave_to}}</td>
                                    <td>{{$res->applicant_leave_duration}} Days</td>
                                    <td>{{$res->applicant_leave_reason}}</td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="javascript:void(0);" data-toggle="dropdown"
                                               class="btn btn-default btn-xs dropdown-toggle">
                                                <em class="fa fa-angle-down"></em>

                                                @if($res->replacement_person_agreement==0)
                                                    <button
                                                            class="btn btn-warning btn-xs">Pending
                                                    </button>
                                                @elseif($res->replacement_person_agreement==1)
                                                    <button
                                                            class="btn btn-success btn-xs">Approved
                                                    </button>
                                                @else
                                                    <button
                                                            class="btn btn-danger btn-xs">Canceled
                                                    </button>
                                                @endif</a>
                                            <ul class="dropdown-menu pull-right text-left">
                                                <li><a href="/leave/replacement/accept/{{$res->leave_id}}">Accept</a>
                                                </li>
                                                <li><a href="/leave/replacement/cancel/{{$res->leave_id}}">Cancel</a>
                                                </li>

                                            </ul>
                                        </div>


                                    </td>


                                    <td>@if($res->recommend_officers_decision==0)
                                            <div class="label label-warning">Pending
                                            </div> @elseif($res->recommend_officers_decision==1)
                                            <div class="label label-success">Approved</div> @else
                                            <div class="label label-danger">Canceled</div>@endif</td>
                                    <td>

                                        @if($res->grant_officers_decision==0)
                                            <div class="label label-warning">Pending
                                            </div> @elseif($res->grant_officers_decision==1)
                                            <div class="label label-success">Approved</div> @else
                                            <div class="label label-danger">Canceled</div>@endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection