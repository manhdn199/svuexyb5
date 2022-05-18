@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
    <?php
    $roleAdmin = config('constants.admin');
    $roleManage = config('constants.manage');
    $roleMember = config('constants.member');
    $user = auth()->user();
    $role = $user->userHasRole->role_id;
    $day = date('01-m-Y');
    $today = date('d-m-Y');
    ?>

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
                        @if($role == $roleManage || $role == $roleAdmin)
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{route('users')}}">Users</a>
                            </li>
                            @if( $role == $roleAdmin )
                                <li class="nav-item btn ">
                                    <a class="nav-link " href="{{ route('roles') }}">Roles</a>
                                </li>
                            @endif
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('projects') }}">Projects</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('reports') }}">Reports</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('userHasRole') }}">User add Role</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('userHasProject') }}">User add Projects</a>
                            </li>
                        @else
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('reportsEmployee') }}">Reports</a>
                            </li>
                        @endif

                    </ul>
                </nav>
                {{--end_menu--}}
            </div>
            <div class="col-md">
                <div>
                    <form action="{{route('addReport')}}" method="post">
                        @csrf

                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        Detail
                        <input type="text" name="detail" value="{{ old('detail') }}" required
                               class="form-control @error('detail') is-invalid @enderror">
                        @error('detail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <br>
                        Working_time
                        <input type="date" name="working_time" required
                               class="form-control @error('working_time') is-invalid @enderror @error('working_time') is-invalid @enderror">
                        @error('working_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        @if(!empty($error))
                            <strong style="color: red">{{ $error }}</strong>
                        @endif
                        <br>
                        Working_type
                        <select name="working_type" id=""
                                class="form-control @error('working_type') is-invalid @enderror">
                            <option value="Offline" class="form-control">Offline</option>
                            <option value="Remote" class="form-control">Remote</option>
                            <option value="Onsite" class="form-control">Onsite</option>
                        </select>
                        @error('working_type')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        </select>
                        <br>
                        Position
                        <select name="position_id" id=""
                                class="form-control @error('working_type') is-invalid @enderror">
                            @foreach($positions as $value)
                                <option value="{{ $value->id }}" class="form-control">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        Project
                        <select name="project" id="" required
                                class="form-control @error('project') is-invalid @enderror">
                            @foreach($project as $value)
                                <option value="{{ $value->idProject }}"
                                        class="form-control">{{ $value->projectName }}</option>
                            @endforeach
                        </select>
                        @error('project')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <br>
                        Time
                        <input type="number" name="time" required
                               class="form-control @error('time') is-invalid @enderror">
                        @error('time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <br>
                        <button type="submit" value="submit" class=" btn btn-primary">
                            Add
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection


