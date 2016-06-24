@extends('layouts.app')

@section('styles-before')
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
@endsection

@section('scripts-before')
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/i18n/pt-BR.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2({
                theme: "bootstrap",
                language: 'pt-BR',
                placeholder: "Selecione o Fornecedor",
                allowClear: true

            });
            $('#inicio').datepicker({
                autoclose: true,
                clearBtn: true,
                language: "pt-BR",
                format: 'dd/mm/yyyy'
            });
            $('#fim').datepicker({
                autoclose: true,
                clearBtn: true,
                language: "pt-BR",
                format: 'dd/mm/yyyy'
            });

            $('[data-toggle="popover"]').popover()
        })
    </script>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Gestão de Contratos
        </h1>
        {!! Breadcrumbs::render('role.index') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>

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
                                <a href="{{ route('contratos.create') }}" class="btn btn-bitbucket">
                                    <i class="fa fa-plus-circle"></i>
                                    Cadastrar Contrato
                                </a>
                                <a href="{{ route('casas.create') }}" class="btn btn-bitbucket">
                                    <i class="fa fa-newspaper-o"></i>
                                    Aditivar Contrato
                                </a>
                                <a href="{{ route('casas.create') }}" class="btn btn-bitbucket">
                                    <i class="fa fa-file-excel-o"></i>
                                    Exportar Excel
                                </a>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                @include('vendor.flash.message')
                                @if(auth()->user()->is_super == 1)
                                    @include('pages.contratos.forms.filter')
                                @else
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
                                            <th width="110" class="text-center">Ações</th>
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
                                                    <a href="{{ route('contratos.view', $contrato->id) }}"
                                                       class="btn-sm btn-microsoft" data-toggle="tooltip" title="Visualizar">
                                                        <i class="fa fa-eye"></i>
                                                    </a>&nbsp;
                                                    <a href="{{ route('contratos.edit', $contrato->id) }}" class="btn-sm btn-bitbucket" data-toggle="tooltip"
                                                       title="Editar">
                                                        <i class="fa fa-edit"></i>
                                                    </a>&nbsp;
                                                    <a href="{{ route('contratos.status', $contrato->id) }}" class="btn-sm btn-google" data-toggle="tooltip"
                                                       title="Status">
                                                        <i class="fa fa-tags"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
