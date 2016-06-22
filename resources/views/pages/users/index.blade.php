@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gestão de Usuário
        </h1>
        {!! Breadcrumbs::render('user.index') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Usuários</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('users.import') }}" class="btn btn-primary">Importar Usuários</a>
                                <br><br>
                                @include('vendor.flash.message')
                                <table id="grid" class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th width="50">ID</th>
                                        <th width="250">Nome</th>
                                        <th width="250">Email</th>
                                        <th width="100">Grupo</th>
                                        <th class="text-center" width="40">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ str_pad($user->id, 3, '0', STR_PAD_LEFT)}}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->roles()->first()->display_name }}</td>
                                            <td class="text-center">
                                                @permission('editar-usuarios')
                                                <a href="{{ route('users.edit', $user->id) }}"
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
