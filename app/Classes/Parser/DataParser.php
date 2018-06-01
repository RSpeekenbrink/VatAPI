<?php

namespace App\Classes;

class DataParser extends VatsimParser {

  private $controllers = array();
  private $pilots = array();

  private $SECTION_PREFIX = '!';
  private $SECTION_SUFFIX = ':';
  private $CLIENTDATA_SEPERATOR = ':';
  private $CLIENTTYPE_PILOT = 'PILOT';
  private $CLIENTTYPE_CONTROLLER = 'ATC';
  private $GENERALDATA_SEPERATOR = '=';

  private $sections = array(
    'GENERAL' => 'processGeneral',
    'VOICE SERVERS' => 'processVoiceServers',
    'CLIENTS' => 'processClients',
    'PREFILE' => 'processPrefile',
    'SERVERS' => 'processServers',
  );

  private $currentProcessor = '';
  
  /**
   * Constructor
   *
   * @param string $url URL where to get the data from
   */
  public function __construct($url) {
      $this->setSource($url);
  }

  protected function processline($string) {
      if($string == $this->ERROR_TOKEN) {
          echo "Error";
          return;
      }
      if(substr($string, 0, strlen($this->SECTION_PREFIX)) == $this->SECTION_PREFIX) {
        if(array_key_exists($this->getStringBetween($string, $this->SECTION_PREFIX, $this->SECTION_SUFFIX), $this->sections)) {
          $this->currentProcessor = $this->sections[$this->getStringBetween($string, $this->SECTION_PREFIX, $this->SECTION_SUFFIX)];
          return;
        }
        else {
          return;
        }
      }
      else {
        if(isset($this->currentProcessor)) {
          if(method_exists($this, $this->currentProcessor)) {
            $method = $this->currentProcessor;
           $this->$method($string);
          }
        }
      }
  }

  protected function processGeneral($line) {

  }

  protected function processVoiceServers($line) {

  }

  protected function processClients($line) {
    $data = explode($this->CLIENTDATA_SEPERATOR, $line);

    if(count($data) == 42) {
      $newClient = array(
        'callsign' => $data[0],
        'cid' => $data[1],
        'realname' => $data[2],
        'clienttype' => $data[3],
        'frequency' => $data[4],
        'latitude' => $data[5],
        'longitude' => $data[6],
        'altitude' => $data[7],
        'groundspeed' => $data[8],
        'planned_aircraft' => $data[9],
        'planned_tascruise' => $data[10],
        'planned_depairport' => $data[11],
        'planned_altitude' => $data[12],
        'planned_destairport' => $data[13],
        'server' => $data[14],
        'protrevision' => $data[15],
        'rating' => $data[16],
        'transponder' => $data[17],
        'facilitytype' => $data[18],
        'visualrange' => $data[19],
        'planned_revision' => $data[20],
        'planned_flighttype' => $data[21],
        'planned_deptime' => $data[22],
        'planned_actdeptime' => $data[23],
        'planned_hrsenroute' => $data[24],
        'planned_minenroute' => $data[25],
        'planned_hrsfuel' => $data[26],
        'planned_minfuel' => $data[27],
        'planned_altairport' => $data[28],
        'planned_remarks' => $data[29],
        'planned_route' => $data[30],
        'planned_depairport_lat' => $data[31],
        'planned_depairport_lon' => $data[32],
        'planned_destairport_lat' => $data[33],
        'planned_destairport_lon' => $data[34],
        'atis_message' => iconv("UTF-8","UTF-8//IGNORE",$data[35]),
        'time_last_atis_received' => $data[36],
        'time_logon' => $data[37],
        'heading' => $data[38],
        'QNH_iHg' => $data[39],
        'QNH_Mb' => $data[40],
      );
  
      if($data[3] == $this->CLIENTTYPE_PILOT) {
        array_push($this->pilots, $newClient);
      }
      if($data[3] == $this->CLIENTTYPE_CONTROLLER) {
        array_push($this->controllers, $newClient);
      }     
    }

  }

  protected function processPrefile($line) {

  }

  protected function processServers($line) {

  }

  private function getStringBetween($string, $start, $end){
      $string = ' ' . $string;
      $ini = strpos($string, $start);
      if ($ini == 0) return '';
      $ini += strlen($start);
      $len = strpos($string, $end, $ini) - $ini;
      return substr($string, $ini, $len);
  }


  public function getData() {
    $this->parse();
    return array(
      'pilots' => $this->pilots,
      'atc' => $this->controllers
    );
  }

  public function getClientData() {
    $this->parse();
    return array(
      'pilots' => $this->pilots,
      'atc' => $this->controllers
    );
  }

}
