<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes\StatusParser;
use App\Classes\DataParser;

class APIController extends Controller
{
    public function getDataURLs() {
        $statusparser = new StatusParser();
        return json_encode($statusparser->getStatusURLs());
    }

    public function getData() {
      $statusparser = new StatusParser();
      $dataServers = $statusparser->getDataURLs();
      $dataparser = new DataParser($dataServers[array_rand($dataServers)]);
      return json_encode($dataparser->getData());
    }
}
