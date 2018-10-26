<?php
include ('Template.php');
include ('DbHandler.php');

//de kaart laden   
function mapApp_getMap(){
    $tpl = new Template('lib/frontendMapApp.inc');
    $mapApp = $tpl->getSection('container_main');
    
    return $mapApp;
}

//alle markers laden
function mapApp_getAllMarkers(){
    $tpl = new Template('frontendMapApp.inc');
    $db = new DbHandler();
    $markerArray = $db->select_Markers();
    
    $content = "";
    foreach($markerArray as $key => $value){
        $tpl->setVar('markerID', $key);
        $tpl->setVar('markerStyle', 'left:'.$value['x'].'px; top:'.$value['y'].'px;');
        
        $titleNotset = '<span class="marker_EmptyText">Marker '.$key.'<div class="marker_Button" id="markerButton'.$key.'"></div></span>';
        $titleIsset = '<span class="marker_Text">'.$value['title'].'<div class="marker_Button" id="markerButton'.$key.'"></div></span>';
        $title = (empty($value['title'])) ? $titleNotset : $titleIsset;
        $tpl->setVar('markerTitle', '<span class="marker_Text">'.$title.'</span>');
        
        $content .= $tpl->getSection('container_Marker');
    }
    
    unset($tpl);
    unset($db);
    return $content;
}

//content voor het infoPanel laden
function mapApp_getMarkerContent($id, $type){
    $tpl = new Template('frontendMapApp.inc');
    $db = new DbHandler();
    $markerContentArray = $db->select_MarkerContent($id);
    
    $tpl->setVar('markerID', $id);
    $tpl->setVar('title', $markerContentArray['title']);
    $tpl->setVar('content', $markerContentArray['content']);
    
    $content = $tpl->getSection('container_InfoPanel'.$type);
    
    unset($tpl);
    unset($db);
    return $content;
}

//alle AJAX functies
if(isset($_POST['action'])){
    switch($_POST['action']){
        case 'loadMarkers':
            $content = mapApp_getAllMarkers();
            echo $content;
            
            break;
        case 'new':
            if(isset($_POST['posX']) && isset($_POST['posY'])){
                $db = new DbHandler();
                $db->insert_Marker(NULL, $_POST['posX'], $_POST['posY']);
                unset($db);
                
                $content = mapApp_getAllMarkers();
                echo $content;
            } else {
                echo "probleem, benodigde variabelen niet ontvangen";
            }
            break;
        case 'savePos':
            if(isset($_POST['posX']) && isset($_POST['posY']) && isset($_POST['id'])){
                $db = new DbHandler();
                $db->insert_Marker($_POST['id'], $_POST['posX'], $_POST['posY']);
                unset($db);
                
                $content = mapApp_getAllMarkers();
                echo $content;
            } else {
                echo "probleem, benodigde variabelen niet ontvangen";
            }
            break;
        case 'loadInfo':
            if(isset($_POST['id'])){
                $content = mapApp_getMarkerContent($_POST['id'], '');
                
                echo $content;
            } else {
                echo "probleem, geen id meegegeven";
            }
            break;
        case 'loadInfoEditor':
            if(isset($_POST['id'])){
                $content = mapApp_getMarkerContent($_POST['id'], 'Edit');
                
                echo $content;
            } else {
                echo "probleem, geen id meegegeven";
            }
            break;
        case 'saveInfo':
            if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content'])){
                $db = new DbHandler();
                $db->update_MarkerContent($_POST['id'], $_POST['title'], $_POST['content']);
                unset($db);
                
                $content = mapApp_getMarkerContent($_POST['id'], '');
                echo $content;
            } else {
                echo "probleem, benodigde variabelen niet ontvangen";
            }
            break;
        case 'deleteMarker':
            if(isset($_POST['id'])){
                $db = new DbHandler();
                $db->delete_Marker($_POST['id']);
                unset($db);
                
                $content = mapApp_getAllMarkers();
                echo $content;
            } else {
                echo "probleem, geen id meegegeven";
            }
            break;
        default:
            echo "error: niet gedefinieerde functie";
    }
}
?>