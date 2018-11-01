@extends('layouts.app')

@section('title', 'Update User')


@section('content')
    <h3>Update User</h3>
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
            <div class="panel-heading">Update User</div>

            <div class="panel-body">

                <form class="form-horizontal" method="post" action="/user/update"
                      enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Leave Approval Authority</label>
                        <div class="col-lg-10">
                            <select class="chosen-select form-control m-b" name="authority_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 control-label">Full Name</label>
                        <div class="col-lg-10">
                            <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" class="form-control" name="id" value="{{$result->id}}">
                            <input type="text" placeholder="Full Name" class="form-control" name="name" value="{{$result->name}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="Username" class="form-control" value="{{$result->username}}" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Phone</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="Phone" class="form-control" value="{{$result->phone}}" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" placeholder="Email" class="form-control" value="{{$result->email}}"  name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Date of joining</label>
                        <div class="col-lg-10">
                            <input type="date" placeholder="Date of joining" class="form-control" value="{{$result->dateofjoining}}" name="dateofjoining">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Date of Birth</label>
                        <div class="col-lg-10">
                            <input type="date" placeholder="Date of Birth" class="form-control" value="{{$result->dateofbirth}}" name="dateofbirth">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Designation</label>
                        <div class="col-lg-10">
                            <select name="designation" class="form-control m-b" onchange="jsfunc1()" id="designation">
                                <option @if($result->designation=="Commissioner") selected @endif>Commissioner</option>
                                <option @if($result->designation=="ADC/JC") selected @endif>ADC/JC</option>
                                <option @if($result->designation=="DC/AC") selected @endif>DC/AC</option>
                                <option @if($result->designation=="RO/ARO") selected @endif>RO/ARO</option>
                                <option @if($result->designation!=null) selected @endif>Other</option>
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
                            <input type="hidden" class="form-control" name="profile_pic" value="{{$result->profile_pic}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" placeholder="Password" class="form-control" name="password" required>
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
        function jsfunc1(){

            if(document.getElementById('designation').value == "Other") {
                document.getElementById("designation2").style.display ='block';
            }else{
                document.getElementById("designation2").style.display ='none';
            }
        }
    </script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        $('#datepicker').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepicker').datepicker("setDate", new Date());
    </script>
@endsection