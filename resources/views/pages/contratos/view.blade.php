@extends('layouts.app')

@section('scripts-before')
    <script src="{{ asset('plugins/jQuery.print/jQuery.print.js') }}"></script>
    <script>
        $(function () {
            $('#send').click(function () {
                $("#print").print({
                    globalStyles: true,
                    mediaPrint: false,
                    stylesheet: null,
                    noPrintSelector: ".no-print",
                    iframe: true,
                    append: null,
                    prepend: null,
                    manuallyCopyFormValues: true,
                    deferred: $.Deferred(),
                    timeout: 250,
                    title: "Gestão de Contratos",
                    doctype: '<!doctype html>'
                });
            });
        });
    </script>
@stop

@section('content')
    <section class="content-header">
        <h1>
            Gestão de Contratos
        </h1>
        {!! Breadcrumbs::render('contratos.view') !!}
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
                        <div id="print">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-7">
                                        <img src="{{ asset('img/fiero.png') }}" width="260" alt="Sistema Fiero">
                                    </div>
                                    <div class="col-xs-5">
                                        <b>Contrato Nº:</b> {{ $contrato->numero }} / {{ $contrato->ano }} <br>
                                        <b>Vigência:</b> {{ $contrato->data_inicio }} até {{ $contrato->data_fim }} <br>
                                        <b>Contratante:</b> {{ $contrato->casa->nome }} <br>
                                        @if(! empty($contrato->unidade_id))
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <b>Unidade:</b> {{ $contrato->unidade->nome }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4>Informações do Contratado</h4>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <b>Tipo: </b> <br>{{ $tipo[$contrato->empresa->tipo_pessoa] }}
                                                    </div>
                                                    <div class="col-xs-4">
                                                        @if(strlen($contrato->empresa->cpf_cnpj) == 14)
                                                            <b>CNPJ: </b>
                                                            <br>{{ mask('##.###.###/####-##', $contrato->empresa->cpf_cnpj) }}

                                                        @else
                                                            <b>CPF: </b>
                                                            <br>{{ mask('###.###.###-##', $contrato->empresa->cpf_cnpj) }}
                                                        @endif
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <b>Razão Social: </b> <br>{{ $contrato->empresa->razao }}
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <b>Responsável: </b> <br>{{ $contrato->empresa->responsavel }}
                                                    </div>
                                                    <div class="col-xs-5">
                                                        <b>E-mail: </b> <br>{{ $contrato->empresa->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4>Informações do Contrato</h4>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <b>Valor Total: </b>
                                                        <br>R$ {{ number_format($contrato->total, 2, ',', '.') }}
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <b>Situação do Contrato: </b>
                                                        <br>{{ $status[$contrato->status] }}
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <b>Contrato Aditivado? </b>
                                                        <br>
                                                        @if($contrato->aditivado == 'S')
                                                            Sim
                                                        @else
                                                            Não
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr>
                                                <br>
                                                @if($contrato->aditivado == 'S')
                                                    <div class="row">
                                                        <div class="col-xs-3">
                                                            <b>Valor de Origem: </b>
                                                            <br>R$ {{ number_format($contrato->valor_origem, 2, ',', '.') }}
                                                        </div>
                                                    </div>
                                                    <br>
                                                @endif
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <b>Objeto do Contrato: </b> <br>
                                                        @if($contrato->aditivado == 'S')
                                                            {!! nl2br($contrato->aditivo->comentario) !!}
                                                        @else
                                                            {!! nl2br($contrato->comentario) !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- / end client details section -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default no-margin">
                                            <div class="panel-heading">
                                                <h4>Gestores do Contrato</h4>
                                            </div>
                                            <div class="panel-body">
                                                @foreach($contrato->gestores as $gestor)
                                                    {{ $gestor->name }},
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-facebook" id="send"><i class="fa fa-print"></i> Imprimir</button>
                                &nbsp;
                                <a href="{{ route('contratos.index') }}" class="btn btn-dropbox"><i
                                            class="fa fa-share"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop