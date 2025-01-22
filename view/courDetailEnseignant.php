<?php

require_once "../controller/controllerCour.php";
require_once "../model/CourModal.php";
require_once "../model/TagsModal.php";
require_once "../controller/controllerTags.php";

$tags = new TagControlleur(new TagsModal);
$tags = $tags->AfficherTags($_GET['IdCour']);

$cour = new CourContrller(new CourModal);
$cour = $cour->AfficheCour($_GET['IdCour']);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Cours</title>
    <?php include_once "./link.php"; ?>

</head>
<body  style="background-color:rgb(52, 26, 41)">

    <!-- Container principal -->
    <div class="container mx-auto mt-10 max-w-4xl">
        <!-- Card de détail -->
        <div class="card shadow-lg rounded-lg overflow-hidden bg-white">
            <!-- Image du cours -->
            <img src="../<?= htmlspecialchars($cour['image']) ?>" 
                 alt="Image du cours" 
                 class="card-img-top w-full h-64 object-cover">
            
            <!-- Contenu du cours -->
            <div class="card-body p-6">
                <!-- Titre du cours -->
                <h2 class="card-title text-2xl font-bold text-gray-800 mb-4">
                    <?= htmlspecialchars($cour['NomCour']) ?>
                </h2>

                <!-- Description -->
                <p class="card-text text-lg text-gray-600 mb-4">
                    <?= htmlspecialchars($cour['Description']) ?>
                </p>

                <!-- Catégorie -->
                <p class="text-md text-blue-500 font-semibold">
                    Catégorie : <a href="#" class="hover:underline"><?= htmlspecialchars($cour['Categorie']) ?></a>
                </p>

                <div class="flex justify-center my-6">
    <video 
        src="../<?= htmlspecialchars($cour['Video']) ?>" 
        controls 
        class="rounded-lg shadow-lg w-full max-w-3xl h-auto border border-gray-300"
    >
        Votre navigateur ne supporte pas les vidéos HTML5.
    </video>
    
</div>
    <div class="flex flex-wrap gap-2 p-4 bg-gray-100 rounded-md shadow-md">
    <?php foreach($tags as $tag): ?>
        <span class="px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded-full">
            <?= htmlspecialchars($tag['NomTag']) ?>
        </span>
    <?php endforeach; ?>
</div>




                <!-- Boutons d'action -->
                <div class="flex justify-between items-center mt-6">
                    <!-- Voir Plus -->
                    <form action="./courDetailEnseignant.php" method="GET" class="w-full">
                        <button 
                            name="IdCour" 
                            value="<?= htmlspecialchars($cour['IdCour']) ?>" 
                            class="btn btn-primary w-full py-2 bg-purple-100 text-white font-semibold rounded-lg hover:bg-purple-700">
                        </button>
                    </form>
                </div>

                <!-- Modifier et Supprimer -->
                <div class="flex justify-between items-center mt-4">
                    <!-- Modifier -->
                    <form action="./editCour.php" method="GET">
                        <button 
                            name="IdCour" 
                            value="<?= htmlspecialchars($cour['IdCour']) ?>" 
                            class="btn btn-warning w-full py-2 text-white font-semibold rounded-lg hover:bg-yellow-600">
                            Modifier
                        </button>
                    </form>
                    <!-- Supprimer -->
                    <form action="../index.php" method="POST" class="ml-4">
                        <input type="hidden" name="IdCour" value="<?= htmlspecialchars($cour['IdCour']) ?>">
                        <button 
                        name="SuprimerCour"
                            type="submit" 
                            class="btn btn-danger w-full py-2 text-white font-semibold rounded-lg hover:bg-red-700">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
