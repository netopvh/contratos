@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gerenciamento
        </h1>
        {!! Breadcrumbs::render('empresas.index') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Contratado</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-remove"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        @permission('add-fornecedores')
                        <div class="row">
                            <div class="col-md-7">
                                <a href="{{ route('empresas.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>
                                    Novo Contratado
                                </a>
                            </div>
                        </div>
                        <br>
                        @endpermission
                        <div class="row">
                            <div class="col-md-12">
                                @include('vendor.flash.message')
                                <table id="grid" class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th width="50">ID</th>
                                        <th>Razão Social</th>
                                        <th>CPF / CNPJ</th>
                                        <th class="text-center" width="110">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($empresas as $empresa)
                                        <tr>
                                            <td>{{ str_pad($empresa->id, 3, '0', STR_PAD_LEFT)}}</td>
                                            <td>{{ $empresa->razao }}</td>
                                            <td>
                                                @if(strlen($empresa->cpf_cnpj) == 14)
                                                {{ mask('##.###.###/####-##', $empresa->cpf_cnpj) }}
                                                @else
                                                 {{ mask('###.###.###-##', $empresa->cpf_cnpj) }}
                                                @endif
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'delete', 'route' => ['empresas.destroy', $empresa->id]]) !!}
                                                @permission('ver-contratos-fornecedor')
                                                <a href="{{ route('casas.edit', $empresa->id) }}"
                                                   class="btn btn-sm btn-success" data-toggle="tooltip" title="Visualizar Contratos">
                                                    <i class="fa fa-search"></i>
                                                </a>&nbsp;
                                                @endpermission
                                                @permission('editar-fornecedores')
                                                <a href="{{ route('empresas.edit', $empresa->id) }}"
                                                   class="btn btn-sm btn-primary" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </a>&nbsp;
                                                @endpermission
                                                @permission('deletar-fornecedores')
                                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                        title="Remover">
                                                    <i class="fa fa-remove"></i>
                                                </button>
                                                @endpermission
                                                {!! Form::close() !!}
                                            </td>
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
    </div>
@endsection

