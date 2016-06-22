<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('razao') ? ' has-error' : '' }}">
            {{ Form::label('nome','Razão Social:') }} <span class="text-danger">*</span>
            {{ Form::text('razao',null,[
                'class' => 'form-control',
                'required' => '',
                'minlength' => '3',
                'autocomplete' => 'off'
            ]) }}
            @if ($errors->has('razao'))
                <span class="help-block">
                    <strong>{{ $errors->first('razao') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('fantasia') ? ' has-error' : '' }}">
            {{ Form::label('nome','Nome Fantasia:') }}
            {{ Form::text('fantasia',null,[
                'class' => 'form-control',
                'minlength' => '3',
                'autocomplete' => 'off'
            ]) }}
            @if ($errors->has('fantasia'))
                <span class="help-block">
                    <strong>{{ $errors->first('fantasia') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group{{ $errors->has('tipo_pessoa') ? ' has-error' : '' }}">
            {{ Form::label('tipo','Tipo de Pessoa:') }} <span class="text-danger">*</span>
            {{ Form::select('tipo_pessoa',$tipos,null,[
                'class' => 'form-control',
                'placeholder' => 'Selecione o Tipo',
                'required' => '',
                'id' => 'tipo'
            ]) }}
            @if ($errors->has('tipo_pessoa'))
                <span class="help-block">
                    <strong>{{ $errors->first('tipo_pessoa') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group{{ $errors->has('cpf_cnpj') ? ' has-error' : '' }}">
            {{ Form::label('cpf','CPF / CNPJ:') }} <span class="text-danger">*</span>
            {{ Form::text('cpf_cnpj',null,[
                'class' => 'form-control',
                'minlength' => '3',
                'required' => '',
                'id' => 'cnpj'
            ]) }}
            @if ($errors->has('cpf_cnpj'))
                <span class="help-block">
                    <strong>{{ $errors->first('cpf_cnpj') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="form-group{{ $errors->has('responsavel') ? ' has-error' : '' }}">
            {{ Form::label('responsavel','Responsável pela Empresa:') }}
            {{ Form::text('responsavel',null,[
                'class' => 'form-control',
                'minlength' => '3',
                'autocomplete' => 'off'
            ]) }}
            @if ($errors->has('responsavel'))
                <span class="help-block">
                    <strong>{{ $errors->first('responsavel') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {{ Form::label('email','Email:') }}
            {{ Form::email('email',null,[
                'class' => 'form-control',
                'minlength' => '3',
                'autocomplete' => 'off'
            ]) }}
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>