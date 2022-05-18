@extends('layouts.app')
{{--@extends('layouts/contentLayoutMaster')--}}

@section('title', 'Home')
@section('content')
    <?php
    $user = auth()->user();
    $role = $user->userHasRole->role_id;
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
            {{--        menu--}}
            <div class="col-md-3 menu_beet" style="height: 100%">
                <nav class="navbar  navbar-dark justify-content-center"
                     style="padding-bottom: 100%; border-right: solid 1px silver">
                    <!-- Links -->
                    <ul class="navbar-nav">
                        @if($role == 2 || $role == 1)
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{asset('users')}}">Users</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ asset('roles') }}">Roles</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ asset('projects') }}">Projects</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ asset('reports') }}">Reports</a>
                            </li>
                        @else
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ asset('employee_report') }}">Reports</a>
                            </li>
                        @endif
                    </ul>
                </nav>
                {{--end_menu--}}
            </div>
            <div class="col-md">
                <div>

                    <form action="{{route('editReport',$report->id)}}" method="post">
                        @csrf
                        {{--    @dd($report)--}}
                        <input type="hidden" name="id" value="{{$report->id}}">
                        <br>
                        Detail
                        <input type="text" name="detail" value="{{$report->detail}}" class="form-control">
                        <br>
                        Project
                        <select name="project" id="" class="form-control">
                            @foreach( $project as $value)
                                @if($value->idProject == $report->project_id)
                                    <option value="{{$value->idProject}}" selected>{{$value->projectName}}</option>
                                @else
                                    <option value="{{$value->idProject}}">{{$value->projectName}}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        Working_Time
                        <input type="date" name="working_time" value="{{$report->working_time}}" class="form-control">
                        <br>
                        Working_Type
                        <select name="working_type" id="" class="form-control">
                            @if($report->working_type == 'Remote')
                                <option value="Remote" selected class="form-control">Remote</option>
                            @elseif($report->working_type == 'Offline')
                                <option value="Offline" selected class="form-control">Offline</option>
                            @else
                                <option value="Onsite" selected class="form-control">Onsite</option>
                            @endif
                            <option value="Remote" class="form-control">Remote</option>
                            <option value="Offline" class="form-control">Offline</option>
                            <option value="Onsite" class="form-control">Onsite</option>

                        </select>
                        <br>
                        Position
                        <select name="position_id" id="" class="form-control">

                            @foreach( $positions as $value)
                                @if($value->id == $report->position_id)
                                    <option value="{{$report->position_id}}" selected
                                            class="form-control">{{$value->name}}</option>
                                @else
                                    <option value="{{$value->id}}" class="form-control">{{$value->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <br>
                        Time
                        <input type="number" name="time" value="{{$report->time}}" class="form-control">

                        <input id="update" type="submit" value="update" disabled="" class="btn btn-primary"
                               style="margin-top:1rem;">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="exponential.js"></script>
<script>
    var button = $('#update');
    var orig = [];

    $.fn.getType = function () {
        return this[0].tagName == "INPUT" ? $(this[0]).attr("type").toLowerCase() : this[0].tagName.toLowerCase();
    }

    $("form :input").each(function () {
        var type = $(this).getType();
        var tmp = {
            'type': type,
            'value': $(this).val()
        };
        if (type == 'radio') {
            tmp.checked = $(this).is(':checked');
        }
        orig[$(this).attr('id')] = tmp;
    });

    $('form').bind('change keyup', function () {

        var disable = true;
        $("form :input").each(function () {
            var type = $(this).getType();
            var id = $(this).attr('id');

            if (type == 'text' || type == 'select') {
                disable = (orig[id].value == $(this).val());
            } else if (type == 'radio') {
                disable = (orig[id].checked == $(this).is(':checked'));
            }

            if (!disable) {
                return false; // break out of loop
            }
        });

        button.prop('disabled', disable);
    });
</script>

