@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <form method="GET" action="{{ route('sisdec.docente.declaracao') }}" class="form">
                    {{--@csrf--}}
                    <p class="">Agora selecione o(a) professor(a) para que o sistema
                        informe os semestres. Logo após, clique em "enviar".
                    </p>
                    <h4>Professor(es):</h4>
                    <div class="form-group">
                        <select name="docente" class="form-control select2" id="docente">
                            <option value=""></option>
                            <option value="-1">Todos</option>
                            @foreach($docentes as $docente)
                                <option value="{{ $docente->id }}">{{ $docente->nome }}</option>
                            @endforeach
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
            })
        });
    </script>
@endpush