<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques Agricoles</title>
    <style>
        :root {
            --primary-color: #2c7744;
            --secondary-color: #f8f9fa;
            --accent-color: #e9ecef;
            --text-color: #333;
            --border-color: #dee2e6;
            --success-color: #28a745;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            color: var(--text-color);
            background-color: #fff;
            position: relative;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 15px;
        }

        .logo {
            height: 80px;
            width: auto;
        }

        .header-info {
            text-align: right;
            font-size: 14px;
        }

        .header-info p {
            margin: 0;
            padding: 3px 0;
        }

        .title {
            text-align: center;
            margin: 20px 0;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .title h2 {
            margin: 0;
            font-weight: 600;
            border-bottom: 3px solid var(--primary-color);
            display: inline-block;
            padding-bottom: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid var(--border-color);
            text-align: left;
            padding: 10px;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
        }

        .parcelle-header {
            background-color: var(--accent-color);
            font-weight: bold;
            font-size: 16px;
            color: var(--primary-color);
        }

        .section-header {
            background-color: var(--secondary-color);
            font-weight: bold;
            color: var(--text-color);
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .recolte-row:nth-child(even) {
            background-color: var(--secondary-color);
        }

        .recolte-row:hover {
            background-color: #e8f4ea;
        }

        .quantity {
            font-weight: bold;
            color: var(--success-color);
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
        }

        @media print {
            body {
                padding: 0;
                font-size: 12px;
            }

            .logo {
                height: 60px;
            }

            table {
                font-size: 11px;
                box-shadow: none;
            }

            th,
            td {
                padding: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="logo.svg" alt="logo" class="logo">
            <div class="header-info">
                <p><strong>Lomé, le</strong> {{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}</p>
                <p><strong>Rapport généré automatiquement</strong></p>
            </div>
        </div>

        <div class="title">
            <h2>STATISTIQUES GLOBALES</h2>
        </div>

        @foreach ($data as $parcelle)
            <table>
                <thead>
                    <tr>
                        <th colspan="3" class="parcelle-header text-center">
                            {{ $parcelle['nom'] }}
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3" class="section-header text-center">
                            RÉCOLTES
                        </th>
                    </tr>
                    <tr>
                        <th class="text-center">Date de la récolte</th>
                        <th class="text-center">Culture récoltée</th>
                        <th class="text-center">Quantité récoltée</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parcelle['recoltes'] as $recolte)
                        <tr class="recolte-row">
                            <td class="text-center">{{ $recolte['date_recolte'] }}</td>
                            <td class="text-center">
                                {{ $recolte['semis']['culture']['nom_culture'] }} <br>
                                <small>Semé le {{ $recolte['semis']['date_semis'] }}</small>
                            </td>
                            <td class="text-center quantity">{{ $recolte['qte'] }}</td>
                        </tr>
                    @endforeach

                    @if (count($parcelle['recoltes']) == 0)
                        <tr>
                            <td colspan="3" class="text-center">Aucune récolte enregistrée</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @endforeach

        <div class="footer">
            <img src="logo.svg" alt="logo" class="logo">
            <p style="margin-top: -20px">© {{ date('Y') }} - Gestion de chaine de valeur agricoles | Agro Tracker
            </p>
        </div>
    </div>
</body>

</html>
