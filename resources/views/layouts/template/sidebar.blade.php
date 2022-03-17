<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      MAT<span> PI</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Menu</li>
      <li class="nav-item">
        <a href="/dashboard" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.growth-tracker.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Growth Tracker</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.development-tracker.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Development Tracker</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="dashboard-one.html" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Vaccination</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="dashboard-one.html" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Nutrition Tracker</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="dashboard-one.html" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Tips</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="dashboard-one.html" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Consultation</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="dashboard-one.html" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Parenting</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="dashboard-one.html" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Parenting Assessment</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="dashboard-one.html" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Logout</span>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </a>
      </li>
    </ul>
  </div>
</nav>