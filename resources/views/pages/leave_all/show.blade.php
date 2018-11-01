@extends('layouts.app')

@section('title', 'All Leave')


@section('content')
    <h3>All Applications</h3>
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
                <div class="panel-heading">Search Leave</div>

                <div class="panel-body">

                    <form class="form-inline" method="post" action="/leave/search"
                          enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-lg-5 control-label">Leave From</label>
                            <div class="col-lg-7">
                                <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                                <input placeholder="Leave From" class="form-control datepicker"
                                       name="applicant_leave_from" data-date-format="mm/dd/yyyy" id="fdate" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-5 control-label">Leave To</label>
                            <div class="col-lg-7">
                                <input placeholder="Leave To" class="form-control datepicker" name="applicant_leave_to"
                                       data-date-format="mm/dd/yyyy" id="tdate" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <button type="submit" class="btn btn-sm btn-primary">Search</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Leave Table
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                {{-- <th>#</th>--}}
                                <th>Requested By</th>
                                <th>From - To</th>
                                <th>Duration</th>
                                <th>Reason</th>
                                <th>Document</th>
                                <th>Replacement Officer Approval</th>
                                <th>Recommending Officer</th>
                                <th>Approving Authority</th>

                                {{--  <th>Birthdate</th>--}}
                                {{-- <th>Action</th>--}}
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
                                        @if($res->applicant_attachment1!=null)
                                            <a class="label label-info"
                                               href="/attachment/{{$res->applicant_attachment1}}"
                                               download/>Doc1
                                        @endif
                                        @if($res->applicant_attachment2!=null)
                                            <a class="label label-primary"
                                               href="/attachment/{{$res->applicant_attachment2}}" download/>Doc2
                                        @endif

                                        @if($res->applicant_attachment1==null &&  $res->applicant_attachment2==null)
                                            <p class="text-danger">Not Submitted</p>
                                        @endif

                                    </td>

                                    <td>@if($res->replacement_person_agreement==0)
                                            <div class="label label-warning">Pending
                                            </div> @elseif($res->replacement_person_agreement==1)
                                            <div class="label label-success">Approved</div> @else
                                            <div class="label label-danger">Canceled</div>@endif</td>
                                    <td class="text-center">
                                        {{-- @if($res->recommend_officers_decision==0)
                                             <a href="/leave/recommend/accept/{{$res->leave_id}}" type="button"
                                                class="btn btn-warning btn-xs">Pending</a>
                                         @elseif($res->recommend_officers_decision==1)
                                             <a href="/leave/recommend/cancel/{{$res->leave_id}}" type="button"
                                                class="btn btn-success btn-xs">Approved</a>
                                         @else
                                             <a href="/leave/recommend/accept/{{$res->leave_id}}" type="button"
                                                class="btn btn-danger btn-xs">Canceled</a>
                                         @endif
     --}}

                                        <div class="btn-group">
                                            <a href="javascript:void(0);" data-toggle="dropdown"
                                               class="btn btn-default btn-xs dropdown-toggle">
                                                <em class="fa fa-angle-down"></em>

                                                @if($res->recommend_officers_decision==0)
                                                    <button
                                                            class="btn btn-warning btn-xs">Pending
                                                    </button>
                                                @elseif($res->recommend_officers_decision==1)
                                                    <button
                                                            class="btn btn-success btn-xs">Approved
                                                    </button>
                                                @else
                                                    <button
                                                            class="btn btn-danger btn-xs">Canceled
                                                    </button>
                                                @endif</a>
                                            <ul class="dropdown-menu pull-right text-left">
                                                <li><a href="/leave/recommend/accept/{{$res->leave_id}}">Accept</a></li>
                                                <li><a href="/leave/recommend/cancel/{{$res->leave_id}}">Cancel</a></li>

                                            </ul>
                                        </div>

                                    </td>
                                    <td class="text-center">

                                        <div class="btn-group">
                                            <a href="javascript:void(0);" data-toggle="dropdown"
                                               class="btn btn-default btn-xs dropdown-toggle">
                                                <em class="fa fa-angle-down"></em>

                                                @if($res->grant_officers_decision==0)
                                                    <button
                                                            class="btn btn-warning btn-xs">Pending
                                                    </button>
                                                @elseif($res->grant_officers_decision==1)
                                                    <button
                                                            class="btn btn-success btn-xs">Approved
                                                    </button>
                                                @else
                                                    <button
                                                            class="btn btn-danger btn-xs">Canceled
                                                    </button>
                                                @endif</a>
                                            <ul class="dropdown-menu pull-right text-left">
                                                <li><a href="/leave/grant/accept/{{$res->leave_id}}">Accept</a></li>
                                                <li><a href="/leave/grant/cancel/{{$res->leave_id}}">Cancel</a></li>

                                            </ul>
                                        </div>
                                    </td>


                                    {{-- <td>{{$res->dateofbirth}}</td>--}}
                                    {{-- <td class="text-center">
                                         <div class="btn-group">
                                             <a href="javascript:void(0);" data-toggle="dropdown"
                                                class="btn btn-default btn-xs dropdown-toggle">
                                                 <em class="fa fa-angle-down"></em>Action</a>
                                             <ul class="dropdown-menu pull-right text-left">
                                                 <li><a href="/leave/edit/{{$res->leave_id}}">Edit</a></li>
                                                 <li><a href="/leave/destroy/{{$res->leave_id}}">Delete</a></li>

                                             </ul>
                                         </div>
                                     </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        $('.datepicker').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('.datepicker').datepicker("setDate", new Date());
    </script>

@endsection