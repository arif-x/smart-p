<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      Smart<span> P</span>
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
          <i class="link-icon" data-feather="bar-chart"></i>
          <span class="link-title">Growth Tracker</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.development-tracker.index') }}" class="nav-link">
          <i class="link-icon" data-feather="activity"></i>
          <span class="link-title">Development Tracker</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.vaccination-tracker.index') }}" class="nav-link">
          <i class="link-icon" data-feather="heart"></i>
          <span class="link-title">Vaccination</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.nutrition-tracker.index') }}" class="nav-link">
          <i class="link-icon" data-feather="align-justify"></i>
          <span class="link-title">Nutrition Tracker</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.tips.index') }}" class="nav-link">
          <i class="link-icon" data-feather="alert-circle"></i>
          <span class="link-title">Tips</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.consultation.index') }}" class="nav-link">
          <i class="link-icon" data-feather="message-square"></i>
          <span class="link-title">Consultation</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.parenting.index') }}" class="nav-link">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Parenting</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.parenting-assessment.index') }}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Parenting Assessment</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.vaksin.index') }}" class="nav-link">
          <i class="link-icon" data-feather="heart"></i>
          <span class="link-title">Vaccine</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="link-icon" data-feather="log-out"></i>
          <span class="link-title">Logout</span>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </a>
      </li>
    </ul>
  </div>
</nav>