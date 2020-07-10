
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon moteur de recherche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="recherche" class="input">
        <input type="SUBMIT" class="btn" value="Rechercher"><br/><br/>
    </form>
    
</body>
</html>
<?php

$db_server = '127.0.0.1';
$db_name = 'moteurderecherche';
$db_user_login = 'root';
$db_user_pass = '';

$conn = mysqli_connect($db_server, $db_user_login, $db_user_pass, $db_name);

$recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';

$q = $conn->query(
    "SELECT * FROM SEARCH_ENGINE
    JOIN categories ON categories.id = categorieId
    WHERE pageurl LIKE '%$recherche%'
    OR pagecontent LIKE '%$recherche%'
    OR page LIKE '%$recherche%'
    OR categorie LIKE '%$recherche%'
    OR couleur LIKE '%$recherche%'
    LIMIT 10");

    while($r = mysqli_fetch_array($q)){
        echo '
        <div class="search">
        <a href="'.$r['pageurl'].'" target="_blank" class="link">'.$r['page'].'</a>
         <br/> <div class="categorie"><p style="background: '.$r['couleur'].';">'.$r['categorie'].'</p></div>
          <p class="content">'.$r['pagecontent'].'</p> <br/> <br/>
          </div>';
    }
?>