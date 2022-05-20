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
                <form method="POST" action="{{route('editRole',$roless->id)}}">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ $roless->name }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Permission') }}</label>
                        <div class="col-md-6">
                            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

                            <select class="js-example-basic-multiple form-control @if(!empty($_GET['errorSetPermission'])) is-invalid @endif " name="permissions[]" multiple="multiple">
                                @foreach($permissions as $value)
                                    @foreach($permissionInRole as $v)
                                        @if($v->permission_id == $value->id)
                                        <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                        @endif
                                    @endforeach
                                        <option value="{{$value->id}}" >{{$value->name}}</option>
                                @endforeach
                            </select>

                        @if(!empty($_GET['errorSetPermission']))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $_GET['errorSetPermission'] }}
                                </strong>
                            </span>
                            @endif
                            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" type="text/javascript"></script>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('.js-example-basic-multiple').select2({
                                        tags:true,
                                        tokenSeparators: [',', ' ']
                                    });
                                });
                            </script>
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



