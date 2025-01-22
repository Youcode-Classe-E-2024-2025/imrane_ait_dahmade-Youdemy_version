<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <?php include_once "../view/link.php"; ?>
</head>
<body class="w-full h-screen flex flex-row">

    <div class="w-1/3 h-full flex justify-center items-center" style="background-color: #6F0B46;">
        <div class="container text-center">
            <h1 class="text-4xl font-bold text-white mb-3">Bienvenue dans notre communauté!</h1>
            <p class="text-gray-200">Créez un compte pour découvrir toutes nos fonctionnalités.</p>
        </div>
    </div>

    
    <div class="flex justify-center items-center w-2/3">
       
    <form class="form-container p-6 rounded-lg w-1/3" action="../index.php" method="POST" id="signupForm">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-700">Créer un compte</h2>
        <div class="form-group mb-4">
            <label for="exampleInputName" class="form-label">Nom complet</label>
            <input name="Nom" type="text" class="form-control" id="exampleInputName" placeholder="Entrez votre nom complet" required>
            <small class="text-danger" id="nameError"></small>
        </div>
        <div class="form-group mb-4">
            <label for="exampleInputEmail1" class="form-label">Adresse e-mail</label>
            <input name="Email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez votre email" required>
            <small class="text-danger" id="emailError"></small>
        </div>
        <div class="form-group mb-4">
            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
            <input name="Password1" type="password" class="form-control" id="exampleInputPassword1" placeholder="Entrez votre mot de passe" required>
            <small class="text-danger" id="password1Error"></small>
        </div>
        <div class="form-group mb-4">
            <label for="exampleInputPassword2" class="form-label">Confirmez le mot de passe</label>
            <input name="Password2" type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirmez votre mot de passe" required>
            <small class="text-danger" id="password2Error"></small>
        </div>
        <div class="form-group mb-4">
            <label for="role" class="form-label">Rôle</label>
            <select name="Role" id="role" class="form-control">
                <option value="Etudiant">Étudiant</option>
                <option value="Enseignant">Enseignant</option>
            </select>
        </div>
        <button type="submit" class="btn w-full text-white" style="background-color: #6F0B46;" name="register">S'inscrire</button>
        <div class="text-center mt-3">
            <small>Vous avez déjà un compte ? <a href="./page_login.php" class="text-primary">Connectez-vous</a></small>
        </div>
    </form>
    </div>

  
    <script>
        document.getElementById("signupForm").addEventListener("submit", function(event) {
          
            let isValid = true;

            // Réinitialiser les messages d'erreur
            document.getElementById("nameError").textContent = "";
            document.getElementById("emailError").textContent = "";
            document.getElementById("password1Error").textContent = "";
            document.getElementById("password2Error").textContent = "";

            const name = document.getElementById("exampleInputName").value.trim();
            const email = document.getElementById("exampleInputEmail1").value.trim();
            const password1 = document.getElementById("exampleInputPassword1").value.trim();
            const password2 = document.getElementById("exampleInputPassword2").value.trim();

            // Validation du nom
            if (!name) {
                document.getElementById("nameError").textContent = "Le nom est obligatoire.";
                isValid = false;
            }

            // Validation de l'email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                document.getElementById("emailError").textContent = "L'adresse email est invalide.";
                isValid = false;
            }

            // Validation des mots de passe
            if (password1.length < 6) {
                document.getElementById("password1Error").textContent = "Le mot de passe doit contenir au moins 6 caractères.";
                isValid = false;
            }
            if (password1 !== password2) {
                document.getElementById("password2Error").textContent = "Les mots de passe ne correspondent pas.";
                isValid = false;
            }

            // Si tous les champs sont valides
            if (isValid) {
                Swal.fire({
                    icon: 'success',
                    title: 'Inscription réussie !',
                    text: 'Votre compte a été créé avec succès.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#6F0B46',
                }).then(() => {
                 
                    console.log("Formulaire soumis avec succès.");
                });
            }
        });
    </script>
</body>
</html>
