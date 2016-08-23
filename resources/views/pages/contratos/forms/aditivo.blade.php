<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('numero','Nº do Contrato:') }} <span class="text-danger">*</span>
            <input type="text" value="{{ isset($contrato->numero) ? $contrato->numero : '' }}" class="form-control"
                   name="numero" required>
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            {{ Form::label('ano','Ano:') }} <span class="text-danger">*</span>
            <input type="text" value="{{ isset($contrato->ano) ? $contrato->ano : '' }}" class="form-control" name="ano"
                   id="numero" maxlength="4">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('casas','Casa:') }} <span class="text-danger">*</span>
            {{ Form::select('casa_id',$listCasas,null,[
                'class' => 'form-control',
                'placeholder' => 'Selecione a Casa',
                'required' => ''
            ]) }}
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            {{ Form::label('unidades','Unidade:') }}
            {{ Form::select('unidade_id',$listUnidades,null,[
                'class' => 'form-control',
                'placeholder' => 'Selecione a Unidade'

            ]) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {{ Form::label('fornecedor','CPF/CNPJ ou Nome do Fornecedor:') }} <span class="text-danger">*</span>
            <select name="empresa_id" class="form-control select2">
                <option value="" selected>Selecione o Fornecedor</option>
                @foreach($listEmpresas as $empresa)
                    <option value="{{ $empresa->id }}"{{ isset($contrato->empresa_id) && $contrato->empresa_id == $empresa->id ? ' selected' : '' }}>
                        @if(strlen($empresa->cpf_cnpj) == 14)
                            {{ mask('##.###.###/####-##', $empresa->cpf_cnpj) }} - {{ $empresa->razao }}
                        @else
                            {{ mask('###.###.###-##', $empresa->cpf_cnpj) }} - {{ $empresa->razao }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('valor_homologado', 'Valor Homologado:') !!} <span class="text-danger">*</span>
            {!! Form::text('homologado', null, [
            'class' => 'form-control',
            'required' => '',
            'id' => 'homologado',
            'data-prefix' => 'R$ ',
            'data-thousands' => '.',
            'data-decimal' => ',']) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('valor_executado', 'Valor Executado:') !!} <span class="text-danger">*</span>
            {!! Form::text('executado', null, [
            'class' => 'form-control',
            'required' => '',
            'id' => 'executado',
            'data-prefix' => 'R$ ',
            'data-thousands' => '.',
            'data-decimal' => ',']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>Data Início</label> <span class="text-danger">*</span>

            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="data_inicio"
                       value="{{ isset($contrato->data_inicio) ? $contrato->data_inicio : '' }}"
                       class="form-control pull-right" id="inicio" required>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Data Fim</label> <span class="text-danger">*</span>

            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="data_fim" value="{{ isset($contrato->data_fim) ? $contrato->data_fim : '' }}"
                       class="form-control pull-right" id="fim" required>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('gestores', 'Gestores do Contrato:') !!} <span class="text-danger">*</span>
            @if(isset($contrato->gestores))
                <select name="gestores[]" class="form-control select2" multiple required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"{{ in_array($user->id, $gestores) ? ' selected="selected"' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            @else
                <select name="gestores[]" class="form-control select2" multiple required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {!! Form::label('comentario', 'Comentários:') !!}
        {!! Form::textarea('comentario', null, ['class' => 'form-control', 'rows' => 6, 'cols' => 40]) !!}
    </div>
</div>
<br>





