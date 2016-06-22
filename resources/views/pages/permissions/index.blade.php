@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gestão de Usuário
        </h1>
        {!! Breadcrumbs::render('permissions.index') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Grupos e Permissões de Usuário</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#grupos" aria-controls="grupos"
                                                                          role="tab" data-toggle="tab">Grupos</a></li>
                                <li role="presentation"><a href="#permissoes" aria-controls="permissoes" role="tab"
                                                           data-toggle="tab">Listar Permissões</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="grupos">
                                    <br>
                                    @permission('add-grupos')
                                    <div class="row">
                                        <div class="col-md-7">
                                            <a href="{{ route('groups.create') }}" class="btn btn-primary">
                                                <i class="fa fa-plus-circle"></i>
                                                Novo Grupo
                                            </a>
                                        </div>
                                    </div>
                                    @endpermission
                                    <div class="row">
                                        <div class="col-md-8">
                                            <br>

                                            <div class="table-responsive">
                                                @include('vendor.flash.message')
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>Ações</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($groups as $group)
                                                        <tr>
                                                            <td>
                                                                {!! $group->name !!}

                                                                @if($group->permissions->count())
                                                                    <div style="padding-left:40px;font-size:.8em">
                                                                        @foreach ($group->permissions as $permission)
                                                                            {!! $permission->display_name !!}<br/>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {!! Form::open(['method' => 'delete', 'route' => ['groups.destroy', $group->id]]) !!}
                                                                @permission('editar-grupos')
                                                                <a href="{{ route('groups.edit', $group->id) }}"
                                                                   class="btn btn-sm btn-primary" data-toggle="tooltip" title="Editar">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>&nbsp;
                                                                @endpermission
                                                                @permission('deletar-grupos')
                                                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                                        title="Remover">
                                                                    <i class="fa fa-remove"></i>
                                                                </button>
                                                                @endpermission
                                                                {!! Form::close() !!}
                                                            </td>
                                                        </tr>
                                                        @if($group->children->count())
                                                            @foreach($group->children as $child)
                                                                <tr>
                                                                    <td style="padding-left:40px">
                                                                        <em>{!! $child->name !!}</em>

                                                                        @if ($child->permissions->count())
                                                                            <div style="padding-left:40px;font-size:.8em">
                                                                                @foreach ($child->permissions as $permission)
                                                                                    {!! $permission->display_name !!}<br/>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::open(['method' => 'delete', 'route' => ['groups.destroy', $child->id]]) !!}
                                                                        @permission('editar-grupos')
                                                                        <a href="{{ route('groups.edit', $child->id) }}"
                                                                           class="btn btn-sm btn-primary" data-toggle="tooltip" title="Editar">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>&nbsp;
                                                                        @endpermission
                                                                        @permission('deletar-grupos')
                                                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                                                title="Remover">
                                                                            <i class="fa fa-remove"></i>
                                                                        </button>
                                                                        @endpermission
                                                                        {!! Form::close() !!}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="permissoes">
                                    <br>
                                    @permission('add-permissoes')
                                    <div class="row">
                                        <div class="col-md-7">
                                            <a href="{{ route('permissions.create') }}" class="btn btn-primary">
                                                <i class="fa fa-plus-circle"></i>
                                                Nova Permissão
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                    @endpermission
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="grid" class="table table-condensed table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th width="50">ID</th>
                                                        <th>Nome</th>
                                                        <th>Grupo</th>
                                                        <th>Ordenação</th>
                                                        <th class="text-center" width="60">Ações</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($permissions as $permission)
                                                        <tr>
                                                            <td>{{ str_pad($permission->id, 3, '0', STR_PAD_LEFT)}}</td>
                                                            <td>{{ $permission->display_name }}</td>
                                                            <td>{{ $permission->group->name }}</td>
                                                            <td>{{ $permission->sort }}</td>
                                                            <td>
                                                                @permission('editar-permissoes')
                                                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                                                   class="btn-sm btn-primary" data-toggle="tooltip"
                                                                   title="Editar">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>&nbsp;
                                                                @endpermission
                                                                @permission('deletar-permissoes')
                                                                <a href="" class="btn-sm btn-danger"
                                                                   data-toggle="tooltip"
                                                                   title="Remover">
                                                                    <i class="fa fa-remove"></i>
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
                </div>
            </div>
        </div>
    </div>
@endsection

