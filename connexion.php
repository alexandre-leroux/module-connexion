<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css" />
    <title>connexion</title>
</head>


<body>

<main>




<?php include("code/header.php"); ?>


<?php

        try 
            {
                $bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
        catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }

        @$login = htmlspecialchars($_POST['login']);
        @$password = password_hash($_POST['password'], PASSWORD_DEFAULT);   

?>


<?php

if ( isset($_POST['submit']))
{
    
    //vérification que l'utilisateur existe bien dans la bdd
    $requete = $bdd->prepare(' SELECT * FROM utilisateurs where login = :login');
    $requete->execute(['login' => $_POST['login']]);
    $result = $requete->fetch();

    

 

    if ( $result == true)
    {
     

            if  ( password_verify($_POST['password'],$result['password']) AND $_POST['password'] === 'admin' AND $_POST['login'] === 'admin') //vérification si la connection concerne le compte admin
       

                { session_start();// ouverture de la session admin
                    $req = $bdd->prepare('SELECT * FROM utilisateurs  WHERE login  = :login');
                    $req->execute(array(
                    
                                        'login' => $_POST['login']
                    
                                        ));
            
                    $_SESSION = $req->fetch();

                    $_SESSION['login'] = $_POST['login'];
                    $_SESSION['nom'] = $result['nom'];
                    $_SESSION['prenom'] = $result['prenom'];
                    header('Location: admin.php');//redirection
                }

            else 

                {


                        if ( password_verify($_POST['password'],$result['password']))// sinon cerification du mpd, pour ouvrir une session utilisateur classique

                            {
                                session_start();
                                $req = $bdd->prepare('SELECT * FROM utilisateurs  WHERE login  = :login');
                                $req->execute(array(
                                
                                                    'login' => $_POST['login']
                                
                                                    ));
                        
                                $_SESSION = $req->fetch();

                                $_SESSION['login'] = $_POST['login'];
                                $_SESSION['nom'] = $result['nom'];
                                $_SESSION['prenom'] = $result['prenom'];
                                header('Location: index.php');//redirection
                            }

                        else 
                        {
                            $mauvaisidentifiants = "identifiants incorrects ";
                            
                        }


                }
    }
    
    else
    {
        $mauvaisidentifiants = "identifiants incorrects ";
    } 

}


?>



<!-- formulaire de connexion -->
<div class="container  " id="page_centrale_connexion">

<div class="row h-100  ">

    <div class="col-12 h-100 d-flex justify-content-center align-items-center">

            <form class="w-50"  action="connexion.php" method="post">

                        <p class="text-center"> <?php  echo @$mauvaisidentifiants;  ?> </p>

                        <div class="form-group">
                            <label for="login">Login</label>
                            <input  type="login" name="login" required class="form-control" id="login" aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" required class="form-control" id="exampleInputPassword1">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

            </form>

    </div>


</div>       

</div>
<?php



?>

<?php include("code/footer.php");?>


</main>



</body>

</html>