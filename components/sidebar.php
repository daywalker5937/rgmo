<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <div class="brand-link">

      <div class="row justify-content-center mb-2 mt-3">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      </div>

      <div class="row justify-content-center"><span class="brand-text font-weight-light h6">Resource Generation Management</span></div>
      <div class="row justify-content-center"><span class="brand-text font-weight-light h6">Office<i>(RGMO)</i> Rental Services</span></div>
      <div class="row justify-content-center"><span class="brand-text font-weight-light h6">Monitoring System</span></div>

    </div>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

          <!-- Both Role Dashboard Sidebar -->
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <!-- Admin Sidebar -->
          <?php if($SES->role_name == 'admin') { ?>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-map-marker"></i>
                <p>Location</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-building"></i>
                <p>Leaseholder</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bolt"></i>
                <p>Services</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>Reports</p>
              </a>
            </li>

          <?php } ?>

          <!-- Client Sidebar -->
          <?php if($SES->role_name == 'client') { ?>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Profile</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bolt"></i>
                <p>Services</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>Reports</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-question-circle"></i>
                <p>About</p>
              </a>
            </li>

          <?php } ?>

          

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>