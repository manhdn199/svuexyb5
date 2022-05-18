@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
    <?php
    $user = auth()->user();
    $role = $user->userHasRole->role_id;
    ?>
    <div class="container-fluid">
        <div class="row ">
            <style>
                .dropdowndate {
                    /*background-color: #3498DB;*/
                    color: black;
                    font-size: 16px;
                    border: 1px solid silver;
                    cursor: pointer;
                }

                .dropbtn {
                    /*background-color: #3498DB;*/
                    color: black;
                    font-size: 16px;
                    border: solid 1px silver;
                    cursor: pointer;
                }

                .radioChoose {
                    margin: 10px;
                }

                /*.dropbtn:hover, .dropbtn:focus {*/
                /*    background-color: #2980B9;*/
                /*}*/

                .dropdown {
                    position: relative;
                    display: inline-block;
                }

                .dropdown-content {
                    width: 225px !important;
                    display: none;
                    position: absolute;
                    background-color: #f1f1f1;
                    min-width: 160px;
                    overflow: auto;
                    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                    z-index: 1;
                }

                .dropdown-content a {
                    color: black;
                    padding: 12px 16px;
                    text-decoration: none;
                    display: block;
                }

                .dropdown a:hover {
                    background-color: #ddd;
                }

                .dropdown-content a:hover {
                    background-color: #ddd;
                }

                .dropdown:hover .dropdown-content {
                    display: block;
                }

                .dropdown:hover .dropbtn {
                    background-color: silver;
                }

                .show {
                    display: block;
                }
            </style>

            <style>
                .dropbtn {
                    /*background-color: #3498DB;*/
                    color: white;
                    font-size: 16px;
                    border: none;
                    cursor: pointer;
                }

                /*.dropbtn:hover, .dropbtn:focus {*/
                /*    background-color: #2980B9;*/
                /*}*/

                .dropdown {
                    position: relative;
                    display: inline-block;
                }

                .dropdown-content {
                    width: 467px !important;
                    display: none;
                    position: absolute;
                    background-color: #f1f1f1;
                    min-width: 160px;
                    overflow: auto;
                    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                    z-index: 1;
                }

                .dropdown-content a {
                    color: black;
                    padding: 12px 16px;
                    text-decoration: none;
                    display: block;
                }

                .dropdown a:hover {
                    background-color: #ddd;
                }

                .dropdown-content a:hover {
                    background-color: #ddd;
                }

                .dropdown:hover .dropdown-content {
                    display: block;
                }

                .dropdown:hover .dropbtn {
                    /*background-color: #3e8e41*/
                }

                .show {
                    display: block;
                }
            </style>
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
                        @if($role == 2 || $role == 1)
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
                        @else
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ asset('employee_report') }}">Reports</a>
                            </li>
                        @endif
                    </ul>
                </nav>
                {{--end_menu--}}
            </div>

            <div class="col-md">
                <div style="margin-bottom: 1rem">
                    <form action="{{ $_SERVER['REQUEST_URI'] }}" method="get">
                        <div class="dropdown">
                            <input type="text" name="search" class="dropbtn form-control search" placeholder="Search">
                            <div id="myDropdown" class="dropdown-content">
                                <div class="radioChoose">
                                    <input type="radio" name="option" value="position" checked="checked"/> Position
                                    <input type="radio" name="option" value="project"/> Project
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

                {{--form Filter--}}
                <div>
                    <div class="dropdown dropdowndate">
                        <form action="{{route('reportsEmployee')}}" method="get">
                            <button class="dropbtn btn" style="    color: black;">Set date</button>

                            <div id="myDropdown" class="dropdown-content">
                                <span>Start</span>
                                <input type="date" name="start" class="form-control">
                                <span>End</span>
                                <input type="date" name="end" class="form-control">
                            </div>
                        </form>
                    </div>
                </div>
                {{--end form Filter--}}
                <div>
                    <form action="" method="post">
                        @csrf

                        <table class="table">
                            <tr>
                                <th>Detail</th>
                                <th>
                                    Project
                                </th>
                                <th>
                                    Position
                                </th>
                                <th>
                                    Working_time
                                </th>
                                <th>
                                    Working_type
                                </th>
                                <th>
                                    Time
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            @foreach( $reports as $value)
                                <tr>
                                    <td>
                                        <span>
                                            {{ $value->detail }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            {{ $value->projectName }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            {{ $value->position }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            {{ $value->working_time }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            {{ $value->working_type }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            {{ $value->time }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="color: yellow">
                                            {{$value->status}}
                                        </span>
                                    </td>
                                    <td>
                                        @if($value->status = 'waiting')
                                            <a href="{{route('editReport',$value->id)}}">Edit</a>
                                            <a href="{{route('deleteReport',$value->id)}}">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $reports->links() }}
                    </form>
                    <div class="row mb-0">
                        <div class="col-md-6">
                            <a type="submit" class="btn btn-primary" href="{{route('showFormAddReport')}}">
                                Add
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("input[name='option']").live("change", function () {
                if ($(this).val() == "position") {
                    $("input.search").attr("name", "position");
                } else if ($(this).val() == "project") {
                    $("input.search").attr("name", "project");
                }
            })
        });
    </script>
@endsection

