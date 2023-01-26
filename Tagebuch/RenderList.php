<?php

class RenderList
{
    public static function header(string $name): void
    {
        echo '<h2 class="font-extrabold text-4xl underline my-6">' . 'Tag ' . $name . '</h2>';
    }

    public static function content(array $content): void
    {
        echo '<ul class="space-y-2 list-disc list-inside">';
        foreach ($content as $line) {
            $subItems = explode('#', $line);
            $mainItem = array_shift($subItems);
            echo '<li>' . $mainItem;
            if (str_contains($line, '#')) {
                echo '<ul class="pl-7 mt-2 space-y-1 list-disc list-inside">';

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