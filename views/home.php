<?php
require_once __DIR__ . '/../models/Avocat.php';
require_once __DIR__ . '/../models/Huissier.php';
$lawyers = Avocat::getAll();
$huissiers = Huissier::getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Istichara - Services Juridiques</title>
    <link rel="stylesheet" href="/istishara/views/main.css">
    <script src="/istishara/public/search.js" defer></script>
</head>
<body>
    <div class="header">
                <h1>🏛️ ISTICHARA - Dashboard Admin</h1>
                <div class="header-actions">
                    <a href="create" class="btn btn-primary">+ Ajouter un professionnel</a>
                    <a href="dashboard" class="btn btn-secondary">Dashboard</a>
                </div>
    </div>  

    <!-- Search & Filters Section -->
    <div class="search-section">
        <input id="searchbar" type="text" class="search-bar" placeholder="Rechercher un professionnel...">
        
        <div class="filters">
            <select id="salairefilter" class="filter-select">
                <option value="">Salaire (MAD/h)</option>
                <option value="0-500">0 - 500 MAD</option>
                <option value="500-1000">500 - 1000 MAD</option>
                <option value="1000-1500">1000 - 1500 MAD</option>
                <option value="1500+">1500+ MAD</option>
            </select>

            <select id="expfilter" class="filter-select">
                <option value="">Années d'expérience</option>
                <option value="0-5">0 - 5 ans</option>
                <option value="5-10">5 - 10 ans</option>
                <option value="10-15">10 - 15 ans</option>
                <option value="15-20">15 - 20 ans</option>
                <option value="20+">20+ ans</option>
            </select>
        </div>
    </div>

    <!-- Professionals List -->
    <div class="professionals-list">
        
        <!-- Professional Card 1 -->
         <?php foreach($lawyers as $lawyer) { ?>
        <div class="pro-card">
            <div class="pro-header">
                <h3><?= $lawyer["name"] ?></h3>
                <span class="pro-badge">Avocat</span>
            </div>
            <div class="pro-details">
                <div class="pro-info">
                    <span class="info-label">Spécialité</span>
                    <span class="info-value"><?= $lawyer['specialization'] ?></span>
                </div>
                <div class="pro-info">
                    <span class="info-label">Ville</span>
                    <span class="info-value"><?= $lawyer['cityname'] ?></span>
                </div>
                <div class="pro-info">
                    <span class="info-label">Expérience</span>
                    <span class="info-value"><?= $lawyer['exp'] ?> ans</span>
                </div>
                <div class="pro-info">
                    <span class="info-label">Tarif horaire</span>
                    <span class="info-value"><?= $lawyer['hourly_rate'] ?> MAD</span>
                </div>
                <div class="pro-info">
                    <span class="info-label">Email</span>
                    <span class="info-value"><?= $lawyer['email'] ?></span>
                </div>
                <div class="pro-info">
                    <span class="info-label">Téléphone</span>
                    <span class="info-value"><?= $lawyer['phone'] ?></span>
                </div>
            </div>
            <div class="pro-actions">
                <a href="/istishara/avocat/edit?id=<?= $lawyer['id'] ?>" class="btn btn-edit">✏️ Modifier</a>
                <a href="/istishara/avocat/delete?id=<?= $lawyer['id'] ?>" 
                   class="btn btn-delete" 
                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avocat ?')">
                    🗑️ Supprimer
                </a>
            </div>

        </div>
        <?php } ?>


         <?php foreach($huissiers as $h) { ?>
        <div class="pro-card">
            <div class="pro-header">
                <h3><?= $h['name'] ?></h3>
                <span class="pro-badge huissier">Huissier</span>
            </div>
            <div class="pro-details">
                <div class="pro-info">
                    <span class="info-label">Types d'actes</span>
                    <span class="info-value"><?= $h['type'] ?></span>
                </div>
                <div class="pro-info">
                    <span class="info-label">Ville</span>
                    <span class="info-value"><?= $h['cityname'] ?></span>
                </div>
                <div class="pro-info">
                    <span class="info-label">Expérience</span>
                    <span class="info-value"><?= $h['exp'] ?> ans</span>
                </div>
                <div class="pro-info">
                    <span class="info-label">Tarif horaire</span>
                    <span class="info-value"><?= $h['hourly_rate'] ?> MAD</span>
                </div>
                <div class="pro-info">
                    <span class="info-label">Email</span>
                    <span class="info-value"><?= $h['email'] ?></span>
                </div>
                <div class="pro-info">
                    <span class="info-label">Téléphone</span>
                    <span class="info-value"><?= $h['phone'] ?></span>
                </div>
            </div>
            <div class="pro-actions">
                <a href="/istishara/huissier/edit?id=<?= $h['id'] ?>" class="btn btn-edit">✏️ Modifier</a>
                <a href="/istishara/huissier/delete?id=<?= $h['id'] ?>" 
                   class="btn btn-delete" 
                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce huissier ?')">
                    🗑️ Supprimer
                </a>
            </div>
        </div>
        <?php } ?>
    </div>
            <script>
                let avocats  = <?= json_encode($lawyers) ?>;
                let huissiers = <?= json_encode($huissiers) ?>;
                let pros = [...avocats, ...huissiers];
                console.log(pros);

                const search = document.getElementById("searchbar")
                let salairefilter = document.getElementById("salairefilter")
                let expfilter = document.getElementById("expfilter")
                let proslist = document.querySelector(".professionals-list")

                // bash nstori les filtres actifs
                let currentSearch = '';
                let currentSalaire = '';
                let currentExperience = '';

                function applyFilters(){
                    let filtred = pros
                    // search
                    if(currentSearch !== ''){
                        filtred = filtred.filter(pro => pro.name.toLowerCase().includes(currentSearch));
                    }
                    // salaire filtre
                    if(currentSalaire !== ''){
                    let min, max;
                    if(currentSalaire === '1500+'){
                        min = 1500
                        max = Infinity
                    }else{
                        [min, max] = currentSalaire.split('-');
                        min = parseInt(min)
                        max = parseInt(max)
                    }
                    filtred = filtred.filter(pro => pro.hourly_rate >= min && pro.hourly_rate <= max);
                    }
                    // exp filtre
                    if(currentExperience !== ''){
                    let min, max;
                    if(currentExperience === '20+'){
                        min = 20
                        max = Infinity
                    }else{
                        [min, max] = currentExperience.split('-');
                        min = parseInt(min)
                        max = parseInt(max)
                    }
                    filtred = filtred.filter(pro => pro.exp >= min && pro.exp <= max);
                    }
                    // affichage
                    proslist.innerHTML = "";
                    filtred.forEach(pro => {
                        let isAvocat = pro.hasOwnProperty("specialization");
                        proslist.innerHTML += `
                        <div class="pro-card">
                            <div class="pro-header">
                                <h3>${pro.name}</h3>
                                <span class="pro-badge ${isAvocat ? '' : 'huissier'}">${isAvocat ? 'Avocat' : 'Huissier'}</span>
                            </div>
                            <div class="pro-details">
                                <div class="pro-info">
                                    <span class="info-label">${isAvocat ? 'Spécialité' : 'Types d\'actes'}</span>
                                    <span class="info-value">${isAvocat ? pro.specialization : pro.type}</span>
                                </div>
                                <div class="pro-info">
                                    <span class="info-label">Ville</span>
                                    <span class="info-value">${pro.cityname}</span>
                                </div>
                                <div class="pro-info">
                                    <span class="info-label">Expérience</span>
                                    <span class="info-value">${pro.exp} ans</span>
                                </div>
                                <div class="pro-info">
                                    <span class="info-label">Tarif horaire</span>
                                    <span class="info-value">${pro.hourly_rate} MAD</span>
                                </div>
                                <div class="pro-info">
                                    <span class="info-label">Email</span>
                                    <span class="info-value">${pro.email}</span>
                                </div>
                                <div class="pro-info">
                                    <span class="info-label">Téléphone</span>
                                    <span class="info-value">${pro.phone}</span>
                                </div>
                            </div>
                            <div class="pro-actions">
                                <a href="/istishara/${isAvocat ? 'avocat' : 'huissier'}/edit?id=${pro.id}" class="btn btn-edit">✏️ Modifier</a>
                                <a href="/istishara/${isAvocat ? 'avocat' : 'huissier'}/delete?id=${pro.id}" 
                                class="btn btn-delete" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">
                                    🗑️ Supprimer
                                </a>
                            </div>
                        </div>
                        `;
                    });
                    if (filtred.length === 0) {
                        proslist.innerHTML = `
                        <p style="text-align: center; padding: 40px; color: #999;">
                            Aucun professionnel trouvé avec ces critères
                        </p>
                        `;
                    }
                }

                search.addEventListener("input", (e) => {
                    currentSearch = e.target.value.toLowerCase();
                    applyFilters();
                })
                salairefilter.addEventListener("change", (e) => {
                    currentSalaire = e.target.value;
                    applyFilters();
                });

                expfilter.addEventListener("change", (e) => {
                    currentExperience = e.target.value;
                    applyFilters();
                });
            </script>
</body>
</html>