<nav class="navbar navbar-default" style="background-color: #ffff">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/"><img src="{!! asset('css/imagenes/MT.jpg')!!}" width="60" height="35" alt=""></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              @if(Auth::check())
              @if (Auth::user()->level==2)
                <li>
                  <a href="/orders" style="color: #5D2D00; font-family: monospace; font-weight: 900"> Ordenes </a>
                </li>
                <li>
                  <a href="/products" style="color: #5D2D00; font-family: monospace; font-weight: 900"> Productos </a>
                </li>
                <li>
                  <a href="/categories" style="color: #5D2D00; font-family: monospace; font-weight: 900"> Categorias </a>
                </li>
                <li>
                  <a href="/admin/reportes" style="color: #5D2D00; font-family: monospace; font-weight: 900"> Generar reportes </a>
                </li>
              @endif
              @endif
                <li>
                  <a href="{{ route('product.shoppingCart') }}" style="color: #5D2D00; font-family: monospace; font-weight: 900">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrito
                    <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                  </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #5D2D00; font-family: monospace; font-weight: 900"><i class="fa fa-user" aria-hidden="true"></i> Cuenta de usuario <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="background-color: #ABA198">
                      @if(Auth::check())
                        <li><a href="{{ route('user.profile') }}" style="color: #5D2D00; font-family: monospace; font-weight: 900">Mis ordenes</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('user.logout') }}" style="color: #5D2D00; font-family: monospace; font-weight: 900">Cerrar sesion</a></li>
                      @else
                        <li><a href="{{ route('user.signup') }}" style="color: #5D2D00; font-family: monospace; font-weight: 900">Registrarse</a></li>
                        <li><a href="{{ route('user.signin') }}" style="color: #5D2D00; font-family: monospace; font-weight: 900">Iniciar sesion</a></li>
                      @endif
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
