<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Role -->
      <li class="nav-item">
        <span class="nav-link"> <?php echo $SES->user_name . " | " . ucfirst($SES->role_name); ?> </span>
      </li>

      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->

      <!-- User Profile and Logout Menu -->
      <li class="nav-item">
        <a href="#" class="nav-link" onclick="signout_user()">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <script>
      function signout_user() {
        answer = confirm("Are you sure you want to logout?");
        if(answer) {
          alert('Logged out!');
          window.location.href = '../objects/logout.php'; 
        }
      }
  </script>