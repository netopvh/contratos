@extends('layouts.app')

@section('scripts-before')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>
@stop

@section('content')
    <section class="content-header">
        <h1>
            Gestão de Contratos
        </h1>
        {!! Breadcrumbs::render('contratos.index') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
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
                            <div class="col-md-10">
                                <a href="{{ route('casas.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>
                                    Cadastrar Contrato
                                </a>
                                <a href="{{ route('casas.create') }}" class="btn btn-primary">
                                    <i class="fa fa-newspaper-o"></i>
                                    Aditivar Contrato
                                </a>
                                <a href="{{ route('contratos.index') }}" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                    Pesquisar
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                @include('vendor.flash.message')
                                <table id="grid" class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>Contrato</th>
                                            <th>Empresa</th>
                                            <th>Casa</th>
                                            <th>Gestores</th>
                                            <th>Início</th>
                                            <th>Fim</th>
                                            <th>Status</th>
                                            <th width="60" class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contratos as $contrato)
                                        <tr>
                                            <td>{{ $contrato->numero }} / {{ $contrato->ano }}</td>
                                            <td>{{ $contrato->empresa->razao }}</td>
                                            <td>{{ $contrato->casa->nome }}</td>
                                            <td>
                                                <a tabindex="0" class="btn btn-sm btn-success" role="button"
                                                   data-toggle="popover"
                                                   data-trigger="focus" title="Gestores do Contrato"
                                                   data-content="@foreach($contrato->gestores as $gestor)
                                                   {{ $gestor->name }},
                                                        @endforeach"><i class="fa fa-search"></i></a>
                                            </td>
                                            <td>{{ $contrato->data_inicio }}</td>
                                            <td>{{ $contrato->data_fim }}</td>
                                            <td>{{ $status[$contrato->status] }}</td>
                                            <td>
                                                <a href="{{ route('permissions.edit', $contrato->id) }}"
                                                   class="btn-sm btn-primary" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </a>&nbsp;
                                                <a href="" class="btn-sm btn-danger" data-toggle="tooltip"
                                                   title="Remover">
                                                    <i class="fa fa-remove"></i>
                                                </a>
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
@stop