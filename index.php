<?php
$data = json_decode(file_get_contents('playlists_data.json'), true);

function stringToRGB($string) {
    // Initialize RGB values
    $red = 0;
    $green = 0;
    $blue = 0;

    // Iterate through characters in the string
    for ($i = 0; $i < strlen($string); $i++) {
        $ascii = ord($string[$i]);
        if ($i % 3 === 0) {
            $red += $ascii; // Add to Red
        } elseif ($i % 3 === 1) {
            $green += $ascii; // Add to Green
        } else {
            $blue += $ascii; // Add to Blue
        }
    }

    // Normalize values to 0-255
    $red = $red % 256;
    $green = $green % 256;
    $blue = $blue % 256;

    return "rgb($red, $green, $blue)";
}

function renderCalendar($year, $month, $data) {
    $firstDay = date("w", strtotime("$year-$month-01"));
    $daysInMonth = date("t", strtotime("$year-$month-01"));
    
    echo "<table class='calendar'>";
    echo "<thead>";
    echo "<tr><th colspan='7'>" . date("F Y", strtotime("$year-$month-01")) . "</th></tr>";
    echo "<tr><th>Dom</th><th>Lun</th><th>Mar</th><th>Mier</th><th>Jue</th><th>Vier</th><th>Sab</th></tr>";
    echo "</thead><tbody><tr>";
    
    // Fill blank days at the start of the month
    for ($i = 0; $i < $firstDay; $i++) {
        echo "<td></td>";
    }

    // Loop through each day in the month
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $currentDate = sprintf('%04d-%02d-%02d', $year, $month, $day); // Format as YYYY-MM-DD
        echo "<td>";
        echo "<div class='day-number'>$day</div>";
			//echo $currentDate;
        // Debug log to ensure dates are parsed correctly
        echo "<!-- Debug: CurrentDate = $currentDate -->";

        foreach ($data as $category => $videos) {
            foreach ($videos as $video) {
                //$videoDate = substr($video['recorded_at'], 0, 10); // Extract only the date part
                $videoDate = substr($video['video_title'], 0, 10);
                $videoDate = str_replace(" ", "-", $videoDate);
                //echo $videoDate."<br>";
                // Debug log for video date
                echo "<!-- Debug: VideoDate = $videoDate, VideoTitle = {$video['video_title']} -->";

                if ($videoDate === $currentDate) {
                $texto = str_replace("_", " ", $category);
                    echo "<div class='event' 
                        data-title='{$video['video_title']}' 
                        data-txt='{$video['txt_file_path']}' 
                        data-img='{$video['thumbnail_file_path']}' 
                        data-url='{$video['video_url']}'
                        style='background:".stringToRGB($texto).";'
                        >
                        {$texto}</div>";
                }
            }
        }
        echo "</td>";

        // Break to a new row after Saturday
        if (($day + $firstDay) % 7 == 0) {
            echo "</tr><tr>";
        }
    }

    // Fill blank days at the end of the month
    while ((($day + $firstDay - 1) % 7) != 0) {
        echo "<td></td>";
        $day++;
    }

    echo "</tr></tbody></table>";
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de eventos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
	<img src="https://tameformacion.com/wp-content/uploads/2024/08/icono-trans.png">
	<h1>Ciclo formativo de grado superior en Desarrollo de Aplicaciones Multiplataforma</h1>
	<h2>Centro de formación TAME - Curso 24/25</h2>
	<h3>Profesor: Jose Vicente Carratala</h3>
    <div class="calendar-container">
        <?php
        for ($month = 9; $month <= 12; $month++) {
            renderCalendar(2024, $month, $data);
        }
        ?>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span id="close-modal" class="close">&times;</span>
            <img id="modal-img" src="" alt="Event Thumbnail">
            <p id="modal-txt"></p>
            <a id="modal-url" href="#" target="_blank">Ver el video en Youtube</a>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>

