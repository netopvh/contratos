@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Gestão de Contratos
        </h1>
        {!! Breadcrumbs::render('contratos.index') !!}
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Aditivar Contrato
                        </h3>

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
                                @include('vendor.flash.message')
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                {{ Form::open(['route' => 'contratos.aditivar.api', 'method' => 'get']) }}
                                    <div class="input-group">
                                        <input type="text" name="contrato" id="value" class="form-control" placeholder="Digite o Numero e Ano do Contrato: 99999/2016">
                                      <span class="input-group-btn">
                                        <button class="btn btn-default" id="search" type="submit">Pesquisar</button>
                                      </span>
                                    </div><!-- /input-group -->
                                {{ Form::close() }}
                            </div><!-- /.col-lg-6 -->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @yield('dados')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
