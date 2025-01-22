<?php
require_once "../controller/controlleurUser.php";
require_once "../model/UserModal.php";


$userController = new ControlleurUser(new UserModal);
$users = $userController->AffichageCours();

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
            background: linear-gradient(180deg, black, #734F93);
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
    </style>
    <?php include_once "./link.php"; ?>
</head>

<body>

    <nav class=" flex sm:flex-row flex-col justify-center items-center px-4 py-2 border-b  gap-2   ">
        <div>
            <img src="../images/logowhite.png" class="img-fluid w-36" alt="">
        </div>
    </nav>
    <section class="flex flex-col md:flex-col w-full gap-6 py-16 items-center justify-betwenn mb-10">
        <div class="flex flex-row justify-center items-center gap-4 w-full md:w-2/3">
            <div class="mb-6 text-center ">
                <h1 class="text-4xl md:text-6xl text-white font-serif">Bienvenue Imrane</h1>
                <p class="text-xl md:text-3xl mt-2 text-gray-300">tu as ladministrateur</p>
            </div>

        </div>

        <div class="flex flex-row justify-center items-center gap-4 w-full md:w-2/3 ">
            <button id="btnTableUser" class="btn btn-primary rounded-3xl shadow-lg py-3 px-8 text-lg text-purple-800 bg-white hover:bg-teal-500 border-none flex flex-row justify-center items-center  text-lg h-2/3" style="background-color:#8AC9C5">
                <img src="../images/verified_user_24dp_734F93_FILL0_wght400_GRAD0_opsz24.png" class="w-12 " alt="">
                verification
            </button>
            <button id="btnTableStatic" class="btn btn-primary rounded-3xl shadow-lg py-3 px-4 text-lg text-purple-800 bg-white hover:bg-purple-800 border-none w-1/2 flex flex-row justify-center items-center  text-lg h-2/3" style="background-color:#734F93">
                <img src="../images/monitoring_24dp_734F93_FILL0_wght400_GRAD0_opsz24.png" class="w-12 " alt="">
                Statistiques
            </button>
            <button id="btnTableContenue" class="btn btn-primary rounded-3xl shadow-lg py-3 px-4 text-lg text-purple-800 bg-white   flex flex-row justify-center items-center  text-lg  border-none w-1/2 h-2/3">
                <img src="../images/bookmark_manager_24dp_734F93_FILL0_wght400_GRAD0_opsz24.png" class="w-12 " alt="">
                gestions des contenues
            </button>
            <button id="btnInsertTags" class="btn btn-primary rounded-3xl shadow-lg py-3 px-4 text-lg text-purple-800 bg-white  flex flex-row justify-center items-center  text-lg  border-none w-1/2 h-2/3">
                <img src="../images/tag_24dp_734F93_FILL0_wght400_GRAD0_opsz24.png" class="w-12 " alt="">
                insert les tags
            </button>
            <button id="btnTableUtilisateur" class="btn btn-primary rounded-3xl shadow-lg py-3 px-4 text-lg text-purple-800 bg-white  flex flex-row justify-center items-center  text-lg  border-none w-1/2 h-2/3">
                <img src="../images/manage_accounts_24dp_734F93_FILL0_wght400_GRAD0_opsz24.png" class="w-12 " alt="">
                gestion des utilisateurs
            </button>
        </div>
    </section

        <div class="container mx-auto mt-10 rounded-xl  ">
    <!-- Conteneur avec overflow contrôlé -->
    <div class="overflow-x-auto hidden" id="openTableUser" style="width: 100%; max-width: 80%; height: auto; max-height: 75vh; overflow-y: auto; margin: auto;">
        <table id="tableUtilisateur" class="w-full bg-white border shadow-lg rounded-lg">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="px-4 py-2 text-left text-sm font-medium">Id</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Nom</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Email</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Role</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">Date de Création</th>
                    <th class="px-4 py-2 text-left text-sm font-medium">verification</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2"><?php echo htmlspecialchars($user['Id']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($user['Nom']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($user['Email']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($user['Role']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($user['DateCreation']); ?></td>
                        <td class="px-4 py-2">
                            <select name="statut_inscription" id="statut_inscription">
                                <option
                                    value="activer"
                                    <?php if (isset($user['StatutInscription']) && $user['StatutInscription'] === 'activer') echo 'selected'; ?>>
                                    activer
                                </option>
                                <option
                                    value="non-activer"
                                    <?php if (isset($user['StatutInscription']) && $user['StatutInscription'] === 'non-activer') echo 'selected'; ?>>
                                    non-activer
                                </option>
                            </select>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>

    

    </div>

  <script src="./script.js"></script>

</body>

</html>