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
        body{
            font-size: 14px;
        }
        html span{
            font-size: 14px;
        }
        .assinatura{
            line-height: 0.1cm;
            font-size: 13px;
            padding-top: 1.5cm;
        }
        .assinatura b{
            line-height: 0.4cm;
            font-size: 14px;
        }
        .img-cabecalho{
            width: 100%;
            margin-bottom: 3%;
        }
        .page-break {
            page-break-after: always;
        }
    </style>

</head>
<body>
@for($in = 0; $in < 2; $in++)
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 text-center">
                <img src="{{ asset('imagens/cabecalho.jpg') }}" alt="cabeçalho" class="img-cabecalho">
                <h4><b>DECLARAÇÃO 2018 - DIREN-CG</b></h4>
                <p>
                    Declaro para os devidos fins que a servidora Rosane Corsini Silva Nogueira,
                    Professora do Ensino Básico, Técnico e Tecnológico – Campus Campo Grande - IFMS, SIAPE nº 2966611,
                    ministrou as seguintes unidades curriculares de 2015.1 a 2017.2:
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th><span>Semestre</span></th>
                        <th><span>Curso</span></th>
                        <th><span>Disciplina</span></th>
                        <th><span>Carga horária</span></th>
                        <th><span>Carga horaria h/a</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < 2; $i++)
                        <tr>
                            <td><span>2015.1</span></td>
                            <td><span>Tecnologia em Sistemas para Internet</span></td>
                            <td><span>Estatística A</span></td>
                            <td><span>45h</span></td>
                            <td><span>60h/a</span></td>
                        </tr>
                        <tr>
                            <td><span>2015.1</span></td>
                            <td><span>Tecnologia em Sistemas para Internet</span></td>
                            <td><span>Estatística A</span></td>
                            <td><span>45h</span></td>
                            <td><span>60h/a</span></td>
                        </tr>
                        {{--<tr>
                            <td><span>2015.1</span></td>
                            <td><span>Tecnologia em Sistemas para Internet</span></td>
                            <td><span>Estatística A</span></td>
                            <td><span>45h</span></td>
                            <td><span>60h/a</span></td>
                        </tr>--}}
                        <tr style="font-weight: bold">
                            <td><span>Total</span></td>
                            <td colspan="2" class="text-center"><span>Média semestral</span></td>
                            <td></td>
                            <td><span>17h/a</span></td>
                        </tr>
                    @endfor
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
    <div class="page-break"></div> {{--Verificar se é a última página--}}
@endfor
</body>
</html>