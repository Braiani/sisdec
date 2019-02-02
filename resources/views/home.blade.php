@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-12">
        <form class="form-signin" method="post" action="{{ route('planilha') }}" enctype="multipart/form-data">
            @csrf
            @include('layouts.header')

            <div class="text-center">
                <div class="opa">
                    <h3>Selecione uma planilha</h3>
                    <input type="file" name="file" accept="text/csv">
                </div>
                <br><br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
            </div>
            <br><br>
            <div class="text-center">
                <a class="btn btn-lg btn-warning btn-block" href="{{ route('docentes') }}">Clique aqui, caso já tenha enviado.</a>
            </div>
            <br>
            <div class="progress mt-3">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar"
                    aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width:33%; height: 30px;">
                </div>
            </div>
            <p class="mt-5 mb-3 text-muted text-center">
                &copy; 2017-2018 Lucas Cabral e Luan Said
                <br>
                &copy; 2019 <a href="http://brtechsistemas.com.br">BR tech Sistemas</a>
            </p>
        </form>
    </div>
  </div>
@endsection
