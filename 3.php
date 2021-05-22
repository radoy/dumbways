<?php

if (!function_exists('drawImage')) {
    function drawImage($pIntLength)
    {
        for ($i = 1; $i <= $pIntLength; $i++) {
            for ($j = 1; $j <= $pIntLength; $j++) {
                if ($i == 1 || $i == $pIntLength || $j == 1 || $j == $pIntLength)
                    echo "*&nbsp;";
                else
                    echo "#&nbsp;";
            }
            echo "<br/>";
        }
    }
}

echo drawImage(7);