var kandidatinnen = [];
var kandidatinnen_popup = [];

var kandidatin_zeigen = -1;
var kandidatin_clicked = -1;
var kandidatin_angezeigt = -1;

var angezeigte_wahlkreise = [];
var just_clicked = 0;

var mobile_view = false;

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
            } else if ($(this).hasClass('id')) {
                kandidatinnen[kandidatin_index]['id'] = $(this).text();
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
        if (mobile_view === true) {
            $('#kandidatinneninfo_container').hide('slide', {'direction':'up'}, duration, function() {
                $('#map').show('slide', {'direction':'up'}, duration);
            });
        } else {
            $('#kandidatinneninfo_container').hide('slide', {'direction':'right'}, duration, function() {
                $('#map').show('slide', {'direction':'right'}, duration);
            });
        }
        kandidatin_angezeigt = -1;
    } else if (kandidatin_clicked === -1 && kandidatin_zeigen !== -1) {
        if ($('#kandidatinneninfo_container').is(':visible')) {
            $('#kandidatinneninfo_container').hide('slide', {'direction':'right'}, duration, function() {
                $('#kandidatinneninfo_container').html($('#kandidat-' + kandidatin_zeigen).html());
                kandidatin_angezeigt = kandidatin_zeigen;
                $('#kandidatinneninfo_container').show('slide', {'direction': 'right'}, duration);
            });
        } else {
            $('#kandidatinneninfo_container').html($('#kandidat-' + kandidatin_zeigen).html());
            kandidatin_angezeigt = kandidatin_zeigen;
            $('#kandidatinneninfo_container').show('slide', {'direction': 'right'}, duration);
            if (mobile_view === true) {
                $('#map').hide('slide', {'direction':'right'}, duration);
            }
        }
    } else if (kandidatin_clicked === kandidatin_zeigen) {
        // Nothing
    } else if (kandidatin_zeigen === -1 && kandidatin_clicked === kandidatin_angezeigt) {
        // Nothing
    } else if (kandidatin_zeigen === -1) {
        if (mobile_view === true) {
            $('#map').hide('slide', {'direction':'up'}, duration, function() {
                $('#kandidatinneninfo_container').hide('slide', {'direction':'up'}, duration, function() {
                    $('#kandidatinneninfo_container').html($('#kandidat-' + kandidatin_clicked).html());
                    kandidatin_angezeigt = kandidatin_clicked;
                    $('#kandidatinneninfo_container').show('slide', {'direction': 'up'}, duration);
                });
            });
        } else {
            $('#kandidatinneninfo_container').hide('slide', {'direction':'right'}, duration, function() {
                $('#kandidatinneninfo_container').html($('#kandidat-' + kandidatin_clicked).html());
                kandidatin_angezeigt = kandidatin_clicked;
                $('#kandidatinneninfo_container').show('slide', {'direction': 'right'}, duration);
            });
        }
    } else {
//        if (kandidatin_clicked !== kandidatin_angezeigt) {
            $('#kandidatinneninfo_container').hide('slide', {'direction':'right'}, duration, function() {
                $('#kandidatinneninfo_container').html($('#kandidat-' + kandidatin_zeigen).html());
                kandidatin_angezeigt = kandidatin_zeigen;
                $('#kandidatinneninfo_container').show('slide', {'direction': 'right'}, duration);
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
    $('#landesliste_select > optgroup > option').each(function() {
        $(this).prop('selected', false);
    });    
    $('#landesliste_select > option').each(function() {
        $(this).prop('selected', false);
    });  
    if (kandidatin_zeigen !== -1) {
        if (angezeigte_wahlkreise[kandidatin_zeigen]) {
            angezeigte_wahlkreise[kandidatin_zeigen].setStyle({fillOpacity: 0.8});
        }
        $('#landesliste > ol > li > span#kandidatin' + kandidatin_zeigen).addClass('highlight');
        $("#landesliste_select option[value='skandidatin'" + kandidatin_zeigen + "']").prop('selected', true);
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
        $('#landesliste_select option#skandidatin' + (kandidatin_clicked)).prop('selected', true);
    }
    return false;

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



    ResizeWindows();
    KandidatinZeigen();

    $.each(kandidatinnen, function(index, value) {
        var wahlkreis_nr = value['wahlkreis'];
        var wahlkreis;
        var zindex;
        var kid = value['id'];

        if (wahlkreis_nr > 0) {

            wahlkreis = new L.Polygon(
              wahlkreise[wahlkreis_nr] ,{
                    color:'#F80',
                    opacity: 0.7,
                    fillColor:'#F80',
                    smoothFactor:2
                }
            );

            wahlkreis.on({
//				mouseover: function(){ kandidatin_zeigen = index; KandidatinZeigen(); },
//              mouseout: function(){ kandidatin_zeigen = -1; KandidatinZeigen(); },
                click: function(){ kandidatin_clicked = kid; just_clicked = 1; KandidatinZeigen(); }
            });
            angezeigte_wahlkreise[kid] = wahlkreis;
            map.addLayer(wahlkreis);
        }

        
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
    
    $('#landesliste > ol > li > span').each(function() {
        var id = parseInt($(this).attr("id").replace('kandidatin',''));
        $(this).on('click', function() {kandidatin_clicked = id; KandidatinZeigen(); return false;});
    });
    
    
    $('#landesliste_select > select').change(function() {
        if ($(this).find("option:selected").attr("id") == 'selectkarte') {
            kandidatin_clicked = -1;
            kandidatin_zeigen = -1;
            KandidatinZeigen();
        } else {
            var id = parseInt($(this).find("option:selected").attr("id").replace('skandidatin',''));
            kandidatin_clicked = id;
            just_clicked = 1;
            KandidatinZeigen();
        }
    });
    
}

function ResizeWindows() {
    var mapheight = $('#map').height();
    var mapwidth = $('#map').width();

    $('#kandidatinneninfo_container').css({'max-height': (mapheight - 60) + 'px' });
    $('#landesliste_parent').css({'max-height': (mapheight - 60) + 'px' });
    $('#landesliste').css({'max-height': (mapheight - 60) + 'px' });

}

function EnterSmallScreen() {
    mobile_view = true;
    if (kandidatin_angezeigt !== -1) {
        $('#map').hide('slide', {'direction':'right'}, 10);
    }
    $('#landesliste_select').css({'display': 'block'});
    $('#landesliste_parent').css({'display': 'none'});
}

function EnterBigScreen() {
    mobile_view = false;
    $('#map').show('slide', {'direction':'right'}, 10);
    $('#landesliste_select').css({'display': 'none'});
    $('#landesliste_parent').css({'display': 'block'});
}

$(window).bind('hashchange', function () {
    var hash = window.location.hash.slice(1);
    var id = parseInt(hash.replace('kandidat-', ''));
    kandidatin_clicked = id;
    just_clicked = 1;
    KandidatinZeigen();
});

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