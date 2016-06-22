@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gestão de Usuário
        </h1>
        {!! Breadcrumbs::render('role.permissions') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Definir Permissções</h3>

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
                                {!! Form::open(['route' => ['roles.permissions', $role->id], 'method' => 'post', 'id' => 'roleForm']) !!}
                                <div class="row">
                                    <div class="col-md-7">
                                        <label>Nome do Pefil:</label>
                                        <input type="text" value="{{ $role->display_name }}" class="form-control"
                                               disabled>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>
                                            <input type="checkbox" id="checkAll">
                                            Marcar Todos
                                        </label>
                                        <br>

                                        <div class="row">
                                            @foreach($groups as $group)
                                                <div class="col-md-3">
                                                    <nav id="permissions">
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    {{ $group->name }}
                                                                </label>
                                                                <ul>
                                                                    <li>
                                                                        <div style="padding-left:10px;">
                                                                            @foreach ($group->permissions as $permission)
                                                                                <label>
                                                                                    @if(in_array($permission['id'],array_keys($rolePermissions)))
                                                                                        <input type="checkbox"
                                                                                               name="permissions[]"
                                                                                               value="{{ $permission['id'] }}"
                                                                                               checked/>
                                                                                    @else
                                                                                        <input type="checkbox"
                                                                                               name="permissions[]"
                                                                                               value="{{ $permission['id'] }}"/>
                                                                                    @endif
                                                                                    {{ $permission['display_name'] }}
                                                                                </label>
                                                                            @endforeach
                                                                            @foreach($group->children as $child)
                                                                                <ul>
                                                                                    <li>
                                                                                        <label>
                                                                                            {!! $child->name !!}
                                                                                        </label>
                                                                                        <ul>
                                                                                            @foreach ($child->permissions as $permission)
                                                                                                <li style="margin-left: 20px">
                                                                                                    <label>
                                                                                                        @if(in_array($permission['id'],array_keys($rolePermissions)))
                                                                                                            <input type="checkbox" name="permissions[]" value="{{ $permission['id'] }}" checked/>
                                                                                                        @else
                                                                                                            <input type="checkbox" name="permissions[]" value="{{ $permission['id'] }}" />
                                                                                                        @endif
                                                                                                        {{ $permission['display_name'] }}
                                                                                                    </label>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            @endforeach
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a href="{{ route('roles.index') }}" class="btn btn-primary">Voltar</a>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts-before')
    <script>
        $("#checkAll").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
    </script>
@stop