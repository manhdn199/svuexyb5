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
                    {{--view form edit project--}}
                    <form method="POST" action="{{route('editProject',$project->id)}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ $project->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Detail') }}</label>

                            <div class="col-md-6">
                                <input id="detail" type="text"
                                       class="form-control @error('detail') is-invalid @enderror" name="detail"
                                       value="{{ $project->detail }}" required autocomplete="name" autofocus>

                                @error('detail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Duration') }}</label>

                            <div class="col-md-6">
                                <input id="duration" type="text"
                                       class="form-control @error('duration') is-invalid @enderror" name="duration"
                                       value="{{ $project->duration }}" required autocomplete="name" autofocus>

                                @error('duration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Revenue') }}</label>

                            <div class="col-md-6">
                                <input id="revenue" type="text"
                                       class="form-control @error('revenue') is-invalid @enderror" name="revenue"
                                       value="{{ $project->revenue }}" required autocomplete="name" autofocus>

                                @error('revenue')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Date_Start') }}</label>

                            <div class="col-md-6">
                                <input id="Date_Start" type="date"
                                       class="form-control @error('start') is-invalid @enderror" name="start"
                                       value="{{ $project->start }}" required autocomplete="name" autofocus>

                                @error('start')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @if(!empty($errors))
                                    @foreach( $errors as $value)
                                        {{ $value->error }}
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Date_End') }}</label>

                            <div class="col-md-6">
                                <input id="end" type="date" class="form-control @error('end') is-invalid @enderror"
                                       name="end" value="{{ $project->end }}" required autocomplete="name" autofocus>

                                @error('end')
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
                                <button href="{{ route('projects') }}" class="btn btn-dark">
                                    Back
                                </button>
                            </div>
                        </div>
                    </form>
                    {{--end form edit project--}}
                </div>
                {{--form project member report--}}
                <div style="margin-top: 1rem">
                    <h2>User report this project</h2>
                    <table class="table ">
                        <tr>
                            <th>
                                User
                            </th>
                            <th>
                                Position
                            </th>
                        </tr>
                        @foreach($arrayMember as $key => $value)
                            <tr>
                                <td>
                                    {{$key}}
                                </td>
                                <td>
                                    @foreach( $value as $k => $v)
                                        <span style="color: red">
                                        {{ $v }}
                                    </span>,
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{--end form project member report--}}

                {{--form project member --}}
                <div style="margin-top: 1rem">
                    <h2>User in project</h2>
                    <table class="table ">
                        <tr>
                            <th>
                                User
                            </th>
                        </tr>
                        @foreach($nameUser as $key => $value)
                            <tr>
                                <td>
                                    {{$value->nameUser}}
                                </td>

                            </tr>
                        @endforeach
                    </table>
                </div>
                {{--end form project member --}}

            </div>
        </div>
    </div>
@endsection

