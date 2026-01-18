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
        
        <form action="/istishara/avocat/update" method="POST">
            <input type="hidden" name="id" value="<?= $avocat['id'] ?>">
            
            <!-- ========== CHAMPS COMMUNS (EN HAUT) ========== -->
            <h3 style="margin-bottom: 20px; color: #2c5f8d;">Informations générales</h3>

            <div class="form-group">
                <label class="form-label">Nom complet *</label>
                <input value="<?= $avocat['name'] ?>" type="text" name="name" class="form-input" placeholder="Ex: Hassan Alami" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email *</label>
                <input value="<?= $avocat['email'] ?>" type="email" name="email" class="form-input" placeholder="Ex: hassan.alami@cabinet.ma" required>
            </div>

            <div class="form-group">
                <label class="form-label">Téléphone *</label>
                <input value="<?= $avocat['phone'] ?>" type="tel" name="phone" class="form-input" placeholder="Ex: +212 6 12 34 56 78" required>
            </div>

            <div class="form-group">
                <label class="form-label">Ville *</label>
                <select name="city_id" class="form-select" required>
                    <option value="">Sélectionnez une ville</option>
                    <?php foreach($cities as $city) { ?>
                    <option value="<?= $city['id'] ?>" <?= $city['id'] == $avocat['city_id'] ? 'selected' : '' ?>><?= $city['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Années d'expérience *</label>
                <input value="<?= $avocat['years_of_experiences'] ?>" type="number" name="years_of_experiences" class="form-input" min="0" max="50" placeholder="Ex: 10" required>
            </div>

            <div class="form-group">
                <label class="form-label">Tarif horaire (MAD) *</label>
                <input value="<?= $avocat['hourly_rate'] ?>" type="number" name="hourly_rate" class="form-input" min="0" step="0.01" placeholder="Ex: 500" required>
            </div>

            <!-- Hidden Field: Type -->
            <input type="hidden" name="type" id="professionalType" value="avocat">

            <!-- ========== CHAMPS SPÉCIFIQUES AVOCAT (EN BAS) ========== -->
            <div id="avocatFields">
                <h3 style="margin-bottom: 20px; color: #2c5f8d;">Informations Avocat</h3>

                <div class="form-group">
                    <label class="form-label">Spécialité *</label>
                    <select name="specialization" class="form-select">
                        <option value="">Sélectionnez une spécialité</option>
                        <option value="Droit pénal" <?= $avocat['specialization'] == 'Droit pénal' ? 'selected' : '' ?>>Droit pénal</option>
                        <option value="Civil" <?= $avocat['specialization'] == 'Civil' ? 'selected' : '' ?>>Civil</option>
                        <option value="Famille" <?= $avocat['specialization'] == 'Famille' ? 'selected' : '' ?>>Famille</option>
                        <option value="Affaires" <?= $avocat['specialization'] == 'Affaires' ? 'selected' : '' ?>>Affaires</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Consultation en ligne</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="consultation_online" value="1" <?= $avocat['consultation_online'] == 1 ? 'checked' : '' ?>>
                            <span>Oui</span>
                        </label>
                        <label>
                            <input type="radio" name="consultation_online" value="0" <?= $avocat['consultation_online'] == 0 ? 'checked' : '' ?>>
                            <span>Non</span>
                        </label>
                    </div>
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