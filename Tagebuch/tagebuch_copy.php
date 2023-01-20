<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Stylesheet.css">
    <title>Praktikum Protokoll</title>

    <script>
        let myVar;

        function Laden() {
            myVar = setTimeout(showPage, 3000);
        }

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("Protokoll").style.display = "block";
        }

        function lightMode() {
            var body = document.getElementById("body")
            body.style.backgroundColor = "#FFFFFF";
            body.style.color = "#282828";
        }

        function darkMode() {
            var body = document.getElementById("body")
            body.style.backgroundColor = "#0C0032FF";
            body.style.color = "#FFFFFF";
        }

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
            document.getElementById("heuteIst").innerHTML = day;
        }
    </script>
</head>
<body id="body" onload="Laden(), heuteIstTag()">
<div id="loader"></div>
<div style="display:none;" id="Protokoll" class="animate-bottom">
    <h1>Praktikum SMF</h1>
    <div>
        <button class="button button1" id="lightMode" onclick="lightMode()">Light Mode</button>
        <button class="button button2" id="darkMode" onclick="darkMode()">Dark Mode</button>
    </div>
    <p>
        Heute ist Tag
        <span id="heuteIst"> ??? </span>
        von 10
    </p>
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
            <textarea class="text" id="TextArea" name="stichpunkt" placeholder="Was war heute los?" rows="1" cols="50"
                      required></textarea>
        </div>

        <div>
            <input class="button button3" type="submit" value="Schreiben">
        </div>
    </form>
    <?php
    include 'FileService.php';
    echo file_get_contents('Tage\Tag.txt');

    ?>
    <div>
        <h2>Tag 1</h2>
        <div class="list">
            <ul>
                <li>Arbeiten mit eigenem Laptop am Schreibtisch</li>
                <li>Zugeguckt bei einem Meeting
                    <ul>
                        <li>SMF hat Zugriff auf Daten von Tankstellen</li>
                        <li>Sie entwickeln eine Website, welche den Tankstellenbesitzern hilft</li>
                        <li>Man kann sehen, wie der Preis von anderen Tankstellen in der Nähe ist</li>
                        <li>Sie diskutierten über, Funktion, Fehler und Design</li>
                    </ul>
                </li>
                <li>12 Uhr Mittagessen</li>
                <li>Danach mit HTML rumprobiert
                    <ul>
                        <li>Schneiderei-Meier Seite</li>
                        <li>Protokoll Seite mit Ladeanimation</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div>
        <h2>Tag 2</h2>
        <div class="list">
            <ul>
                <li>Weiterarbeiten an der Protokollseite
                    <ul>
                        <li>Light Mode Button</li>
                        <li>Dark Mode Button</li>
                        <li>Dynamische Tag Zahl</li>
                        <li>Idee von einem Formular
                            <ul>
                                <li>Nix klappt</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>Generalprobe von zwei Mündlichen-Prüfungen angesehen</li>
            </ul>
        </div>
    </div>
    <div>
        <h2>Tag 3</h2>
        <div class="list">
            <ul>
                <li>Teilgenommen an einem Workshop</li>
                <li>Weiter an der Website gearbeitet
                    <ul>
                        <li>Fertig mit Css (erstmal)</li>
                        <li>angefangen mit php</li>
                    </ul>
                </li>
                <li>Php angefangen anzugucken</li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
