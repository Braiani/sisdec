@extends('layouts.app')

@section('content')
    <div class="container p-3">
        @if ($errors->any())
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="col-12">
            <a href="{{ route('home') }}" class="btn btn-info m-1">
                <i class="fa fa-home"></i> Retornar
            </a>
            <a href="{{ route('sisdec.docente.create') }}" class="btn btn-primary m-1">
                <i class="fa fa-plus"></i> Adicionar docente
            </a>
        </div>
        <div class="col-12 p-3">
            <div class="card">
                <div class="card-header">
                    <h1>Editar o docente {{ $docente->nome }}</h1>
                </div>
                <div class="card-body">
                    <form class="form" action="{{ route('sisdec.docente.update', $docente->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nome">Nome do docente:</label>
                            <input type="text" name="nome" class="form-control" value="{{ $docente->nome }}"
                                   placeholder="Digite o nome do docente">
                        </div>
                        <div class="form-group">
                            <label for="nome">E-mail do docente:</label>
                            <input type="text" name="email" class="form-control" value="{{ $docente->email }}"
                                   placeholder="Digite o e-mail do docente">
                        </div>
                        <div class="form-group">
                            <label for="nome">SIAPE do docente:</label>
                            <input type="text" name="siape" class="form-control" value="{{ $docente->siape }}"
                                   placeholder="Digite o SIAPE do docente">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection