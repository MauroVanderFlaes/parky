<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Document</title>
</head>

<body>
    <div id="logo_zwart"></div>
    <a class="back2" href="spotChoose.php"><img src="img/back.png" alt=""></a>
    <div class="options">
        <a href="">traveller</a>
        <a href="">parker</a>
    </div>
    <div class="title">
        <h1>oprit informatie</h1>
    </div>
    <div class="oprit3">
        <img src="img/parkingOprit.png" alt="foto">
        
    </div>

    <div>
        <form action="" method="post">
            <div class="adres">
                <p>adres</p>
                <input type="text" name="adres" id="adres" placeholder="stad, straat, nummer">

            </div>
        </form>
    </div>
    


   
    
    <div class="boxBtn">
        <a class="btn" href="opritInfo.php">oprit toevoegen</a>
    </div>




    <?php include 'nav.php'; ?>

</body>
<script src="script.js"></script>

</html>