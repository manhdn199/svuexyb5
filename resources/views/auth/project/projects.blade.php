@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-3 ">
                <nav class="navbar bg-success navbar-dark justify-content-center" style="    padding-bottom: 100%;">
                    <!-- Links -->
                    <ul class="navbar-nav">
                        <li class="nav-item btn btn-success">
                            <a class="nav-link " href="{{asset('users')}}">Users</a>
                        </li>
                        <li class="nav-item btn btn-success">
                            <a class="nav-link " href="{{ asset('roles') }}">Roles</a>
                        </li>
                        <li class="nav-item btn btn-success">
                            <a class="nav-link " href="{{ asset('projects') }}">Projects</a>
                        </li>
                    </ul>
                </nav>

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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


