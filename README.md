![alt Vatsim][logo]

# VatAPI - Vatsim's data API to JSON
This application allows you to use Vatsim's data api in json format. It uses the laravel php framework to set up the API's environment.

## How to use
When you have the application running and the databases migrated you can use the api by doing a request to one of the links underneath. You will need to pass your API key as `api_key` variable or use basic auth with your API key and username. Default API key and user account can be found in the UsersTableSeeder class.

URL's:

|            URL           |             Description             |
|:------------------------:|:-----------------------------------:|
| /api/vatapi/status       | Return all vatapi data server url's |
| /api/vatapi/data         | Return all current vatsim data      |
| /api/vatapi/data/clients | Return current client data only     |

### Response data - Status
|  Name  |  Type |                      Description                     |
|:------:|:-----:|:----------------------------------------------------:|
| data   | Array | Contains an array of vatsim-data server urls         |
| server | Array | Contains an array of vatsim-servers data server urls |

### Response data - Data
The data responds contains out of multiple sections:

|     Name     |  Type |                         Description                        |
|:------------:|:-----:|:----------------------------------------------------------:|
| general      | Array | Contains all general data (See underneath)                 |
| pilots       | Array | Contains all current pilots flying (See underneath)        |
| atc          | Array | Contains all current ATC positions online (See underneath) |
| prefile      | Array | Contains all current prefiled flightplans (See underneath) |
| voiceservers | Array | Contains all voice servers available (See underneath)      |
| servers      | Array | Contains all vatsim servers available (See underneath)     |

#### general
|        Name       |            Type            |                                        Description                                       |
|:-----------------:|:--------------------------:|:----------------------------------------------------------------------------------------:|
| VERSION           | Int                        | Current Vatsim API version                                                               |
| RELOAD            | Int                        | Time in minutes the data file will be reloaded                                           |
| UPDATE            | Timestamp (yyyymmddhhnnss) | Timestamp of when the data file got updated last                                         |
| ATIS ALLOW MIN    | Int                        | Time in minutes to wait before allowing manual Atis refresh by way of web page interface |
| CONNECTED CLIENTS | Int                        | The number of clients currently connected                                                |

#### pilots
An array for each client online which contains:

callsign:cid:realname:clienttype:frequency:latitude:longitude:altitude:groundspeed:planned_aircraft:planned_tascruise:planned_depairport:planned_altitude:planned_destairport:server:protrevision:rating:transponder:facilitytype:visualrange:planned_revision:planned_flighttype:planned_deptime:planned_actdeptime:planned_hrsenroute:planned_minenroute:planned_hrsfuel:planned_minfuel:planned_altairport:planned_remarks:planned_route:planned_depairport_lat:planned_depairport_lon:planned_destairport_lat:planned_destairport_lon:atis_message:time_last_atis_received:time_logon:heading:QNH_iHg:QNH_Mb:

|           Name          |  Type  |                   Description                   |
|:-----------------------:|:------:|:-----------------------------------------------:|
| callsign                | String | Client's callsign                               |
| cid                     | String | Client's vatsim id                              |
| realname                | String | Client's real name                              |
| clienttype              | String | Client's type (PILOT or ATC)                    |
| frequency               | String | Client's current frequency                      |
| latitude                | Double | Client's current latitude                       |
| longitude               | Double | Client's current longitude                      |
| altitude                | Int    | Client's current altitude                       |
| groundspeed             | Int    | Client's current groundspeed                    |
| planned_aircraft        | String | Client's planned aircraft                       |
| planned_tascruise       | Int    | Client's planned TAS in Cruise                  |
| planned_depairport      | String | ICAO of the planned depairport                  |
| planned_altitude        | Int    | Client's planned altitude                       |
| planned_destairport     | String | ICAO of the planned destination airport         |
| server                  | String | The server the client is currently connected to |
| protrevision            |        |                                                 |
| rating                  | String | Client's Pilot/ATC rating                       |
| transponder             | Int    | Client's current SQUAWK                         |
| facilitytype            |        |                                                 |
| visualrange             |        |                                                 |
| planned_revision        |        |                                                 |
| planned_flighttype      | String | Client's planned flight type (VFR/IFR)          |
| planned_deptime         |        |                                                 |
| planned_actdeptime      |        |                                                 |
| planned_hrsenroute      |        |                                                 |
| planned_minenroute      |        |                                                 |
| planned_hrsfuel         |        |                                                 |
| planned_minfuel         |        |                                                 |
| planned_altairport      |        |                                                 |
| planned_remarks         |        |                                                 |
| planned_route           |        |                                                 |
| planned_depairport_lat  |        |                                                 |
| planned_depairport_lon  |        |                                                 |
| planned_destairport_lat |        |                                                 |
| planned_destairport_lon |        |                                                 |
| atis_message            | String | ATIS message                                    |
| time_last_atis_received |        |                                                 |
| time_logon              |        |                                                 |
| heading                 | Int    | Client's current heading                        |
| QNH_iHg                 | Int    |                                                 |
| QNH_Mb                  | Int    |                                                 |

** Missing descriptions and types will be added when known

#### atc
Same as pilots

#### prefile
Same as pilots

#### voiceservers
hostname_or_IP:location:name:clients_connection_allowed:type_of_voice_server:

#### servers
ident:hostname_or_IP:location:name:clients_connection_allowed:

### Response data - Clients
This only returns the pilots and atc section, which are the same as the Data response data.



[logo]: https://www.vatsim.net/sites/default/files/vatsim_0.png