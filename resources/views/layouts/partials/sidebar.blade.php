<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      <img src="{{ asset('dist/img/psu_logo.png') }}" alt="PSU Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Registrar Office') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user1.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info text-white">
          {{Auth::user()->name}}
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link 
              {{ request()->is('dashboard') ? 'active' : null }}
            ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">
            Interface
          </li>
          <li class="nav-item">
            <a href="{{route('orders.index')}}" class="nav-link
              {{ request()->is('orders') ? 'active' : null }}
            ">
              <i class="nav-icon fas fa-paperclip"></i>
              <p>
                Requests
              </p>
            </a>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="" class="nav-link {{ request()->is('reports') || request()->is('quarterly-reports') ? 'active' : null }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Generate Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('reports')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Monthly Report
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('quarterly-reports')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Quarterly Report
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('documents')}}" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Document Types
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('accounts')}}" class="nav-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Accounts
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>