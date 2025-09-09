<?php

use App\Models\FAQ;

if (!function_exists('getFaqs')) {
    function getFaqs()
    {
        return FAQ::all();
    }
}
