@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar Usuário
        </h1>
        {!! Breadcrumbs::render('user.edit') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Usuários</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::model($user,['route' => ['users.update', $user['id']], 'method' => 'put']) !!}
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            {{ Form::label('nome','Nome:') }}
                                            {{ Form::text('name',null,[
                                                'class' => 'form-control',
                                                'disabled' => ''
                                            ]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            {{ Form::label('username','Usuário:') }}
                                            {{ Form::text('username',null,[
                                                'class' => 'form-control',
                                                'disabled' => ''
                                            ]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('grupo','Grupos de Usuário:') }} <span class="text-danger">*</span>
                                            {{ Form::select('role_id',$roles,null,[
                                                'class' => 'form-control',
                                                'placeholder' => 'Selecione...'
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group{{ $errors->has('is_super') ? ' has-error' : '' }}">
                                            {{ Form::label('verTodas','Ver Todas as Casas:') }}
                                            <label>
                                                {{ Form::radio('is_super', 0, true) }}
                                                Não
                                            </label>
                                            <label>
                                                {{ Form::radio('is_super', 1) }}
                                                Sim
                                            </label>
                                            @if ($errors->has('is_super'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('is_super') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        {!! Form::submit('Gravar',['class' => 'btn btn-success']) !!}
                                        <a href="{{ route('users.index') }}" class="btn btn-primary">Voltar</a>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
