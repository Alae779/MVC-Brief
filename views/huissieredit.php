<?php
require_once __DIR__ . '/../models/City.php';
$cities = City::getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Professionnel - Istichara</title>
    <link rel="stylesheet" href="/istishara/views/form.css">
    <script src="/istishara/public/script.js" defer></script>
</head>
<body>
    
    <!-- Header -->
    <div class="header">
        <h1>🏛️ ISTICHARA - Ajouter un Professionnel</h1>
        <div class="header-actions">
            <a href="/istishara/" class="btn btn-secondary">← Retour</a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        
        <form action="/istishara/huissier/update" method="POST">
            <input type="hidden" name="id" value="<?= $huissier['id'] ?>">
            <!-- ========== CHAMPS COMMUNS (EN HAUT) ========== -->
            <h3 style="margin-bottom: 20px; color: #2c5f8d;">Informations générales</h3>

            <div class="form-group">
                
                <label class="form-label">Nom complet *</label>
                <input value="<?= $huissier['name'] ?>" type="text" name="name" class="form-input" placeholder="Ex: Hassan Alami" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email *</label>
                <input value="<?= $huissier['email'] ?>" type="email" name="email" class="form-input" placeholder="Ex: hassan.alami@cabinet.ma" required>
            </div>

            <div class="form-group">
                <label class="form-label">Téléphone *</label>
                <input value="<?= $huissier['phone'] ?>" type="tel" name="phone" class="form-input" placeholder="Ex: +212 6 12 34 56 78" required>
            </div>

            <div class="form-group">
                <label class="form-label">Ville *</label>
                <select name="city_id" class="form-select" required>
                    <option value="">Sélectionnez une ville</option>
                    <?php foreach($cities as $city) { ?>
                    <option value="<?= $city['id'] ?>" <?= $city['id'] == $huissier['city_id'] ? 'selected' : '' ?>><?= $city['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Années d'expérience *</label>
                <input value="<?= $huissier['years_of_experiences'] ?>" type="number" name="years_of_experiences" class="form-input" min="0" max="50" placeholder="Ex: 10" required>
            </div>

            <div class="form-group">
                <label class="form-label">Tarif horaire (MAD) *</label>
                <input value="<?= $huissier['hourly_rate'] ?>" type="number" name="hourly_rate" class="form-input" min="0" step="0.01" placeholder="Ex: 500" required>
            </div>


            <!-- Hidden Field: Type -->
            <input type="hidden" name="type" id="professionalType" value="avocat">

            <!-- ========== CHAMPS SPÉCIFIQUES AVOCAT (EN BAS) ========== -->
            

            <!-- ========== CHAMPS SPÉCIFIQUES HUISSIER (EN BAS) ========== -->
            <div id="huissierFields">
                <h3 style="margin-bottom: 20px; color: #f39c12;">Informations Huissier</h3>

                <div class="form-group">
                    <label class="form-label">Types d'actes *</label>
                    <select name="types_actes" class="form-select">
                        <option value="">Sélectionnez un type</option>
                        <option value="Signification" <?= $huissier['type'] == 'Signification' ? 'selected' : '' ?>>Signification</option>
                        <option value="Exécution"<?= $huissier['type'] == 'Exécution' ? 'selected' : '' ?>>Exécution</option>
                        <option value="Constats" <?= $huissier['type'] == 'Constats' ? 'selected' : '' ?>>Constats</option>
                    </select>
                </div>
            </div>

            <!-- ========== SUBMIT BUTTON ========== -->
            <button name="submit" type="submit" class="btn-submit">
                ✅ Enregistrer le professionnel
            </button>

        </form>
    </div>
</body>
</html>