<?php 

namespace App\Classes;

class StatusParser extends VatsimParser {

    private $dataURL = array();
    private $DATA_URL_TOKEN   = "url0";
    private $serverURL = array();
    private $SERVER_URL_TOKEN = "url1";

    public function __construct() {
        $this->setSource('https://status.vatsim.net/');
    }

    protected function processline($string) {
        if($string == $this->ERROR_TOKEN) {
            echo "Error";
            return;
        }

        $line = explode('=',$string);
        if(count($line) == 2) {
            if($line[0] == $this->DATA_URL_TOKEN) {
                array_push($this->dataURL, $line[1]);
            }
            if($line[0] == $this->SERVER_URL_TOKEN) {
                array_push($this->serverURL, $line[1]);
            }
        }
    }

    /**
     * Get data URLS from vatsim status to pick a random from
     * 
     * @return array of urls
     */
    public function getDataURLs() {
        $this->parse();
        return $this->dataURL;
    }

    /**
     * Get Server URLS from vatsim status to pick a random from
     * 
     * @return array of urls
     */
    public function getServerURLs() {
        $this->parse();
        return $this->serverURL;
    }

    /**
     * Get all URLS from vatsim status to pick a random from
     * 
     * @return array of urls
     */
    public function getStatusURLs() {
        $this->parse();
        return array (
            "data" => $this->dataURL,
            "server" => $this->serverURL,
        );
    }
}