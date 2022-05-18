@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
    <?php
    $roleAdmin = config('constants.admin');
    $roleManage = config('constants.manage');
    $roleMember = config('constants.member');
    $users = auth()->user();
    $roler = $users->userHasRole->role_id;
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
            {{--        menu--}}
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
                    <form method="POST" action="{{ route('addUserHasRole') }}">
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
                                        @foreach( $user as $value)
                                            <option value="{{$value->id}}"
                                                    class="form-control">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="role_id" id="role_id" class="form-control">
                                        @foreach( $role as $value)
                                            <option value="{{$value->id}}"
                                                    class="form-control">{{$value->name}}</option>
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
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

