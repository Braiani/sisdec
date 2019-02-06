@php
    $hoje = now();
    $hoje->setLocale(app()->getLocale());
@endphp
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('imagens/icone.png') }}" type="image/png">
    <title>Delcaração 2019 - DIREN/CG</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <style>
        body {
            font-size: 14px;
        }

        html span {
            font-size: 14px;
        }

        .assinatura {
            line-height: 0.1cm;
            font-size: 13px;
            padding-top: 1.5cm;
        }

        .assinatura b {
            line-height: 0.4cm;
            font-size: 14px;
        }

        .img-cabecalho {
            width: 100%;
            margin-bottom: 3%;
        }

        .page-break {
            page-break-after: always;
        }
    </style>

</head>
<body>
@foreach($docentes as $docente)
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 text-center">
                <img src="{{ asset('imagens/cabecalho.jpg') }}" alt="cabeçalho" class="img-cabecalho">
                <h4><b>DECLARAÇÃO 2018 - DIREN-CG</b></h4>
                <p>
                    Declaro para os devidos fins que o(a) servidor(a) {{ strtoupper($docente->nome) }},
                    Professor(a) do Ensino Básico, Técnico e Tecnológico – Campus Campo Grande - IFMS, SIAPE
                    nº {{ $docente->siape }},
                    ministrou as seguintes unidades curriculares de 2016.1 a 2018.2:
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered" width="100%">
                    <thead>
                    <tr class="bg-white">
                        <th><span>Semestre</span></th>
                        <th><span>Curso</span></th>
                        <th><span>Disciplina</span></th>
                        <th><span>Carga horária</span></th>
                        <th><span>Carga horaria h/a</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($docente->disciplinas->groupBy('pivot.semestre') as $semestre => $disciplinas)
                        @php
                            $sum = 0;
                            $inte = 0;
                        @endphp
                        @foreach($disciplinas as $disciplina)
                            <tr>
                                <td><span>{{ $disciplina->pivot->semestre }}</span></td>
                                <td><span>{{ $disciplina->curso->nome }}</span></td>
                                <td><span>{{ $disciplina->nome }}</span></td>
                                <td><span>{{ $disciplina->ch }}h</span></td>
                                <td><span>{{ ((integer)$disciplina->ch / 15) * 20 }}h/a</span></td>
                            </tr>
                            @php
                                $sum += (integer) ((integer)$disciplina->ch / 15) * 20;
                                $inte ++;
                            @endphp
                        @endforeach
                        <tr style="font-weight: bold" class="table-active">
                            <td><span>Total</span></td>
                            <td colspan="2" class="text-center"><span>Média semestral</span></td>
                            <td></td>
                            <td><span>{{ (integer)$sum / (integer)$inte }}h/a</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-right">
                Campo Grande-MS, {{ $hoje->formatLocalized('%d de %B de %Y') }}.
            </div>
            <div class="col-sm-12 text-center assinatura">
                <p><b>Elton da Silva Paiva Valiente</b></p>
                <p>Direção de Ensino</p>
                <p>Campus Campo Grande</p>
                <p>Port. 2404 de 20/10/2017</p>
            </div>
        </div>
    </div>
    @if(!$loop->last)
        <div class="page-break"></div>
    @endif
@endforeach
</body>
</html>