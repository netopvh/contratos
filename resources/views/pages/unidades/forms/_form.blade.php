<div class="row">
    <div class="col-md-10">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {{ Form::label('nome','Nome:') }} <span class="text-danger">*</span>
            {{ Form::text('nome',null,[
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
        <div class="form-group{{ $errors->has('casa_id') ? ' has-error' : '' }}">
            {{ Form::label('casa','Casa:') }} <span class="text-danger">*</span>
            {{ Form::select('casa_id',$casas,null,[
                'class' => 'form-control',
                'placeholder' => 'Selecione a Casa',
                'required' => ''
            ]) }}

            @if ($errors->has('casa_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('casa_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {{ Form::label('email','Email:') }} <span class="text-danger">*</span>
            {{ Form::email('email',null,[
                'class' => 'form-control',
                'required' => '',
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