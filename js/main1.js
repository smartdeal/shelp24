


//Yandex Map
// ========================================================
     var map_container = document.getElementById("map");
    if (map_container) {
        $(document).ready(function () {
            get_map(map_container, map_contact);
        });
    }

    function get_map(map_container, map_array){

    
        if ( map_container !== null ) {
            if (typeof ymaps === 'undefined') 
                $.loadScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU', function(){
                
                    ymaps.ready(init);
                    var myMap, 
                        myPlacemark,
                        curLat,
                        curLong,
                        curDesc;

                    function init(){ 
                        curLat = map_array['lat'];
                        curLong = map_array['long'];
                        myMap = new ymaps.Map(map_container, {
                            // center: [61.582319, 98.112851],
                            center: [curLat, curLong],
                            zoom: 17
                        }); 
                        myPlacemark = new ymaps.Placemark([curLat, curLong], 
                            {
                                balloonContentBody: '<span class="ym-balloon">г. Москва, ул. Русаковская, д. 13, оф. 905<br><b>+7 495 266-25-40</b></span>',
                            },
                            {
                                iconLayout: 'default#image',
                                iconImageHref: theme_url+'/img/map-pin.png',
                                iconImageSize: [42, 58],
                                iconImageOffset: [-30, -70]
                            }
                        );
                        myMap.geoObjects.add(myPlacemark);
                    }

            });
        }
    }
