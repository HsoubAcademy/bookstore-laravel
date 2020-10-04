    <!-- Sidebar -->
    <ul class="pr-0 navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
          <img style="width:70%" src="{!! asset('logo.png') !!}"> 
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{ route('admin.index') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>لوحة التحكم</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item {{ request()->is('admin/books*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{ route('books.index') }}">
        <i class="fas fa-book-open"></i>
          <span>الكتب</span>
        </a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{ route('categories.index') }}">
        <i class="fas fa-folder"></i>
          <span>التصنيفات</span>
        </a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item {{ request()->is('admin/authors*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{ route('authors.index') }}">
        <i class="fas fa-pen-fancy"></i>
          <span>المؤلفون</span>
        </a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item {{ request()->is('admin/publishers*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{ route('publishers.index') }}">
        <i class="fas fa-table"></i>
          <span>الناشرون</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
        <a class="nav-link text-right" href="{{ route('users.index') }}">
        <i class="fas fa-users"></i>
          <span>المستخدمون</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->