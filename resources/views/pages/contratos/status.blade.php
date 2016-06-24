@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gestão de Contratos
        </h1>
        {!! Breadcrumbs::render('contratos.status') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <b>Definir Status do Contrato</b>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        {!! Form::model($contrato, ['method' => 'patch', 'route' => ['contratos.status', $contrato->id], 'autocomplete' => 'off']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('contrato', 'Nº do Contrato:') !!}
                                    {!! Form::text('numero', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('ano', 'Ano:') !!}
                                    {!! Form::text('ano', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    {!! Form::label('fornecedor', 'Fornecedor:') !!}
                                    <input type="text" class="form-control" value="{{ $contrato->empresa->razao }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('status', 'Status do Contrato:') !!}
                                    {!! Form::select('status', $status,null,[
                                        'class' => 'form-control',
                                        'placeholder' => 'Selecione o Status'
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>&nbsp;
                                <a href="{{ route('contratos.index') }}" class="btn btn-primary"><i class="fa fa-share"></i> Voltar</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop