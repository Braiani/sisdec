@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <form method="post" class="form">
                @csrf
                @include('layouts.header')
                <p class="">Agora selecione o(a) professor(a) para que o sistema
                informe os semestres. Logo após, clique em "enviar".
                </p>
                <h4>Professor(es):</h4>
                <div class="form-group">
                    <select name="docente" class="form-controlselect2" id="docente">
                        <option value=""></option>
                        <option value="-1">Todos</option>
                        <option value="1">Prof. 1</option>
                        <option value="2">Prof. 2</option>
                        <option value="3">Prof. 3</option>
                        <option value="4">Prof. 4</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <button class="btn btn-primary btn-block" type="submit">Gerar declaração</button>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('home') }}" class="btn btn-success btn-block">Voltar</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="progress mt-2">
                            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar"
                                aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection