@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
@endpush

@section('content')
    <div class="container">
        <div class="col-sm-12 text-center">
            <div class="row">
                <div class="col-sm-4 p-1">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#atualizarDisciplinas">
                        Atualizar Disciplinas <i class="fas fa-file-csv"></i>
                    </button>
                </div>
                <div class="col-sm-4 p-1">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#atualizarDocentes">
                        Atualizar Docentes <i class="fas fa-chalkboard-teacher"></i>
                    </button>
                </div>
                <div class="col-sm-4 p-1">
                    <a class="btn btn-info" href="{{ route('docentes') }}">
                        Continuar <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Modal - Atualizar Disciplinas -->
        <div class="modal fade" id="atualizarDisciplinas" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Atualizar Disciplinas</h3>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="form-disciplinas" method="post" action="{{ route('planilha') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="arquivo">Selecione a planilha:</label>
                                    <input type="file" class="form-control-file" name="arquivo" accept="text/csv">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" form="form-disciplinas" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal - Atualizar Docentes -->
        <div class="modal fade" id="atualizarDocentes" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Atualizar Docentes</h5>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="form-docentes" method="post" action="{{ route('planilha') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="arquivo">Selecione a planilha:</label>
                                    <input type="file" class="form-control-file" name="arquivo" accept="text/csv">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" form="form-docentes" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

