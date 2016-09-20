<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Adldap::search()->users()->find(Auth::user()->username)->getThumbnailEncoded() }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p class="small">{{ text_limit(auth()->user()->name) }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ isUrlActive('/') }}"><a href="{{ route('home') }}"><i class="fa fa-home"></i> <span>Home</span></a></li>
            @permission('ver-cadastros')
            <li class="treeview {{ arUrlActive(['casas','unidades','empresas']) }}">
                <a href="#"><i class="fa fa-plus-square"></i> <span>Cadastros</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('ver-casas')
                    <li class="{{ isUrlActive('casas') }}"><a href="{{ route('casas.index') }}"><i class="fa fa-institution"></i> Contratantes</a></li>
                    @endpermission
                    @permission('ver-unidades')
                    <li class="{{ isUrlActive('unidades') }}"><a href="{{ route('unidades.index') }}"><i class="fa fa-building"></i> Unidades Operacionais</a></li>
                    @endpermission
                    @permission('ver-fornecedores')
                    <li class="{{ isUrlActive('empresas') }}"><a href="{{ route('empresas.index') }}"><i class="fa fa-industry"></i> Contratados</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('ver-movimentos')
            <li class="treeview {{ arUrlActive(['contratos']) }}">
                <a href="#"><i class="fa fa-history"></i> <span>Movimentação</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ isUrlActive('contratos') }}"><a href="{{ route('contratos.index') }}"><i class="fa fa-paperclip"></i> Contratos</a></li>
                </ul>
            </li>
            @endpermission
            <li class="treeview {{ arUrlActive(['report']) }}">
                <a href="#"><i class="fa fa-folder-open"></i> <span>Relatórios</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ isUrlActive('report') }}"><a href="{{ route('report.index') }}"><i class="fa fa-file-excel-o"></i> Contratos</a></li>
                </ul>
            </li>

        </ul>
        @permission('ver-admin')
        <ul class="sidebar-menu">
            <li class="header">ADMINISTRAÇÃO</li>
            <li class="treeview {{ arUrlActive(['users', 'roles', 'permissions']) }}">
                <a href="#"><i class="fa fa-users"></i> <span>Gestão de Usuários</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @permission('ver-usuarios')
                    <li class="{{ isUrlActive('users') }}"><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> Usuários</a></li>
                    @endpermission
                    @permission('ver-perfis')
                    <li class="{{ isUrlActive('roles') }}"><a href="{{ route('roles.index') }}"><i class="fa fa-group"></i> Perfis</a></li>
                    @endpermission
                    @permission('ver-permissoes')
                    <li class="{{ isUrlActive('permissions') }}"><a href="{{ route('permissions.index') }}"><i class="fa fa-unlock-alt"></i> Permissões</a></li>
                    @endpermission
                </ul>
            </li>
            @permission('ver-parametros')
            <li class="treeview">
                <a href="#"><i class="fa fa-cogs"></i> <span>Configurações</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-cog"></i> Parametrização</a></li>
                </ul>
            </li>
            @endpermission
            @permission('ver-logs')
            <li class="{{ isUrlActive('logs') }}"><a href="{{ route('logs') }}"><i class="fa fa-warning"></i> <span>Logs do Sistema</span></a></li>
            @endpermission
        </ul>
        @endpermission
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>