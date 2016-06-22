@extends('layouts.app')

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
                        <div id="print">
                            <div class="row">
                                <div class="col-md-8">
                                    <img src="{{ asset('img/fiero.png') }}" width="260" alt="Sistema Fiero">
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <b>Contrato Nº:</b> {{ $contrato->numero }} / {{ $contrato->ano }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <b>Vigência:</b> {{ $contrato->data_inicio }} até {{ $contrato->data_fim }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <b>Casa:</b> {{ $contrato->casa->nome }}
                                        </div>
                                    </div>
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
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend>Fornecedor / Prestador de Serviço</legend>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <b>Tipo: </b>{{ $tipo[$contrato->empresa->tipo_pessoa] }}
                                            </div>
                                            <div class="col-md-3">
                                                @if(strlen($contrato->empresa->cpf_cnpj) == 14)
                                                    <b>CNPJ: </b>{{ mask('##.###.###/####-##', $contrato->empresa->cpf_cnpj) }}

                                                @else
                                                    <b>CPF: </b>{{ mask('###.###.###-##', $contrato->empresa->cpf_cnpj) }}
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <b>Razão Social: </b>{{ $contrato->empresa->razao }}
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <b>Responsável: </b>{{ $contrato->empresa->responsavel }}
                                            </div>
                                            <div class="col-md-4">
                                                <b>E-mail: </b>{{ $contrato->empresa->email }}
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend>Informações do Contrato</legend>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b>Valor Homologado: </b>R$ {{ number_format($contrato->homologado, 2, ',', '.') }}
                                            </div>
                                            <div class="col-md-3">
                                                <b>Valor Homologado: </b>R$ {{ number_format($contrato->executado, 2, ',', '.') }}
                                            </div>
                                            <div class="col-md-4">
                                                <b>Situação do Contrato: </b>{{ $status[$contrato->status] }}
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered table-striped table-condensed">
                                                    <thead>
                                                    <tr>
                                                        <th>Gestores do Contrato:</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($contrato->gestores as $gestor)
                                                        <tr>
                                                            <td>{{ $gestor->name }}</td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-facebook"><i class="fa fa-print"></i> Imprimir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop