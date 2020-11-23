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

        try 
            {
                $bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
        catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }
            
?>



<?php include("code/header-admin.php"); ?>

<?php //récupère les données du compte pour les afficher dans les inputs


     $req = $bdd->query('SELECT * FROM utilisateurs ');

     $donnees = $req->fetch(PDO::FETCH_ASSOC);

     
?>


<div class='container  table-responsive-lg'>

    <table class="table table-bordered table-hover ">
        <thead class="thead-light">
            <tr>
                    <?php             
                            foreach ( $donnees as $key => $value)
                            
                            {
                                echo '<th>'.$key.'</th> '; 

                            }
                    ?>
            </tr>
        </thead>



        <tbody >
                <tr>
                        <?php            
                                echo '<tr>';
                                foreach ( $donnees as $key => $value)
                                
                                {
                                    echo '<td>' .$value.'</td>'; 

                                }
                                echo '<tr/>';



                                while (  (  $donnees = $req->fetch(PDO::FETCH_ASSOC))  != NULL)

                                {

                                    echo '<tr>';  
                                    
                                    foreach ( $donnees as $key => $value){
                                        echo '<td>' .$value.'</td>'; 
                                            }  
                                    
                                    '<tr/>';
                                }

                        ?>
                </tr>
        </tbody>


    </table>
    
</div>







<?php include("code/footer.php");?>


</main>

</body>

</html>