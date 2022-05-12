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
                            <a class="nav-link " href="{{asset('users')}}" >Users</a>
                        </li>
                        <li class="nav-item btn btn-success">
                            <a class="nav-link " href="{{ asset('roles') }}" >Roles</a>
                        </li>
                        <li class="nav-item btn btn-success">
                            <a class="nav-link " href="{{ asset('projects') }}" >Projects</a>
                        </li>
                    </ul>
                </nav>

            </div>
            <div class="col-md">
                <div>
                    <form method="POST" action="{{ route('addRole') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  autocomplete="name" autofocus>

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
                                    Add
                                </button>
                                <button href="{{ route('roles') }}" class="btn btn-success">
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




