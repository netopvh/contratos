@extends('layouts.app')

@section('scripts-before')
<script src="{{ asset('plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/dist/additional-methods.min.js') }}"></script>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Gestão de Usuários
        </h1>
        {!! Breadcrumbs::render('permissions.create') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Permissão</h3>

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
                                {!! Form::open(['route' => 'permissions.store', 'method' => 'post', 'id' => 'permissionForm']) !!}
                                @include('pages.permissions.forms._form')
                                {!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
                                <a href="{{ route('permissions.index') }}" class="btn btn-primary">Voltar</a>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
