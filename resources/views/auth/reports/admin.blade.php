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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <div class="container-fluid">
        <div class="row ">
            <style>
                .dropbtn {
                    /*background-color: #3498DB;*/
                    color: white;
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
            <!--menu-->
            <div class="col-md-3 menu_beet" style="height: 100%">
                @include('layouts.menu')
                {{--end_menu--}}
            </div>
            <div class="col-md">
                <div>
                    <form action="{{ $_SERVER['REQUEST_URI'] }}" method="get">
                        <div class="dropdown">
                            <input type="text" name="search" class="dropbtn form-control search" placeholder="Search">
                            <div id="myDropdown" class="dropdown-content">
                                <div class="radioChoose">
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="radio" name="option" value="user" checked="checked"/> User
                                            </td>
                                            <td>
                                                <input type="radio" name="option" value="project"/> Project
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="radio" name="option" value="position"/> Position
                                            </td>
                                            <td>
                                                <input type="radio" name="option" value="working_type"/> Working_type
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    {{--show reports --}}
                    <form action="" method="post">
                        @csrf

                        <table style="text-align: center" class="table">
                            <tr>
                                <th>@sortablelink('detail', __('Detail'), ['page' => request()->get('page')])</th>
                                <th>@sortablelink('user', __('User'), ['page' => request()->get('page')])</th>
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
                            @foreach( $report as $value)
                                <tr>
                                    <td>
                                        <span>
                                            {{ $value->detail }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            {{ $value->userName }}
                                        </span>
                                    </td>

                                    <td>
                                        <span>
                                            {{$value->projectName}}
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
                                        @if($value->status == 'waiting')
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
                                        @if($value->status == 'waiting')
                                            <a href="{{route('acceptReport',$value->id)}}">Accept</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $report->appends(Request::all())->render() }}
                    </form>
                    {{--end show reports --}}

                </div>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("input[name='option']").live("change", function () {
                if ($(this).val() == "user") {
                    $("input.search").attr("name", "user");
                } else if ($(this).val() == "project") {
                    $("input.search").attr("name", "project");
                } else if ($(this).val() == "position") {
                    $("input.search").attr("name", "position");

                } else if ($(this).val() == "working_type") {
                    $("input.search").attr("name", "working_type");

                }
            })
        });
    </script>
@endsection

