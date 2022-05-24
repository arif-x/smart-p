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
        <a href="#" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item nav-category">Konfigurasi</li>
      <li class="nav-item">
        <a href="{{ route('admin.jenis-parenting.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Jenis Parenting</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.kategori-parenting.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Kategori Parenting</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.kategori-development.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Kategori Development</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.kategori-nutrition.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Kategori Nutrisi</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.kategori-parenting-assessment.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Kategori Parenting A.</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.klasifikasi-tinggi-badan.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Klasifikasi Tinggi Badan</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.klasifikasi-berat-badan.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Klasifikasi Berat Badan</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.klasifikasi-lingkar-kepala.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Klasifikasi Lingkar Kepala</span>
        </a>
      </li>

      <li class="nav-item nav-category">Post</li>
      <li class="nav-item">
        <a href="{{ route('admin.artikel.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Artikel</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.development.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Development</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.nutrition.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Nutrition</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.parenting.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Parenting</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.vaksin.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Vaksin</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.slider.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Slider</span>
        </a>
      </li>

      <li class="nav-item nav-category">Quiz</li>
      <li class="nav-item">
        <a href="{{ route('admin.parenting-assessment.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Parenting Assessment</span>
        </a>
      </li>

      <li class="nav-item nav-category">Data</li>
      <li class="nav-item">
        <a href="{{ route('admin.rekap.index') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Rekap Anak</span>
        </a>
      </li>

      <li class="nav-item nav-category">Logout</li>
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