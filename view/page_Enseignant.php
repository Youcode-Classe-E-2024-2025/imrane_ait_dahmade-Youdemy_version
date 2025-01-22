<?php
require_once "../controller/controllerTags.php";
require_once "../model/TagsModal.php";
require_once "../controller/controllerCategorie.php";
require_once "../model/CategorieModal.php";
require_once "../entities/Categorie.php";
require_once "../entities/Cour.php";
require_once "../model/CourModal.php";
require_once "../controller/controllerCour.php";

$cours = new CourContrller(new CourModal) ;
$cours = $cours->AffichageCoursEnseignant($_GET['name']);




$tags = new TagControlleur(new TagsModal);
$categories = new controllerCategorie(new CategorieModal);
$categoriesArray = $categories->GetAllCategories();
$tagsArray = $tags->RecoverDataToArrayTags();
$tagsArray = array_map(function ($tag) {
    return ['value' => $tag['NomTag'], 'id' => $tag['IdTag']];
}, $tagsArray);
// $categoriesArray = array_map(function ($categorie){
//     return ['value' => $categorie['NomCategorie'], 'id' => $categorie['id']];
// },$categoriesArray);
/**
 * Dump and die.
 *
 * @param $var
 * @return void
 */
function dd(...$var)
{
    foreach ($var as $elem) {
        echo '<pre class="codespan">';
        echo '<code>';
        !$elem || $elem == '' ? var_dump($elem) : print_r($elem);
        echo '</code>';
        echo '</pre>';
    }


    die();
}



//  dd($categoriesArray);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html,
        body {
            min-height: 150vh;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(180deg, black, #8AC9C5);
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }



        .slider-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: auto;
            padding: 20px 0;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            gap: 20px;
            padding: 0 20px;
        }

        .card {
            flex: 0 0 auto;
            width: 20rem;
            min-height: 24rem;
            background-color: #6F0B46;
            margin: 0 10px;
            border-radius: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-radius: 1.5rem 1.5rem 0 0;
        }

        .card-body {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            cursor: pointer;
            background-color: rgba(75, 85, 99, 0.8);
            color: white;
            padding: 1rem;
            border-radius: 50%;
            border: none;
            transition: background-color 0.3s;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(75, 85, 99, 1);
        }

        .prev {
            left: 1rem;
        }

        .next {
            right: 1rem;
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            padding: 2.5rem;
            background-color: #6F0B46;
            border-radius: 0.5rem;
            margin-top: 2.5rem;
        }

        .stat-card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    <?php include_once "./link.php"; ?>
    <script src="./script.js"></script>
    <!-- Tagify CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">

    <!-- Tagify JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>

</head>

<body>
    <nav class=" flex sm:flex-row flex-col justify-between items-center px-4 py-2 border-b  gap-2   ">
        <div>
            <img src="../images/logoVert.png" class="img-fluid w-36" alt="">
        </div>
        <div class="input-group rounded  sm:w-[20%] w-1/2  ">
            <form action="../index.php" method="GET" class="d-flex align-items-center gap-2">
                <input
                    value="<?= htmlspecialchars($_GET['mot_cle'] ?? '') ?>"
                    type="search"
                    name="mot_cle"
                    class="form-control rounded-3xl"
                    placeholder="Search"
                    aria-label="Search"
                    aria-describedby="search-addon" />
                <button type="submit" class="btn btn-primary bg-transparent border-none "><img src="../images/recherche.png" alt="" class="w-[50%] image-cercle "></button>
            </form>

        </div>
        <div class="flex flex-row gap-2 lg:w-1/5">
            <a href="./page_login.php" class="btn btn-primary rounded-3xl shadow-sm lg:py-1 w-1/2 sm:text-lg text-sm  " style="background-color: #8AC9C5; border:none">
                se connecter
            </a>
            <a href="./page_signup.php" class="btn btn-primary rounded-3xl shadow-sm w-1/2 sm:text-lg" style="background-color:  #6F0B46; border:none ;">
                s'inscrer
            </a>
        </div>
    </nav>

    <main class="container mx-auto py-10 px-4">
        <!-- Welcome Section -->
        <section class="flex flex-col md:flex-row w-full gap-6 py-16 items-center justify-between mb-10">
            <div class="flex flex-col justify-center items-center gap-4 w-full md:w-1/2">
                <div class="mb-6 text-center">
                    <h1 class="text-4xl md:text-6xl text-white font-serif">Bienvenue Enseignant</h1>
                    <p class="text-xl md:text-3xl mt-2 text-gray-300">Comment Je Peux Aider</p>
                </div>
                <button class="btn btn-primary rounded-3xl shadow-lg py-2 px-8 text-lg text-white hover:bg-teal-500 border-none" style="background-color:#8AC9C5">
                    ajouter un nouvelle cour
                </button>
            </div>

            <div class="flex flex-col justify-center items-center gap-4 w-full md:w-1/2 ">
                <button id="btnAfficherSectionCour" class="btn btn-primary rounded-3xl shadow-lg py-2 px-8 text-lg text-white hover:bg-purple-800 border-none w-1/2" style="background-color:#734F93">
                    voir mes cours
                </button>
                <button class="btn btn-primary rounded-3xl shadow-lg py-2 px-8 text-lg text-white bg-rose-700 hover:bg-rose-800 border-none w-1/2" style="background-color: #6F0B46;">
                    voir les statistiques
                </button>
            </div>
        </section>




        <!-- Course Actions Section -->
        <section class="flex flex-col md:flex-row justify-center py-12 gap-8">
            <button id="openPopupVideo" class="btn btn-primary rounded-full shadow-lg  flex flex-row justify-center items-center  text-lg text-purple-800 hover:bg-purple-800 border-none" style="background-color:white">
                <img src="../images/motion_play_24dp_734F93_FILL0_wght400_GRAD0_opsz24.png" class="w-14 " alt="">
                <span class="">
                    ajouter un cour video
                </span>
            </button>
            <button id="openPopupDocument" class="btn btn-primary rounded-full shadow-lg  flex flex-row justify-center items-center  text-lg text-purple-800 hover:bg-purple-800 border-none" style="background-color:white">
                <img src="../images/description_24dp_734F93_FILL0_wght400_GRAD0_opsz24.png" class="w-14 " alt="">
                <span class="">
                    ajouter un cour document
                </span>
            </button>
        </section>
        <section id="AfficherSectionCour" class="flex flex-wrap w-full px-2  pt-4 ">
        <?php foreach($cours as $cour): ?>
<div class="card flex-1 " >
  <img src="../<?=  $cour['image'] ?>" class="card-img-top h-52" alt="...">
  <div class="card-body">
    <h5 class="card-title  text-2xl"><?= htmlspecialchars($cour['NomCour']) ?></h5>
    <p class="card-text text-xl"><?= htmlspecialchars($cour['Description'])?></p>
    <a class="card-text text-lg " href="" style="color:#8AC9C5 ;"><?= htmlspecialchars($cour['Categorie'])?></a><br>
    <form action="./courDetailEnseignant.php" method="GET">
        
    <button class="btn btn-primary border-none w-full" name="IdCour" value="<?= htmlspecialchars($cour['IdCour'])?>" style="background-color: #6F0B46;">voir plus</button>
    </form>
  </div>
</div>
<?php endforeach;?>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="stat-card">
                <h3 class="text-2xl font-semibold text-gray-800">+1,200</h3>
                <p class="text-gray-600">Total d'étudiants</p>
            </div>
            <div class="stat-card">
                <h3 class="text-2xl font-semibold text-gray-800">150</h3>
                <p class="text-gray-600">Total de cours</p>
            </div>
            <div class="stat-card">
                <h3 class="text-2xl font-semibold text-gray-800">8</h3>
                <p class="text-gray-600">Instructeurs</p>
            </div>
            <div class="stat-card">
                <h3 class="text-2xl font-semibold text-gray-800">90%</h3>
                <p class="text-gray-600">Taux de satisfaction</p>
            </div>
        </section>
      
    </main>
    <div
        id="popup"
        class="container my-5 p-5 bg-white shadow-lg rounded-xl  w-[80%] h-fit absolute hidden left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50" style="box-shadow:10px #78589B;">
        <h2 class="text-2xl font-bold text-center mb-5">Ajouter un Cours</h2>
        <form action="../index.php" method="post" enctype="multipart/form-data">
            <div class="flex flex-row justify-between items-center">
                <div class="flex flex-col w-1/2">
                    <div class="mb-4">
                        <label for="NomCour" class="form-label font-semibold">Entrer le nom du cours</label>
                        <input
                            type="text"
                            name="NomCour"
                            id="NomCour"
                            class="form-control border border-gray-300 rounded-lg p-2 focus:ring-2  focus:outline-none" style="border:solid 1px #78589B">
                    </div>
                    <!-- Description -->
                    <div class="mb-4">
                        <label for="Description" class="form-label font-semibold">Entrer une description</label>
                        <textarea
                            name="Description"
                            id="Description"
                            rows="4"
                            class="form-control border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?= $_GET['name'] ?>">
                </div>
                <!-- Téléchargement Vidéo -->
                <div class="flex flex-col w-[40%]">
                    <div class="mb-4">
                        <label for="Video" class="form-label font-semibold">Télécharger la vidéo</label>
                        <input
                            type="file"
                            name="Video"
                            id="Video"
                            class="form-control border   rounded-lg p-2">

                    </div>
                    <!-- Téléchargement Image -->
                    <div class="mb-4">
                        <label for="Image" class="form-label font-semibold">Télécharger une image</label>
                        <input
                            type="file"
                            name="Image"
                            id="Image"
                            class="form-control border border-gray-300 rounded-lg p-2">
                    </div>
                    <!-- Catégorie -->
                    <div class="mb-4">
                        <label for="Categorie" class="form-label font-semibold">Catégorie</label>
                        <select
                            name="Categorie"
                            id="Categorie"
                            class="form-select border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 text-black  focus:outline-none">
                            <option value="" disabled selected>Choisir une catégorie</option>
                            <?php foreach ($categoriesArray as $categorie): ?>
                                <option class="text-black" value="<?php echo htmlspecialchars($categorie['NomCategorie']); ?>"><?php echo htmlspecialchars($categorie['NomCategorie']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Tags -->
                    <div class="mb-4">
                        <label for="Tags" class="form-label font-semibold">Tags</label>
                        <input name='input-custom-dropdown' class='tagify--custom-dropdown form-control' placeholder='Ecrire votre Tags' />
                    </div>
                </div>
            </div>
            <!-- Bouton Soumettre -->
            <div class="text-c
        enter">
                <button
                    name="AjouterUnCourVideo"
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none border-none" style="background-color: #78589B">
                    Soumettre
                </button>
            </div>
        </form>
        <!-- Bouton pour fermer la popup -->
        <div class="absolute top-2 right-2">
            <button
                id="closePopup"
                class="text-gray-500 hover:text-gray-800 text-xl font-bold">
                &times;
            </button>
        </div>
    </div>
    <div
        id="overlay"
        class="fixed inset-0 bg-black bg-opacity-50 hidden z-40">
    </div>



    <div id="PopupDocument"
        class="container p-5 bg-white w-full shadow-lg rounded-lg absolute hidden left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50"
        style="width: 100%; max-width: 70%; height: auto; max-height: 90vh; overflow-y: auto;">
        <h1 class="text-2xl font-bold text-center mb-4">Éditeur Markdown</h1>

        <form action="../index.php" method="post" enctype="multipart/form-data"  class="space-y-4">
       
            <div class="flex flex-row justify-between">
                <div class="flex flex-col justify-between w-1/2 ">
                    <div class="mb-4">
                        <label for="NomCour" class="form-label font-semibold">Entrer le nom du cours</label>
                        <input
                            type="text"
                            name="NomCour"
                            id="NomCour"
                            class="form-control border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none w-full">
                    </div>
                    <!-- Description -->
                    <div class="mb-4">
                        <label for="Description" class="form-label font-semibold">Entrer une description</label>
                        <textarea
                            name="Description"
                            id="Description"
                            rows="4"
                            class="form-control border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none w-full"></textarea>
                    </div>
                </div>


           
                <div class="flex flex-col justify-between w-[40%]">
                    <!-- Téléchargement d'image -->
                    <div class="mb-4">
                        <label for="Image" class="form-label font-semibold">Télécharger une image</label>
                        <input
                            type="file"
                            name="Image"
                            id="Image"
                            class="form-control border border-gray-300 rounded-lg p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="Categorie" class="form-label font-semibold">Catégorie</label>
                        <select
                            name="Categorie"
                            id="Categorie"
                            class="form-select border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 text-black  focus:outline-none">
                            <option value="" disabled selected>Choisir une catégorie</option>
                            <?php foreach ($categoriesArray as $categorie): ?>
                                <option class="text-black" value="<?php echo htmlspecialchars($categorie['NomCategorie']); ?>"><?php echo htmlspecialchars($categorie['NomCategorie']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?= $_GET['name'] ?>">
                    <!-- Tags -->
                    <div class="mb-4">
                        <label for="Tags" class="form-label font-semibold">Tags</label>
                        <input name='tags-document' class='tagify--custom-dropdown form-control' placeholder='Ecrire vos Tags' />



                    </div>
                </div>
            </div>
            <div class="mb-4">
                <textarea
                    name="Document"
                    id="editor"
                    class="w-full rounded-md border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500"
                    rows="8"></textarea>
            </div>
            <!-- Bouton Enregistrer -->
            <button
            name="AjouterUnCourDoc"
                type="submit"
                class="btn btn-primary w-full py-2 text-lg bg-blue-500 text-white rounded-lg hover:bg-blue-600 border-none" style="background-color: #78589B">
                Enregistrer
            </button>
           
          
        </form>
    </div>

    <script>
        var tagsFromPHP = <?php echo json_encode($tagsArray); ?>;

        var inputElm = document.querySelector('input[name="input-custom-dropdown"]');

        var tagify = new Tagify(inputElm, {
            whitelist: tagsFromPHP,
            maxTags: 10,
            dropdown: {
                maxItems: 20,
                classname: 'tags-look',
                enabled: 0,
                closeOnSelect: false
            }
        });

        var inputForm2 = document.querySelector('input[name="tags-document"]');
    var tagifyForm2 = new Tagify(inputForm2, {
        whitelist: tagsFromPHP,
        maxTags: 10,
        dropdown: {
            maxItems: 20,
            classname: 'tags-look',
            enabled: 0,
            closeOnSelect: false
        }
    });
    </script>




</body>

</html>