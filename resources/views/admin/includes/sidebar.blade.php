<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#blogs-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Blogs</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="blogs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('blogs.index') }}">
                        <i class="bi bi-circle"></i><span>List</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('blogs.create') }}">
                        <i class="bi bi-circle"></i><span>Add</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('users.create') }}">
                        <i class="bi bi-circle"></i><span>Add</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="bi bi-circle"></i><span>List</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Roles</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('roles.create') }}">
                        <i class="bi bi-circle"></i><span>Add</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('roles.index') }}">
                        <i class="bi bi-circle"></i><span>List</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Permission</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('permissions.index') }}">
                        <i class="bi bi-circle"></i><span>List</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('permissions.create') }}">
                        <i class="bi bi-circle"></i><span>Add</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tools" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Tool</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tools" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('tool.index') }}">
                        <i class="bi bi-circle"></i><span>List</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tool.create') }}">
                        <i class="bi bi-circle"></i><span>Add</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#custom-pages" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Custom Pages</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="custom-pages" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('custom_page.index')}}">
                        <i class="bi bi-circle"></i><span>List</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('custom_page.create') }}">
                        <i class="bi bi-circle"></i><span>Add</span>
                    </a>
                </li>
            </ul>
        </li>
        
    </ul>

</aside><!-- End Sidebar-->
