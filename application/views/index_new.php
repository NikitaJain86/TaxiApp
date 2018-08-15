

<!-------- Customizable Css for Map  ----------------------------->
<style type="text/css">
    html {
        height: 100%;
    }
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #map {
        margin: 0;
        padding: 0;
        height: 550px;
        max-width: none;
    }
    #map img {
        max-width: none !important;
    }
    .gm-style-iw {
        //width: 250px !important;
        top: 15px !important;
        left: 0px !important;
        background-color: #fff;
        //box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
        //border: 1px solid rgba(72, 181, 233, 0.6);
        //border-radius: 2px 2px 10px 10px;
    }
    #iw-container {
        margin-bottom: 10px;
    }
    #iw-container .iw-title {
        font-family: 'Open Sans Condensed', sans-serif;
        font-size: 22px;
        font-weight: 400;
        padding: 10px;
        background-color: #48b5e9;
        color: white;
        margin: 0;
        border-radius: 2px 2px 0 0;
    }
    #iw-container .iw-content {
        font-size: 13px;
        line-height: 18px;
        font-weight: 400;
        margin-right: 1px;
        padding: 15px 5px 20px 15px;
        max-height: 140px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .iw-content img {
        float: right;
        margin: 0 5px 5px 10px;	
    }
    .iw-subTitle {
        font-size: 16px;
        font-weight: 700;
        padding: 5px 0;
    }
    .iw-bottom-gradient {
        position: absolute;
        width: 326px;
        height: 25px;
        bottom: 10px;
        right: 18px;
        background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
        background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
        background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
        background: -ms-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    }
</style>

<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDzaa4MZ7r4s26i54PwErpKTynKAaWVxTc&v=3&language=en"></script>-->
<!--<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">
</script>-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>-->
<!------------- Java Scripts for Map  ------------------->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=<?= $this->session->userdata('user')->google_api_key ?>&v=3&language=en"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>

<script type="text/javascript">
    var marker;
    var map = null;
    var markersArray = [];

    var currentPopup;
    var bounds = new google.maps.LatLngBounds();


    var icon = {
        url: "https://firebasestorage.googleapis.com/v0/b/api-project-796350111526.appspot.com/o/gps.svg?alt=media&token=def31471-155c-4d9a-9a46-d428459517c0",
        anchor: new google.maps.Point(25, 50),
        scaledSize: new google.maps.Size(50, 50),
        animated: true
    }



    function addMarker(lat, lng, feature) {
        position = new google.maps.LatLng(lat, lng);
        marker.setPosition(position);
        var content = '<div id="iw-container">' +
                '<div class="iw-title">' + feature.u_name + '</div>' +
                '<div class="iw-content">' +
                '<img src="<?= $this->config->base_url() ?>' + feature.avatar + '" alt="Profile pic" height="115" width="83">' +
                '<div class="iw-subTitle">Contacts</div>' +
                '<br>Phone. ' + feature.mobile + ' &nbsp;&nbsp e-mail: ' + feature.email + '</p>' +
                '</div>' +
                '<div class="iw-bottom-gradient"></div>' +
                '</div>';


        var infowindow = new google.maps.InfoWindow({
            content: content,
            // Assign a maximum value for the width of the infowindow allows
            // greater control over the various content elements
            maxWidth: 350
        });
        google.maps.event.addListener(marker, 'click', function () {
            if (currentPopup != null) {
                currentPopup.close();
                currentPopup = null;
            }
            infowindow.open(map, marker);
            currentPopup = infowindow;

        });

        google.maps.event.addListener(map, 'click', function () {
            infowindow.close();
            currentPopup = null;
        });

        google.maps.event.addListener(infowindow, 'domready', function () {


            // Reference to the DIV that wraps the bottom of infowindow
            var iwOuter = $('.gm-style-iw');

            /* Since this div is in a position prior to .gm-div style-iw.
             * We use jQuery and create a iwBackground variable,
             * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
             */
            var iwBackground = iwOuter.prev();

            // Removes background shadow DIV
            iwBackground.children(':nth-child(2)').css({'display': 'none'});

            // Removes white background DIV
            iwBackground.children(':nth-child(4)').css({'display': 'none'});

            // Moves the infowindow 115px to the right.
            iwOuter.parent().parent().css({left: '115px'});

            // Moves the shadow of the arrow 76px to the left margin.
            iwBackground.children(':nth-child(1)').attr('style', function (i, s) {
                return s + 'left: 76px !important;'
            });

            // Moves the arrow 76px to the left margin.
            iwBackground.children(':nth-child(3)').attr('style', function (i, s) {
                return s + 'left: 76px !important;'
            });

            // Changes the desired tail shadow color.
            iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index': '1'});

            // Reference to the div that groups the close button elements.
            var iwCloseBtn = iwOuter.next();

            // Apply the desired effect to the close button
            iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});

            // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
            if ($('.iw-content').height() < 140) {
                $('.iw-bottom-gradient').css({display: 'none'});
            }

            // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
            iwCloseBtn.mouseout(function () {
                $(this).css({opacity: '1'});
            });
        });
    }

    function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: new google.maps.LatLng(<?= $res[0]['u_lat'] ?>, <?= $res[0]['u_lon'] ?>),
            mapTypeId: 'roadmap'
        });
        var pt = new google.maps.LatLng(<?= $res[0]['u_lat'] ?>, <?= $res[0]['u_lon'] ?>);
        bounds.extend(pt);
        marker = new google.maps.Marker({
            position: pt,
            draggable: true,
            raiseOnDrag: true,
            icon: icon,
            map: map
        });
        markersArray.push(marker);


        addMarker(<?= $res[0]['u_lat'] ?>, <?= $res[0]['u_lon'] ?>, "Longitude:<?= $res[0]['u_lat'] ?><br><?= $res[0]['email'] ?><br><?= $res[0]['u_name'] ?>");
        setInterval(function mapload() {

            $.ajax({
                type: "POST",
                url: window.location.href + '/ajax',
                // data: form_data,
                success: function (data)
                {

                    // var json_obj = $.parseJSON(data);//parse JSON
                    var json_obj = jQuery.parseJSON(JSON.stringify(data));
                    for (var i in json_obj)
                    {
                        addMarker(json_obj[i].u_lat, json_obj[i].u_lon, json_obj[i]);

                    }
                },
                dataType: "json"//set to JSON    
            })


        }, 2000);

        center = bounds.getCenter();
        map.fitBounds(bounds);
        
          markerStartEnd(map, new google.maps.LatLng(<?= $pickup_start ?>,<?= $pickup_end ?>), new google.maps.LatLng(<?= $drop_start ?>,<?= $drop_end ?>), "10:00", "10:20");
          var bounds1 = new google.maps.LatLngBounds();
          bounds1.extend(new google.maps.LatLng(<?= $pickup_start ?>,<?= $pickup_end ?>));
          bounds1.extend(new google.maps.LatLng(<?= $drop_start ?>,<?= $drop_end ?>));
          map.fitBounds(bounds1);
       

    }
    
    function markerStartEnd(map, startPoint, endPoint, startTime, endTime) {
          var anchor = new google.maps.Point(20, 41),
            size = new google.maps.Size(41, 41),
            origin = new google.maps.Point(0, 0),
            icon = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/micons/blue.png', size, origin, anchor);
             var marker_p =  new google.maps.Marker({
                icon: icon,
                map: map,
                position: startPoint
              });
              
              var pickup = '<?= $pickup_address ?>';
              var drop = '<?= $drop_address ?>';
              
            icon = new google.maps.MarkerImage('http://maps.google.com/mapfiles/ms/micons/green.png', size, origin, anchor);
             var marker_d = new google.maps.Marker({
                icon: icon,
                map: map,
                position: endPoint
              });
              var infowindow1 = new google.maps.InfoWindow({
                content: pickup
            });
            
             var infowindow2 = new google.maps.InfoWindow({
                content: drop
            });
            
              infowindow1.open(map, marker_p);
              infowindow2.open(map, marker_d);
           
 
}

</script>

</head>
<body onLoad="initMap()">
    <div   class="vd_content-wrapper">
        <div class="vd_container">
            <div class="vd_content clearfix">
                <div  class="vd_content-section clearfix">

                    <div id="map"></div>
                </div>
            </div>

        </div>
    </div>
</body>



