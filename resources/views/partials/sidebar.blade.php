<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="{{ route('dashboard') }}" class="b-brand text-primary">
        <img src="/images/logo.png" alt="" class="logo logo-lg w-100">
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label>Navigation</label>
          <i class="ti ti-dashboard"></i>
        </li>
        <li class="pc-item">
          <a href="{{ route('dashboard') }}" class="pc-link"><span class="pc-micon"><i class="ti ti-dashboard"></i></span><span
              class="pc-mtext">Dashboard</span></a>
        </li>

        <li class="pc-item pc-hasmenu">
            <a href="#" class="pc-link">
              <span class="pc-micon">
                <i class="ti ti-user"></i>
              </span>
              <span class="pc-mtext" data-i18n="User">Role</span>
              <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu">
                <li class="pc-item"><a class="pc-link" href="{{ route('roles.create') }}" data-i18n="Pricing">Add New</a></li>
                <!-- <li class="pc-item"><a class="pc-link" href="{{ route('roles.store') }}" data-i18n="List">List</a></li> -->
            </ul>
        </li>

        <li class="pc-item pc-hasmenu">
            <a href="#" class="pc-link">
              <span class="pc-micon">
                <i class="ti ti-user"></i>
              </span>
              <span class="pc-mtext" data-i18n="Teachers">Permissions</span>
              <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu">
                <li class="pc-item"><a class="pc-link" href="{{ route('permissions.create') }}" data-i18n="Pricing">Add New</a></li>
                <li class="pc-item"><a class="pc-link" href="{{ route('permissions.role') }}" data-i18n="List">Permission Assign</a></li>
            </ul>
        </li>

        <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link">
              <span class="pc-micon"><i class="ti ti-book"></i> </span>
              <span class="pc-mtext" data-i18n="Courses">Courses</span>
              <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu">
              <li class="pc-item">
                <a class="pc-link" href="{{ route('addCourse') }}" data-i18n="Add New">Add New course</a>
              </li>
              <li class="pc-item">
                <a class="pc-link" href="{{ route('courses') }}" data-i18n="Active List">Courses List</a>
              </li>
              <li class="pc-item">
                <a class="pc-link" href="#" data-i18n="Drafted List">Drafted List</a>
              </li>
              <li class="pc-item">
                <a class="pc-link" href="#" data-i18n="Expired List">Expired List</a>
              </li>
              <li class="pc-item">
                <a class="pc-link" href="#" data-i18n="View All">View All</a>
              </li>
            </ul>
        </li>

        <li class="pc-item pc-hasmenu">
            <a href="#" class="pc-link">
              <span class="pc-micon">
                <i class="ti ti-user"></i>
              </span>
              <span class="pc-mtext" data-i18n="Teachers">Teachers</span>
              <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu">
                <li class="pc-item"><a class="pc-link" href="{{ route('teacheradd') }}" data-i18n="Pricing">Add New</a></li>
                <li class="pc-item"><a class="pc-link" href="{{ route('teacherlist') }}" data-i18n="List">List</a></li>
            </ul>
        </li>

        <li class="pc-item pc-hasmenu">
            <a href="#" class="pc-link">
              <span class="pc-micon">
                <i class="ti ti-users"></i>
              </span>
              <span class="pc-mtext" data-i18n="Students">Students</span>
              <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu">
                <li class="pc-item"><a class="pc-link" href="{{ route('studentadd') }}" data-i18n="Pricing">Add New</a></li>
                <li class="pc-item"><a class="pc-link" href="{{ route('studentlist') }}" data-i18n="List">List</a></li>
            </ul>
        </li>


        <li class="pc-item pc-hasmenu">
            <a href="#" class="pc-link">
              <span class="pc-micon">
                <i class="ti ti-user"></i>
              </span>
              <span class="pc-mtext" data-i18n="User">Users</span>
              <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
            </a>
            <ul class="pc-submenu">
                <li class="pc-item"><a class="pc-link" href="{{ route('useradd') }}" data-i18n="Pricing">Add New</a></li>
                <li class="pc-item"><a class="pc-link" href="{{ route('userlist') }}" data-i18n="List">List</a></li>
            </ul>
        </li>



      </ul>
    </div>
  </div>
</nav>
