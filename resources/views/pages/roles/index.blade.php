@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gestão de Usuário
        </h1>
        {!! Breadcrumbs::render('role.index') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Perfis de Usuário</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        @permission('add-perfis')
                        <div class="row">
                            <div class="col-md-7">
                                <a href="{{ route('roles.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>
                                    Novo Perfil
                                </a>
                            </div>
                        </div>
                        <br>
                        @endpermission
                        <div class="row">
                            <div class="col-md-12">
                                @include('vendor.flash.message')
                                <table id="grid" class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th width="50">ID</th>
                                        <th width="250">Nome</th>
                                        <th class="text-center" width="80">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ str_pad($role->id, 3, '0', STR_PAD_LEFT)}}</td>
                                            <td>{{ $role->display_name }}</td>
                                            <td>
                                                @permission('ver-perfis')
                                                <a href="" class="btn-sm btn-success" data-toggle="tooltip"
                                                   title="Ver Permissões">
                                                    <i class="fa fa-search"></i>
                                                </a>&nbsp;
                                                @endpermission
                                                @permission('definir-perfis')
                                                <a href="{{ route('roles.permissions', $role->id) }}" class="btn-sm btn-warning" data-toggle="tooltip"
                                                   title="Definir Permissões">
                                                    <i class="fa fa-key"></i>
                                                </a>&nbsp;
                                                @endpermission
                                                @permission('editar-perfis')
                                                <a href="{{ route('roles.edit', $role->id) }}"
                                                   class="btn-sm btn-primary" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endpermission
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

