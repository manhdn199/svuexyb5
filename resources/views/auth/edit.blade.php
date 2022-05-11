@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-3 " >
                <style>#box{ width:24%; font-size:12px; line-height:20px;  top:25%; position:fixed; z-index:100}#tab{ float:left; list-style:none outside none; margin:0; padding:0; position:relative; z-index:99}#tab li span{ display:block; padding:0 5px; position:relative}#links{ width:100%; padding:10px; float:left;}.show,.hide{ transition:margin-right .4s ease-in; -webkit-transition:margin-right .4s ease-in}.hide{ margin-right:0px}.show{ margin-right:95px}#arrow,bt{ cursor:pointer}.bt{ width:100%; height:40px; margin:-1px; text-align:center; border:1px solid #858fa6; font:bold 13px Helvetica,Arial,sans-serif; text-shadow:0px 0px 5px rgba(0,0,0,0.75); background:#014464; background-image:-o-linear-gradient(left,#1F82AF,#002F44); background-image:-ms-linear-gradient(left,#1F82AF,#002F44); background-image:-moz-linear-gradient(left,#1F82AF,#002F44); background-image:-webkit-linear-gradient(left,#1F82AF,#002F44); background-image:-webkit-gradient(linear,left top,right top,from(#1F82AF),to(#002F44))}.bt a{ line-height:40px; color:#fff; display:block}.bt:hover{ transition:background .3s linear; background:#32A3D3; -o-transition:background .3s linear; -moz-transition:background .3s linear; -webkit-transition:background .3s linear}#deco{ width:100%; float:left; box-shadow:0px 0px 5px #000; -moz-box-shadow:0px 0px 5px #000; -webkit-box-shadow:0px 0px 5px #000}</style>
                <div id="box" class="hide">
                    <div id="links">
                        <div id="deco">
                            <div class="bt">
                                <a href="{{asset('users')}}" >Users</a></div>
                            <div class="bt">
                                <a href="{{ asset('roles') }}" >Roles</a></div>
                            <div class="bt">
                                <a href="{{ asset('projects') }}" >Projects</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div>
                    <form method="POST" action="{{route('edit',$user->id)}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"  autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}"  autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  value="{{$user->password}}">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select name="gender" id="gender">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Birthday') }}</label>

                            <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control" name="birthday"  value="{{ $user->birthday }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Tel') }}</label>

                            <div class="col-md-6">
                                <input id="tel" type="number" class="form-control" name="tel"  value="{{ $user->tel }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address"  value="{{ $user->address }}">
                            </div>
                        </div>

                        <div class="row mb">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <button href="{{ route('users') }}">
                                    Back
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
