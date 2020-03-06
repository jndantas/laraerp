                <!-- Sidebar Menu -->
                <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                with font-awesome or any other icon font library -->

                            <li class="nav-item">
                                <a href="{{route('home')}}" class="nav-link" active-class="active" exact>
                                    <i class="nav-icon fas fa-tachometer-alt blue"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-astronaut"></i>
                                    <p>
                                        Segurança do Trabalho
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('categories')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-boxes nav-icon"></i>
                                            <p>Categorias dos EPI's</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('certificates')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-certificate nav-icon"></i>
                                            <p>CA's</p>
                                        </a>
                                    </li>

                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-user-shield nav-icon"></i>
                                            <p>
                                                EPI's
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview" style="display: none;">
                                            <li class="nav-item">
                                                <a href="{{route('products')}}" class="nav-link">
                                                    <i class="fas fa-circle nav-icon"></i>
                                                    <p>Produtos</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('inputs')}}" class="nav-link" active-class="active" exact>
                                                    <i class="fas fa-sign-in-alt nav-icon"></i>
                                                    <p>Entradas</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('outputs')}}" class="nav-link" active-class="active" exact>
                                                    <i class="fas fa-sign-out-alt nav-icon"></i>
                                                    <p>Saídas</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('typeaccident')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-car-crash nav-icon"></i>
                                            <p>Tipos de Acidentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('accidents')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-user-injured nav-icon"></i>
                                            <p>Acidentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('trainings')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-running nav-icon"></i>
                                            <p>Treinamentos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('exams')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-clinic-medical nav-icon"></i>
                                            <p>Exames</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p>
                                        Recursos Humanos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('enterprises')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-building nav-icon"></i>
                                            <p>Empresas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('sectors')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-building nav-icon"></i>
                                            <p>Setores</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('positions')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-building nav-icon"></i>
                                            <p>Cargos</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('employees.index')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-user-friends nav-icon"></i>
                                            <p>Funcionários</p>
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
                                        <a href="{{route('users')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>Usuários</p>
                                        </a>
                                    </li>
                                </ul>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('developer')}}" class="nav-link" active-class="active" exact>
                                            <i class="fas fa-user-cog nav-icon"></i>
                                            <p>Desenvolvedor</p>
                                        </a>
                                    </li>
                                </ul>
                                @endcan
                            </li>
                            <li class="nav-item">
                                <a href="{{route('profile')}}" class="nav-link" active-class="active" exact>
                                    <i class="nav-icon fas fa-user-alt green"></i>
                                    <p>
                                        Perfil
                                    </p>
                                </a>
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
