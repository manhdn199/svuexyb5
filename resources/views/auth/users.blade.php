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
                    <a class="btn btn-success" href="{{ route('viewAddUser') }}">Add</a>
                    <form action="" method="post">
                        @csrf
                        @if(!empty($errors))
                            <span>
                                <strong>
                                    @foreach($errors as $value)
                                        <div class="alert alert-warning" role="alert">
                                          {{$value}}
                                        </div>
                                    @endforeach
                                </strong>
                            </span>

                        @endif

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>gender</th>
                                    <th>Birthday</th>
                                    <th>Tel</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            @foreach($user as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->name  }}</td>
                                    <td>{{ $value->email  }}</td>
                                    <td>@if($value->gender == 1)
                                            Male
                                        @elseif($value->gender == 2)
                                            Female
                                        @else
                                            Other
                                        @endif

                                    </td>
                                    <td>{{ $value->birthday  }}</td>
                                    <td>{{ $value->tel  }}</td>
                                    <td>{{ $value->address  }}</td>
                                    <td>
                                        <a href="{{ route('edit',$value->id) }}"> Edit</a>
                                        <a onclick="return confirm('Do u want delete?')" href="{{route('delete',$value->id)}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
