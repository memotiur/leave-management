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
    <div class="col-lg-3 col-md-6 col-sm-8 col-xs-12 align-middle">

        <div data-toggle="play-animation" data-play="fadeInUp" data-offset="0" class="panel panel-default panel-flat">


            <p class="text-center mb-lg">
                <br>
                <a href="#">
                    <img src="/images/logo.png" alt="Image" width="75px" class="block-center img-rounded">
                </a>
            </p>
            <p class="text-center mb-lg">
                <strong>SIGN IN TO CONTINUE.</strong>
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
                    <form role="form" class="mb-lg" method="post" action="/login-check"
                          enctype="multipart/form-data">
                        {{-- <div class="text-right mb-sm"><a href="#" class="text-muted">Need to Signup?</a>
                         </div>--}}
                        <div class="form-group has-feedback">
                            <input id="exampleInputEmail1" type="text" placeholder="Username" >
                                   class="form-control" name="username">
                            <span class="fa fa-phone form-control-feedback text-muted"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input id="exampleInputPassword1" type="password" placeholder="Password">
                                   class="form-control" name="password">
                            <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                            <span class="fa fa-lock form-control-feedback text-muted"></span>
                        </div>
                        <div class="clearfix">
                            <div class="checkbox c-checkbox pull-left mt0">
                                <label>
                                    <input type="checkbox" value="">
                                    <span class="fa fa-check"></span>Remember Me</label>
                            </div>
                            <div class="pull-right"><a href="#" class="text-muted">Forgot your password?</a>
                            </div>
                            {{-- <div class="pull-right"><a href="/user/forget-pass" class="text-muted">Forgot your password?</a>
                             </div>--}}
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Login</button>
                        <a href="/user/registration" class="btn btn-block btn-success">Registration</a>
                    </form>
                </div>
        </div>

    </div>
</div>


<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="/plugins/animo/animo.min.js"></script>

<script src="/app/js/pages.js"></script>

</body>

</html>