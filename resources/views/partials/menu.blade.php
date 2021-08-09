<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link bg-info" href="javascript:void()" style="cursor: help;">
                    {{ auth()->user()->name }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('visitor_manage')
            <li class="nav-item">
                <a href="{{ route('visitor.create') }}" class="nav-link">
                    <i class="nav-icon fa fa-street-view fa-fw"></i>
                    Visitor Entry
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('visitor.list') }}" class="nav-link">
                    <i class="nav-icon fa fa-street-view fa-fw"></i>
                    Latest Visitors
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('report.search') }}" class="nav-link">
                    <i class="nav-icon fa fa-graph fa-fw"></i>
                    Report
                </a>
            </li>
            @endcan
            @can('employee_manage')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employee.index') }}">
                        <i class="fa-fw fas fa-user nav-icon"></i>
                        {{ trans('cruds.employeeManage.title') }}
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">

                    </i>
                    Change password
                </a>
            </li>
            @can('users_manage')
                <li class="nav-item bg-secondary">
                    <a class="nav-link" href="javascript:void()" style="cursor: none;">
                        <!-- <i class="fa-fw fas fa-trash nav-icon"></i> -->
                        Trash
                    </a>
                </li>
                    <!-- <ul class="nav-dropdown-items"> -->
                <li class="nav-item">
                    <a href="{{ route('trash.employee') }}" class="nav-link {{ request()->is('trash/employee') || request()->is('admin/employee/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-users nav-icon"></i>
                        Employee
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('trash.visits') }}" class="nav-link {{ request()->is('trash/visits') || request()->is('admin/visits/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-male nav-icon"></i>
                        Visits
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('trash.users') }}" class="nav-link {{ request()->is('trash/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user nav-icon"></i>
                        {{ trans('cruds.user.title') }}
                    </a>
                </li>
                   <!--  </ul>
                </li> -->
            @endcan
            @can('users_manage')
                <li class="nav-item">
                    <a class="nav-link bg-secondary" href="javascript:void()" style="cursor: none;">
                        <!-- <i class="fa-fw fas fa-users nav-icon"></i> -->
                        User Setting
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-unlock-alt nav-icon">

                        </i>
                        {{ trans('cruds.permission.title') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase nav-icon">

                        </i>
                        {{ trans('cruds.role.title') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user nav-icon">

                        </i>
                        {{ trans('cruds.user.title') }}
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>