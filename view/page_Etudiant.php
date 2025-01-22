<?php

require_once "../controller/controllerCour.php";
require_once "../model/CourModal.php";



$CourModal = new CourModal();
$Courcontroller = new CourContrller($CourModal);
$data = $Courcontroller->AffichageCoursWithPagination();
$cours =$data[0];
$totalPages =$data[1];
$page =$data[2];

session_start();
$id = $_SESSION['IdUser'];

$mescours = $Courcontroller->AffichageMesCourEtudiant($id);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        html, body {
            min-height: 150vh;
            margin: 0;
            padding: 0;
        }

         body {
            background: linear-gradient(180deg, black,  #6F0B46);
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }


    </style>
    <?php include_once "./link.php"; ?>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<!-- Navigation Bar -->
<nav class="flex sm:flex-row flex-col justify-between items-center px-6 py-4 bg-transparent shadow-md">
    <!-- Logo -->
    <div>
        <img src="../images/1x/logored.png" class="w-36" alt="Logo">
    </div>
    
    <!-- Search Bar -->
    <form action="../index.php" method="GET" class="flex items-center gap-2 w-full sm:w-1/3">
        <input 
            type="search" 
            name="mot_cle" 
            value="<?= htmlspecialchars($_GET['mot_cle'] ?? '') ?>" 
            class="form-control px-4 py-2 rounded-full w-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400" 
            placeholder="Rechercher un cours..." 
        />
        <button type="submit" class="flex items-center justify-center w-10 h-10 bg-transparent rounded-full">
            <img src="../images/recherche.png" alt="Search Icon" class="w-5">
        </button>
    </form>

    <!-- Links & Profile -->
    <div class="flex items-center gap-6">

        <a href="#">
            <img src="../images/etudiant.jpg" class="rounded-full w-14 h-14 border-2 border-blue-500" alt="Avatar">
        </a>
    </div>
</nav>

<!-- Main Content -->
<main class="px-6 py-4">
<section class="flex flex-col md:flex-row w-full gap-6 py-16 items-center justify-between mb-10">
            <div class="flex flex-col justify-center items-center gap-4 w-full md:w-1/2">
                <div class="mb-6 text-center">
                    <h1 class="text-4xl md:text-6xl text-white font-serif">Bienvenue Etudiant</h1>
                    <p class="text-xl md:text-3xl mt-2 text-gray-300">Comment Je Peux Aider</p>
                </div>
            </div>
            
            <div class="flex flex-col justify-center items-center gap-4 w-full md:w-1/2 ">
                <button class="btn btn-primary rounded-3xl shadow-lg py-2 px-8 text-lg text-white bg-rose-700 hover:bg-rose-800 border-none w-1/2" style="background-color:#8AC9C5">
                 Mes cours
                </button>
                <button class="btn btn-primary rounded-3xl shadow-lg py-2 px-8 text-lg text-white bg-rose-700 hover:bg-rose-800 border-none w-1/2" style="background-color: #6F0B46;">
                Inscription à un cours
                </button>
            </div>
        </section>
    
    <!-- Catalogue des cours -->
   <div class="flex flex-wrap gap-2">
    <?php foreach($cours as $cour): ?>
<div class="card flex-1 text-white rounded-2xl border-white border-1" style="background-color:rgba(32, 5, 21, 0.66);" >
  <img src="<?= $cour['image'] ?>" class="card-img-top h-52 rounded-2xl" alt="...">
  <div class="card-body">
    <h5 class="card-title  text-2xl"><?= htmlspecialchars($cour['NomCour']) ?></h5>
    <p class="card-text text-xl"><?= htmlspecialchars($cour['Description'])?></p>
    <a class="card-text text-lg " href="" style="color:#8AC9C5 ;"><?= htmlspecialchars($cour['Categorie'])?></a><br>
    <form action="./courDetailEtudiant.php" method="GET">
     
        <button class="btn btn-primary border-none w-full" name="IdCour" value="<?= htmlspecialchars($cour['IdCour'])?>" style="background-color: #6F0B46;">voir a plus</button>
        </form>
  </div>
</div>
<?php endforeach;?>
</div>
   
<div class="flex justify-center mt-6">
    <nav class="inline-flex rounded-md shadow-sm">
        <!-- Previous Page Link -->
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50" aria-label="Previous page">Précédent</a>
        <?php else: ?>
            <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-l-md" aria-disabled="true" aria-label="Previous page">Précédent</span>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php if ($totalPages <= 7): ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 <?= $i == $page ? 'bg-gray-200' : '' ?>" aria-label="Page <?= $i ?>"><?= $i ?></a>
            <?php endfor; ?>
        <?php else: ?>
            <!-- Show First Page -->
            <a href="?page=1" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 <?= $page == 1 ? 'bg-gray-200' : '' ?>" aria-label="Page 1">1</a>
            
            <!-- Show Ellipsis if necessary -->
            <?php if ($page > 4): ?>
                <span class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300">...</span>
            <?php endif; ?>

            <!-- Show Near Pages -->
            <?php 
            $start = max(2, $page - 2);
            $end = min($totalPages - 1, $page + 2);
            for ($i = $start; $i <= $end; $i++): ?>
                <a href="?page=<?= $i ?>" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 <?= $i == $page ? 'bg-gray-200' : '' ?>" aria-label="Page <?= $i ?>"><?= $i ?></a>
            <?php endfor; ?>

            <!-- Show Ellipsis if necessary -->
            <?php if ($page < $totalPages - 3): ?>
                <span class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300">...</span>
            <?php endif; ?>

            <!-- Show Last Page -->
            <a href="?page=<?= $totalPages ?>" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 <?= $page == $totalPages ? 'bg-gray-200' : '' ?>" aria-label="Page <?= $totalPages ?>"><?= $totalPages ?></a>
        <?php endif; ?>

        <!-- Next Page Link -->
        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50" aria-label="Next page">Suivant</a>
        <?php else: ?>
            <span class="px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-r-md" aria-disabled="true" aria-label="Next page">Suivant</span>
        <?php endif; ?>
    </nav>
</div>

    <!-- Section Mes cours -->
    <section class="p-6 bg-gray-100 mt-2">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Mes Cours Inscrits</h1>
    <div class="flex flex-wrap gap-4 justify-center">
        <?php foreach ($mescours as $cour): ?>
        <div class="card flex-1 max-w-sm bg-white shadow-lg rounded-lg overflow-hidden transform transition hover:scale-105 hover:shadow-2xl">
            <img src="../<?= $cour['image'] ?>" class="card-img-top w-full h-52 object-cover" alt="Image du cours">
            <div class="card-body p-4">
                <h5 class="card-title text-xl font-semibold text-gray-800 mb-2"><?= htmlspecialchars($cour['NomCour']) ?></h5>
                <p class="card-text text-gray-600 mb-4"><?= htmlspecialchars($cour['Description']) ?></p>
                <a class="card-text text-sm text-blue-500 hover:underline mb-4 inline-block" href="#"><?= htmlspecialchars($cour['Categorie']) ?></a>
                <form action="./courDetailEtudiant.php" method="GET">
                    <button class="btn w-full py-2 my-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500" name="IdCour" value="<?= htmlspecialchars($cour['IdCour']) ?>">Voir Plus</button>
                </form>
                <form action="../index.php" method="GET">
                <input type="hidden" name="IdCour" value="<?= htmlspecialchars($cour['IdCour']); ?>">
                <input type ="hidden" name="IdName" value="<?=$id?>">
                    <button class="btn w-full py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-purple-500" name="suprimerCourMesCours">suprimer</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

</main>

<?php include_once "./footer.php"; ?>

</body>
</html>
