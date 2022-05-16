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
                    <form method="POST" action="{{ route('addUserHasRole') }}">
                        @csrf

                        <div class="row mb-3">
                            <table class="table">
                                <tr>
                                    <td>
                                        Name
                                    </td>
                                    <td>
                                        Role
                                    </td>
                                </tr>
                                @foreach($userHasRole as $value)
                                    <tr>
                                        <td>
                                            {{$value->userName}}
                                        </td>
                                        <td>
                                            {{$value->roleName}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {{ $userHasRole->links() }}

                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 ">
                                <a href="{{ route('viewAddUserHasRole') }}" class="btn btn-success">
                                    Add
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

