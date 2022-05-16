@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
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
                        {{ $project->links() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


