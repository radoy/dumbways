<?php

if (!function_exists('urutKata')) {
    function urutKata($pStrInput)
    {
        $dArrString = explode(' ', $pStrInput);

        $dArrResult = [];
        foreach ($dArrString as $dStrItem) {
            $dIntItem = filter_var($dStrItem, FILTER_SANITIZE_NUMBER_INT);

            if ($dIntItem > 0) {
                $dArrResult[$dIntItem] = $dStrItem;
            }
        }

        //Sort Ascending
        ksort($dArrResult);

        return implode(' ', $dArrResult);
    }
}

$dStrInput = 'ta3hun menjela2ng se1lamat b4aru';

echo 'Input string: ' . $dStrInput . '<br />';
echo 'Result string: ' . urutKata($dStrInput);