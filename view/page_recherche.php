
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once __DIR__ . "/link.php" ;?>
</head>
<body>
    <?php include_once __DIR__ . "/nav.php";?>
<div class=" flex  flex-wrap p-2 ">
    <?php foreach($cours as $cour): ?>
<div class="card flex-2">
  <img src="<?= $cour['image'] ?>" class="card-img-top h-52" alt="...">
  <div class="card-body">
    <h5 class="card-title  text-2xl"><?= htmlspecialchars($cour['NomCour']) ?></h5>
    <p class="card-text text-xl"><?= htmlspecialchars($cour['Description'])?></p>
    <a class="card-text text-lg " href="" style="color:#8AC9C5 ;"><?= htmlspecialchars($cour['Categorie'])?></a><br>
    <a href="#" class="btn btn-primary border-none w-full " style="background-color: #6F0B46;">voir plus</a>
  </div>
</div>
<?php endforeach;?>
</div>
</body>
</html>