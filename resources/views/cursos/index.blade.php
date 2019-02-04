@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="{{ route('sisdec.curso.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Adicionar
                curso</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center">Cursos cadastrados:</h1>
            </div>
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nome</th>
                            <th>Criado em</th>
                            <th>Atualizado em</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cursos as $curso)
                            <tr class="text-center">
                                <td>{{ $curso->id }}</td>
                                <td>{{ $curso->nome }}</td>
                                <td>{{ $curso->created_at->formatLocalized('%d/%m/%Y %H:%M') }}</td>
                                <td>{{ $curso->updated_at->formatLocalized('%d/%m/%Y %H:%M') }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="{{ route('sisdec.curso.edit', $curso->id) }}" class="btn btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <form method="POST" action="{{ route('sisdec.curso.destroy', $curso->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection