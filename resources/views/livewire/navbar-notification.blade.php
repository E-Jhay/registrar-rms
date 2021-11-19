<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{$notificationTotal}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-header">{{$notificationTotal}} Notifications</span>
      <div class="dropdown-divider"></div>
      <a href="{{route('orders.index')}}" class="dropdown-item">
        <i class="fas fa-clipboard-list"></i> {{$expiredOrders}} Expired Orders
      </a>
      <div class="dropdown-divider"></div>
      <a href="{{route('orders.index')}}" class="dropdown-item">
        <i class="fas fa-clipboard-list"></i> {{$pendingOrders}} Pending Orders
      </a>
      <div class="dropdown-divider"></div>
      <a href="{{route('orders.index')}}" class="dropdown-item">
        <i class="fas fa-clipboard-list"></i> {{$ordersToClaim}} Claimable Orders
      </a>
    </div>
</li>
