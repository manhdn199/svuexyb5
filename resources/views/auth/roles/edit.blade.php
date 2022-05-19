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
                <form method="POST" action="{{route('edit',$role->id)}}">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ $role->name }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection



