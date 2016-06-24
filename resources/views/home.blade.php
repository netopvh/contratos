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
                        <span class="info-box-text">Total Contratos</span>
                        <span class="info-box-number">{{ str_pad($allContratos->count(), 4, '0', STR_PAD_LEFT)}}</span>
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
                            <table class="table table-bordered table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th>Numero do Contrato</th>
                                    <th>CPF / CNPJ</th>
                                    <th>Fornecedor</th>
                                    <th>Vencimento</th>
                                    <th width="60">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($allContratos->count() < 0)
                                    <tr>
                                        <td colspan="3">Sem Contratos Próximos do Vencimento</td>
                                    </tr>
                                @else
                                    @foreach($allContratos as $contrato)
                                        <tr class="bg-danger">
                                            <td>{{ $contrato->numero }} / {{ $contrato->ano }}</td>
                                            <td>@if(strlen($contrato->empresa->cpf_cnpj) == 14)
                                                    {{ mask('##.###.###/####-##', $contrato->empresa->cpf_cnpj) }}
                                                @else
                                                    {{ mask('###.###.###-##', $contrato->empresa->cpf_cnpj) }}
                                                @endif</td>
                                            <td>{{ $contrato->empresa->razao }}</td>
                                            <td>{{ $contrato->data_fim }}</td>
                                            <td>
                                                <a href="{{ route('contratos.view', $contrato->id) }}" class="btn btn-sm btn-bitbucket" data-toggle="tooltip" title="Visualizar">
                                                    <i class="fa fa-search"></i>
                                                </a>
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
    </section>
@endsection
