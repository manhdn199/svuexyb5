@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
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
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{asset('users')}}">Users</a>
                        </li>
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{ asset('roles') }}">Roles</a>
                        </li>
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{ asset('projects') }}">Projects</a>
                        </li>
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{ asset('reports') }}">Reports</a>
                        </li>
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{ asset('userHasRole') }}">User add Role</a>
                        </li>
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{ asset('userHasProject') }}">User add Projects</a>
                        </li>
                    </ul>
                </nav>
                {{--end_menu--}}
            </div>
            <div class="col-md">
                <div>
                    <form method="get" action="">
                        @csrf

                        <table class="table">
                            <tr>
                                <th>
                                    User
                                </th>
                                <th>
                                    Project
                                </th>
                            </tr>
                            @foreach( $userHasProject as $value)
                                <tr>
                                    <td>
                                        <input type="text" name="user_id" value="{{$value->userName}}"
                                               class="form-control" disabled>
                                    </td>
                                    <td>
                                        <input type="text" name="project_id" value="{{$value->projectName}}"
                                               class="form-control" disabled>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $userHasProject->links() }}
                    </form>
                    <div class="row mb-0">
                        <div class="col-md-6 ">
                            <a class="btn btn-primary" href=" {{ route('viewAddUserHasProject') }}">
                                Add
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


