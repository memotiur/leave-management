<nav role="navigation" class="navbar navbar-default navbar-top navbar-fixed-top">

    <div class="navbar-header">
        <a href="#" class="navbar-brand">
            <div class="brand-logo">Leave Management</div>
            <div class="brand-logo-collapsed">LM</div>
        </a>
    </div>


    <div class="nav-wrapper">

        <ul class="nav navbar-nav">
            <li>
                <a href="#" data-toggle="aside">
                    <em class="fa fa-align-left"></em>
                </a>
            </li>
        </ul>


        <ul class="nav navbar-nav navbar-right">


            <li class="dropdown dropdown-list">
                <a href="#" data-toggle="dropdown" data-play="bounceIn" class="dropdown-toggle">
                    <em class="fa fa-bell"></em>
                    @if( Session::get('designation')=="Commissioner"
                        OR Session::get('designation')=="ADC/JC"
                        OR Session::get('designation')=="DC/AC")
                        <div class="label @if(sizeof($unseen_notifications)+sizeof($unseen_replacement_notifications)==0) label-success @else label-danger @endif">{{sizeof($unseen_notifications)+sizeof($unseen_replacement_notifications)}}</div>

                    @else
                        <div class="label @if(sizeof($unseen_replacement_notifications)==0) label-success @else label-danger @endif">{{sizeof($unseen_replacement_notifications)}}</div>

                    @endif
                 </a>

                <ul class="dropdown-menu">
                    @if( Session::get('designation')=="Commissioner"
                         OR Session::get('designation')=="ADC/JC"
                         OR Session::get('designation')=="DC/AC")
                        @foreach($unseen_notifications as $unseen_notification)
                            <li>
                                <div class="list-group">

                                    <a href="/leave/all" class="list-group-item">
                                        <div class="media">
                                            <div class="pull-left">
                                                <em class="fa fa-envelope-o fa-2x text-success"></em>
                                            </div>
                                            <div class="media-body clearfix">
                                                <div class="media-heading">Leave Request
                                                    from- {{$unseen_notification->name}}</div>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            </li>
                        @endforeach
                    @endif

                    @foreach($unseen_replacement_notifications as $unseen_notification)
                        <li>
                            <div class="list-group">

                                <a href="/leave/replacement" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left">
                                            <em class="fa fa-envelope-o fa-2x text-success"></em>
                                        </div>
                                        <div class="media-body clearfix">
                                            <div class="media-heading">Replacement Request
                                                from- {{$unseen_notification->name}}</div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </li>
                    @endforeach
                </ul>

            </li>


            <li class="dropdown">
                <a href="#" data-toggle="dropdown" data-play="bounceIn" class="dropdown-toggle">
                    <em class="fa fa-user"></em>
                </a>

                <ul class="dropdown-menu">
                    <li><a href="/user/profile">Profile</a>

                    <li><a href="/logout">Logout</a>
                    </li>
                </ul>

            </li>

        </ul>

    </div>


</nav>