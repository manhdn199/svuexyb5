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
            {{--menu--}}
            <div class="col-md-3 menu_beet" style="height: 100%">
                @include('layouts.menu')

                {{--end_menu--}}
            </div>
            <div class="col-md">
                <div style="margin-bottom: 1rem">
                    <form action="{{ $_SERVER['REQUEST_URI'] }}" method="get">
                        <div class="dropdown">
                            <input type="text" name="search" class="dropbtn form-control search" placeholder="Search">
                            <div id="myDropdown" class="dropdown-content">
                                <div class="radioChoose">
                                    <input type="radio" name="option" value="user" checked="checked"/> User
                                    <input type="radio" name="option" value="role"/> Role
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div>
                    <form method="POST" >
                        @csrf

                        <div class="row mb-3">
                            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
                                  rel="stylesheet"
                                  integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
                                  crossorigin="anonymous">

                            <table class="table">
                                <tr>
                                    <td>
                                        @sortablelink('name', __('Name'), ['page' => request()->get('page')])
                                    </td>
                                    <td>
                                        @sortablelink('role', __('Role'), ['page' => request()->get('page')])
                                    </td>
                                    <td>
                                        Action
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
                                        <td>
                                            <a href="{{ route('editHasRole',$value->id) }}"> Edit</a>
                                            <a href="{{ route('deleteHasRole',$value->id) }}"> Delete</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {{ $userHasRole->appends(\Request::all())->render() }}
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("input[name='option']").live("change", function () {
                if ($(this).val() == "user") {
                    $("input.search").attr("name", "user");
                } else if ($(this).val() == "role") {
                    $("input.search").attr("name", "role");
                }
            })
        });
    </script>
@endsection

