<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 10px;
            margin-top: -10px;
        }

        th,
        td {
            border: 1px solid black;
            text-align: left;
            padding: 3px;
        }

        .td-right {
            border: 1px solid black;
            text-align: right;
            padding: 3px;
        }

        th {
            background-color: #FFFFFF;
        }

        tfoot td {
            font-weight: bold;
            background-color: #FFFFFF;
        }

        /* Positionnement absolu des mentions dans le coin supérieur droit */
        .header-info {
            position: absolute;
            top: 1px;
            right: 10px;
            text-align: left;
            font-size: 12px;
        }

        .header-info p {
            margin: -5;
            padding: 5px 0;
        }

        /* Positionnement du logo */
        .logo {
            margin-top: -110px;
            margin-bottom: -50px;
            display: block;
            width: auto;
            height: 190;
        }

        /* Positionnement absolu des mentions dans les coins */
        .timbre-bureau {
            position: absolute;
            top: 915px;
            left: 0;
            text-align: left;
            font-size: 12px;
            margin: 0;
        }

        .signature-agent {
            position: absolute;
            bottom: 0;
            left: 0;
            text-align: left;
            font-size: 12px;
            margin: 0;
        }

        .timbre-transporteur {
            position: absolute;
            top: 915px;
            right: 0;
            text-align: right;
            font-size: 12px;
            margin: 0;
        }

        .signature-transporteur {
            position: absolute;
            bottom: 0;
            right: 0;
            text-align: right;
            font-size: 12px;
            margin: 0;
        }

        .title {
            margin-top: -30px;
        }

        .total {
            text-align: center
        }
    </style>
</head>

<body>

    <img src="logo.svg" alt="logo">


    <div class="header-info">
        <p><strong>Lomé, le </strong> {{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}</p>
    </div>

    <div class="title">
        <h4> <strong>STATISTIQUES GLOBALES</strong></h4>
    </div>

    <table>
        <thead>
            <tr>
                <th>COL 1</th>
                <th>COL 2</th>
                <th>COL 3</th>
            </tr>
        </thead>
        <tbody>


            @foreach ($data as $parcelle)
                <tr>
                    <th colspan="3" style=" text-align: center">
                        {{ $parcelle["nom"] }}
                    </th>
                </tr>
                <tr>
                    <th colspan="3" style=" text-align: center">
                        RECOLTES
                    </th>
                </tr>
                <tr>
                    <th scope="col" style=" text-align: center">
                        Date de la récolte
                    </th>
                    <th scope="col" style=" text-align: center">
                        Culture récoltée
                    </th>
                    <th scope="col" style=" text-align: center">
                        Quantité récoltée
                    </th>
                </tr>
                @foreach ($parcelle['recoltes'] as $recolte)
                <tr> 
                    <th scope="col"  style=" text-align: center"> Date récolte: {{$recolte["date_recolte"]}} </th>
                    <th scope="col"  style=" text-align: center">  {{$recolte["semis"]["culture"]["nom_culture"]}} du  {{$recolte["semis"]["date_semis"]}}</th>
                    <th scope="col"  style=" text-align: center"> {{$recolte["qte"]}} </th>
                </tr>

                @endforeach


              
        </tbody>
        @endforeach

        {{-- <tfoot>
            <tr>
                <td colspan="2">SOUS TOTAL</td>

                <th scope="col" class="border px-3 py-2 font-medium text-gray-900 text-right">
                    test
                </th>
                
                <td></td>
            </tr>
            <tr>
                <td colspan="2">TOTAL</td>
                <td class="total" colspan="7">qsdf</td>

            </tr>
        </tfoot> --}}
    </table>




</body>

</html>
