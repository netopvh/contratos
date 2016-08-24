@extends('layouts.app')

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
                        <h3 class="box-title">Contratos</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <fieldset>
                            <legend>Relatórios de Contratos</legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Selecione o Tipo de Relatório:</label>
                                    <br><br>
                                    <a href="{{ route('report.data') }}" class="link"><i class="fa fa-file-pdf-o"></i> Relatórios por Data</a>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
