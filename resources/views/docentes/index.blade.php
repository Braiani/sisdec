@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.13.4/dist/bootstrap-table.min.css">
@endpush

@section('content')
    <div class="container">
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
                    <h1 class="text-center">Docentes cadastrados:</h1>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered ">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>SIAPE</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($docentes as $docente)
                                    <tr class="text-center">
                                        <td>{{ $docente->id }}</td>
                                        <td>{{ $docente->nome }}</td>
                                        <td>{{ $docente->email }}</td>
                                        <td>{{ $docente->siape }}</td>
                                        <td>
                                            <div class="col-sm-12">
                                                <a href="{{ route('sisdec.docente.edit', $docente->id) }}"
                                                   class="btn btn-warning m-1">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form method="POST"
                                                      action="{{ route('sisdec.docente.destroy', $docente->id) }}">
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