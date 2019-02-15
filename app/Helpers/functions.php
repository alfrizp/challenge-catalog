<?php

function get_year_range($min = 1900, $max = 2000) {
    $years = [];

    for ($i=$max; $i > $min ; $i--) {
        $years[$i] = $i;
    }

    return $years;
}

function flash($message = null, $level = 'info')
{
    $session = app('session');
    if (!is_null($message)) {
        $session->flash('flash_notification.message', $message);
        $session->flash('flash_notification.level', $level);
    }
}
