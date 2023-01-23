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
            echo '<li>' . $mainItem . '<ul style="margin-left: -200px">';
//          TODO: Render no child-ul when no subItems exist
            foreach ($subItems as $subItem) {
                echo '<li>' . $subItem . '</li>';
            }

            echo '</ul>' . '</li>';
        }
        echo '</ul>';
    }
}