$(document).ready(function(){
    //laadscherm weergeven
    /*het laadscherm voorkomt dat een gebruiker iets kan doen voordat
    alles goed geladen is door een div over alles heen te zetten*/
    $('#loader').css('z-index', '20');
    
//Begin Map-functies  
    var startX = 260;
    var startY = 660;
    //de kaart en scrollbars rond nederland centreren
    $("div.container_Map").scrollTop(startY).scrollLeft(startX);
    $('div.mapUI_ScrollHorz').scrollLeft(380 - (startX / (1300/380)));
    $('div.mapUI_ScrollVert').scrollTop(160 - (startY / (1150/160)));
    
    //scrollwheel uitzetten voor de kaart
    $("div.container_Map").bind("mousewheel DOMMouseScroll", function() {
        return false;
    });
    
    //de kaart draggable maken met behulp van de dragscrollable jQuery plugin
    $("div.container_Map, img.map_Image").dragscrollable({
        dragSelector: 'img', 
        acceptPropagatedEvent: false
    });
        
    //cursor aanpassen bij het slepen van de kaart
    $("img.map_Image")
        .on('mousedown', function(){
            $("div.map_Bounds").css("cursor", "all-scroll");
        })
        .on('mouseup mouseout', function(){
            $("div.map_Bounds").css("cursor", "auto");
        });
    
    //markers ophalen
    $('#map_Markers').load('lib/mapApp_Core.php', {'action':'loadMarkers'});
//Eind Map-functies  
     
//Begin MapUI-functies
    //scrollbars draggable maken met dragscrollable jQuery plugin
    $("div.mapUI_ScrollHorz, div.scroll_HorzDragger").dragscrollable({
        dragSelector: 'div', 
        acceptPropagatedEvent: false
    });  
    $("div.mapUI_ScrollVert, div.scroll_VertDragger").dragscrollable({
        dragSelector: 'div', 
        acceptPropagatedEvent: false
    });
    
    //kaart aan scrollbars koppelen en andersom
    $('img.map_Image')
        .on('mousedown', function(){
            $('div.container_Map').on('scroll', function () {
                $('div.mapUI_ScrollHorz').unbind('scroll');
                $('div.mapUI_ScrollVert').unbind('scroll');
                $('div.mapUI_ScrollHorz').scrollLeft(380 - ($('div.container_Map').scrollLeft() / (1300/380)));
                $('div.mapUI_ScrollVert').scrollTop(160 - ($('div.container_Map').scrollTop() / (1150/160)));
            });
        });
    $('div.scroll_VertDragger')
        .on('mousedown', function(){
            $('div.mapUI_ScrollVert').on('scroll', function(){
                $('div.container_Map').unbind('scroll');
                $('div.container_Map').scrollTop(1150 - ($('div.mapUI_ScrollVert').scrollTop() / (160/1150)));
            });
        })
    $('div.scroll_HorzDragger')
        .on('mousedown', function(){
            $('div.mapUI_ScrollHorz').on('scroll', function(){
                $('div.container_Map').unbind('scroll');
                $('div.container_Map').scrollLeft(1300 - ($('div.mapUI_ScrollHorz').scrollLeft() / (380/1300)));
            });
        })
   
    //coördinaten weergeven van de muis
    //gebruikt voor ontwikkel-doeleinden
/*    $('div.map_Bounds').on('mousemove', function(e){
        var pos = getMousePos(e);
        $("div.mapUI_MouseXY").html('x: ' + pos[0] + ' | y: ' + pos[1]);
    });
    $('img.map_Image').on('mousedown', function(e){
        var pos = getMousePos(e);
        $("div.mapUI_LastClickedXY").html('x: ' + pos[0] + ' | y: ' + pos[1]);
    });*/
    
    //addMarker functies
    $('div.mapUI_AddMarkerButton').on('mouseover', function(){
        $('div.mapUI_AddMarker').css('background-color', '#FEFEFE');
    });
    $('div.mapUI_AddMarkerButton').on('mouseout', function(){
        $('div.mapUI_AddMarker').css('background-color', '#F6F6F6');
    });
    $('div.mapUI_AddMarkerButton').on('click', function(){
        $('#loader').css('z-index', '20');
        var posX = $('div.container_Map').scrollLeft() + 460;
        var posY = $('div.container_Map').scrollTop() + 20;
        $('#map_Markers').load('lib/mapApp_Core.php', {'action':'new', 'posX':posX, 'posY':posY}, function(){
            $('#loader').css('z-index', '-1');
        });
    });
    
    //verberg de verwijder-check bij annuleren
    $('div.check_ActionCancel').on('click', function(){
        $('#delete_MarkerCheck').css('display', 'none');
    });
    
    //bij bevestiging van verwijdering, verwijder de marker en laad de markers opnieuw
    $('div.check_ActionDelete').on('click', function(){
        var marker_id = $('div.check_ActionDelete').attr('id');
        $('div.check_ActionDelete').attr('id', '');
        $('#loader').css('z-index', '20');
        $('#delete_MarkerCheck').css('display', 'none');
        $('#map_Markers').load('lib/mapApp_Core.php', {'action':'deleteMarker', 'id':marker_id}, function(){
            $('#loader').css('z-index', '-1');
        });
    });
//Eind MapUI-functies
    
    //infopanel verbergen bij click op het kruis
    $('img.info_ExitCross').on('click', function(){
        $('#loader').css('z-index', '20');
        $('div.info_CollapsableContainer').slideUp(function(){
            $('div.container_Info').hide(0,function(){$('#loader').css('z-index', '-1');});
        });
    });
    
    //laadscherm verbergen zodra alle functies geladen zijn
    $('#loader').css('z-index', '-1');
});

//gebruikt voor ontwikkel-doeleinden
/*function getMousePos(e){
    var posX = (e.pageX - $('div.map_Bounds').offset().left);
    var posY = (e.pageY - $('div.map_Bounds').offset().top);
    var pos = [posX, posY];
        
    return pos;
}*/