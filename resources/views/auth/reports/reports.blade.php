@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
    <?php
    $roleAdmin = config('constants.admin');
    $roleManage = config('constants.manager');
    $roleMember = config('constants.member');
    $status = config('constants.status');
    $accept = config('constants.accept');
    $user = auth()->user();
    $role = $user->userHasRole->role_id;
    $day = date('01-m-Y');
    $today = date('d-m-Y');
    ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

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
            {{--menu--}}
            <div class="col-md-3 menu_beet" style="height: 100%">
                @include('layouts.menu')

                {{--end_menu--}}
            </div>

            <div class="col-md">
                <div style="margin-bottom: 1rem">
{{--form search--}}
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
{{--end form search--}}

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
                {{--report by employee--}}
                    <form action="" method="post">
                        @csrf

                        <table class="table">
                            <tr>
                                <th>@sortablelink('detail', __('Detail'), ['page' => request()->get('page')])</th>

                                <th>@sortablelink('project', __('Project'), ['page' => request()->get('page')])</th>
                                <th>@sortablelink('position', __('Position'), ['page' => request()->get('page')])</th>
                                <th>@sortablelink('working_time', __('Working_time'), ['page' =>
                                    request()->get('page')])
                                </th>
                                <th>@sortablelink('working_type', __('Working_type'), ['page' =>
                                    request()->get('page')])
                                </th>
                                <th>@sortablelink('time', __('Time'), ['page' => request()->get('page')])</th>
                                <th>@sortablelink('status', __('Status'), ['page' => request()->get('page')])</th>

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
                                        @if($value->status == $status)
                                        <span style="color: yellow">
                                            {{$value->status}}
                                        </span>
                                        @else
                                            <span style="color: green">
                                            {{$value->status}}
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($value->status == $status)
                                            <a href="{{route('editReport',$value->id)}}">Edit</a>
                                            <a href="{{route('deleteReport',$value->id)}}">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $reports->appends(\Request::all())->render() !!}

                    </form>
                    <div class="row mb-0">
                        <div class="col-md-6">
                            <a type="submit" class="btn btn-primary" href="{{route('showFormAddReport')}}">
                                Add
                            </a>

                        </div>
                    </div>
                {{--end report by employee--}}

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

