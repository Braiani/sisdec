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
            font-size: 13px;
            margin-top: 2.5cm;
            margin-bottom: 1.5cm;
        }

        html span {
            font-size: 13px;
        }

        .assinatura {
            line-height: 0.05cm;
            font-size: 12px;
            /*border: 1px solid lightgreen;*/
        }

        .img-assinatura {
            width: 33%;
            /*border: 1px solid lightsalmon;*/
        }

        .assinatura b {
            line-height: 0.4cm;
            font-size: 13px;
        }

        header {
            position: fixed;
            top: -1cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
        }

        header img {
            width: 100%;
            height: 100%;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        footer {
            position: fixed;
            bottom: -1cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        .footer-head, .footer-head span {
            font-size: 10px;
        }

        .footer-head span {
            float: right;
        }

        .footer-body {
            border-top: 2px solid black;
            margin-bottom: auto;
        }

        .footer-nome {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: auto;
        }

        .footer-endereco {
            font-size: 10px;
        }

        .footer-body p, .footer-footer p {
            text-align: center;
        }
    </style>

</head>
<body>
<header>
    <img src="{{ env('APP_URL') }}/imagens/cabecalho.jpg" alt="">
</header>
<footer>
    <div class="footer-head">
        <p>Impresso em {{ $hoje->formatLocalized('%d/%m/%Y') }} <span>* Documento gerado pelo SISDEC - DIREN/CG</span>
        </p>
    </div>
    <div class="footer-body">
        <p class="footer-nome">
            INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DE MATO GROSSO DO SUL | CAMPUS CAMPO GRANDE
        </p>
        <p class="footer-endereco">
            Rua Taquari, 831 | Santo Antônio | 79100510 | Campo Grande, MS | Tel.: 3357-8511 | campo.grande@ifms.edu.br
            |
            www.ifms.edu.br
        </p>
    </div>
</footer>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 text-justify">
                <h4 class="text-center"><b>DECLARAÇÃO {{ $hoje->formatLocalized('%Y') }} - DIREN-CG</b></h4>
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
                    @foreach($docente->disciplinas->groupBy('pivot.semestre')->sortKeys() as $semestre => $disciplinas)
                        @php
                            $sumH = 0;
                            $sumCa = 0;
                            $inte = 0;
                        @endphp
                        @foreach($disciplinas as $disciplina)
                            <tr>
                                <td><span>{{ $disciplina->pivot->semestre }}</span></td>
                                <td><span>{{ $disciplina->curso->nome }}</span></td>
                                <td><span>{{ $disciplina->nomeFormatado }}</span></td>
                                <td><span>{{ $disciplina->ch }}h</span></td>
                                <td><span>{{ ((integer)$disciplina->ch / 15) * 20 }}h/a</span></td>
                            </tr>
                            @php
                                $sumCa += (integer) ((integer)$disciplina->ch / 15) * 20;
                                $sumH += (integer)$disciplina->ch;
                                $inte ++;
                            @endphp
                        @endforeach
                        @php
                            $medCh = ((integer)$sumH / (integer)$inte) / 20;
                            $medCha = ((integer)$sumCa / (integer)$inte) / 20;
                        @endphp
                        <tr style="font-weight: bold" class="table-active">
                            <td><span>Total</span></td>
                            <td colspan="2" class="text-center"><span>Média semestral</span></td>
                            <td>{{ number_format($medCh, 1) }}h</td>
                            <td><span>{{ number_format($medCha, 1) }}h/a</span></td>
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
        </div>
        <div class="row">
            <div class="col-sm-12 text-center assinatura">
                <img src="{{ env('APP_URL') }}/imagens/assinatura.png" class="img-assinatura" alt="assinatura">
                <p><b>Elton da Silva Paiva Valiente</b></p>
                <p>Direção de Ensino</p>
                <p>Campus Campo Grande</p>
                <p>Port. 2404 de 20/10/2017</p>
            </div>
        </div>
    </div>
</main>
</body>
</html>