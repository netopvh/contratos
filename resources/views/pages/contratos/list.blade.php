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
                                @permission('add-contratos')
                                <a href="{{ route('contratos.create') }}" class="btn btn-bitbucket">
                                    <i class="fa fa-plus-circle"></i>
                                    Cadastrar Contrato
                                </a>
                                @endpermission
                                @permission('aditivar-contratos')
                                <a href="{{ route('contratos.aditivar.index') }}" class="btn btn-bitbucket">
                                    <i class="fa fa-newspaper-o"></i>
                                    Aditivar Contrato
                                </a>
                                @endpermission
                                @permission('exportar-contratos')
                                <a href="{{ route('casas.create') }}" class="btn btn-bitbucket">
                                    <i class="fa fa-file-excel-o"></i>
                                    Exportar Excel
                                </a>
                                @endpermission
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
                                            <th width="60">Gestores</th>
                                            <th>Início</th>
                                            <th>Fim</th>
                                            <th width="60">Aditivado</th>
                                            <th>Status</th>
                                            <th width="135" class="text-center">Ações</th>
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
                                            <td>
                                                @if($contrato->aditivado == 'S')
                                                    <span class="label label-success">Sim</span>
                                                @else
                                                    <span class="label label-warning">Não</span>
                                                @endif
                                            </td>
                                            <td>{{ $status[$contrato->status] }}</td>
                                            <td>
                                                <a href="{{ url('/') }}/uploads/files/{{ $contrato->arquivo }}" target="_blank"
                                                   class="btn-sm btn-flickr" data-toggle="tooltip" title="Integra do Contrato">
                                                    <i class="fa fa-file-pdf-o"></i>
                                                </a>&nbsp;
                                                @permission('visualizar-contratos')
                                                <a href="{{ route('contratos.view', $contrato->id) }}"
                                                   class="btn-sm btn-microsoft" data-toggle="tooltip" title="Visualizar">
                                                    <i class="fa fa-eye"></i>
                                                </a>&nbsp;
                                                @endpermission
                                                @permission('editar-contratos')
                                                <a href="{{ route('contratos.edit', $contrato->id) }}" class="btn-sm btn-bitbucket" data-toggle="tooltip"
                                                   title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </a>&nbsp;
                                                @endpermission
                                                @permission('status-contratos')
                                                <a href="{{ route('contratos.status', $contrato->id) }}" class="btn-sm btn-google" data-toggle="tooltip"
                                                   title="Status">
                                                    <i class="fa fa-tags"></i>
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
@stop