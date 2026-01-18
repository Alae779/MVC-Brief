<?php
require_once __DIR__ . '/../models/Avocat.php';
require_once __DIR__ . '/../models/Huissier.php';
require_once __DIR__ . '/../models/City.php';

$lawyers = Avocat::getAlll();
$huissiers = Huissier::getAlll();
$cities = City::getAlll();
$repartition = Avocat::repartition();
$three = Avocat::topthree();


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Istichara - Dashboard</title>
    <link rel="stylesheet" href="/istishara/views/main.css">
    <style>
        /* Styles pour les tableaux */
        .dashboard-tables {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        
        .table-container {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .table-container h2 {
            color: #2c5f8d;
            margin-bottom: 20px;
            font-size: 20px;
            border-bottom: 3px solid #2c5f8d;
            padding-bottom: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background: #2c5f8d;
            color: white;
        }
        
        th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }
        
        td {
            padding: 12px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }
        
        tbody tr:hover {
            background: #f8f9fa;
        }
        
        .badge-number {
            background: #2c5f8d;
            color: white;
            padding: 4px 10px;
            border-radius: 50%;
            font-weight: 600;
            display: inline-block;
            min-width: 30px;
            text-align: center;
        }
        
        @media (max-width: 968px) {
            .dashboard-tables {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    
    <!-- Header -->
    <div class="header">
        <h1>🏛️ ISTICHARA - Dashboard</h1>
        <div class="header-actions">
            <a href="/istishara/" class="btn btn-primary">← Retour</a>
        </div>
    </div>
    
    <!-- Stats Section -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-number"><?= $lawyers['ttl'] ?></div>
            <div class="stat-label">Avocats</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $huissiers['ttl'] ?></div>
            <div class="stat-label">Huissiers</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $cities['ttl'] ?></div>
            <div class="stat-label">Villes</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?= $lawyers['ttl'] + $huissiers['ttl'] ?></div>
            <div class="stat-label">Total Professionnels</div>
        </div>
    </div>

    <!-- Tableaux de statistiques -->
    <div class="dashboard-tables">
        
        <!-- Tableau 1 : Répartition par ville -->
        <div class="table-container">
            <h2>📍 Répartition des professionnels par ville</h2>
            <table>
                <thead>
                    <tr>
                        <th>Ville</th>
                        <th>Avocats</th>
                        <th>Huissiers</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($repartition as $rep) { ?>
                    <tr>
                        
                        <td><strong><?= $rep['cityname'] ?></strong></td>
                        <td><?= $rep['ttlav'] ?></td>
                        <td><?= $rep['ttlhu'] ?></td>
                        <td><strong><?= $rep['overall'] ?></strong></td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
        <!-- Tableau 2 : Top 3 avocats par expérience -->
        <div class="table-container">
            <h2>🏆 Top 3 des avocats par expérience</h2>
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Nom</th>
                        <th>Spécialité</th>
                        <th>Expérience</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1; foreach($three as $th) { 
                       
                    ?>
                    <tr>
                        <td><span class="badge-number"><?= $counter ?></span></td>
                        <td><strong><?= $th['name'] ?></strong></td>
                        <td><?= $th['specialization'] ?></td>
                        <td><?= $th['years_of_experiences'] ?> ans</td>
                    </tr>
                    <?php
                    $counter++;
                    } ?>
                </tbody>
            </table>
        </div>
        
    </div>

</body>
</html>