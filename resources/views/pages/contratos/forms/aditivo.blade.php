@extends('pages.contratos.aditivar')

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
    <script src="{{ asset('plugins/jquery-validation/src/localization/messages_pt_BR.js') }}"></script>
    <script src="{{ asset('plugins/jquery-maskmoney/dist/jquery.maskMoney.min.js') }}"></script>
    <script>
        $(function () {
            $('#total').maskMoney();
            $("form").submit(function () {
                $('#total').val($('#total').maskMoney('unmasked')[0]);
            });
        });
    </script>
@endsection

@section('dados')
    <br>
    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Aditivar Contrato</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab"
                                       data-toggle="tab">Todos os Aditivos</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        {{ Form::open(['route' => 'contratos.aditivar.store', 'method' => 'post', 'id' => 'aditivoForm', 'autocomplete' => 'off']) }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Contrato:</label>
                                    <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
                                    <input type="text" class="form-control"
                                           value="{{ $contrato->numero }} / {{ $contrato->ano }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fornecedor:</label>
                                    <input type="text" class="form-control" value="{{ $contrato->empresa->razao }}"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>Data de Vencimento:</label>
                                <input type="text" class="form-control" value="{{ $contrato->data_fim }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <legend>Informações</legend>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Ano:</label>
                                                <input type="text" name="ano" value="{{ date('Y') }}"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Data de Início:</label>
                                                <input type="text" id="inicio" name="inicio" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Data de Fim:</label>
                                                <input type="text" id="fim" name="fim" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                {!! Form::label('total', 'Valor Total:') !!} <span
                                                        class="text-danger">*</span>
                                                {!! Form::text('total', null, [
                                                'class' => 'form-control',
                                                'required' => '',
                                                'id' => 'total',
                                                'data-prefix' => 'R$ ',
                                                'data-thousands' => '.',
                                                'data-decimal' => ',']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                {!! Form::label('comentario', 'Objeto:') !!}
                                {!! Form::textarea('comentario', null, ['class' => 'form-control', 'rows' => 6, 'cols' => 40]) !!}
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                                <a href="{{ route('contratos.index') }}" class="btn btn-primary"><i
                                            class="fa fa-share"></i> Voltar</a>
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th width="40">Ordem</th>
                                    <th width="130">Contrato e Ano</th>
                                    <th width="290">Fornecedor</th>
                                    <th width="90">Data Início</th>
                                    <th width="90">Data Fim</th>
                                    <th>Objeto</th>
                                    <th width="120" class="text-center"> Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contrato->aditivo as $aditivo)
                                    <tr>
                                        <td>{{ $aditivo->posicao }}</td>
                                        <td>{{ $contrato->numero }} / {{ $contrato->ano }}</td>
                                        <td>{{ $contrato->empresa->razao }}</td>
                                        <td>{{ $aditivo->inicio }}</td>
                                        <td>{{ $aditivo->fim }}</td>
                                        <td>{{ $aditivo->comentario }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection