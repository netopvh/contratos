@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gerenciamento
        </h1>
        {!! Breadcrumbs::render('unidades.index') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Unidades</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        @permission('add-unidades')
                        <div class="row">
                            <div class="col-md-7">
                                <a href="{{ route('unidades.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>
                                    Nova Unidade
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
                                        <th>Nome</th>
                                        <th>Casa</th>
                                        <th class="text-center" width="60">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($unidades as $unidade)
                                        <tr>
                                            <td>{{ str_pad($unidade->id, 3, '0', STR_PAD_LEFT)}}</td>
                                            <td>{{ $unidade->nome }}</td>
                                            <td>{{ $unidade->casa->nome }}</td>
                                            <td>
                                                {!! Form::open(['method' => 'delete', 'route' => ['unidades.destroy', $unidade->id]]) !!}
                                                @permission('editar-unidades')
                                                <a href="{{ route('unidades.edit', $unidade->id) }}"
                                                   class="btn btn-sm btn-primary" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </a>&nbsp;
                                                @endpermission
                                                @permission('deletar-unidades')
                                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                        title="Remover">
                                                    <i class="fa fa-remove"></i>
                                                </button>
                                                @endpermission
                                                {!! Form::close() !!}
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

