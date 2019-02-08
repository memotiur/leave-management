@extends('layouts.app')

@section('title', 'Create User')


@section('content')
    <h3>Create User</h3>
    <hr>

    <div class="col-sm-10 col-md-offset-1">
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
            <div class="panel-heading">New User</div>

            <div class="panel-body">

                <form class="form-horizontal" method="post" action="/user/store"
                      enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Full Name</label>
                        <div class="col-lg-10">
                            <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                            <input type="text" placeholder="Full Name" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="Username" class="form-control" name="username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" placeholder="Password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="Phone" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" placeholder="Email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Date of joining</label>
                        <div class="col-lg-10">
                            <input  class="form-control datepicker" name="dateofjoining"
                                   data-date-format="dd/mm/yyyy" >

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Date of Birth</label>
                        <div class="col-lg-10">
                            <input  class="form-control datepicker" name="dateofbirth"
                                    data-date-format="dd/mm/yyyy" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Designation</label>
                        <div class="col-lg-10">
                            <select name="designation" class="form-control m-b" onchange="jsfunc1()" id="designation">
                                <option>Commissioner</option>
                                <option>ADC/JC</option>
                                <option>DC/AC</option>
                                <option>RO/ARO</option>
                                <option id="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="display: none" id="designation2">
                        <label class="col-lg-2 control-label">Write Here</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="designation2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Image</label>
                        <div class="col-lg-10">
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Leave Approval Authority</label>
                        <div class="col-lg-10">

                            <select class="chosen-select form-control m-b" name="authority_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach

                            </select>

                            {{-- <select class="chosen-select form-control m-b" name="authority_id">
                                 @foreach($users as $user)
                                     <option value="{{$user->id}}">{{$user->name}}</option>
                                 @endforeach
                                 <option value="1">Admin</option>
                             </select>--}}
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


    <script>
        function jsfunc1() {

            if (document.getElementById('designation').value == "Other") {
                document.getElementById("designation2").style.display = 'block';
            } else {
                document.getElementById("designation2").style.display = 'none';
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.css">
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