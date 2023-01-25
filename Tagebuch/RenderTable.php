<?php

class RenderTable
{
    public static function header(string $name): void
    {
        echo '<h2>' . 'Tag ' . $name . '</h2>';
    }

    public static function content(string $day, array $content): void
    {
        echo PHP_EOL;
        echo '<table>' . PHP_EOL;

        /*  Header  */
        self::renderTableHead();

        /*  Body    */
        echo '<tbody>' . PHP_EOL;
        $count = self::countSubItems($content);
        foreach ($content as $key => $line) {
            self::renderTableRow($line, $key, $count, $day);
        }

        echo '</tbody>' . PHP_EOL;
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
        echo '<thead>' . PHP_EOL;
        echo '<tr>' . PHP_EOL;

        echo '<th>' . 'Tage' . '</th>' . PHP_EOL;
        echo '<th>' . 'Stichpunkte' . '</th>' . PHP_EOL;
        echo '<th>' . 'Unterpunkte' . '</th>' . PHP_EOL;

        echo '</tr>' . PHP_EOL;
        echo '</thead>' . PHP_EOL;
    }

    private static function renderTableRow($line, $key, $count, $day): void
    {
        $rowspanDay = $count;

        echo '<tr>' . PHP_EOL;
        $subItems = explode('#', $line);
        $mainItem = array_shift($subItems);

        if ($key === 0) {
            echo '<td class="Tag" rowspan="' . $rowspanDay . '">' . $day . '</td>' . PHP_EOL;
        }

        $count = count($subItems);
        $rowspanMain = $count;


        $rowspanAttribute = '';
        if($rowspanMain !== 0){
            $rowspanAttribute = ' rowspan="' . $rowspanMain . '"';
        }

        echo '<td class="Hauptpunkt"' . $rowspanAttribute . '>' . $mainItem . '</td>' . PHP_EOL;
        if ($rowspanMain === 0){
            echo '<td class="Unterpunkt"> / </td>' . PHP_EOL;
        } else {
            foreach ($subItems as $subKey => $subItem){
                if ($subKey !== 0){
                    echo '</tr>' . PHP_EOL;
                    echo '<tr>' . PHP_EOL;
                }
                echo '<td class="Unterpunkt">' . str_replace(PHP_EOL, '', $subItem) . '</td>' . PHP_EOL;
            }
        }

        echo '</tr>' . PHP_EOL;
    }
}