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
                <div>
                    {{--form add user has project--}}
                    <form method="POST" action="{{ route('addUserHasProject') }}">
                        @csrf

                        <table class="table">
                            <tr>
                                <th width="50%">
                                    User
                                </th>
                                <th>
                                    Project
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="user_id" id="" class="form-control">
                                        @foreach( $user as $value)
                                            <option value="{{$value->id}}"
                                                    class="form-control">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="project_id" id="project_id" class="form-control">
                                        @foreach( $project as $value)
                                            <option value="{{$value->id}}"
                                                    class="form-control">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>@if(!empty($error))
                                    <td class="alert-warning">
                                        <div class="alert alert-warning" role="alert">
                                            <span>{{ $error }}</span>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        </table>

                        <div class="row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>

                            </div>
                        </div>
                    </form>
                    {{--end form add user has project--}}
                </div>
            </div>
        </div>
    </div>
@endsection


