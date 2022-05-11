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
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                            <input id="detail" type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" value="{{ old('detail') }}" required autocomplete="name" autofocus>

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
                            <input id="duration" type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" required autocomplete="name" autofocus>

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
                            <input id="revenue" type="text" class="form-control @error('revenue') is-invalid @enderror" name="revenue" value="{{ old('revenue') }}" required autocomplete="name" autofocus>

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
                            <input id="Date_Start" type="date" class="form-control @error('start') is-invalid @enderror" name="start" value="{{old('start') }}" required autocomplete="name" autofocus>

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
                            <input id="end" type="date" class="form-control @error('end') is-invalid @enderror" name="end" value="{{old('end')}}" required autocomplete="name" autofocus>

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
                            <button href="{{ route('projects') }}">
                                Back
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



