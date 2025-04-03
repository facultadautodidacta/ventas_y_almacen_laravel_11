<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route("home") }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      @can('ver-ventas')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="fa-solid fa-cart-shopping"></i><span>Ventas</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route("ventas-nueva") }}">
              <i class="bi bi-circle"></i><span>Vender Producto</span>
            </a>
          </li>
          <li>
            <a href="{{route("detalle-venta")}}">
              <i class="bi bi-circle"></i><span>Consultar Ventas</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->
      @endcan
      
      @can('ver-admin')
      <!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route("categorias") }}">
          <i class="fa-solid fa-list-check"></i>
          <span>Categorias</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#productos-nav" data-bs-toggle="collapse" href="#">
          <i class="fa-solid fa-window-restore"></i></i><span>Productos</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="productos-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route("productos") }}">
              <i class="bi bi-circle"></i><span>Administrar productos</span>
            </a>
          </li>
          <li>
            <a href="{{ route("reportes_productos") }}">
              <i class="bi bi-circle"></i><span>Reportes de productos</span>
            </a>
          </li>
          
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('compras') }}">
          <i class="fa-solid fa-shop"></i>
          <span>Compras</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route("proveedores") }}">
          <i class="fa-solid fa-truck"></i>
          <span>Proveedores</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route("usuarios") }}">
          <i class="fa-solid fa-users"></i>
          <span>Usuarios</span>
        </a>
      </li><!-- End Blank Page Nav -->
      @endcan
    </ul>

  </aside>