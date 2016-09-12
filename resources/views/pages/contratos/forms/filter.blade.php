{{ Form::open(['route' => 'contratos.lists', 'method' => 'get']) }}
<fieldset>
    <legend>Pesquisar Contratos</legend>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('casas','Casa:') }}
                {{ Form::select('casa_id',$listCasas,null,[
                    'class' => 'form-control',
                    'placeholder' => 'Selecione a Casa'
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('unidades','Unidades:') }}
                {{ Form::select('unidade_id',$listUnidades,null,[
                    'class' => 'form-control',
                    'placeholder' => 'Selecione a Unidade'

                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Status:</label>
                <select name="status" class="form-control">
                    @foreach($listStatus as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                {{ Form::label('numero','Numero do Contrato:') }}
                {{ Form::text('numero',null,['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                {{ Form::label('ano','Ano:') }}
                {{ Form::text('ano',null,[
                'class' => 'form-control',
                'maxlength' => '4',
                'id' => 'numero']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('fornecedor','CPF/CNPJ ou Nome do Fornecedor:') }}
                <select name="empresa_id" class="form-control select2">
                    <option value="" selected>Selecione o Fornecedor</option>
                    @foreach($listEmpresas as $empresa)
                        <option value="{{ $empresa->id }}">
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
    </div>
    <div class="row">
        <div class="col-md-3">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Pesquisar Contrato
            </button>
        </div>
    </div>
</fieldset>
{{ Form::close() }}





