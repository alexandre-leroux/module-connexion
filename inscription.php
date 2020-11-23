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

</head>


<body>

<main>

<!-- header -->
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
    @$nom = htmlspecialchars($_POST['nom']);
    @$prenom = htmlspecialchars($_POST['prenom']);
    @$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
?>


<?php

if ($_POST == NULL)// génération d'un forumaile de base

                {?>

                    <div class="container " id="page_centrale_connexion">

                    <div class="row h-100  ">

                        <div class="col-12 h-100 d-flex justify-content-center align-items-center">

                                <form class="w-50"  action="inscription.php" method="post">


                                            <div class="form-group">
                                                <label for="login">Choisissez votre pseudo</label>
                                                <input  type="login" name="login" class="form-control" id="login" >
                                            </div>

                                            <div class="form-group">
                                                <label for="nom">Votre nom</label>
                                                <input  type="text" name="nom" class="form-control" id="nom">
                                            </div>

                                            <div class="form-group">
                                                <label for="prenom">Votre prénom</label>
                                                <input  type="text" name="prenom" class="form-control" id="prenom">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input  type="password" name="password" class="form-control" id="password">
                                            </div>

                                            <div class="form-group">
                                                <label for="confirm_password">Confirmez le Password</label>
                                                <input  type="password" name="confirm_password" class="form-control" id="confirm_password">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Submit</button>

                                </form>

                        </div>


                    </div>       

                    </div>

                <?php
                }

else {  

            $req = $bdd->prepare(' SELECT * FROM utilisateurs WHERE login = :login ');//on va chercher dans la bdd si le login existe déjà
            $req->execute(array( 'login' => $_POST['login']   ));
            $donnees = $req->fetch();


            if (@$donnees['login'] == $_POST['login'])// on compare le résultat, si c'est le cas on générère un form avec le message " login déjà utilisé " 
            
            
                {
                    ?>
                    <div class="container " id="page_centrale_connexion">

                    <div class="row h-100  ">

                        <div class="col-12 h-100 d-flex justify-content-center align-items-center">

                                <form class="w-50"  action="inscription.php" method="post">


                                            <div class="form-group">
                                                <label for="login">Choisissez votre pseudo</label>
                                                <input  type="login" name="login" class="form-control" id="login" value="<?php if(isset($login)) {echo $login;} ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="nom">Votre nom</label>
                                                <input  type="text" name="nom" class="form-control" id="nom" value="<?php if(isset($nom)) {echo $nom;} ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="prenom">Votre prénom</label>
                                                <input  type="text" name="prenom" class="form-control" id="prenom" value="<?php if(isset($prenom)) {echo $prenom;} ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input  type="password" name="password" class="form-control" id="password">
                                            </div>

                                            <div class="form-group">
                                                <label for="confirm_password">Confirmer le Password</label>
                                                <input  type="password" name="confirm_password" class="form-control" id="confirm_password">
                                            </div>
                                            <p>Pseudo déjà utilisé, veuillez en choisir un autre.</p>
                                            <button type="submit" class="btn btn-primary">Submit</button>

                                </form>

                        </div>


                    </div>       

                    </div>

                    <?php
                    }

                    else {



                                                
                                        if ( $_POST['login'] != NULL AND  $_POST['nom'] != NULL AND  $_POST['prenom'] != NULL AND  $_POST['password'] != NULL AND  $_POST['confirm_password'] != NULL   )
                                            // si tous les champs sont remplis, on peu passer à la suite
                                        {
                                        
                                                if ( @$_POST['confirm_password'] === @$_POST['password'] )
                                                    // on verifie d'abord que les mdp sont bien identiques

                                                                    {

                                                                        

                                                                            $req = $bdd->prepare('INSERT INTO utilisateurs(login, nom, prenom, password) VALUES(:login, :nom, :prenom, :password)');
                                                                            $req->execute(array(
                                                                                'login' => $login,
                                                                                'nom' => $nom,
                                                                                'prenom' => $prenom,
                                                                                'password' => $password,  ));

                                                                                header('Location: connexion.php');//redirection
                                                                            
                                                                    }

                                                else 
                                                    // si mdp non identiques, on génère le formulaire avec un message
                                                                    {?>


                                                                    <div class="container " id="page_centrale_connexion">

                                                                    <div class="row h-100  ">

                                                                        <div class="col-12 h-100 d-flex justify-content-center align-items-center">

                                                                                <form class="w-50"  action="inscription.php" method="post">


                                                                                            <div class="form-group">
                                                                                                <label for="login">Choisissez votre pseudo</label>
                                                                                                <input  type="login" name="login" class="form-control" id="login" value="<?php if(isset($login)) {echo $login;} ?>">
                                                                                            </div>

                                                                                            <div class="form-group">
                                                                                                <label for="nom">Votre nom</label>
                                                                                                <input  type="text" name="nom" class="form-control" id="nom" value="<?php if(isset($nom)) {echo $nom;} ?>">
                                                                                            </div>

                                                                                            <div class="form-group">
                                                                                                <label for="prenom">Votre prénom</label>
                                                                                                <input  type="text" name="prenom" class="form-control" id="prenom" value="<?php if(isset($prenom)) {echo $prenom;} ?>">
                                                                                            </div>

                                                                                            <div class="form-group">
                                                                                                <label for="password">Password</label>
                                                                                                <input  type="password" name="password" class="form-control" id="password">
                                                                                            </div>

                                                                                            <div class="form-group">
                                                                                                <label for="confirm_password">Confirmer le Password</label>
                                                                                                <input  type="password" name="confirm_password" class="form-control" id="confirm_password">
                                                                                            </div>
                                                                                            <p>Les mots de passe ne sont pas identiques</p>
                                                                                            <button type="submit" class="btn btn-primary">Submit</button>

                                                                                </form>

                                                                        </div>


                                                                    </div>       

                                                                    </div>
                                                                        
                                                                    <?php
                                                                    }
                                                                
                                                                
                                                                }
                                                                    


                                            else 
                                                // si des champs sont vides, on génère le formulaire avec un message
                                                        {?>


                                                        <div class="container " id="page_centrale_connexion">

                                                        <div class="row h-100  ">

                                                            <div class="col-12 h-100 d-flex justify-content-center align-items-center">

                                                                    <form class="w-50"  action="inscription.php" method="post">


                                                                                <div class="form-group">
                                                                                    <label for="login">Choisissez votre pseudo</label>
                                                                                    <input  type="login" name="login" class="form-control" id="login" value="<?php if(isset($login)) {echo $login;} ?>">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="nom">Votre nom</label>
                                                                                    <input  type="text" name="nom" class="form-control" id="nom" value="<?php if(isset($nom)) {echo $nom;} ?>">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="prenom">Votre prénom</label>
                                                                                    <input  type="text" name="prenom" class="form-control" id="prenom" value="<?php if(isset($prenom)) {echo $prenom;} ?>">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="password">Password</label>
                                                                                    <input  type="password" name="password" class="form-control" id="password">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="confirm_password">Confirmer le Password</label>
                                                                                    <input  type="password" name="confirm_password" class="form-control" id="confirm_password">
                                                                                </div>
                                                                                <p>veuillez remplir tous les champs</p>
                                                                                <button type="submit" class="btn btn-primary">Submit</button>

                                                                    </form>

                                                            </div>


                                                        </div>       

                                                        </div>
                                                 <?php
                                                 }}}
                                                 ?>



<?php


$bdd = null;


?>




<?php include("code/footer.php");?>


</main>
</body>

</html>