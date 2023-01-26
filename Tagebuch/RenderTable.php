<?php

class RenderTable
{
    public static function header(string $name): void
    {
        echo '<h2 class="font-extrabold text-4xl underline my-6">' . 'Tag ' . $name . '</h2>';
    }

    public static function content(string $day, array $content): void
    {
        $count = self::countSubItems($content);

        echo PHP_EOL;
        echo "<div class='inline-grid grid-cols-3 w-full border border-black place-items-center'>" . PHP_EOL;

        /*  Header  */
        self::renderTableHead();

        /*  Body    */
        foreach ($content as $key => $line) {
            self::renderTableRow($line, $key, $count, $day);
        }

        echo '</div>' . PHP_EOL;
    }
    private static function countSubItems(array $content): int
    {
        $count = 1;
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
        echo '<div class="text-center">' . 'Tag' . '</div>' . PHP_EOL;
        echo '<div class=text-center"">' . 'Stichpunkte' . '</div>' . PHP_EOL;
        echo '<div class="text-center">' . 'Unterpunkte' . '</div>' . PHP_EOL;
    }

    private static function renderTableRow($line, $key, $count, $day): void
    {
        $rowspanDay = $count + 1;

        $subItems = explode('#', $line);
        $mainItem = array_shift($subItems);

        if ($key === 0) {
            echo "<div style='grid-row-end: {$rowspanDay}' class='row-start-2 '>" . $day . '</div>' . PHP_EOL;
        }

        $count = count($subItems);
        $rowspanMain = $count;


        $rowspanAttribute = '';
        if($rowspanMain !== 0){
            $rowspanAttribute = ' rowspan="' . $rowspanMain . '"';
        }

        echo '<div style="grid-row: span '.$rowspanMain.'" class=""' . $rowspanAttribute . '>' . $mainItem . '</div>' . PHP_EOL;
        if ($rowspanMain === 0){
            echo '<div class=""> / </div>' . PHP_EOL;
        } else {
            foreach ($subItems as $subKey => $subItem){
                if ($subKey !== 0){
                }
                echo '<div class="">' . str_replace(PHP_EOL, '', $subItem) . '</div>' . PHP_EOL;
            }
        }
    }
}