@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')

@endsection
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-3 " style="height: 100%">
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
        <div class="col-md-9">

        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="exponential.js"></script>
