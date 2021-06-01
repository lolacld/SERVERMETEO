
<?php

// chemin ABSOLU | fichier index = routeur |
// Constante définie permettant de crer le chemin absolu pr l'acces à nos ressources (img, code etc)
// la constante URL sera remplacé par notre index.php avec devant hhtps / http suivi de mon API
define("URL", str_replace("index.php", "", (isset($SERVER['HTTPS']) ?  "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]")); //Modification de mon URL : http://localhost/...


require_once "controllers/front/APIController.php";
$apiController = new APIController(); // nouvelle instance pr utiliser les fonctions de la classe API 

try{
    if(empty($_GET['page'])){
        throw new  Exception("la page n'existe pas");
    } else{
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        if(empty($url[0]) || empty($url[1]) ||empty($url[2])) throw new  Exception("la page n'existe pas");//si le nombre de "dossiers" ne depasse pas 2 alors la page n'existe pas
        switch($url[0]){
            case "front" : 
                switch($url[1]){
                    case "releves": 
                            //print '<td>'.$apiController->getReleves().'';
                                switch($url[2]){
                                case "1" :
                                    print '<tr><h1>STATION METEO</h1>';
                                    print '<td><h2>Présentation des données météo | id_releve(1)</h2></tr>';
                                    print '<td>'.$apiController->getReleves1().'';
                                break;

                                case "2" :
                                    print '<tr><h1>STATION METEO</h1>';
                                    print '<tr><h1>Présentation des données météo | id_releve(2)</h1></tr>';
                                    print '<td>'.$apiController->getReleves2().'';
                                break;

                                case "3" :
                                    print '<tr><h1>STATION METEO</h1>';
                                    print '<tr><h1>Présentation des données météo | id_releve(3)</h1></tr>';
                                    print '<td>'.$apiController->getReleves3();'</td>';
                                    print '</tr>';
                                break;

                    case "sonde": $apiController->getSonde();
                    break;

                    case "station": $apiController->getStation();
                    break;

                    default: throw new Exception("Cette page n'existe pas");
                }
            }
        
            break;
            case "back" : echo "page back end demandée";
            break;
            default: throw new Exception("Cette page n'existe pas");
        }
    }
}

catch(Exception $e){
    $msg = $e->getMessage();
    echo $msg;
}

?>


                    
                    
                   
               
                
                   
    