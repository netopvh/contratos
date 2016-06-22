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
    <script src="{{ asset('plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js') }}"></script>
    <script>
        $(function(){
            $('#homologado, #executado').maskMoney();
            $("form").submit(function() {
                $('#homologado').val($('#homologado').maskMoney('unmasked')[0]);
                $('#executado').val($('#executado').maskMoney('unmasked')[0]);
            });
        });
    </script>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Gestão de Contratos
        </h1>
        {!! Breadcrumbs::render('empresas.create') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Contrato</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-md-12">
                                @include('vendor.flash.message')
                                {!! Form::open(['route' => 'contratos.store', 'method' => 'post', 'id' => 'contratoForm', 'autocomplete' => 'off']) !!}
                                @include('pages.contratos.forms.form')
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                                <a href="{{ route('contratos.index') }}" class="btn btn-primary"><i class="fa fa-share"></i> Voltar</a>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
