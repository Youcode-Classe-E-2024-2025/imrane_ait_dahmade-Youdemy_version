<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YOUDEMY</title>
   
    <?php include_once "./link.php"; ?>
</head>

<body class="w-full">
    <?php include_once "./nav.php" ?>
    <main>
        <section class="container flex sm:justify-between p-4 gap-8 sm:flex-row flex-col  justify-center items-center   ">
            <div class="container flex flex-col items-between gap-8 ">
                <img src="../images/Group 1.png" class="img-fluid sm:w-80 w-60 " alt="">
                <p class="sm:text-sm md:text-lg lg:text-xl xl:text-3xl blockquote-footer ">La plateforme de cours en ligne Youdemy vise à révolutionner lapprentissage en proposant un système interactif et personnalisé pour les étudiants et les enseignants.</p>
            </div>
            <div class=" img-fluid sm:w-80 w-60">
                <img src="../images/350293f38ec786c069ddc22c0f318e6d_high@2x.png" alt="">
            </div>
        </section>
        <a class="btn btn-primary rounded-3xl shadow-sm w-1/3 sm:text-xl flex  justify-center items-center ml-[5%]" style="background-color:  #9B6FAC; border:none ; " href="./Catalogue.php">

            catalogue des cours
        </a>
    </main>
    <?php include_once"./footer.php"; ?>
</body>
 
</html>