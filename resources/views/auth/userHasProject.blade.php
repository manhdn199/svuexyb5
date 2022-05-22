@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
    <?php
    $roleAdmin = config('constants.admin');
    $roleManage = config('constants.manager');
    $roleMember = config('constants.member');
    $users = auth()->user();
    $role = $users->userHasRole->role_id;
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
                                    <input type="radio" name="option" value="project"/> Project
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

                <div>
                    {{--form user has project--}}
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
                                <th>
                                    Action
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
                                    <td>
                                        <a href="{{ route('editHasProject',$value->id) }}"> Edit</a>
                                        <a href="{{ route('deleteHasProject',$value->id) }}"> Delete</a>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $userHasProject->appends(Request::except('page'))->links() }}
                    </form>
                    <div class="row mb-0">
                        <div class="col-md-6 ">
                            <a class="btn btn-primary" href=" {{ route('viewAddUserHasProject') }}">
                                Add
                            </a>
                        </div>
                    </div>
                    {{--end form user has project--}}
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
                }
            })
        });
    </script>
@endsection


