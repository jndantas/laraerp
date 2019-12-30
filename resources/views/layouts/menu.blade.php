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
                                        <router-link to="/enterprise" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-building nav-icon"></i>
                                            <p>Empresas</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/category" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-boxes nav-icon"></i>
                                            <p>Categorias</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/product" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-user-shield nav-icon"></i>
                                            <p>EPI's</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/position" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-user-tie nav-icon"></i>
                                            <p>Cargos</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/employee" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-user-friends nav-icon"></i>
                                            <p>Funcionários</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/typeaccident" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-car-crash nav-icon"></i>
                                            <p>Tipos de Acidentes</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/accident" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-user-injured nav-icon"></i>
                                            <p>Acidentes</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/input" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-sign-in-alt nav-icon"></i>
                                            <p>Entradas</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/output" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-sign-out-alt nav-icon"></i>
                                            <p>Saídas</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/training" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-running nav-icon"></i>
                                            <p>Treinamentos</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/exam" tag="a" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-clinic-medical nav-icon"></i>
                                            <p>Exames</p>
                                        </router-link>
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
