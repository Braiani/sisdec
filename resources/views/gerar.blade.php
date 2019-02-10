@extends('layouts.app')

@section('content')
    <div class="container">
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
        <div class="row">
            <div class="col-sm-12 text-center">
                <form method="GET" id="form-gerar-declaracao" action="{{ route('sisdec.docente.declaracao') }}"
                      class="form">
                    {{--@csrf--}}
                    <p class="">Agora selecione o(a) professor(a) para que o sistema
                        informe os semestres. Logo após, clique em "enviar".
                    </p>
                    <div class="form-group">
                        <h4>Professor(es):</h4>
                        <select name="docente" class="form-control select2" id="docente">
                            <option value=""></option>
                            <option value="-1">Todos</option>
                            @foreach($docentes as $docente)
                                <option value="{{ $docente->id }}">{{ $docente->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--<div class="form-group">
                        <h3>Semestres:</h3>
                        <div class="form-check">
                            <input class="form-check-input" checked name="ultimosSemestres" type="checkbox" value="1"
                                   id="ultimosSemestres">
                            <label class="form-check-label" for="defaultCheck1">
                                Últimos 06 (seis) semestres
                            </label>
                        </div>
                    </div>--}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('home') }}" class="btn btn-primary btn-block">Voltar</a>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-success btn-block" type="submit">Gerar declaração</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).on('pageReady', function () {
            $("#docente").select2({
                placeholder: 'Selecione um professor!',
                allowClear: true
            });
            /*$("#ultimosSemestres").on('change', function () {
                if ($(this).prop('checked')) {
                    console.log('checked');
                } else {
                    console.log('unChecked');
                }
            });*/
        });
    </script>
@endpush