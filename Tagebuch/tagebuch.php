<!DOCTYPE html>
<html lang="de">
<head>
    <?php
    //  TODO: Textfeld ist doof
    //  TODO: Unterpunkt
    ?>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Stylesheet.css">
    <link rel="icon" href="favicon.png">
    <title>Praktikum Protokoll</title>

    <script>
        //  Für den Ladekreis
        let myVar;

        function Laden() {
            myVar = setTimeout(showPage, 3000);
        }

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("Protokoll").style.display = "block";
        }

        //  Ändert die Farben zum "Light Mode"
        function lightMode() {
            var body = document.getElementById("body")
            body.style.backgroundColor = "#FFFFFF";
            body.style.color = "#282828";
        }

        //  Ändert die Farben zum "Dark Mode"
        function darkMode() {
            var body = document.getElementById("body")
            body.style.backgroundColor = "#0C0032FF";
            body.style.color = "#FFFFFF";
        }

        //  Guckt welcher Tag es ist, um auf der Website den Stand des Praktikum anzuzeigen
        function heuteIstTag() {
            console.log(day);
            const date = new Date();
            switch (date.getDate()) {
                case 16:
                    day = "1";
                    break;
                case 17:
                    day = "2";
                    break
                case 18:
                    day = "3";
                    break;
                case 19:
                    day = "4";
                    break;
                case 20:
                    day = "5";
                    break;
                case 23:
                    day = "6";
                    break;
                case 24:
                    day = "7";
                    break;
                case 25:
                    day = "8";
                    break;
                case 26:
                    day = "9";
                    break;
                case 27:
                    day = "10";
                    break;
                default:
                    day = "?";
                    break;
            }
            //  Ersetzt auf der Website die Zahl mit dem heutigen Tag
            document.getElementById("heuteIst").innerHTML = day;

            //  Das Dropdown-Menü kriegt als Standardwert den des heutigen Tages
            if (day <= 10) {
                document.getElementById('day').value = day;
            } else {
                document.getElementById('day').value = 1;
            }

        }
    </script>
</head>
<body id="body" onload="Laden(), heuteIstTag()">

<!--    Der Ladekreis    -->
<div id="loader"></div>

<!--    Die Seite erscheint nach dem Ladekreis    -->
<div style="display:none;" id="Protokoll" class="animate-bottom">

    <h1>Praktikum SMF</h1>

    <!--    Light Mode und Dark Mode Knöpfe  -->
    <div>
        <button class="button button1" id="lightMode" onclick="lightMode()">Light Mode</button>
        <button class="button button2" id="darkMode" onclick="darkMode()">Dark Mode</button>
    </div>

    <!--    Anzeige, welche zeigt, welcher Tag heute ist    -->
    <p>
        Heute ist Tag
        <span id="heuteIst"> ??? </span>
        von 10
    </p>

    <?php
    include 'loadClasses.php';

    $fileService = new FileService('./Tage');

    //      Es wird der Ordner "Tage" überprüft
    $fileService->checkDir();

    //      Wenn der Tag ausgewählt und das Textfeld beschrieben wurde, dann wird in die jeweilige Textdatei geschrieben
    if (array_key_exists("day", $_POST) && array_key_exists("stichpunkt", $_POST)) {
        $fileService->write($_POST["day"], $_POST["stichpunkt"]);
    }
    ?>

    <!--   Das Formular     -->
    <form action="/tagebuch.php" method="post">
        <div class="dropdown">
            <select class="select" name="day" id="day" required>
                <optgroup class="optgrp" label="Woche 1">
                    <option class="option" value="1">Tag 1</option>
                    <option class="option" value="2">Tag 2</option>
                    <option class="option" value="3">Tag 3</option>
                    <option class="option" value="4">Tag 4</option>
                    <option class="option" value="5">Tag 5</option>
                </optgroup>
                <optgroup class="optgrp" label="Woche 2">
                    <option class="option" value="6">Tag 6</option>
                    <option class="option" value="7">Tag 7</option>
                    <option class="option" value="8">Tag 8</option>
                    <option class="option" value="9">Tag 9</option>
                    <option class="option" value="10">Tag 10</option>
                </optgroup>
            </select>
        </div>
        <div class="textarea">
            <textarea class="text" id="TextArea" name="stichpunkt" placeholder="Überpunkt&#10Unterpunkt&#10Unterpunkt" rows="3" cols="50"
                      required></textarea>
        </div>

        <div>
            <input class="button button3" type="submit" value="Schreiben">
        </div>
    </form>

    <div>
        <?php
        $files = $fileService->readFolder();
        foreach ($files as $filename => $fileContent) {
            $header = $fileService->cleanUpFileName($filename);
            Render::header($header);
            Render::content($fileContent);
        }
        ?>
    </div>
</div>
</body>
</html>
