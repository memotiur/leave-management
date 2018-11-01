@extends('layouts.app2')

@section('title', 'Create Leave')


@section('content')
    <h3>Create Leave</h3>
    <hr>

    <div class="col-sm-12">
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
            <div class="panel-heading">New Leave</div>

            <div class="panel-body">

                <form class="form-horizontal" method="post" action="/leave/store"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Applicant Name</label>
                        <div class="col-lg-9">
                            <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">

                            <input type="hidden" class="form-control" name="user_id" value="{{$result->id}}">
                            <input type="text" placeholder="Full Name" value="{{$result->name}}" disabled
                                   class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Designation</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="designation" disabled
                                   value="{{$result->designation}}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 control-label">Leave From</label>
                        <div class="col-lg-9">
                            <input placeholder="Leave From" class="form-control datepicker"
                                   name="applicant_leave_from" data-date-format="mm/dd/yyyy" id="fdate" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Leave To</label>
                        <div class="col-lg-9">
                            <input placeholder="Leave To" class="form-control datepicker" name="applicant_leave_to"
                                   data-date-format="mm/dd/yyyy" id="tdate" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Duration (Days)</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="Duration" class="form-control"
                                   name="applicant_leave_duration" id="days" re>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Reason</label>
                        <div class="col-lg-9">
                            <textarea type="text" placeholder="Leave Reason" class="form-control"
                                      name="applicant_leave_reason" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Leave Type</label>
                        <div class="col-lg-9">

                            <select name="applicant_leave_type" class="form-control m-b" onchange="jsfunc1()" id="leave_type">
                                <option>CL</option>
                                <option>EL</option>
                                <option>ML</option>
                                <option>EXBD</option>
                                <option>SL</option>
                                <option>R&R</option>
                                <option>Other</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="applicant_available_holidays2" >
                        <label class="col-lg-3 control-label">Available CL Holidays</label>
                        <div class="col-lg-9">
                            <input type="number" placeholder="Available Holidays" class="form-control"
                                  value="{{$cl_counter}}" disabled>
                        </div>
                    </div>

                    <div class="form-group"  style="display: none">
                        <label class="col-lg-3 control-label">Available CL Holidays</label>
                        <div class="col-lg-9">
                            <input type="number" placeholder="Available Holidays" class="form-control"
                                   name="applicant_available_holidays2" value="{{$cl_counter}}">
                        </div>
                    </div>

                    <div class="form-group" style="display: none" id="applicant_available_holidays">
                        <label class="col-lg-3 control-label">Available Holidays</label>
                        <div class="col-lg-9">
                            <input type="number" placeholder="Available Holidays" class="form-control"
                                   name="applicant_available_holidays" value="0">
                        </div>
                    </div>

                    {{--                    File--}}

                    <div class="form-group" id="applicant_available_holidays2">
                        <label class="col-lg-3 control-label">Attachment Files</label>
                        <div class="col-lg-9">
                            <input type="file" class="form-control"
                                   name="attachment1">
                            <input type="file" class="form-control"
                                   name="attachment2">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 control-label">Last Enjoyed  Leave from</label>
                        <div class="col-lg-9">
                            <input placeholder="Last Enjoyed Leave  from" class="form-control datepicker"
                                   name="applicant_taken_leave_from" data-date-format="dd/mm/yyyy"
                                   value="@if(!is_null($last_leave)){{$last_leave->applicant_taken_leave_from}}  @endif"
                                   @if(is_null($last_leave))id="applicant_taken_leave_from" @endif>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Last Enjoyed Leave To</label>
                        <div class="col-lg-9">
                            <input placeholder="Last Enjoyed Leave  To" class="form-control datepicker"
                                   name="applicant_taken_leave_to" data-date-format="dd/mm/yyyy"
                                   value="@if(!is_null($last_leave)){{$last_leave->applicant_taken_leave_to}}  @endif"
                                   @if(is_null($last_leave))id="applicant_taken_leave_to" @endif>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Last Enjoyed Leave Duration</label>
                        <div class="col-lg-9">
                            <input type="number" placeholder="Last Enjoyed Leave  Duration" class="form-control"
                                   name="applicant_taken_leave_duration"
                                   value="@if(!is_null($last_leave)){{$last_leave->applicant_taken_leave_duration}}@endif">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Leave Time Address</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="Leave Time Address " class="form-control"
                                   name="applicant_leave_time_location" re>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Leave Time contact number</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="applicant_leave_time_phone"
                                   value="{{$result->phone}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Replacement Officer</label>
                        <div class="col-lg-9">
                            <select class="chosen-select form-control m-b" name="replacement_person_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </div>
                </form>
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

    <script>
        $(function () {

            $('#fdate').datepicker({
                format: "dd-M-yy",
                todayHighlight: 'TRUE',
                autoclose: true,
                minDate: 0,
                maxDate: '+1Y+6M'
            }).on('changeDate', function (ev) {
                $('#tdate').datepicker('setStartDate', $("#fdate").val());
            });


            $('#tdate').datepicker({
                format: "dd-M-yy",
                todayHighlight: 'TRUE',
                autoclose: true,
                minDate: '0',
                maxDate: '+1Y+6M'
            }).on('changeDate', function (ev) {
                var start = $("#fdate").val();
                var startD = new Date(start);
                var end = $("#tdate").val();
                var endD = new Date(end);
                var diff = parseInt((endD.getTime() - startD.getTime()) / (24 * 3600 * 1000));
                $("#days").val(diff);
            });

        });

    </script>


    <script>
        function jsfunc1() {

            if (document.getElementById('leave_type').value == "CL") {
                document.getElementById("applicant_available_holidays2").style.display = 'block';
                document.getElementById("applicant_available_holidays").style.display = 'none';
            } else {
                document.getElementById("applicant_available_holidays").style.display = 'block';
                document.getElementById("applicant_available_holidays2").style.display = 'none';
            }
        }


        $('#applicant_taken_leave_to').datepicker();
        $('#applicant_taken_leave_to').val('');
        $('#applicant_taken_leave_from').datepicker();
        $('#applicant_taken_leave_from').val('');
    </script>





    <link rel="stylesheet" href="/plugins/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/plugins/animo/animate%2banimo.css">
    <link rel="stylesheet" href="/plugins/csspinner/csspinner.min.css">

    <link rel="stylesheet" href="/plugins/chosen/chosen.min.css">
    <link rel="stylesheet" href="/plugins/slider/css/slider.css">
    <link rel="stylesheet" href="/app/css/app.css">




{{--

    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>

    <script src="/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="/plugins/slider/js/bootstrap-slider.js"></script>
    <script src="/plugins/filestyle/bootstrap-filestyle.min.js"></script>

    <script src="/plugins/animo/animo.min.js"></script>

    <script src="/plugins/sparklines/jquery.sparkline.min.js"></script>

    <script src="/plugins/slimscroll/jquery.slimscroll.min.js"></script>


    <script src="/plugins/codemirror/lib/codemirror.js"></script>
    <script src="/plugins/codemirror/addon/mode/overlay.js"></script>
    <script src="/plugins/codemirror/mode/markdown/markdown.js"></script>
    <script src="/plugins/codemirror/mode/xml/xml.js"></script>
    <script src="/plugins/codemirror/mode/gfm/gfm.js"></script>
    <script src="/plugins/marked/marked.js"></script>

    <script src="/plugins/moment/min/moment-with-langs.min.js"></script>
    <script src="/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

    <script src="/plugins/tagsinput/bootstrap-tagsinput.min.js"></script>

    <script src="/plugins/inputmask/jquery.inputmask.bundle.min.js"></script>


    <script src="/app/js/app.js"></script>--}}
@endsection