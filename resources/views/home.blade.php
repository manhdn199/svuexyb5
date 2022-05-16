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
            <div class="col-md-9">
                {{--                chart--}}
                <form action="{{ route('statistic') }}" method="get">

                    <table class="table">
                        <tr>
                            <th width="50%">Project</th>
                            <th>User</th>
                        </tr>
                        <tr>
                            <td>
                                @csrf
                                <select name="project_id" id="" class="form-control">
                                    <option value="" class="form-control" selected>---</option>
                                    @foreach($projects as $value)
                                        <option value="{{$value->id}}" class="form-control">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <div style="width: 100%;">
                                    <script
                                        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                                    <canvas id="myChart" style="width:50%;max-width:600px"></canvas>
                                    <script>
                                        var xValues = ['#'];

                                        @foreach ($positionArray as $key => $value)
                                        xValues.push({{$value}});
                                        @endforeach

                                        var yValues = [0];

                                        @foreach ($timeArray as $key => $value)
                                        yValues.push({{$value}});
                                        @endforeach
                                        console.log(yValues);
                                        var barColors = ["red", "green"];

                                        new Chart("myChart", {
                                            type: "bar",
                                            data: {
                                                labels: xValues,
                                                datasets: [{
                                                    backgroundColor: barColors,
                                                    data: yValues
                                                }]
                                            },
                                            options: {
                                                legend: {display: false},
                                                title: {
                                                    display: true,
                                                    text: "Total tim use on Project & sum by role "
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>
                                <select name="user_id" id="" class="form-control">
                                    <option value="" class="form-control" selected>---</option>
                                    @foreach($users as $value)
                                        <option value="{{$value->id}}" class="form-control">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <div style="width: 100%;">
                                    <script
                                        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                                    <canvas id="myChart1" style="width:50%;max-width:600px"></canvas>
                                    <script>
                                        var xValues1 = ['#'];
                                        @foreach ($typeArray as $key => $value)
                                        xValues1.push("{{$value}}");
                                        @endforeach

                                        var yValues1 = [0];
                                        @foreach ($timeArrayUser as $key => $value)
                                        yValues1.push("{{$value}}");
                                        @endforeach

                                        console.log(xValues1);
                                        var barColors1 = ["red", "green", "blue", 'yellow'];

                                        new Chart("myChart1", {
                                            type: "bar",
                                            data: {
                                                labels: xValues1,
                                                datasets: [{
                                                    backgroundColor: barColors1,
                                                    data: yValues1
                                                }]
                                            },
                                            options: {
                                                legend: {display: false},
                                                title: {
                                                    display: true,
                                                    text: "Time use in project by Member"
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </td>
                        </tr>
                        <input type="submit" value="Show" class="btn btn-primary" style="margin-top: 1rem;">

                    </table>
                </form>
                {{--end chart--}}
            </div>
        </div>
    </div>

@endsection
