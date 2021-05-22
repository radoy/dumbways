<?php

if (!function_exists('removeDuplicateChar')) {
    function removeDuplicateChar($pStrInput)
    {
        return implode('', array_unique(str_split($pStrInput)));
    }
}

$dStrInput = 'alagcgcdodol';

echo 'Input string: ' . $dStrInput . '<br />';
echo 'Result string: ' . removeDuplicateChar($dStrInput);
