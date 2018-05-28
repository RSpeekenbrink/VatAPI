<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes\StatusParser;

class APIController extends Controller
{
    public function getDataURLs() {
        $statusparser = new StatusParser();
        return json_encode($statusparser->getStatusURLs());
    }
}
