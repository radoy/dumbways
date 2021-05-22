<?php

function removeQuote($pStrVar)
{
    return str_replace('"', '', str_replace("'", '', $pStrVar));
}