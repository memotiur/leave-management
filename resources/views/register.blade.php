<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="/app/css/bootstrap.css">

    <link rel="stylesheet" href="/plugins/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/plugins/animo/animate%2banimo.css">
    <link rel="stylesheet" href="/plugins/csspinner/csspinner.min.css">

    <link rel="stylesheet" href="/app/css/app.css">

    <script src="/plugins/modernizr/modernizr.js" type="application/javascript"></script>

    <script src="/plugins/fastclick/fastclick.js" type="application/javascript"></script>
</head>
<body>

<div style="height: 100%; padding: 50px 0; background-color: #2c3037" class="row row-table">
    <div class="col-lg-5 col-md-7 col-sm-8 col-xs-12 align-middle">

        <div data-toggle="play-animation" data-play="fadeInUp" data-offset="0" class="panel panel-default panel-flat">



            <p class="text-center mb-lg">
                <br>
                <a href="#">
                    <img src="/images/logo.png" alt="Image" width="75px" class="block-center img-rounded">
                </a>
            </p>
            <p class="text-center mb-lg">
                <strong>SIGN UP TO CONTINUE.</strong>
            @if(session('success'))

                <div class="alert alert-success">{{session('success')}}!</div>

            @endif
            @if(session('failed'))
                <div class="alert alert-danger">
                    {{session('failed')}}!
                </div>
                @endif
            </p>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="/user/registration/save"
                      enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Full Name</label>
                        <div class="col-lg-9">
                            <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                            <input type="text" placeholder="Full Name" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Username</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="Username" class="form-control" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Phone</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="Phone" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email</label>
                        <div class="col-lg-9">
                            <input type="email" placeholder="Email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Date of joining</label>
                        <div class="col-lg-9">
                            <input type="date" placeholder="Date of joining" class="form-control" name="dateofjoining">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Date of Birth</label>
                        <div class="col-lg-9">
                            <input type="date" placeholder="Date of Birth" class="form-control" name="dateofbirth">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Designation</label>
                        <div class="col-lg-9">
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
                        <label class="col-lg-3 control-label">Write Here</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="designation2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Image</label>
                        <div class="col-lg-9">
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Password</label>
                        <div class="col-lg-9">
                            <input type="password" placeholder="Password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group" style="display: none">
                        <label class="col-lg-3 control-label">Leave Approval Authority</label>
                        <div class="col-lg-9">
                            <select class="chosen-select form-control m-b" name="authority_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <button type="submit" class="btn btn-sm btn-primary btn-block">Registration</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <a href="/login" type="submit" class="btn btn-sm btn-success btn-block">Login</a>
                        </div>
                    </div>
                </form>
            </div>
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

<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="/plugins/animo/animo.min.js"></script>

<script src="/app/js/pages.js"></script>

</body>

</html>