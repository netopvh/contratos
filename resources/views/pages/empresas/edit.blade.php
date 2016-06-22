@extends('layouts.app')

@section('scripts-before')
    <script src="{{ asset('plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery.inputmask/dist/inputmask/inputmask.js') }}"></script>
    <script src="{{ asset('plugins/jquery.inputmask/dist/inputmask/jquery.inputmask.js') }}"></script>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Gerenciamento
        </h1>
        {!! Breadcrumbs::render('empresas.edit') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Fornecedor</h3>

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
                                {!! Form::model($empresa, ['method' => 'patch', 'route' => ['empresas.update', $empresa->id], 'id' =>'empresaForm']) !!}
                                @include('pages.empresas.forms._form')
                                {!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
                                <a href="{{ route('empresas.index') }}" class="btn btn-primary">Voltar</a>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
