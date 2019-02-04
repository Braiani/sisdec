@extends('layouts.app')

@section('content')
    <div class="container p-5">
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
        <div class="col-sm-12">
            <h1>Adicionar um curso ao sistema</h1>
        </div>
        <div class="col-sm-12">
            <form class="form" action="{{ route('sisdec.curso.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome do curso:</label>
                    <input type="text" name="nome" class="form-control" placeholder="Digite o nome do curso">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection