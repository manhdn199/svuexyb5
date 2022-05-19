@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
    <?php
    $roleAdmin = config('constants.admin');
    $roleManage = config('constants.manager');
    $roleMember = config('constants.member');
    $user = auth()->user();
    $role = $user->userHasRole->role_id;
    $day = date('01-m-Y');
    $today = date('d-m-Y');
    ?>

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
                        @if($role == $roleManage || $role == $roleAdmin)
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{route('users')}}">Users</a>
                            </li>
                            @if( $role == $roleAdmin )
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
                    <form method="POST" action="{{ route('editHasProject',$hasProject->id) }}">
                        @csrf
                        <table class="table">
                            <tr>
                                <th width="50%">
                                    User
                                </th>
                                <th>
                                    Role
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="user_id" id="" class="form-control">
                                        <option name="user_id" value="{{$hasProject->user_id}}"
                                                class="form-control">{{$hasProject->nameUser}}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="project_id" id="role_id" class="form-control">
                                        @foreach($projects as $v)
                                            @if($v->id == $hasProject->project_id )
                                                <option selected name="project_id" value="{{$v->id}}"
                                                        class="form-control">{{$v->name}}</option>
                                            @endif
                                            <option name="project_id" value="{{$v->id}}"
                                                    class="form-control">{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>@if(!empty($error))
                                    <td class="alert-warning">
                                        <div class="alert alert-warning" role="alert">
                                            <span>{{ $error }}</span>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        </table>
                        <div class="row mb">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

