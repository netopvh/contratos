<div class="row">
    <div class="col-md-10">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {{ Form::label('nome','Nome:') }} <span class="text-danger">*</span>
            {{ Form::text('name',null,[
                'class' => 'form-control',
                'required' => '',
                'minlength' => '3',
                'autocomplete' => 'off'
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
        <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
            {{ Form::label('nomeExibicao','Nome de Exibição:') }} <span class="text-danger">*</span>
            {{ Form::text('display_name',null,[
                'class' => 'form-control',
                'required' => '',
                'minlength' => '3',
                'autocomplete' => 'off'
            ]) }}
            @if ($errors->has('display_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('display_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            {{ Form::label('descricao','Descrição:') }}
            {{ Form::textarea('description',null,[
            'class' => 'form-control',
            'size' => '30x3'
            ]) }}
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>