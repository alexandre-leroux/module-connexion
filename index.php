<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css" />
    <title>inscription</title>
</head>
<!--  premier essai avec bootsrtap !!!!  -->
</head>


<body>

<main>

<!-- header -->



<?php //vérification si session en cours, après connexion. Include du header différent selon qui est connecté

    if ( @$_SESSION['login'] == 'admin')

        {
            include("code/header-admin.php");
        }

    elseif (isset($_SESSION['login']))

        {
            include("code/header-connect.php");
        }

    else
        {
            include("code/header.php");
        }
 ?>




<!-- section centrale accueil -->
<section>

            <div class="container-lg  mb-5">

            <div class="row-lg   flex-column  ">
                
                <h1 class="text-center my-5 text-secondary">Bienvenue chez Welcome !</h1>

                <div class="row-lg no-gutters d-flex flex-wrap  h-75" id=logo_presentation>

                    <div class="col-md d-flex flex-column justify-content-between">
                        <h2 class="text-center text-info">Une équipe dynamique</h2>
                        <img class="img-fluid d-block mx-auto mb-5" src="media/012-mortgage loan.png" alt="">
                    </div>

                    <div class="col-md  d-flex flex-column justify-content-between">
                        <h2 class="text-center text-info">Des solutions adaptées à vos besoins</h2>
                        <img class="img-fluid d-block mx-auto mb-5" src="media/013-park.png" alt="">
                    </div>

                    <div class="col-md  d-flex flex-column justify-content-between">
                        <h2 class="text-center text-info">Une écoute au quotidien</h2>
                        <img class="img-fluid d-block mx-auto mb-5 " src="media/014-rent.png" alt="">
                    </div>

                </div>

            </div>

            </div>

</section>



<!-- footer -->
<?php include("code/footer.php");?>


</main>
</body>

</html>