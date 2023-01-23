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

        $count = count($content);
        foreach ($content as $key => $line) {
            self::renderTableRow($line, $key, $count, $day);
        }

        echo $t . '</tbody>' . PHP_EOL;
        echo '</table>' . PHP_EOL;
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

        echo $t . $t . '<tr>' . PHP_EOL;
        $subItems = explode('#', $line);
        $mainItem = array_shift($subItems);

        if ($key === 0){
            echo $t . $t . $t . '<td rowspan="' . $count . '">' . $day . '</td>' . PHP_EOL;
        }

        echo $t . $t . $t . '<td>' . $mainItem . '</td>' . PHP_EOL;
        echo $t . $t . '</tr>' . PHP_EOL;
    }
}