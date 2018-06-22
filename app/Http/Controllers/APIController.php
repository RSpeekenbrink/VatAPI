<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes\StatusParser;
use App\Classes\DataParser;

class APIController extends Controller
{
    /**
     * Get data URLs
     * 
     * @return string data urls array as json
     */
    public function getDataURLs()
    {
        $statusparser = new StatusParser();
        return json_encode($statusparser->getStatusURLs());
    }

    /**
     * Get all data
     * 
     * @return string data array as json
     */
    public function getData()
    {
        $statusparser = new StatusParser();
        $dataServers = $statusparser->getDataURLs();
        $dataparser = new DataParser($dataServers[array_rand($dataServers)]);
        return json_encode($dataparser->getData());
    }

    /**
     * Get only client data
     * 
     * @return string client data array as json
     */
    public function getClientData()
    {
        $statusparser = new StatusParser();
        $dataServers = $statusparser->getDataURLs();
        $dataparser = new DataParser($dataServers[array_rand($dataServers)]);
        return json_encode($dataparser->getClientData());
    }
}
