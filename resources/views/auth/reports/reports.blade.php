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
            {{--        menu--}}
            <div class="col-md-3 menu_beet" style="height: 100%">
                <nav class="navbar  navbar-dark justify-content-center" style="padding-bottom: 100%; border-right: solid 1px silver">
                    <!-- Links -->
                    <ul class="navbar-nav">
                        @if($role == 2 || $role == 1)
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
                        @else
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ asset('employee_report') }}" >Reports</a>
                            </li>
                        @endif
                    </ul>
                </nav>
                {{--end_menu--}}
            </div>
            <div class="col-md">
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
@endsection

