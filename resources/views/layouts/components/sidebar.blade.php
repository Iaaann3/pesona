 <nav class="sidebar-nav scroll-sidebar" data-simplebar>
          <ul id="sidebarnav">
            <!-- ---------------------------------- -->
            <!-- Home -->
            <!-- ---------------------------------- -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <!-- ---------------------------------- -->
            <!-- Dashboard -->
            <!-- ---------------------------------- -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.pembayaran.index') }}">
                <span><i class="ti ti-cash"></i></span>
                <span class="hide-menu">Pembayaran</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.iklan.index') }}">
                <span><i class="ti ti-broadcast"></i></span>
                <span class="hide-menu">Iklan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.pengumuman.index') }}">
                <span><i class="fa fa-bullhorn"></i></span>
                <span class="hide-menu">Pengumuman</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.kegiatan.index') }}">
                <span><i class="ti ti-calendar-event"></i></span>
                <span class="hide-menu">Kegiatan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.saran.index') }}">
                <span><i class="ti ti-message-dots"></i></span>
                <span class="hide-menu">Saran & Kritik</span>
              </a>
            </li>
          </ul>
        </nav>
