@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@stop

@section('content')
    <section class="content-header">
        <h4>
            Bem Vindo {{ auth()->user()->name }}
        </h4>
        {!! Breadcrumbs::render('home') !!}
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua-gradient"><i class="fa fa-clone"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Contratos a vencer</span>
                        <span class="info-box-number">{{ str_pad($contratos->count(), 4, '0', STR_PAD_LEFT)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Fornecedores</span>
                        <span class="info-box-number">{{ str_pad($allEmpresas->count(), 4, '0', STR_PAD_LEFT)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Contratos Próximos do Vencimento</b>
                    </div>
                	<div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th width="200">Numero do Contrato</th>
                                    <th>CPF / CNPJ</th>
                                    <th>Contratado</th>
                                    <th>Contratante</th>
                                    <th>Unidade / Setor</th>
                                    <th>Vencimento</th>
                                    <th width="60">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($contratos->count() <= 0)
                                    <tr>
                                        <td colspan="6" class="text-center"><b>Sem Contratos Próximos do Vencimento</b></td>
                                    </tr>
                                @else
                                    @foreach($contratos as $contrato)
                                        <tr class="bg-red-active">
                                            <td>{{ $contrato->numero }} / {{ $contrato->ano }}</td>
                                            <td>@if(strlen($contrato->empresa->cpf_cnpj) == 14)
                                                    {{ mask('##.###.###/####-##', $contrato->empresa->cpf_cnpj) }}
                                                @else
                                                    {{ mask('###.###.###-##', $contrato->empresa->cpf_cnpj) }}
                                                @endif</td>
                                            <td>{{ $contrato->empresa->razao }}</td>
                                            <td>{{ $contrato->casa->nome }}</td>
                                            <td>{{ $contrato->unidade->nome }}</td>
                                            <td>{{ $contrato->data_fim }}</td>
                                            <td>
                                                @permission('visualizar-contratos')
                                                <a href="{{ route('contratos.view', $contrato->id) }}" class="btn btn-sm btn-bitbucket" data-toggle="tooltip" title="Visualizar">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                                @endpermission
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                	</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="well">
                    <a href="{{ url('/') }}/uploads/manual/manual.pdf" target="_blank" class="btn btn-primary">Manual do Sistema de Contratos</a>
                </div>
            </div>
        </div>
    </section>
@endsection
