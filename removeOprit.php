<?php


include_once(__DIR__ . "/bootstrap.php");
include_once(__DIR__ . "/LoginCheck.php");



if(!empty($_POST)){
    //check if response is ja of nee
    if(isset($_POST['ja'])){
        //verwijder oprit
        echo "ja";
        $user = new User();
        $user->deleteOprit($user_id);
        $user->removeLocation($user_id);
        header('Location: index.php');
    } else {
        //ga terug naar parkingOverzicht
        echo "nee";
        header('Location: parkingOverzicht.php');
    }
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>

<div class="logo">
    <div id="logo_zwart"></div>
    </div>
    <a class="back2" href="parking.php"><img src="img/back.png" alt=""></a>
    <div class="options">
        <a href="traveller.php" class="option">traveller</a>
        <a href="parking.php" class="option-active">parker</a>
    </div>

</div>

    <div class="warning">
        <h1>bent u zeker dat u uw oprit wilt verwijderen?</h1>
    </div>
    
    <form action="" method="post">

        <div class="btnOverzicht3">
            <!-- <a href="parkingOverzicht.php">nee</a> -->
            <input type="submit" value="nee" name="nee">
        </div>
    
        <div class="btnOverzicht4">
            
            <input type="submit" value="ja" name="ja">
        </div>
    </form>

    


</body>
</html>