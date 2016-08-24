@extends('layouts.app')

@section('styles-before')
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
@endsection

@section('scripts-before')
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
    <script>
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
    </script>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Relatórios
        </h1>
        {!! Breadcrumbs::render('relatorios.index') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Relatório por Data</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        {{ Form::open(['route' => 'report.data.print', 'method' => 'post', 'autocomplete' => 'off']) }}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Data Início</label>
                                    <input type="text" id="inicio" name="inicio" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Data Fim</label>
                                    <input type="text" id="fim" name="fim" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="T">Todos</option>
                                        <option value="V">Vigente</option>
                                        <option value="T">Finalizado</option>
                                        <option value="T">Cancelado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Gerar Relatório
                                </button>
                                <a href="{{ route('report.index') }}" class="btn btn-primary"><i
                                            class="fa fa-share"></i> Voltar</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
