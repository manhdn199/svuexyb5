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
                    <a class="btn btn-success" href="{{ route('viewAddUser') }}">Add</a>
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
                            <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>gender</th>
                                <th>Birthday</th>
                                <th>Tel</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            @foreach($user as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->name  }}</td>
                                    <td>{{ $value->email  }}</td>
                                    <td>@if($value->gender == 1)
                                            Male
                                        @elseif($value->gender == 2)
                                            Female
                                        @else
                                            Other
                                        @endif

                                    </td>
                                    <td>{{ $value->birthday  }}</td>
                                    <td>{{ $value->tel  }}</td>
                                    <td>{{ $value->address  }}</td>
                                    <td>
                                        <a href="{{ route('edit',$value->id) }}"> Edit</a>
                                        <a onclick="return confirm('Do u want delete?')"
                                           href="{{route('delete',$value->id)}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $user->links() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
