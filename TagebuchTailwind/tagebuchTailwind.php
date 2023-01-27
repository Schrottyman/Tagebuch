<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="favicon.png">
        <link href="/dist/output.css" rel="stylesheet">
        <title>Praktikum Protokoll</title>
        <script>
            //  Guckt welcher Tag es ist, um auf der Website den Stand des Praktikum anzuzeigen
            function heuteIstTag() {
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
    <body id="body" onload="heuteIstTag()" class="bg-gradient-to-r from-orange-300 to-red-500 text-gray-800 text-lg font-mono overflow-x-hidden">

        <header class="bg-gray-800 w-auto py-5 rounded-b-full text-center text-orange-300">
            <h1 class="bg-gradient-to-r w-screen from-orange-300 to-red-500 bg-clip-text text-transparent font-extrabold leading-tight text-8xl mt-0 mb-2 ">Praktikum SMF</h1>
            <p class="bg-gradient-to-r w-screen from-orange-300 to-red-500 bg-clip-text text-transparent font-bold text-lg">von Timo</p>
        </header>

        <main class="m-auto w-4/5">
            <!--    Anzeige, welche zeigt, welcher Tag heute ist    -->
            <div class="mt-3 flex bg-orange-100 rounded-lg p-4 mb-4 text-sm text-orange-700" role="alert">
                <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                          clip-rule="evenodd"></path>
                </svg>
                <div>
                    <span class="font-bold">Heute</span> ist Tag <span id="heuteIst" class="font-bold"> ??? </span> von
                    10
                </div>
            </div>
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
            <form action="tagebuchTailwind.php" method="post">
                <select class="block bg-white text-center text-gray-900 font-bold text-m p-4 rounded-t-xl focus:ring-blue-500 focus:border-blue-500"
                        name="day" id="day" required>
                    <optgroup class=" text-center" label="Woche 1">
                        <option class="" value="1">Tag 1</option>
                        <option class="text" value="2">Tag 2</option>
                        <option class="" value="3">Tag 3</option>
                        <option class="" value="4">Tag 4</option>
                        <option class="" value="5">Tag 5</option>
                    </optgroup>
                    <optgroup class="" label="Woche 2">
                        <option class="" value="6">Tag 6</option>
                        <option class="" value="7">Tag 7</option>
                        <option class="" value="8">Tag 8</option>
                        <option class="" value="9">Tag 9</option>
                        <option class="" value="10">Tag 10</option>
                    </optgroup>
                </select>

                <textarea
                        class="rounded-tr-xl rounded-bl-xl block p-2.5 text-gray-900 bg-white w-full font-bold text-xl caret-pink-500"
                        id="TextArea" name="stichpunkt" placeholder="Überpunkt&#10Unterpunkt&#10Unterpunkt" rows="5"
                        cols="50" required></textarea>

                <input class="bg-white hover:bg-gray-100 text-gray-800 font-semibold rounded-b-xl shadow text-center text-m p-4 float-right"
                       type="submit" value="Schreiben">

            </form>

            <script>
                function toggleView() {
                    const table = document.getElementById("tableView");
                    const list = document.getElementById("listView");

                    if (table.style.display === 'none' && list.style.display === 'block') {
                        table.style.display = 'block';
                        list.style.display = 'none';
                    } else {
                        table.style.display = 'none';
                        list.style.display = 'block';
                    }
                }

            </script>
            <button class="fixed bottom-10 right-10 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow
                            transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:bg-sky-500 duration-200"
                    onclick="toggleView()">Toggle View
            </button>


            <div>
                <?php
                $files = $fileService->readFolder();
                ?>
                <div id="listView" class="" style="display: block;">
                    <?php
                    foreach ($files as $filename => $fileContent) {
                        $header = $fileService->cleanUpFileName($filename);
                        RenderList::header($header);
                        RenderList::content($fileContent);
                    }
                    ?>
                </div>
                <div id="tableView" class="" style="display: none;">
                    <?php
                    foreach ($files as $filename => $fileContent) {
                        $header = $fileService->cleanUpFileName($filename);
                        RenderTable::header($header);
                        RenderTable::content($header, $fileContent);
                    }
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>
