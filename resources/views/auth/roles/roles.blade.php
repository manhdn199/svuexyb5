@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
    <?php
    $roleAdmin = config('constants.admin');
    $roleManage = config('constants.manager');
    $roleMember = config('constants.member');
    $user = auth()->user();
    $roler = $user->userHasRole->role_id;
    $day = date('01-m-Y');
    $today = date('d-m-Y');
    ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <div class="container-fluid">
        <div class="row ">
            <style>
                .menu_beet > nav > ul > li > a {
                    color: black !important;
                    width: 100%;
                }

                .menu_beet > nav > ul {
                    width: 100%;
                }

                .menu_beet > nav > ul > li {
                    margin: 2px 0 2px 0;

                }

                .menu_beet > nav > ul > li:hover {
                    background: silver;
                    transition: 1s;
                }
            </style>
            {{--menu--}}
            <div class="col-md-3 menu_beet" style="height: 100%">
                <nav class="navbar  navbar-dark justify-content-center"
                     style="padding-bottom: 100%; border-right: solid 1px silver">
                    <!-- Links -->
                    <ul class="navbar-nav">
                        @if($roler == $roleManage || $roler == $roleAdmin)
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{route('users')}}">Users</a>
                            </li>
                            @if( $roler == $roleAdmin )
                                <li class="nav-item btn ">
                                    <a class="nav-link " href="{{ route('roles') }}">Roles</a>
                                </li>
                            @endif
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('projects') }}">Projects</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('reports') }}">Reports</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('userHasRole') }}">User add Role</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('userHasProject') }}">User add Projects</a>
                            </li>
                        @else
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('reportsEmployee') }}">Reports</a>
                            </li>
                        @endif

                    </ul>
                </nav>
                {{--end_menu--}}
            </div>
            <div class="col-md">
                <div>
                    <a class="btn btn-success" href="{{ route('viewAddRole') }}">Add</a>
                    <form action="" method="post">
                        @csrf
                        @if(!empty($errors))
                            <span>
                                <strong>
                                    @foreach($errors as $value)
                                        <div class="alert alert-warning" role="alert">
                                          {{$value}}
                                        </div>
                                    @endforeach
                                </strong>
                            </span>
                        @endif
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>@sortablelink('name', __('Name'), ['page' => request()->get('page')])</th>
                                <th>Action</th>
                            </tr>
                            @foreach($role as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->name  }}</td>
                                    <td>
                                        <a href="{{ route('viewEditRole',$value->id) }}"> Edit</a>
                                        <a onclick="return confirm('Do u want delete?')"
                                           href="{{route('deleteRole',$value->id)}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $role->appends(\Request::all())->render() !!}


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


