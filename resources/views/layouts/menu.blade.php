<nav class="navbar  navbar-dark justify-content-center"
     style="padding-bottom: 100%; border-right: solid 1px silver">
    <!-- Links -->
    <ul class="navbar-nav">
        <?php
        $PerUser = config('constants.Users');
        $PerRole = config('constants.Roles');
        $PerProject = config('constants.Projects');
        $PerReport = config('constants.Reports');
        $PerReportByEm = config('constants.ReportsByEm');
        $PerUserAddRole = config('constants.UserAddRole');
        $PerUserAddProject = config('constants.UserAddProject');

        $permission = \App\Models\RoleHasPermission::select('*')
            ->where('role_id','=',$role)
            ->get();
        ?>
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
        @elseif($role == $roleMember)
            <li class="nav-item btn ">
                <a class="nav-link " href="{{ route('reportsEmployee') }}">Reports</a>
            </li>
        @endif
        @foreach($permission as $value)
            @if($value->permission_id == $PerUser)
                <li class="nav-item btn ">
                    <a class="nav-link " href="{{route('users')}}">Users</a>
                </li>
            @endif
            @if($value->permission_id == $PerRole)
                <li class="nav-item btn ">
                    <a class="nav-link " href="{{ route('roles') }}">Roles</a>
                </li>
            @endif
            @if($value->permission_id == $PerProject)
                <li class="nav-item btn ">
                    <a class="nav-link " href="{{ route('projects') }}">Projects</a>
                </li>
            @endif
            @if($value->permission_id == $PerReport)
                <li class="nav-item btn ">
                    <a class="nav-link " href="{{ route('reports') }}">Reports</a>
                </li
            @endif
            @if($value->permission_id == $PerReportByEm)
                <li class="nav-item btn ">
                    <a class="nav-link " href="{{ route('reportsEmployee') }}">Reports</a>
                </li
            @endif
            @if($value->permission_id == $PerUserAddRole)
                <li class="nav-item btn ">
                    <a class="nav-link " href="{{ route('userHasRole') }}">User add Role</a>
                </li>
            @endif
            @if($value->permission_id == $PerUserAddProject)
                <li class="nav-item btn ">
                    <a class="nav-link " href="{{ route('userHasProject') }}">User add Projects</a>
                </li>
            @endif
        @endforeach

    </ul>
</nav>
