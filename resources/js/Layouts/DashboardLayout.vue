<template>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <div class="dropdown-header text-center pb-2 pt-2 border-bottom">
              <strong>{{ user?.name || 'Administrator' }}</strong>
            </div>
            <a href="#" class="dropdown-item py-2">
              <i class="fas fa-user mr-2 text-primary"></i> My Profile
            </a>
            <a href="#" class="dropdown-item py-2">
              <i class="fas fa-cog mr-2 text-secondary"></i> Settings
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item py-2" @click.prevent="logout">
              <i class="fas fa-sign-out-alt mr-2 text-danger"></i> Sign Out
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/" class="brand-link text-center py-3">
        <img src="/images/logo.png" alt="Azam TV Logo" class="img-fluid" style="max-width: 140px; margin-bottom: 5px; display: block; margin-left: auto; margin-right: auto;">
        <!-- <span class="brand-text font-weight-bold" style="font-size: 1.2rem;">SMS</span> -->
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel with dropdown -->
        <div class="user-panel mt-3 pb-2 mb-2">
          <div class="d-flex align-items-center">
            <div class="image pl-2">
              <i class="fas fa-user-circle fa-2x text-light"></i>
            </div>
            <div class="info">
              <a href="#" class="d-block dropdown-toggle" data-toggle="collapse" data-target="#userOptions">
                {{ user?.name || 'Administrator' }}
              </a>
            </div>
          </div>
          
          <!-- User options dropdown -->
          <div id="userOptions" class="collapse mt-2">
            <div class="bg-dark rounded p-2 ml-2">
              <a href="#" class="text-white d-block py-1 px-2 rounded hover-bg-light">
                <i class="fas fa-user-edit mr-2"></i> Edit Profile
              </a>
              <a href="#" class="text-white d-block py-1 px-2 rounded hover-bg-light" @click.prevent="logout">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
              </a>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="/" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-sms"></i>
                <p>
                  SMS Management
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/sms/send" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Send SMS</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/sms/templates" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SMS Templates</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/sms/logs" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SMS Logs</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="/recipients" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Recipients</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/settings" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>Settings</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content with no header or title -->
      <div class="content pt-4">
        <div class="container-fluid">
          <slot></slot>
        </div>
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; {{ new Date().getFullYear() }} <a href="#">Azam TV Bulk SMS</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
  title: {
    type: String,
    default: 'Dashboard'
  }
});

// Temporarily disabled for first-time setup
const user = ref({ name: 'Administrator' });

function logout() {
  // Will implement proper logout later
  window.location.href = '/login';
}

// Initialize AdminLTE JS functionality after component is mounted
onMounted(() => {
  // Initialize dropdown in navbar
  const userDropdownToggle = document.getElementById('userDropdown');
  if (userDropdownToggle) {
    userDropdownToggle.addEventListener('click', (e) => {
      e.preventDefault();
      const dropdownMenu = userDropdownToggle.nextElementSibling;
      if (dropdownMenu) {
        dropdownMenu.classList.toggle('show');
        userDropdownToggle.setAttribute('aria-expanded', dropdownMenu.classList.contains('show'));
      }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
      if (!userDropdownToggle.contains(e.target)) {
        const dropdownMenu = userDropdownToggle.nextElementSibling;
        if (dropdownMenu && dropdownMenu.classList.contains('show')) {
          dropdownMenu.classList.remove('show');
          userDropdownToggle.setAttribute('aria-expanded', 'false');
        }
      }
    });
  }
  
  // Toggle sidebar menu items
  document.querySelectorAll('.nav-treeview').forEach(el => {
    // Initialize with closed state
    el.style.display = 'none';
  });

  // Add click handlers to menu items with submenu
  document.querySelectorAll('.nav-item a').forEach(el => {
    if (el.nextElementSibling && el.nextElementSibling.classList.contains('nav-treeview')) {
      el.addEventListener('click', (e) => {
        e.preventDefault();
        const submenu = el.nextElementSibling;
        if (submenu.style.display === 'none' || submenu.style.display === '') {
          submenu.style.display = 'block';
          el.classList.add('active');
        } else {
          submenu.style.display = 'none';
          el.classList.remove('active');
        }
      });
    }
  });

  // Initialize other AdminLTE components
  if (window.$.AdminLTE) {
    window.$.AdminLTE.init();
  } else if (window.AdminLTE) {
    // For AdminLTE 3.x
    document.querySelectorAll('[data-widget="pushmenu"]').forEach(el => {
      el.addEventListener('click', (e) => {
        e.preventDefault();
        document.body.classList.toggle('sidebar-collapse');
        document.body.classList.toggle('sidebar-open');
      });
    });
  }
});
</script>

<style>
/* Custom styling for the dashboard layout */
.hover-bg-light:hover {
  background-color: rgba(255, 255, 255, 0.1);
  transition: background-color 0.2s;
}

/* Make sure dropdown toggle has a pointer cursor */
.dropdown-toggle {
  cursor: pointer;
}

/* Add some animation to the dropdown */
#userOptions {
  transition: all 0.3s ease;
}

/* Dropdown styles for navbar user menu */
.dropdown-menu.show {
  display: block;
  transform: translate3d(0, 38px, 0) !important;
  top: 0 !important;
  right: 0 !important;
  left: auto !important;
  animation: fadeIn 0.2s ease-in;
}

.dropdown-item {
  transition: background-color 0.2s;
}

.dropdown-item:hover {
  background-color: #f8f9fa;
}

.dropdown-header {
  color: #6c757d;
  background-color: #f8f9fa;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
