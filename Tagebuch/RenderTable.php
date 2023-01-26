<?php

class RenderTable
{
    public static function header(string $name): void
    {
        echo '<h2 class="font-extrabold text-4xl underline my-6">' . 'Tag ' . $name . '</h2>';
    }

    public static function content(string $day, array $content): void
    {
        echo PHP_EOL;
        echo '<table class="table-auto border-collapse border border-slate-500 w-full text-center m-auto">' . PHP_EOL;

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

        echo '<th class="border border-slate-600 bg-gray-200">' . 'Tag' . '</th>' . PHP_EOL;
        echo '<th class="border border-slate-600 bg-gray-200">' . 'Stichpunkte' . '</th>' . PHP_EOL;
        echo '<th class="border border-slate-600 bg-gray-200">' . 'Unterpunkte' . '</th>' . PHP_EOL;

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
            echo '<td class="border border-slate-600 bg-gray-400" rowspan="' . $rowspanDay . '">' . $day . '</td>' . PHP_EOL;
        }

        $count = count($subItems);
        $rowspanMain = $count;


        $rowspanAttribute = '';
        if($rowspanMain !== 0){
            $rowspanAttribute = ' rowspan="' . $rowspanMain . '"';
        }

        echo '<td class="border border-slate-600 bg-gray-400"' . $rowspanAttribute . '>' . $mainItem . '</td>' . PHP_EOL;
        if ($rowspanMain === 0){
            echo '<td class="border border-slate-600 bg-gray-400"> / </td>' . PHP_EOL;
        } else {
            foreach ($subItems as $subKey => $subItem){
                if ($subKey !== 0){
                    echo '</tr>' . PHP_EOL;
                    echo '<tr>' . PHP_EOL;
                }
                echo '<td class="border border-slate-600 bg-gray-400">' . str_replace(PHP_EOL, '', $subItem) . '</td>' . PHP_EOL;
            }
        }

        echo '</tr>' . PHP_EOL;
    }
}