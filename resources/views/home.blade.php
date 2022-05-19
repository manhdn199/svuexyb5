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
                .dropbtn {
                    background-color: #3498DB;
                    color: white;
                    font-size: 16px;
                    border: none;
                    cursor: pointer;
                }

                /*.dropbtn:hover, .dropbtn:focus {*/
                /*    background-color: #2980B9;*/
                /*}*/

                .dropdown {
                    position: relative;
                    display: inline-block;
                }

                .dropdown-content {
                    width: 467px !important;
                    display: none;
                    position: absolute;
                    background-color: #f1f1f1;
                    min-width: 160px;
                    overflow: auto;
                    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                    z-index: 1;
                }

                .dropdown-content a {
                    color: black;
                    padding: 12px 16px;
                    text-decoration: none;
                    display: block;
                }

                .dropdown a:hover {
                    background-color: #ddd;
                }

                .dropdown-content a:hover {
                    background-color: #ddd;
                }

                .dropdown:hover .dropdown-content {
                    display: block;
                }

                .dropdown:hover .dropbtn {
                    background-color: #3e8e41
                }

                .show {
                    display: block;
                }
            </style>
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
                        @if($role == $roleManage || $role == $roleAdmin)
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{route('users')}}">Users</a>
                            </li>
                            @if( $role == $roleAdmin )
                                <li class="nav-item btn ">
                                    <a class="nav-link " href="{{ route('roles') }}">Roles</a>
                                </li>
                            @endif
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('projects') }}">Projects</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('reports') }}">Reports</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('userHasRole') }}">User add Role</a>
                            </li>
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('userHasProject') }}">User add Projects</a>
                            </li>
                        @else
                            <li class="nav-item btn ">
                                <a class="nav-link " href="{{ route('reportsEmployee') }}">Reports</a>
                            </li>
                        @endif

                    </ul>
                </nav>
                {{--end_menu--}}
            </div>
            <div class="col-md-9">
                {{--                chart--}}
                <form action="{{ route('statistic') }}" method="get">
                    @csrf

                    <table class="table">
                        <tr>
                            <th width="50%">Project</th>
                            <th>
                                @if($role == $roleAdmin || $role == $roleManage)
                                    User
                                @else
                                    Time
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <select name="project_id" id="" class="form-control">
                                    <option value="" class="form-control" selected>---</option>
                                    @foreach($projects as $value)
                                        <option value="{{$value->id}}" selected
                                                class="form-control">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @if(!empty($error))
                                    <span class="alert alert-warning">{{$error}}</span>
                                @endif
                                <div style="width: 100%;">
                                    <script
                                        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                                    <canvas id="myChart" style="width:50%;max-width:600px"></canvas>
                                    @if(!empty($positionArray))
                                        @if($role == $roleAdmin || $role == $roleManage)
                                            <script>
                                                var xValues = ['#'];
                                                @foreach ($positionArray as $key => $value)
                                                xValues.push('{{$value}}');
                                                @endforeach
                                                var yValues = [0];

                                                @foreach ($timeArray as $key => $value)
                                                yValues.push({{$value}});
                                                @endforeach
                                                console.log(xValues);
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
                                                        },
                                                        scales: {
                                                            yAxes: [{
                                                                ticks: {
                                                                    beginAtZero: true
                                                                }
                                                            }]
                                                        }
                                                    }
                                                });
                                            </script>
                                        @endif
                                    @endif
                                    @if(!empty($totalTimeUser))
                                        @if($role == $roleMember)
                                            <script>
                                                var xValues = ['#'];
                                                @foreach ($projectName as $key => $value)
                                                xValues.push('{{$value}}');
                                                @endforeach
                                                var yValues = [0];
                                                @foreach ($totalTimeUser as $key => $value)
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
                                                            text: "Total tim use in Project "
                                                        },
                                                        scales: {
                                                            yAxes: [{
                                                                ticks: {
                                                                    beginAtZero: true
                                                                }
                                                            }]
                                                        }

                                                    }
                                                });
                                            </script>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($role == $roleAdmin || $role == $roleManage)
                                    <select name="user_id" id="" class="form-control">
                                        <option value="" class="form-control" selected>---</option>
                                        @foreach($users as $value)
                                            <option value="{{$value->id}}"
                                                    class="form-control">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if($role == $roleMember)
                                    <div class="dropdown">
                                        <button class="dropbtn btn">Set date</button>
                                        <form action="">
                                            <div id="myDropdown" class="dropdown-content">
                                                <span>Start</span>
                                                <input type="date" name="start" class="form-control" value="">
                                                <span>End</span>
                                                <input type="date" name="end" class="form-control" value="">
                                            </div>
                                        </form>

                                    </div>
                                @endif
                                <div style="width: 100%;">
                                    <script
                                        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
                                        type="text/javascript"></script>
                                    <canvas id="myChart1" style="width:50%;max-width:600px"></canvas>
                                    @if(!empty($positionArray))
                                        @if($role == $roleAdmin || $role == $roleManage)

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
                                                        },
                                                        scales: {
                                                            yAxes: [{
                                                                ticks: {
                                                                    beginAtZero: true
                                                                }
                                                            }]
                                                        }
                                                    }
                                                });
                                            </script>
                                        @endif
                                    @endif
                                    @if(!empty($totalTimeUser))
                                        @if($role == $roleMember)
                                            <script>
                                                var xValues1 = ['#'];
                                                @foreach ($arrayWorkingType as $key => $value)
                                                xValues1.push('{{$value}}');
                                                @endforeach
                                                var yValues1 = [0];
                                                @foreach ($arrayTimeMonth as $key => $value)
                                                yValues1.push({{$value}});
                                                @endforeach
                                                console.log(yValues);
                                                var barColors = ["red", "green", "blue", "yellow"];

                                                new Chart("myChart1", {
                                                    type: "bar",
                                                    data: {
                                                        labels: xValues1,
                                                        datasets: [{
                                                            backgroundColor: barColors,
                                                            data: yValues1
                                                        }]
                                                    },
                                                    options: {
                                                        legend: {display: false},
                                                        title: {
                                                            display: true,
                                                            text: "Total tim use in Project by Type "
                                                        },
                                                        scales: {
                                                            yAxes: [{
                                                                ticks: {
                                                                    beginAtZero: true
                                                                }
                                                            }]
                                                        }
                                                    }
                                                });
                                            </script>
                                        @endif
                                    @endif
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
