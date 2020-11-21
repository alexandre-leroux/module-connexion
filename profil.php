<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css" />
    <title>profil</title>
</head>



<body>

<main>


<?php

    $bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

?>



<?php include("code/header-connect.php"); ?>






<?php //récupère les données du compte pour les afficher dans les inputs
                                                 
       
         $req = $bdd->prepare('SELECT * FROM utilisateurs  WHERE id  = :id');
         
         $req->execute(array( 'id' => $_SESSION['id']   ));
 
         $donnees = $req->fetch();
              
                           
?>
                    
                    
                    
                    
                    <!-- forumailre pour changer les données du compte -->
<div class="container " id="page_centrale_connexion">

<div class="row h-100  ">

    <div class="col-12 h-100 d-flex justify-content-center align-items-center">

            <form class="w-50"  action="profil.php" method="post">


                        <div class="form-group">
                            <label for="login">Modifier votre pseudo</label>
                            <input  type="login" name="login" class="form-control" id="login" placeholder="<?php echo $donnees['login'];   ?>" >
                        </div>

                        <div class="form-group">
                            <label for="nom">Modifier votre nom</label>
                            <input  type="text" name="nom" class="form-control" id="nom" placeholder="<?php echo $donnees['nom'];   ?>">
                        </div>

                        <div class="form-group">
                            <label for="prenom">Modifier votre prénom</label>
                            <input  type="text" name="prenom" class="form-control" id="prenom"  placeholder="<?php echo $donnees['prenom'];   ?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Modifier votre password</label>
                            <input  type="password" name="password" class="form-control" id="password" >
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirmer la modification du password</label>
                            <input  type="password" name="confirm_password" class="form-control" id="confirm_password">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

            </form>

    </div>


</div>       

</div>
                    
                    
                    
                    
            <?php        if ( isset($_POST['submit']))//verification d'envoi du formulaire


                            {
                                         
                                         if (  !$_POST['password'] == NULL OR !$_POST['confirm_password'] == NULL )//verification pour le password
         
         
         
                                                {
            
            
                                                    if ( !$_POST['password'] == NULL AND $_POST['confirm_password'] == NULL )
            
                                                            {
                                                                echo ' <div class=row><div class="col-12"><p class="text-center">Vous devez confirmer votre mot de passe</p></div></div> ';
                                                                include("code/footer.php");
                                                                            exit();
                                                            }
            
                                                    if ( $_POST['password'] == NULL AND !$_POST['confirm_password'] == NULL )
            
                                                           {
                                                               echo ' <div class=row><div class="col-12"><p class="text-center">Vous n\'avez pas saisi le champs " Modifier votre password "</p></div></div> ';
                                                               include("code/footer.php");
                                                                           exit();
                                                           }
            
                                                        
                                                    if ( !$_POST['password'] == NULL AND !$_POST['confirm_password'] == NULL AND  $_POST['password'] !== $_POST['confirm_password']  )
            
                                                           {
                                                               echo ' <div class=row><div class="col-12"><p class="text-center">Vous devez saisir deux mots de passe identiques</p></div></div> ';
                                                               include("code/footer.php");
                                                                           exit();
                                                           }
            
            
            
            
                                                    if (  $_POST['password'] === $_POST['confirm_password'] )//conditions reunies, modification du password
            
                  
                                                          {
                                                              $password = $_POST['password'];
                                                              $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                                              $req = $bdd->prepare('UPDATE utilisateurs SET password = :password WHERE id  = :id');
                                                              $req->execute(array(
                                                              'password' => $password,
                                                              'id' => $donnees['id']
                                                                      ));
                      
                                                          }
                                                    
                                               }// fin de vérification pour le password




                                        if (  !$_POST['login'] == NULL  )//verification et changement pour le login


                                                {
                                                    $req = $bdd->prepare('UPDATE utilisateurs SET login = :login WHERE id  = :id');
                                                    $req->execute(array(
                                                            'login' => $_POST['login'],
                                                            'id' => $donnees['id']
                                                                        ));
            
                                                    $_SESSION['login'] = $_POST['login'];
                                                }
        


                                        if (  !$_POST['nom'] == NULL )//verification et changement pour le nom


                                                {
                                                    $req = $bdd->prepare('UPDATE utilisateurs SET nom = :nom WHERE id  = :id');
                                                    $req->execute(array(
                                                            'nom' => $_POST['nom'],
                                                            'id' => $donnees['id']
                                                                        ));
            
                                                    $_SESSION['nom'] = $_POST['nom'];
                                                }


        
                                        if (  !$_POST['prenom'] == NULL  )//verification et changement pour le prénom


                                                {
                                                    $req = $bdd->prepare('UPDATE utilisateurs SET prenom = :prenom WHERE id  = :id');
                                                    $req->execute(array(
                                                            'prenom' => $_POST['prenom'],
                                                            'id' => $donnees['id']
                                                                        ));
            
                                                    $_SESSION['prenom'] = $_POST['prenom'];
                                                }
                           
                                




                             
                                header('Location: profil.php');//rafraichissement de la page pour remttre les valeurs affichées dans les inputs à jour
                        

                            }
                   
            
                    
            ?>
              
     
                    







<?php include("code/footer.php");?>


</main>

</body>

</html>