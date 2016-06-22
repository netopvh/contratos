<div class="row">
    <div class="col-md-10">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {{ Form::label('nome','Nome do Grupo:') }} <span class="text-danger">*</span>
            {{ Form::text('name',null,[
                'class' => 'form-control',
                'required' => '',
                'minlength' => '3',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
            {{ Form::label('grupo','Agrupado com:') }}
            {{ Form::select('parent_id',$groups,null,[
                'class' => 'form-control',
                'placeholder' => 'Selecione o Grupo',
            ]) }}
            @if ($errors->has('parent_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('parent_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group{{ $errors->has('sort') ? ' has-error' : '' }}">
            {{ Form::label('ordenacao','Ordenação:') }}
            {{ Form::text('sort',null,[
                'class' => 'form-control',
                'autocomplete' => 'off',
                'id' => 'numero'
            ]) }}
            @if ($errors->has('sort'))
                <span class="help-block">
                    <strong>{{ $errors->first('sort') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>