@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gerenciamento
        </h1>
        {!! Breadcrumbs::render('casas.index') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Contratantes</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        @permission('add-casas')
                        <div class="row">
                            <div class="col-md-7">
                                <a href="{{ route('casas.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>
                                    Novo Contratante
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
                                        <th class="text-center" width="40">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($casas as $casa)
                                        <tr>
                                            <td>{{ str_pad($casa->id, 3, '0', STR_PAD_LEFT)}}</td>
                                            <td>{{ $casa->nome }}</td>
                                            <td>
                                                {!! Form::open(['method' => 'delete', 'route' => ['casas.destroy', $casa->id]]) !!}
                                                @permission('editar-casas')
                                                <a href="{{ route('casas.edit', $casa->id) }}"
                                                   class="btn btn-sm btn-primary" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </a>&nbsp;
                                                @endpermission
                                                @permission('deletar-casas')
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
