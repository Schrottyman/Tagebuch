<?php

class RenderList
{
    public static function header(string $name): void
    {
        echo '<h2>' . 'Tag ' . $name . '</h2>';
    }

    public static function content(array $content): void
    {
        echo '<ul>';
        foreach ($content as $line) {
            $subItems = explode('#', $line);
            $mainItem = array_shift($subItems);
            echo '<li>' . $mainItem;
            if (str_contains($line, '#')) {
                echo '<ul style="margin-left: -200px">';

                foreach ($subItems as $subItem) {
                    echo '<li>' . $subItem . '</li>';
                }
                echo '</ul>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }
}