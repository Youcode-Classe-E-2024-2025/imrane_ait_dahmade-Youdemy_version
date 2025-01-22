<?php
 require_once "../controller/controllerCour.php";
 require_once "../model/CourModal.php";




$Courcontroller = new CourContrller(new CourModal);
$data = $Courcontroller->AffichageCoursWithPagination();
$cours =$data[0];
$totalPages =$data[1];
$page =$data[2];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>catalogue</title>
    <?php include_once"./link.php";?>
</head>
<body>
<?php include_once "./nav.php";?>
<main class=" flex flex-wrap gap-2   m-[2%]">

  <?php foreach($cours as $cour): ?>
<div class="card flex-1 " >
  <img src="../<?= $cour['image'] ?>" class="card-img-top h-52" alt="...">
  <div class="card-body">
    <h5 class="card-title  text-2xl"><?= htmlspecialchars($cour['NomCour']) ?></h5>
    <p class="card-text text-xl"><?= htmlspecialchars($cour['Description'])?></p>
    <a class="card-text text-lg " href="" style="color:#8AC9C5 ;"><?= htmlspecialchars($cour['Categorie'])?></a><br>
    <a href="#" class="btn btn-primary border-none w-full " style="background-color: #6F0B46;">voir plus</a>
  </div>
</div>
<?php endforeach;?>

</main>
<!-- Pagination -->
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
    <?php include_once"./footer.php"; ?>
</body>
</html>