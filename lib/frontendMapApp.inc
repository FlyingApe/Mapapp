{->container_main}
<div class="container_MapApp">
    <div class="container_Map">
        <div class="map_Bounds">
            <img src="lib/img/europ_map.jpg" class="map_Image" />
            <div id="map_Markers"></div>
        </div>
    </div>
    <div class="container_MapUI">
<!--        <div class="mapUI_MouseXY">X: 000 | y: 000</div>        Te gebruiken voor development doeleinden
        <div class="mapUI_LastClickedXY">x: 000 | y: 000</div>-->
        <div class="mapUI_AddMarker">
            <div class="mapUI_AddMarkerImg"></div>
            <span class="mapUI_AddMarkerText">een marker toevoegen</span>
        </div>
        <div class="mapUI_AddMarkerButton"></div>
        <div class="mapUI_ScrollHorz">
            <div class="scroll_HorzHolder">
                <div class="scroll_HorzDragger"></div>
            </div>
        </div>
        <div class="mapUI_ScrollVert">
            <div class="scroll_VertHolder">
                <div class="scroll_VertDragger"></div>
            </div>
        </div>
    </div>
    <div class="container_Info">
        <div class="info_Exit"><img src="lib/img/cross_16x16.png" class="info_ExitCross" /></div>
        <div class="info_CollapsableContainer">
            <div id="info_Content"></div>
            <div class="info_Bar"></div>
        </div>
    </div>
    <div id="delete_MarkerCheck">
        <div class="delete_CheckCenter">
            <span class="check_Text">hiermee verwijdert u deze marker en alle bijhorende gegevens.</span>
            <div class="check_ActionDelete">verwijderen</div>
            <div class="check_ActionCancel">annuleren</div>
        </div>
    </div>
    <div id="loader">
        <div class="loader_Center">
            <img src="lib/img/loader_balk.png" class="loader" />
        </div>
    </div>
</div>
{<-container_main}

{->container_Marker}
                <div id="marker{markerID}" class="container_Marker" style="{markerStyle}">
                    <div id="markerInfo{markerID}" class="marker_Info">
                        {markerTitle}
                        <div class="marker_ActionDel" id="markerDel{markerID}"></div>
                    </div>
                    <img src="lib/img/marker.png" id="markerImg{markerID}" class="marker_Marker" />
                </div>
<!--dit is lelijk maar zorgt ervoor dat alle functies voor elke individueele
marker geladen worden als de markers door AJAX opgehaald worden-->
<script type="text/javascript">
    //markers draggable maken
    $('#marker{markerID}').draggable({
        handle: '#markerImg{markerID}',
        containment: 'div.container_Map'
    });
    
    //laat de textbuble van de marker zien zodra de muis over de marker beweegt
    $('#markerImg{markerID}').on('mouseover', function(){
        $('#markerInfo{markerID}').fadeIn();
    });
    
    //verberg alle marker textbubles als de muis weer over de kaart gaat
    $('img.map_Image').on('mouseover', function(){
        $('#markerInfo{markerID}').fadeOut();
    });
    
    //fade functies uitschakelen als de marker versleept wordt en weer inschakelen bij een mouseup event
    $('#markerImg{markerID}')
        .on('mousedown', function(){
            $('#markerImg{markerID}').unbind('mouseover');
            $('img.map_Image').unbind('mouseover');
            $('#markerInfo{markerID}').fadeOut();
        });
    $(document).on('mouseup', function(){
        $('#markerImg{markerID}').on('mouseover', function(){
            $('#markerInfo{markerID}').fadeIn();
        });
        $('img.map_Image').on('mouseover', function(){
            $('#markerInfo{markerID}').fadeOut();
        });
    });
    
    //bij een mouseup de nieuwe positie van de marker opslaan
    $('#markerImg{markerID}').on('mouseup', function(){
        $('#loader').css('z-index', '20');
        var posX = $('#marker{markerID}').position().left + $('img.map_Image').scrollLeft();
        var posY = $('#marker{markerID}').position().top + $('img.map_Image').scrollTop();
        $('#map_Markers').load('lib/mapApp_Core.php', {'action':'savePos', 'posX':posX, 'posY':posY, 'id':'{markerID}'}, function(){
            setTimeout(function(){$('#loader').css('z-index', '-1');});
        });
    });

    //bij een click op span.marker_Text het infopaneel weergeven
    $('#markerButton{markerID}').on('click', function(){
        $('div.container_Info').show(0, function(){
            $('#loader').css('z-index', '20');
            $('#info_Content').load('lib/mapApp_Core.php', {'action':'loadInfo', 'id':'{markerID}'}, function(){
                $('div.info_CollapsableContainer').slideDown(function(){$('#loader').css('z-index', '-1');});
            }); 
        });  
    });
    
    //de verwijder-check laten zijn bij een click op het kruis en
    //de juiste marker-id laden in de verwijder functie
    $('#markerDel{markerID}').on('click', function(){
        $('#delete_MarkerCheck').css('display', 'block');
        $('div.check_ActionDelete').attr('id', '{markerID}');
    });
</script>                
{<-container_Marker}

{->container_InfoPanel}
            <div class="info_Title">
                <span class="title_Text">{title}</span>
                <div class="info_ActionEdit"></div>
            </div>
            <div class="info_TextField">
                <div class="info_Content">
                    {content}
                </div>
            </div>                
<script type="text/javascript">
    //bij een click op div.info_ActionEdit de editor weergeven
    $('div.info_ActionEdit').on('click', function(){
        $('#loader').css('z-index', '20');
        $('div.info_CollapsableContainer').slideUp(function(){
            $('#info_Content').load('lib/mapApp_Core.php', {'action':'loadInfoEditor', 'id':'{markerID}'}, function(){
                $('div.info_CollapsableContainer').slideDown(function(){$('#loader').css('z-index', '-1');});
            }); 
        });
    }); 
</script> 
{<-container_InfoPanel}

{->container_InfoPanelEdit}
            <form><input type="hidden" name="id" value="{markerID}" />
                <div class="info_Title">
                    <input type="text" name="marker_Title" class="title" value="{title}" autofocus />
                    <div class="info_Save">Opslaan</div>
                    <div class="info_Cancel">Annuleren</div>
                </div>
                <div class="info_TextField">
                    <textarea name="marker_Content" class="content" >{content}</textarea>
                </div>
            </form>  
<script type="text/javascript">
    //bij een click op div.info_Save alles opslaan en weer terug gaan naar het Infopaneel
    $('div.info_Save').on('click', function(){
        $('#loader').css('z-index', '20');
        $('div.info_CollapsableContainer').slideUp(function(){
            $('#info_Content').load('lib/mapApp_Core.php',
                                    {'action':'saveInfo',
                                     'id':'{markerID}',
                                     'title': $('input.title').val(),
                                     'content': $('textarea.content').val()},
                                     function(){
                $('#map_Markers').load('lib/mapApp_Core.php', {'action':'loadMarkers'});   
                $('div.info_CollapsableContainer').slideDown(function(){$('#loader').css('z-index', '-1');});
            }); 
        });
    });
    
    //bij een click op div.info_Cancel weer terug gaan naar het Infopaneel
    $('div.info_Cancel').on('click', function(){
        $('#loader').css('z-index', '20');
        $('div.info_CollapsableContainer').slideUp(function(){
            $('#info_Content').load('lib/mapApp_Core.php', {'action':'loadInfo', 'id':'{markerID}'}, function(){
                $('div.info_CollapsableContainer').slideDown(function(){$('#loader').css('z-index', '-1');});
            }); 
        });
    }); 
</script> 
{<-container_InfoPanelEdit}