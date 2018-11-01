<aside class="aside">

    <nav class="sidebar">
        <ul class="nav">

            <li>
                <div data-toggle="collapse-next" class="item user-block has-submenu">

                    <div class="user-block-picture">
                        <img src="/images/user/{{Session::get('profile_pic')}}" alt="Avatar" width="60" height="60"
                             class="img-thumbnail img-circle">

                        <div class="user-block-status">
                            <div class="point point-success point-lg"></div>
                        </div>
                    </div>

                    <div class="user-block-info">
                        <span class="user-block-name item-text">{{ Session::get('name')}}</span>
                        <span class="user-block-role">{{ Session::get('designation')}}</span>

                    </div>
                </div>
            </li>


            <li class="">
                <a href="/admin-home" title="Dashboard" class="">
                    <em class="fa fa-dashboard"></em>
                    <span class="item-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="#" title="Charts" data-toggle="collapse-next" class="has-submenu">
                    <em class="fa fa-mail-forward"></em>
                    <span class="item-text">My Application</span>
                </a>

                <ul class="nav collapse ">
                    <li>
                        <a href="/leave/create" title="Flot" data-toggle="" class="no-submenu">
                            <span class="item-text">Apply For Leave</span>
                        </a>
                    </li>
                    <li>
                        <a href="/leave/show" title="Radial" data-toggle="" class="no-submenu">
                            <span class="item-text"> Leave Show</span>
                        </a>
                    </li>
                    {{-- <li>
                         <a href="/leave/accepted" title="Radial" data-toggle="" class="no-submenu">
                             <span class="item-text">Accepted Leave</span>
                         </a>
                     </li>
                     <li>
                         <a href="/leave/pending" title="Radial" data-toggle="" class="no-submenu">
                             <span class="item-text">Pending Leave</span>
                         </a>
                     </li>
                     <li>
                         <a href="/declined-leave" title="Radial" data-toggle="" class="no-submenu">
                             <span class="item-text">Declined Leave</span>
                         </a>
                     </li>--}}
                </ul>

            </li>

            @if( Session::get('designation')=="Commissioner"
                OR Session::get('designation')=="ADC/JC"
                OR Session::get('designation')=="DC/AC")
                <li class="">
                    <a href="/leave/all" title="Dashboard" class="">
                        <em class="fa fa-envelope-o"></em>
                        <span class="item-text">All Application</span>
                    </a>
                </li>
            @endif

            <li class="">
                <a href="/leave/replacement" title="Dashboard" class="">
                    <em class="fa fa-signal"></em>
                    <span class="item-text">Replacement Request</span>
                </a>
            </li>

            @if(Session::get('designation')=="DC/AC")
                <li class="">
                    <a href="/user/account-activate" title="Dashboard" class="">
                        <em class="fa fa-signal"></em>
                        <span class="item-text">Account Activate Request</span>
                    </a>
                </li>
            @endif


            @if( Session::get('designation')=="Commissioner"
                OR Session::get('designation')=="ADC/JC"
                OR Session::get('designation')=="DC/AC")
                <li>
                    <a href="#" title="Tables" data-toggle="collapse-next" class="has-submenu">
                        <em class="fa fa-users"></em>
                        <span class="item-text">Manage User</span>
                    </a>

                    <ul class="nav collapse ">
                        <li>
                            <a href="/user/create" title="Data Table" data-toggle="" class="no-submenu">
                                <span class="item-text">New User</span>
                            </a>
                        </li>
                        <li>
                            <a href="/user/show" title="Standard" data-toggle="" class="no-submenu">
                                <span class="item-text">All User</span>
                            </a>
                        </li>
                    </ul>

                </li>
            @endif

            <li class="">
                <a href="/user/profile" title="Dashboard" class="">
                    <em class="fa fa-user"></em>
                    <span class="item-text">My Profile</span>
                </a>
            </li>
            <li class="">
                <a href="/user/profile/edit" title="Dashboard" class="">
                    <em class="fa fa-cog"></em>
                    <span class="item-text">Setting</span>
                </a>
            </li>
            <li class="">
                <a href="/logout" title="Dashboard" class="">
                    <em class="fa fa-sign-out"></em>
                    <span class="item-text">Logout</span>
                </a>
            </li>
            <li class="nav-footer">
                <div class="nav-footer-divider"></div>

                <div class="btn-group text-center">
                    <button type="button" data-toggle="tooltip" data-title="Add Contact" class="btn btn-link">
                        <em class="fa fa-user text-muted"><sup class="fa fa-plus"></sup>
                        </em>
                    </button>
                    <button type="button" data-toggle="tooltip" data-title="Settings" class="btn btn-link">
                        <em class="fa fa-cog text-muted"></em>
                    </button>
                    <button type="button" data-toggle="tooltip" data-title="Logout" class="btn btn-link">
                        <em class="fa fa-sign-out text-muted"></em>
                    </button>
                </div>

            </li>
        </ul>
    </nav>

</aside>