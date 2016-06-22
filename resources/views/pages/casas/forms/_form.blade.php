<div class="row">
    <div class="col-md-10">
        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
            {{ Form::label('nome','Nome:') }} <span class="text-danger">*</span>
            {{ Form::text('nome',null,[
                'class' => 'form-control',
                'required' => '',
                'minlength' => '3',
                'autocomplete' => 'off'
            ]) }}
            @if ($errors->has('nome'))
                <span class="help-block">
                    <strong>{{ $errors->first('nome') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>