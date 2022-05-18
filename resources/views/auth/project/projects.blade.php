@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
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
                .radioChoose{
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
                .menu_beet>nav>ul>li>a{
                    color: black !important;
                    width: 100%;
                }
                .menu_beet>nav>ul{
                    width: 100%;
                }

                .menu_beet>nav>ul>li{
                    margin: 2px 0 2px 0;

                }

                .menu_beet>nav>ul>li:hover{
                    background: silver ;
                    transition: 1s;
                }
            </style>
            {{--menu--}}
            <div class="col-md-3 menu_beet" style="height: 100%">
                <nav class="navbar  navbar-dark justify-content-center" style="padding-bottom: 100%; border-right: solid 1px silver">
                    <!-- Links -->
                    <ul class="navbar-nav">
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{asset('users')}}" >Users</a>
                        </li>
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{ asset('roles') }}" >Roles</a>
                        </li>
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{ asset('projects') }}" >Projects</a>
                        </li>
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{ asset('reports') }}" >Reports</a>
                        </li>
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{ asset('userHasRole') }}" >User add Role</a>
                        </li>
                        <li class="nav-item btn ">
                            <a class="nav-link " href="{{ asset('userHasProject') }}" >User add Projects</a>
                        </li>
                    </ul>
                </nav>
                {{--end_menu--}}
            </div>
            <div class="col-md">
                <div style="margin-bottom: 1rem">
                    <div>
                        <form action="{{ $_SERVER['REQUEST_URI'] }}" method="get">
                            <div class="dropdown">
                                <input type="text" name="search" class="dropbtn form-control search" placeholder="Search">
{{--                                <div id="myDropdown" class="dropdown-content">--}}
{{--                                    <div class="radioChoose">--}}
{{--                                        <input type="radio" name="option" value="name" checked="checked" /> Name--}}
{{--                                        <input type="radio" name="option" value="detail" /> Detail--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </form>
                    </div>
                </div>
                <div>
                    <a class="btn btn-success" href="{{ route('viewAddProject') }}">Add</a>
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
                                <th>Name</th>
                                <th>Detail</th>
                                <th>Duration</th>
                                <th>Revenue</th>
                                <th>Date_Start</th>
                                <th>Date_End</th>
                                <th>Action</th>
                            </tr>
                            @foreach($project as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->name  }}</td>
                                    <td>{{$value->detail}}</td>
                                    <td>{{$value->duration}}</td>
                                    <td>{{$value->revenue}}</td>
                                    <td>{{$value->start}}</td>
                                    <td>{{$value->end}}</td>
                                    <td>
                                        <a href="{{ route('viewEditProject',$value->id) }}"> Edit</a>
                                        <a onclick="return confirm('Do u want delete?')"
                                           href="{{route('deleteProject',$value->id)}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                        {{ $project->appends(Request::except('page'))->links() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $("input[name='option']").live("change", function(){
                if ($(this).val() == "name") {
                    $("input.search").attr("name", "name");
                }
                else if ($(this).val() == "detail") {
                    $("input.search").attr("name", "detail");
                }
            })});
    </script>
@endsection


