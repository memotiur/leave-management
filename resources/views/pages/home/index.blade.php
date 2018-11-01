@extends('layouts.app')

@section('title', 'Page Title')


@section('content')

    <h3>Dashboard</h3>
    {{--     <div data-toggle="notify" data-onload
              data-message="&lt;b&gt;New Updates Available!&lt;/b&gt; Don't forget to check them!"
              data-options="{&quot;status&quot;:&quot;danger&quot;, &quot;pos&quot;:&quot;top-right&quot;}"
              class="hidden-xs"></div>
         <div class="row">--}}

    <div class="col-md-9">

        <div class="row">
            <div class="col-lg-3 col-sm-6">

                <div data-toggle="play-animation" data-play="fadeInDown" data-offset="0" data-delay="100"
                     class="panel widget">
                    <div class="panel-body bg-primary">
                        <div class="row row-table row-flush">
                            <div class="col-xs-8">
                                <p class="mb0">Users</p>
                                <h3 class="m0">{{$user_count}}</h3>
                            </div>
                            <div class="col-xs-4 text-center">
                                <em class="fa fa-user fa-2x"><sup class="fa fa-plus"></sup>
                                </em>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="text-center">
                            <div data-bar-color="primary" data-height="30" data-bar-width="6"
                                 data-bar-spacing="6" class="inlinesparkline inline">
                                5,3,4,6,5,9,4,4,10,5,9,6,4
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">

                <div data-toggle="play-animation" data-play="fadeInDown" data-offset="0" data-delay="500"
                     class="panel widget">
                    <div class="panel-body bg-warning">
                        <div class="row row-table row-flush">
                            <div class="col-xs-8">
                                <p class="mb0">Leave Request</p>
                                <h3 class="m0">{{$leave_count}}</h3>
                            </div>
                            <div class="col-xs-4 text-center">
                                <em class="fa fa-mail-reply fa-2x"></em>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="text-center">
                            <div data-bar-color="warning" data-height="30" data-bar-width="6"
                                 data-bar-spacing="6" class="inlinesparkline inline">
                                10,30,40,70,50,90,70,50,90,40,40,60,40
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">

                <div data-toggle="play-animation" data-play="fadeInDown" data-offset="0" data-delay="1000"
                     class="panel widget">
                    <div class="panel-body bg-danger">
                        <div class="row row-table row-flush">
                            <div class="col-xs-8">
                                <p class="mb0">Canceled </p>
                                <h3 class="m0">{{$failed}}</h3>
                            </div>
                            <div class="col-xs-4 text-center">
                                <em class="fa fa-question fa-2x"></em>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="text-center">
                            <div data-bar-color="danger" data-height="30" data-bar-width="6"
                                 data-bar-spacing="6" class="inlinesparkline inline">
                                2,7,5,9,4,2,7,5,7,5,9,6,4
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">

                <div data-toggle="play-animation" data-play="fadeInDown" data-offset="0" data-delay="1500"
                     class="panel widget">
                    <div class="panel-body bg-success">
                        <div class="row row-table row-flush">
                            <div class="col-xs-8">
                                <p class="mb0">Accepted</p>
                                <h3 class="m0">{{$accepted}}</h3>
                            </div>
                            <div class="col-xs-4 text-center">
                                <em class="fa fa-check fa-2x"></em>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="text-center">
                            <div data-bar-color="success" data-height="30" data-bar-width="6"
                                 data-bar-spacing="6" class="inlinesparkline inline">
                                4,7,5,9,6,4,8,6,3,4,7,5,9
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--

                <div class="row">
                    <div class="col-md-4">

                        <div data-toggle="play-animation" data-play="fadeInLeft" data-offset="0" data-delay="1400"
                             class="panel widget">
                            <div class="panel-body">
                                <div class="text-right text-muted">
                                    <em class="fa fa-users fa-2x"></em>
                                </div>
                                <h3 class="mt0">120</h3>
                                <p class="text-muted">New followers added this month</p>
                                <div class="progress progress-striped progress-xs">
                                    <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 80%;" class="progress-bar progress-bar-success">
                                        <span class="sr-only">80% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">

                        <div data-toggle="play-animation" data-play="fadeInLeft" data-offset="0" data-delay="1400"
                             class="panel widget">
                            <div class="panel-body">
                                <div class="text-right text-muted">
                                    <em class="fa fa-bar-chart-o fa-2x"></em>
                                </div>
                                <h3 class="mt0">$ 6530</h3>
                                <p class="text-muted">Average Monthly Income</p>
                                <div class="progress progress-striped progress-xs">
                                    <div role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 40%;" class="progress-bar progress-bar-info">
                                        <span class="sr-only">40% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">

                        <div data-toggle="play-animation" data-play="fadeInLeft" data-offset="0" data-delay="1400"
                             class="panel widget">
                            <div class="panel-body">
                                <div class="text-right text-muted">
                                    <em class="fa fa-trophy fa-2x"></em>
                                </div>
                                <h3 class="mt0">$ 65812</h3>
                                <p class="text-muted">Yearly Income Goal</p>
                                <div class="progress progress-striped progress-xs">
                                    <div role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 60%;" class="progress-bar progress-bar-warning">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

        --}}

        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Requests
                        <a href="#" data-perform="panel-dismiss" data-toggle="tooltip" title="Close Panel"
                           class="pull-right">
                            <em class="fa fa-times"></em>
                        </a>
                        <a href="#" data-perform="panel-collapse" data-toggle="tooltip"
                           title="Collapse Panel" class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Requested By</th>
                                <th>From - To</th>
                                <th>Duration</th>
                                <th>Reason</th>
                                <th>Replacement Officer Approval</th>
                                <th>Recommending Officer</th>
                                <th>Approving Authority</th>
                            </tr>
                            </thead>
                            <tbody>


                            <tr>
                            @foreach($all_leave_request as $res)
                                <tr class="gradeX">
                                    <td>{{$res->name}}</td>
                                    <td>{{$res->applicant_leave_from}} - {{$res->applicant_leave_to}}</td>
                                    <td>{{$res->applicant_leave_duration}} Days</td>
                                    <td>{{$res->applicant_leave_reason}}</td>
                                    <td>@if($res->replacement_person_agreement==0)
                                            <div class="label label-warning">Pending
                                            </div> @elseif($res->replacement_person_agreement==1)
                                            <div class="label label-success">Approved</div> @else
                                            <div class="label label-danger">Canceled</div>@endif</td>
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

                    <div class="panel-footer text-right">
                        <a href="#">
                            <small>View all</small>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <div class="col-md-3">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Activity feed</div>
            </div>

            <div class="list-group">

                @foreach($all_leave_request as $all_leave)

                    <div class="list-group-item">
                        <div class="media">
                            <div class="pull-left">
<span class="fa-stack fa-lg">
<em class="fa fa-circle fa-stack-2x text-green"></em>
<em class="fa fa-bell fa-stack-1x fa-inverse text-white"></em>
</span>
                            </div>
                            <div class="media-body clearfix">

                                <p class="m0">
                                    <small>Leave Request
                                        from- {{$all_leave->name}}</small>
                                </p>
                                <small>{{$all_leave->created_at}}</small>
                            </div>
                        </div>
                    </div>

                @endforeach


            </div>


            <div class="panel-footer clearfix">
                <a href="#" class="pull-left">
                    <small>Load more</small>
                </a>
            </div>

        </div>
    </div>

    </div>


@endsection