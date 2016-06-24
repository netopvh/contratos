@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <br><br>
                <div class="text-center">
                    <img src="{{ url('/') }}/img/proibido.png" width="150px" alt="">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8">
                <h2 class="text-center">Acesso não autorizado</h2>
                <p>
                    Você não tem permissão para acessar essa área, por favor contate o administrador para mais informações.
                </p>
            </div>
        </div>
    </div>
@stop