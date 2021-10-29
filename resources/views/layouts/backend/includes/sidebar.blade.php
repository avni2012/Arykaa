<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-purple">
  <!-- Brand Logo -->
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <img src="{{ asset('frontend/images/favicon.ico') }}" alt="Project Logo" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: white">
    <span class="brand-text font-weight-light">
      @if(auth()->guard()->user())
        {{ auth()->guard()->user()->name }}
      @endif

    </span>
  </a>
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a  class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="nav-icon fas fa-tachometer-alt">

            </i>
            <p class="text">Dashboard</p>
          </a>
        </li>
        @if(auth()->guard()->user()->can('list-staff') )
        <li class="nav-item">
          <a href="{{ route('manage-staff.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-friends">
              </i>
              <p class="text">Staff</p>
          </a>
        </li>
        @endif

        @if(auth()->guard()->user()->can('list-product'))
              <li class="nav-item">
                  <a href="{{route('manage-product.index')}}" class="nav-link">
                      <i class="nav-icon fa fa-shopping-cart" aria-hidden="true">
                      </i>
                      <p class="text">Product Masters</p>
                  </a>
              </li>
          @endif 

          <li class="nav-item">
            <a href="{{route('manage-sub-product.index')}}" class="nav-link">
              <i class="nav-icon fa fa-shopping-cart" aria-hidden="true">
              </i>
              <p class="text">Products</p>
            </a>
          </li>

          @if(auth()->guard()->user()->can('list-order'))
              <li class="nav-item">
                  <a href="{{route('manage-order.index')}}" class="nav-link">
                      <i class="nav-icon fa fa-reorder" aria-hidden="true">
                      </i>
                      <p class="text">Orders</p>
                  </a>
              </li>
          @endif 
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
</aside>
