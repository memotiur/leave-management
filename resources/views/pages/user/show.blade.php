@extends('layouts.app')

@section('title', 'All User')


@section('content')
    <h3>All User</h3>
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
                <div class="panel-heading">User Table
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="datatable2" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                {{-- <th>#</th>--}}
                                <th>Name</th>
                                <th>Username</th>
                                <th>Designation</th>
                                <th>
                                    <div class="media">Photo</div>
                                </th>
                                {{-- <th>Email</th>--}}
                                {{-- <th class="sort-numeric">Phone</th>--}}
                                {{--<th class="sort-alpha">Joining date</th>--}}
                                {{--  <th>Birthdate</th>--}}
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($result as $res)
                                <tr class="gradeX">
                                    {{-- <td>{{$i++}}</td>--}}
                                    <td>{{$res->name}}</td>
                                    <td>{{$res->username}}</td>
                                    <td>{{$res->designation}}</td>
                                    <td>
                                        <div class="media">
                                            <img src="/images/user/{{$res->profile_pic}}" alt="Image"
                                                 class="img-responsive img-circle">
                                        </div>
                                    </td>
                                    {{-- <td>{{$res->email}}</td>--}}
                                    {{--  <td>{{$res->phone}}</td>--}}
                                    {{-- <td>{{$res->dateofjoining}}</td>--}}
                                    <td>
                                        @if($res->active_status==1)
                                            <button type="button"
                                                    class="btn btn-success btn-xs">Active
                                            </button>
                                        @elseif($res->active_status==420)
                                            <button type="button"
                                                    class="btn btn-danger btn-xs">E-Pending
                                            </button>
                                        @elseif($res->active_status==0)
                                            <button type="button"
                                                    class="btn btn-danger btn-xs">Pending
                                            </button>
                                        @else
                                            <button type="button"
                                                    class="btn btn-danger btn-xs">Inactive
                                            </button>
                                        @endif


                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="javascript:void(0);" data-toggle="dropdown"
                                               class="btn btn-default btn-xs dropdown-toggle">
                                                <em class="fa fa-angle-down"></em>Action</a>
                                            <ul class="dropdown-menu pull-right text-left">
                                                <li><a href="/user/edit/{{$res->id}}">Edit</a></li>
                                                <li><a href="/user/destroy/{{$res->id}}">Delete</a></li>
                                                @if($res->active_status!=1)
                                                    <li><a href="/user/active/{{$res->id}}">Activate</a></li>
                                                @else
                                                    <li><a href="/user/deactive/{{$res->id}}">Deactivate</a></li>
                                                @endif

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                {{--<th>
                                    <input type="text" class="form-control input-sm datatable_input_col_search">
                                </th>--}}
                                <th>
                                    <input type="text" class="form-control input-sm datatable_input_col_search">
                                </th>
                                <th>
                                    <input type="text" class="form-control input-sm datatable_input_col_search">
                                </th>
                                <th>
                                    <input type="text" class="form-control input-sm datatable_input_col_search">
                                </th>
                                <th>
                                    <input type="text" class="form-control input-sm datatable_input_col_search">
                                </th>
                                <th>
                                    <input type="text" class="form-control input-sm datatable_input_col_search">
                                </th>
                                <th>
                                    <input type="text" class="form-control input-sm datatable_input_col_search">
                                </th>
                            </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection