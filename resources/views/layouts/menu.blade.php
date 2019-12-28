                <!-- Sidebar Menu -->
                <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                with font-awesome or any other icon font library -->

                            <li class="nav-item">
                                <router-link to="/dashboard" tag="a" class="nav-link" active-class="active" exact>
                                    <i class="nav-icon fas fa-tachometer-alt blue"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </router-link>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Segurança do Trabalho
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/category" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-boxes nav-icon"></i>
                                            <p>Categorias</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-circle nav-icon"></i>
                                            <p>Inactive Page</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @can('isAdmin')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        Configurações
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/users" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>Usuários</p>
                                        </router-link>
                                    </li>
                                </ul>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/developer" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-user-cog nav-icon"></i>
                                            <p>Desenvolvedor</p>
                                        </router-link>
                                    </li>
                                </ul>
                                @endcan
                            </li>
                            <li class="nav-item">
                                <router-link to="/profile" tag="a" class="nav-link" active-class="active" exact>
                                    <i class="nav-icon fas fa-user-alt green"></i>
                                    <p>
                                        Perfil
                                    </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                    <i class="nav-icon fa fa-power-off red"></i>
                                    <p>
                                        {{ __('Logout') }}
                                    </p>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
