<nav class=" flex sm:flex-row flex-col justify-between items-center px-4 py-2 border-b  gap-2   ">
    <div>
        <img src="../images/logo.png" class="img-fluid w-36" alt="">
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