<?php 

include_once(__DIR__ . "/bootstrap.php");
include_once(__DIR__ . "/LoginCheck.php");




$amountUser = new User();
$amountUser->getLocationCount($_SESSION['user_id']);
// echo $amountUser->getLocationCount($_SESSION['user_id']);
if($amountUser->getLocationCount($_SESSION['user_id']) >= 1){
    header("Location: parkingOverzicht.php");
} 
// else{
//     header("Location: parking.php");
// }


?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Parky - Parking</title>
</head>

<body>
    
    <div id="logo_zwart"></div>
    <div class="options">
        <a href="">traveller</a>
        <a href="">parker</a>
    </div>
    <div class="placement">
        <div class="spots">
            <?php
            
            if (empty($spots)) {
                echo '<div class="spot_content">
        <a href="./spotChoose.php" class="add-spot">&plus;</a>
        <h1 class="noposts">U heeft nog geen parking of oprit toegevoegd.</h1>
        </div>';
            } else {
                foreach ($spots as $prompt) {
                    echo "<div class='spot'>";
                    echo "<h1 class='spot-title'>" . $spot['title'] . "</h1>";
                    echo "<p class='spot-text'>" . $spot['text'] . "</p>";
                    echo "<p class='spot-author'>By " . $spot['author'] . "</p>";
                    echo "</div>";
                    
                }
            }

            ?>
        </div>
    </div>
    <?php include_once('nav.php') ;?>
    <!-- <script src="script.js"></script> -->
</body>

</html>