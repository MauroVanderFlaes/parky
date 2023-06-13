<?php
include_once(__DIR__ . "/bootstrap.php");
include_once(__DIR__ . "/LoginCheck.php");



if(!empty($_POST)) {




    if (isset($_POST['myCheckbox']) && $_POST['myCheckbox'] == '1') {
        // Checkbox is checked, perform the desired action
        // echo 'Checkbox is checked';




        $user = new User();
        $location = $_POST['location'];
        $postcode = $_POST['locationCode'];
        $city = $_POST['city'];
        $user_Id = $_SESSION['user_id'];
        $prijs = $_POST['slider'];
        $soortParking = "oprit";
        $startUur = $_POST['startUur'];
        $eindUur = $_POST['eindUur'];

        // var_dump($prijs);



        if (!empty($_POST['selectedDaysOutput'])) {
            $selectedDaysOutput = $_POST['selectedDaysOutput'];
            // $user->setAvailability($user_Id, $selectedDaysOutput);
            // var_dump($selectedDaysOutput);
            // Handle the selectedDaysOutput value as needed
        } else {
            echo "no days selected";
        }




        if (!empty($_POST["selectedImage"])) {
            $selectedImage = $_POST["selectedImage"];
            // echo $selectedImage;
            // Store the selected image in a variable
            // ...
        } else {
            // Checkbox is not selected
            echo "Please select the checkbox";
        }







        //geocoding using nominatim
        $address = $location . " " . $postcode . " " . $city;
        $url = "https://nominatim.openstreetmap.org/search?q=" . urlencode($address) . "&format=json&addressdetails=1&limit=1&polygon_svg=1";

        $options =[
            'http'=>[
                'header'=>'User-Agent: PHP'
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);

        if(!empty($response)) {
            $latitude = round((float) $response[0]['lat'], 6);
            $longitude = round((float) $response[0]['lon'], 6);

            $user->setLocation($user_Id, $location, $postcode, $city, $latitude, $longitude, $prijs, $selectedDaysOutput, $selectedImage, $soortParking, $startUur, $eindUur);
            //verhoog aantal toevoegde locaties met 1
            $user->addLocation($user_Id);
            header("Location: index.php");
        } else {
            echo "Address doesn't exist";
        }


    } else {
        // Checkbox is not checked, perform an alternate action or do nothing
        $errorCheckbox = "Accepteer de parker voorwaarden om verder te gaan";
    }

}

//checkbox




//selecting size










function generateCalendar($month, $year)
{
    // Haal de eerste dag van de maand op
    $firstDay = mktime(0, 0, 0, $month, 1, $year);

    // Haal het aantal dagen in de maand op
    $daysInMonth = date('t', $firstDay);

    // Haal de weekdag op voor de eerste dag
    $dayOfWeek = date('N', $firstDay);

    // Maak de kalendertabel aan
    $calendar = '<table class="calendar">';

    // Maak de tabelkop met maand en jaar aan
    // $calendar .= '<caption>' . date('F Y', $firstDay) . '</caption>';

    $calendar .= '<thead><tr>';
    $calendar .= '<th colspan="7">Ma Di Wo Do Vr Za Zo</th>';
    $calendar .= '</tr></thead>';

    $calendar .= '<tbody><tr>';

    $calendar .= str_repeat('<td></td>', $dayOfWeek - 1);

    for ($day = 1; $day <= $daysInMonth; $day++) {
        $calendar .= '<td class="calendar-day" data-day="' . $day . '">' . $day . '</td>';

        if (($day + $dayOfWeek - 1) % 7 == 0 && $day != $daysInMonth) {
            $calendar .= '</tr><tr>';
        }
    }

    $calendar .= str_repeat('<td></td>', 7 - (($day + $dayOfWeek - 1) % 7));

    $calendar .= '</tr></tbody>';
    $calendar .= '</table>';

    return $calendar;
}

$month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

$calendarMarkup = generateCalendar($month, $year);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">

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

    <div><?php if(isset($errorCheckbox)): ?></div>
        <p><?php echo $errorCheckbox?></p>
    <div><?php endif;?></div>
   

    <div class="boxInfo">
        <form action="" method="post">
            <div class="adres">
                    <div class="boxOpritinfo">
                        <p  class="streetOprit">Straat en nummer</p>
                        <input class="inputOprit" type="text" name="location" id="adres" placeholder="straat, nummer">
                        <p class="postcodeOprit">Postcode</p>
                        <input type="text" name="locationCode" id="adres" placeholder="postcode">
                        <p class="adresOprit" >City</p>
                        <input type="text" name="city" id="adres" placeholder="city">

                    </div>



                    <div class="boxSlider">
                        <p class="tariefCls">Tarief (prijs/uur)</p>
                        <div class="thirdDivFilterOprit">
                            <div class="rangeOprit">
                                <div class="sliderValueOprit">
                                    <span>5</span>
                                </div>
                                <div class="fieldOprit">
                                    <div class="value left">€0</div>
                                    <input name="slider" type="range" min="0" max="10" value="5" steps="1">
                                    <div class="value right">€10</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    
                <div class="calendar-container">
                    <div class="calendar-navigation">
                        <?php
                            $prevMonth = ($month - 1) <= 0 ? 12 : ($month - 1);
$prevYear = ($month - 1) <= 0 ? ($year - 1) : $year;
$nextMonth = ($month + 1) > 12 ? 1 : ($month + 1);
$nextYear = ($month + 1) > 12 ? ($year + 1) : $year;
?>
                        <a href="?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>">&lt;</a>
                        <span class="calendar-caption"><?php echo date('F Y', mktime(0, 0, 0, $month, 1, $year)); ?></span>
                        <a href="?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>">&gt;</a>
                    </div>

                    <div class="calendar-wrapper">
                        <?php echo $calendarMarkup; ?>
                    </div>

                    <div id="selected-days"></div>

                    
                    <!-- Other form fields -->
                    <input type="hidden" name="selectedDaysOutput" id="selected-days-output">
                    <input class="btn" type="submit" value="oprit toevoegen">

                </div>

                <p class="tijdstip">tijdstip</p>
                <div class="time">
                    <input type="time" name="startUur" id="time1" placeholder="start-uur">
                    <p>:</p>
                    <input type="time" name="eindUur" id="time2" placeholder="eind-uur">

                </div>

                <p class="tijdstip2">grootte parkeerplaats</p>
                <!-- <div class="boxImgs">
                    <a class="firstImg" href=""><img src="img/small.png" alt="foto"></a>
                    <a class="firstGreenImg" href=""><img src="img/smallGreen.png" alt="green"></a>
                    <a class="secondImg" href=""><img src="img/medium.png" alt="2efoto"></a>
                    <a class="secondGreenImg" href=""><img src="img/mediumGreen.png" alt="2efoto"></a>
                    <a href=""><img src="img/large.png" alt=""></a>
                    <a href=""><img src="img/xl.png" alt=""></a>
                </div> -->



                
                    <div class="boxImgs">
                        <label>
                            <input type="radio" name="selectedImage" value="small oprit" />
                            <img src="img/small.png" alt="foto">
                        </label>
                        <label>
                            <input type="radio" name="selectedImage" value="medium" />
                            <img src="img/medium.png" alt="2efoto">
                        </label>
                        <label>
                            <input type="radio" name="selectedImage" value="large oprit" />
                            <img src="img/large.png" alt="">
                        </label>
                        <label>
                            <input type="radio" name="selectedImage" value="extra large oprit" />
                            <img src="img/xl.png" alt="">
                        </label>
                    </div>
                    
                


    
                
                <div class="textVoorwaarden">
                <form method="POST" action="process.php">
                    <label>
                    <input type="checkbox" name="myCheckbox" value="1">
                    <!-- Check me -->
                    </label>
                    <br>
                    
                </form>
                    <p class="textVoorw">ik heb de <a class="voorwaarden" href="">Parker voorwaarden</a> gelezen en ik ga akkoord.</p>
                </div>
                
                
                <div class="opritBtn">
                    <div class="boxBtn">
                        <input class="btn" type="submit" value="oprit toevoegen">
                </div>

              
            </div>
        </div>
    </form>
</div>
    

    <?php include 'nav.php'; ?>

    <script>


let slideValue = document.querySelector(".sliderValueOprit span");
  let inputSlider = document.querySelector(".rangeOprit input");
  inputSlider.oninput = (()=>{
    let value = inputSlider.value;
    slideValue.textContent = value;
    slideValue.style.left = (value*10) + "%";
    slideValue.classList.add("show");
    // console.log(value);
    
});



  inputSlider.onblur = (()=>{
    slideValue.classList.remove("show");
  });


















    





    // Add event listeners to each day cell
    var dayCells = document.querySelectorAll('.calendar td[data-day]');
    dayCells.forEach(function(dayCell) {
        dayCell.addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.toggle('selected-day');
            displaySelectedDays();
        });
    });

    // Display the selected days
    // function displaySelectedDays() {
    //     var selectedDays = document.querySelectorAll('.calendar td.selected-day');
    //     var selectedDaysOutput = '';
    //     selectedDays.forEach(function(selectedDay) {
    //         var day = selectedDay.getAttribute('data-day');
    //         selectedDaysOutput += day + ', ';
    //     });
    //     selectedDaysOutput = selectedDaysOutput.slice(0, -2); // Remove the trailing comma and space
    //     document.getElementById('selected-days').textContent = 'Geselecteerde dagen ' + selectedDaysOutput;
    //     console.log(selectedDaysOutput);
    // }

    // Display the selected days and update the hidden input field value
function displaySelectedDays() {
  var selectedDays = document.querySelectorAll('.calendar td.selected-day');
  var selectedDaysOutput = '';
  selectedDays.forEach(function(selectedDay) {
    var day = selectedDay.getAttribute('data-day');
    selectedDaysOutput += day + ', ';
  });
  selectedDaysOutput = selectedDaysOutput.slice(0, -2); // Remove the trailing comma and space
  document.getElementById('selected-days').textContent = 'Geselecteerde dagen ' + selectedDaysOutput;
  document.getElementById('selected-days-output').value = selectedDaysOutput;
}



//update img
//prevent default


    </script>
</body>
</html>