var kandidatinnen = [];
var kandidatinnen_popup = [];

var kandidatin_zeigen = -1;
var kandidatin_clicked = -1;
var kandidatin_angezeigt = -1;

var angezeigte_wahlkreise = [];
var just_clicked = 0;

var map;

function GetKandidatinnen() {
    $('ul#kandidatinnen > li').each(function(index) {
        var kandidatin_index = index;
        kandidatinnen[index] = [];
        $(this).children('div').each(function() {
            if ($(this).hasClass('name')) {
                kandidatinnen[kandidatin_index]['name'] = $(this).text();
            } else if ($(this).hasClass('geschlecht')) {
                if ($(this).text() === 'w') {
                    kandidatinnen[kandidatin_index]['geschlecht'] = 'w';
                } else if ($(this).text() === 'm') {
                    kandidatinnen[kandidatin_index]['geschlecht'] = 'm';
                } else {
                    kandidatinnen[kandidatin_index]['geschlecht'] = '*';
                }
            } else if ($(this).hasClass('beruf')) {
                kandidatinnen[kandidatin_index]['beruf'] = $(this).text();
            } else if ($(this).hasClass('url')) {
                kandidatinnen[kandidatin_index]['url'] = $(this).text();
            } else if ($(this).hasClass('bild')) {
                kandidatinnen[kandidatin_index]['bild'] = $(this).text();
            } else if ($(this).hasClass('bildlizenz')) {
                kandidatinnen[kandidatin_index]['bildlizenz'] = $(this).text();
                kandidatinnen[kandidatin_index]['bildlizenzhtml'] = $(this).html();
            } else if ($(this).hasClass('wahlkreis')) {
                kandidatinnen[kandidatin_index]['wahlkreis'] = $(this).text();
            } else if ($(this).hasClass('listenplatz')) {
                var listenplatz = parseInt($(this).text());
                kandidatinnen[kandidatin_index]['listenplatz'] = listenplatz;
            } else if ($(this).hasClass('beschreibung')) {
                kandidatinnen[kandidatin_index]['beschreibung'] = $(this).html();
            }
        });
    });
}

jQuery.fn.redraw = function() {
  return this.hide(0, function(){$(this).show()});
};

function KandidatinZeigen() {
    // kandidatin_zeigen anzeigen.
    // Wenn das -1 ist, kandidatin_clicked anzeigen.
    // Wenn das -1 ist, Bereich ausblenden

    var duration = 300;

    if ((kandidatin_clicked !== -1) && (just_clicked)) {
        $('#landesliste_parent').scrollTo($('#kandidatin'+kandidatin_clicked), 700, {offset: -100});
        just_clicked = 0;
    }

    if (kandidatin_clicked === -1 && kandidatin_zeigen === -1) {
        $('#kandidatinneninfo').hide('slide', {'direction':'right'}, duration);
    } else if (kandidatin_clicked === -1 && kandidatin_zeigen !== -1) {
        if ($('#kandidatinneninfo').is(':visible')) {
            $('#kandidatinneninfo').hide('slide', {'direction':'right'}, duration, function() {
                $('#kandidatinneninfo').html(kandidatinnen_popup[kandidatin_zeigen]);
                kandidatin_angezeigt = kandidatin_zeigen;
                $('#kandidatinneninfo').show('slide', {'direction': 'right'}, duration);
            });
        } else {
            $('#kandidatinneninfo').html(kandidatinnen_popup[kandidatin_zeigen]);
            kandidatin_angezeigt = kandidatin_zeigen;
            $('#kandidatinneninfo').show('slide', {'direction': 'right'}, duration);
        }
    } else if (kandidatin_clicked === kandidatin_zeigen) {
        // Nothing
    } else if (kandidatin_zeigen === -1 && kandidatin_clicked === kandidatin_angezeigt) {
        // Nothing
    } else if (kandidatin_zeigen === -1) {
        $('#kandidatinneninfo').hide('slide', {'direction':'right'}, duration, function() {
            $('#kandidatinneninfo').html(kandidatinnen_popup[kandidatin_clicked]);
            kandidatin_angezeigt = kandidatin_clicked;
            $('#kandidatinneninfo').show('slide', {'direction': 'right'}, duration);
        });
    } else {
//        if (kandidatin_clicked !== kandidatin_angezeigt) {
            $('#kandidatinneninfo').hide('slide', {'direction':'right'}, duration, function() {
                $('#kandidatinneninfo').html(kandidatinnen_popup[kandidatin_zeigen]);
                kandidatin_angezeigt = kandidatin_zeigen;
                $('#kandidatinneninfo').show('slide', {'direction': 'right'}, duration);
            });
//        }
    }

    $.each(angezeigte_wahlkreise, function(index, value) {
        if (value) {
            value.setStyle({fillOpacity: 0.2,
                opacity: 0.7,
                color: '#F80'
            });
        }
    });

    $('#landesliste > ol > li > span').each(function() {
        $(this).removeClass('highlight');
        $(this).removeClass('clicked');
    });

    if (kandidatin_zeigen !== -1) {
        if (angezeigte_wahlkreise[kandidatin_zeigen]) {
            angezeigte_wahlkreise[kandidatin_zeigen].setStyle({fillOpacity: 0.8});
        }
        $('#landesliste > ol > li > span#kandidatin' + kandidatin_zeigen).addClass('highlight');
    }
    if (kandidatin_clicked !== -1) {
        if (angezeigte_wahlkreise[kandidatin_clicked]) {
            angezeigte_wahlkreise[kandidatin_clicked].setStyle({opacity: 1,
                color: 'black',
                fillOpacity: 0.8});
            angezeigte_wahlkreise[kandidatin_clicked].bringToFront();
        }
        $('#landesliste > ol > li > span#kandidatin' + kandidatin_clicked).addClass('highlight');
        $('#landesliste > ol > li > span#kandidatin' + kandidatin_clicked).addClass('clicked');
    }

}

function Gender(gender) {
    if (gender === 'w') {
        return 'in';
    } else if (gender === 'm') {
        return '';
    } else {
        return 'eichh&ouml;rnchen';
    }
}

function InitMap() {
    var cloudmadeAttrib, cloudmadeUrl, subDomains;

    var cloudmadeUrl = 'http://{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png';
    var subDomains = ['otile1','otile2','otile3','otile4'];
    var cloudmadeAttrib = 'Data, imagery and map information provided by <a href="http://open.mapquest.co.uk" target="_blank">MapQuest</a>, <a href="http://www.openstreetmap.org/" target="_blank">OpenStreetMap</a> and contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/" target="_blank">CC-BY-SA</a><br />&copy; Bundeswahlleiter, Statistisches Bundesamt, Wiesbaden 2012, Wahlkreiskarte f&uuml;r die Wahl zum 18. Deutschen Bundestag Grundlage der Geoinformationen &copy; Geobasis-DE / BKG (2011)';
    var cloudmade = new L.TileLayer(
        cloudmadeUrl
        ,{
            attribution: cloudmadeAttrib
            ,subdomains: subDomains
        }
    );
    map = new L.Map(
    'map'
    ,{
        maxZoom: 18
        ,minZoom: 6
        ,center: new L.LatLng(
            48.54
            ,9.04
        )
        ,zoom: 8
        ,scrollWheelZoom: false
        ,dragging: true
    });
    L.tileLayer(cloudmadeUrl, {
        attribution: cloudmadeAttrib,
        subdomains: subDomains,
        maxZoom: 18
    }).addTo(map);

    $('#map').after('<div id="kandidatinneninfo"></div>');
    $('#map').before('<div id="landesliste_parent"></div>');
    $('#landesliste_parent').html('<div id="landesliste"></div>');


    ResizeWindows();
    KandidatinZeigen();

    $.each(kandidatinnen, function(index, value) {
        var wahlkreis_nr = value['wahlkreis'];
        var wahlkreis;
        var zindex;
        var info_text = '';

        info_text += '<h3>';
        info_text += value['name'] + '</h3>';

        info_text += '<div class="kandidatinnen_infos">'
        if (value['bild']) {
            info_text += '<img src="' + value['bild'] + '" alt="' + value['name'];
            if (value['bildlizenz']) {
                info_text += ' (Foto: ' + value['bildlizenz'] + ')';
            }
            info_text += '" style="float: right;" />';
            if (value['bildlizenzhtml']) {
                info_text += '<div class="lizenz">Foto: ' + value['bildlizenzhtml'] + '</div>';
            }
        }


        if (wahlkreis_nr > 0) {
            info_text += '<h4>';
            info_text += 'Direktkandidat' + Gender(value['geschlecht']) + " im Wahlkreis " + wahlkreis_infos[wahlkreis_nr]['name'] + ' (' + wahlkreis_nr + ')</h4>';

            wahlkreis = new L.Polygon(
              wahlkreise[wahlkreis_nr] ,{
                    color:'#F80',
                    opacity: 0.7,
                    fillColor:'#F80',
                    smoothFactor:2
                }
            );

            wahlkreis.on({mouseover: function(){ kandidatin_zeigen = index; KandidatinZeigen(); },
                mouseout: function(){ kandidatin_zeigen = -1; KandidatinZeigen(); },
                click: function(){ kandidatin_clicked = index; just_clicked = 1; KandidatinZeigen(); }
            });
            angezeigte_wahlkreise[index] = wahlkreis;
            map.addLayer(wahlkreis);
        }

        if (value['listenplatz'] > 0) {
            info_text += '<h4>Landesliste Platz ' + value['listenplatz'] + '</h4>';
        }

        info_text += '<ul>';
        if (value['beruf']) {
            info_text += '<li><strong>Beruf:</strong> ' + value['beruf'] + '</li>';
        }

        info_text += '</ul>';

        if (value['url']) {
            info_text += '<a href="' + value['url'] + '" target="_blank">Zur Homepage</a>';
        }

        info_text += '</div>';

        info_text += '<div class="clearfix"></div>';

        info_text += '<div class="beschreibung">';
        info_text += value['beschreibung'];
        info_text += '</div>';

        kandidatinnen_popup[index] = info_text;
        
    });

}
var sorted_kandidatinnen;

var l, u, r, o;

function ZoomMap() {
    l = 0.0;
    $.each(kandidatinnen, function(index, value) {
        var wahlkreis = value['wahlkreis'];
        if (wahlkreis > 0) {
            $.each(wahlkreise[wahlkreis], function(index, value) {
                if (l === 0.0) {
                    l = value.lng;
                    r = value.lng;
                    u = value.lat;
                    o = value.lat;
                } else {
                    if (l > value.lng) {
                        l = value.lng;
                    }
                    if (r < value.lng) {
                        r = value.lng;
                    }
                    if (u > value.lat) {
                        u = value.lat;
                    }
                    if (o < value.lat) {
                        o = value.lat;
                    }
                }
            })
        }
    });
    var ul = new L.LatLng(u,l);
    var or = new L.LatLng(o,r);
    var bounds = new L.LatLngBounds(ul,or);
    var mid_lat = (u + o) / 2.0;
    var mid_lon = (l + r) / 2.0;
    var middle = new L.LatLng(mid_lat, mid_lon);
    var zoom = map.getBoundsZoom(bounds) - zoom_offset;
    map.setView(middle, zoom);
   
}

function ZeigeLandesliste() {
    var landesliste = '';

    $.each(kandidatinnen, function(index, value) {
        value['index'] = index;
    });
    sorted_kandidatinnen = kandidatinnen.sort(function(a,b) {
        var valA = a['listenplatz'];
        var valB = b['listenplatz'];
        if (!valA > 0) {
            valA = 0;
        }
        if (!valB > 0) {
            valB = 0;
        }
        return valA-valB;
    });
    var listecnt = 0;
    var nichtlistecnt = 0;
    $.each(sorted_kandidatinnen, function(index, value) {
        if (value['listenplatz']) {
            listecnt++;
        } else if (value['wahlkreis']) {
            nichtlistecnt++;
        }
    });

    if (listecnt > 0) {
        landesliste += '<h3>Unsere Landesliste:</h3>';
        landesliste += '<ol>';
        $.each(sorted_kandidatinnen, function(index, value) {
            if (value['listenplatz']) {
                landesliste += '<li><span id="kandidatin'+value['index']+'" '+
                '><span class="listenummer">'+value['listenplatz'] + '.</span> <span class="name">' + value['name']+'</span></span></li>';
            }
        });
        landesliste += '</ol>';
    }
    if (nichtlistecnt > 0) {
        landesliste += '<h3>Unsere Direktkandidat*Innen:</h3>';
        landesliste += '<ol>';
        $.each(sorted_kandidatinnen, function(index, value) {
            if (!value['listenplatz']) {
                landesliste += '<li><span id="kandidatin'+value['index']+'" '+
                '>'+ value['name']+'</span></li>';
            }
        });
        landesliste += '</ol>';
    }
    $('#landesliste').html(landesliste);
    $('#landesliste > ol > li > span').each(function() {
        var id = parseInt($(this).attr("id").replace('kandidatin',''));
        $(this).on('mouseenter', function() {kandidatin_zeigen = id; KandidatinZeigen();});
        $(this).on('mouseleave', function() {kandidatin_zeigen = -1; KandidatinZeigen();});
        $(this).on('click', function() {kandidatin_clicked = id; KandidatinZeigen();});
    });
}

function ResizeWindows() {
    var mapheight = $('#map').height();
    var mapwidth = $('#map').width();

    $('#kandidatinneninfo').css({'max-height': (mapheight - 60) + 'px' });
    $('#landesliste_parent').css({'max-height': (mapheight - 60) + 'px' });
    $('#landesliste').css({'max-height': (mapheight - 60) + 'px' });

}

/*
$(document).ready(function() {
  // Handler for .ready() called.
  GetKandidatinnen();
  InitMap();
  ZoomMap();
  ResizeWindows();
  KandidatinZeigen();
  ZeigeLandesliste();
});
*/