<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once "../view/link.php" ?>
</head>

<body class="w-full h-screen flex flex-row">

    <div class=" border-none w-1/3 h-full flex justify-center items-center " style="background-color: #8AC9C5;">
        <div class="container mt-5">
            <div class="text-center py-5  rounded">
                <h1 class="text-4xl  font-bold text-white mb-3">Bienvenue, vous êtes de retour!</h1>
                <p class="text-gray-600">Nous sommes ravis de vous revoir parmi nous.</p>
            </div>
        </div>
    </div>
    <div class=" flex justify-center items-center w-2/3">
        <form class="border-1 shadow-lg bg-light p-6 rounded-lg w-1/2" action="../index.php" method="POST">
            <div class="form-group  ">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>


            <button type="submit"  class="btn btn-primary  border-none w-full" name="login"  style="background-color: #8AC9C5;">Submit</button>
            <div class="text-center mt-3">
                <small>Vous n avez pas un compte ? <a href="./page_signup.php" class="text-primary">s'inscrer</a></small>
            </div>
        </form>
    </div>


</body>

</html>