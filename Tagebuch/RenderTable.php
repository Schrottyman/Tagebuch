<?php

class RenderTable
{
    public static function header(string $name): void
    {
        echo '<h2>' . 'Tag ' . $name . '</h2>';
    }

    public static function content(string $day, array $content): void
    {
        $t = "\t";
        echo PHP_EOL;
        echo '<table>' . PHP_EOL;

        /*  Header  */
        self::renderTableHead();

        /*  Body    */
        echo $t . '<tbody>' . PHP_EOL;
        $count = self::countSubItems($content);
        foreach ($content as $key => $line) {
            self::renderTableRow($line, $key, $count, $day);
        }

        echo $t . '</tbody>' . PHP_EOL;
        echo '</table>' . PHP_EOL;
    }
    private static function countSubItems(array $content): int
    {
        $count = 0;
        foreach ($content as $line) {
            $subCount = substr_count($line, '#');

            if ($subCount === 0) {
                $subCount = 1;
            }

            $count += $subCount;
        }
        return $count;
    }

    private static function renderTableHead(): void
    {
        $t = "\t";

        echo $t . '<thead>' . PHP_EOL;
        echo $t . $t . '<tr>' . PHP_EOL;

        echo $t . $t . $t . '<th>' . 'Tage' . '</th>' . PHP_EOL;
        echo $t . $t . $t . '<th>' . 'Stichpunkte' . '</th>' . PHP_EOL;
        echo $t . $t . $t . '<th>' . 'Unterpunkte' . '</th>' . PHP_EOL;

        echo $t . $t . '</tr>' . PHP_EOL;
        echo $t . '</thead>' . PHP_EOL;
    }

    private static function renderTableRow($line, $key, $count, $day): void
    {
        $t = "\t";
        $rowspanDay = $count;

        echo $t . $t . '<tr>' . PHP_EOL;
        $subItems = explode('#', $line);
        $mainItem = array_shift($subItems);

        if ($key === 0) {
            echo $t . $t . $t . '<td class="Tag" rowspan="' . $rowspanDay . '">' . $day . '</td>' . PHP_EOL;
        }

        $count = count($subItems);
        $rowspanMain = $count;


        $rowspanAttribute = '';
        if($rowspanMain !== 0){
            $rowspanAttribute = ' rowspan="' . $rowspanMain . '"';
        }

        echo $t . $t . $t . '<td class="Hauptpunkt"' . $rowspanAttribute . '>' . $mainItem . '</td>' . PHP_EOL;

        foreach ($subItems as $subKey => $subItem){
            if ($subKey !== 0){
                echo $t . $t . '</tr>' . PHP_EOL;
                echo $t . $t . '<tr>' . PHP_EOL;
            }

            echo $t . $t . $t . '<td class="Unterpunkt">' . str_replace(PHP_EOL, '', $subItem) . '</td>' . PHP_EOL;

        }

        echo $t . $t . '</tr>' . PHP_EOL;
    }
}