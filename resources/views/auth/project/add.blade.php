@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-3 " >
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
                            <a href="{{ route('projects') }}" class="btn btn-success">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



