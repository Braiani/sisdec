@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.13.4/dist/bootstrap-table.min.css">
@endpush

@section('content')
    <div class="container">
        <div class="col-12">
            <a href="{{ route('sisdec.curso.create') }}" class="btn btn-primary m-1">
                <i class="fa fa-plus"></i> Adicionar curso
            </a>
            <a href="{{ route('home') }}" class="btn btn-info m-1">
                <i class="fa fa-home"></i> Retornar
            </a>
        </div>
        <div class="col-12 p-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Cursos cadastrados:</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered ">
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
                                        <div class="col-sm-12">
                                            <a href="{{ route('sisdec.curso.edit', $curso->id) }}"
                                               class="btn btn-warning m-1">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form method="POST"
                                                  action="{{ route('sisdec.curso.destroy', $curso->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger m-1">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
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
    </div>
@endsection

@push('script')
    <script src="https://unpkg.com/bootstrap-table@1.13.4/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.13.4/dist/bootstrap-table-locale-all.min.js"></script>
    <script>
        $(document).on('pageReady', function () {
            $("#table").bootstrapTable({
                pagination: true,
                search: true,
                locale: 'pt-BR'
            });
        });
    </script>
@endpush