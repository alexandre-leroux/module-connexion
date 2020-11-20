<!-- header -->

<header class="container-sm-fluid sticky-top" id=header>

    <nav class="h-100 navbar navbar-expand-sm navbar-dark bg-dark ">

        <a class="navbar-brand h-100" href="index.php"><img src="media/logo.png"  class="h-100 img-fluid"   alt="logo">Welcome !</a>

        <button class=" navbar-toggler navbar-toggler-dark bg-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="bg-dark justify-content-around navbar-nav ">

                            <li class="nav-item ml-5 my-2 ">
                                <a class="nav-link " href="profil.php">modifier votre profil</a>
                            </li>

                            <form class="ml-5 my-2 d-flex align-items-center" action="index.php" method="post">
                                     <input class="btn btn-primary " name = "deco" type="submit" value="Se déconnecter">
                            </form>
                           
                </ul>

                <div></div>
    
        </div>

    </nav>

</header>

<?php  if ( isset($_POST['deco'])) {session_destroy();header('Location: index.php'); }   ?> 
