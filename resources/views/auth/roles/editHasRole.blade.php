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
                @include('layouts.menu')

                {{--end_menu--}}
            </div>
            <div class="col-md">
                <div>
                    {{--form edit user has role--}}}
                    <form method="POST" action="{{ route('editHasRole',$hasRole->id) }}">
                        @csrf
                        <table class="table">
                            <tr>
                                <th width="50%">
                                    User
                                </th>
                                <th>
                                    Role
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="user_id" id="" class="form-control">
                                        <option name="user_id" value="{{$hasRole->user_id}}"
                                                class="form-control">{{$hasRole->nameUser}}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="role_id" id="role_id" class="form-control">
                                        @foreach($roles as $v)
                                            @if($v->id == $hasRole->role_id )
                                                <option selected name="role_id" value="{{$v->id}}"
                                                        class="form-control">{{$v->name}}</option>
                                            @endif
                                            <option name="role_id" value="{{$v->id}}"
                                                    class="form-control">{{$v->name}}</option>
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
                        <div class="row mb">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                    {{--end form edit user has role--}}}
                </div>
            </div>
        </div>
    </div>
@endsection

