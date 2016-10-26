@extends('layouts.app')

@section('styles-before')
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}">
@endsection

@section('scripts-before')
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/i18n/pt-BR.js') }}"></script>
@endsection

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
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('grupo','Grupos de Usuário:') }} <span class="text-danger">*</span>
                                            <select name="role_id" class="form-control">
                                                <option value="">Selecione...</option>
                                                @foreach($roles as $role)
                                                    @if($user->roles->first()->id == $role->id)
                                                        <option value="{{ $role->id }}" selected>{{ $role->display_name }}</option>
                                                    @else
                                                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group{{ $errors->has('is_super') ? ' has-error' : '' }}">
                                            {{ Form::label('verTodas','Ver Todas as Casas:') }}<br>
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
                                    <div class="col-md-3">
                                        <div class="form-group{{ $errors->has('is_master') ? ' has-error' : '' }}">
                                            {{ Form::label('verUnidades','Ver Todas Unidades:') }}<br>
                                            <label>
                                                {{ Form::radio('is_master', 0, true) }}
                                                Não
                                            </label>
                                            <label>
                                                {{ Form::radio('is_master', 1) }}
                                                Sim
                                            </label>
                                            @if ($errors->has('is_master'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('is_master') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('casas', 'Casas Vinculadas:') !!} <span class="text-danger">*</span>
                                            @if($user->casas->count() >= 1)
                                                <select name="casas[]" class="form-control select2" multiple required>
                                                    @foreach($casas as $casa)
                                                        <option value="{{ $casa->id }}"{{ in_array($casa->id, $casasAr) ? ' selected="selected"' : '' }}>{{ $casa->nome }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="casas[]" class="form-control select2" multiple required>
                                                    @foreach($casas as $casa)
                                                        <option value="{{ $casa->id }}">{{ $casa->nome }}</option>
                                                    @endforeach
                                                </select>
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
