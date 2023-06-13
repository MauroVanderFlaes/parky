<!-- mag weg dit nrml -->




<?php
function generateCalendar($month, $year) {
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
   
    <style>
    .calendar td {
        padding: 8px;
    }
    .calendar-caption {
        text-align: center;
        padding: 10px;
    }
    .calendar-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .calendar-navigation {
        text-align: center;
        margin-bottom: 20px;
        margin-right: 40px;
    }
    .calendar-navigation a {
        text-decoration: none;
        color: #333;
    }
    .calendar-wrapper {
        width: 300px; /* Adjust the width as needed */
        margin: 0 auto;
    }
    .calendar th {
        padding: 12px 0; /* Add more vertical padding */
        width: calc(300px / 7); /* Distribute the width equally among the days */
        box-sizing: border-box; /* Include padding in the width calculation */
        text-align: center; /* Center the day labels */
        margin-right: 8px; /* Add space between the day labels */
    }
    .calendar th:last-child {
        margin-right: 0; /* Remove space for the last day label */
    }
    .calendar thead th:not(:last-child) {
        border-right: 1px solid #ccc; /* Add a border between the day labels */
    }
    .selected-day {
        background-color: #11211F;
        color: #F2FFFF;
    }

    .calendar-day {
    padding: 8px;
    background-color: #22C7A6;
    color: #11211F;
}

.calendar-day.selected-day {
    background-color: #11211F;
    color: #F2FFFF;
}
    </style>
</head>
<body>
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
    </div>

    <script>
    // Add event listeners to each day cell
    var dayCells = document.querySelectorAll('.calendar td[data-day]');
    dayCells.forEach(function(dayCell) {
        dayCell.addEventListener('click', function() {
            this.classList.toggle('selected-day');
            displaySelectedDays();
        });
    });

    // Display the selected days
    function displaySelectedDays() {
        var selectedDays = document.querySelectorAll('.calendar td.selected-day');
        var selectedDaysOutput = '';
        selectedDays.forEach(function(selectedDay) {
            var day = selectedDay.getAttribute('data-day');
            selectedDaysOutput += day + ', ';
        });
        selectedDaysOutput = selectedDaysOutput.slice(0, -2); // Remove the trailing comma and space
        document.getElementById('selected-days').textContent = 'Geselecteerde dagen ' + selectedDaysOutput;
    }
    </script>
</body>
</html>
