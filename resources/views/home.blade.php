@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')

@endsection
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-3 " style="height: 100%">
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
        <div class="col-md-9">

        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="exponential.js"></script>
