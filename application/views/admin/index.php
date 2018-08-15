
<style>
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
        width: 250px !important;
        top: 15px !important;
        left: 0px !important;
        background-color: #fff;
        box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
        border: 1px solid rgba(72, 181, 233, 0.6);
        border-radius: 2px 2px 10px 10px;
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

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>


    function set_marker(features) {

        var map;
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: new google.maps.LatLng(-33.91722, 151.23064),
            mapTypeId: 'roadmap'
        });

        var icon = {
            url: "https://firebasestorage.googleapis.com/v0/b/api-project-796350111526.appspot.com/o/gps.svg?alt=media&token=def31471-155c-4d9a-9a46-d428459517c0",
            anchor: new google.maps.Point(25, 50),
            scaledSize: new google.maps.Size(50, 50),
            animated: true
        }

        // Create markers.
        var bounds = new google.maps.LatLngBounds();

        features.forEach(function (feature) {
            bounds.extend(feature.position);
            var marker = new google.maps.Marker({
                position: feature.position,
                icon: icon,
                map: map,
                optimized: false
            });
            var content = '<div id="iw-container">' +
                    '<div class="iw-title">' + feature.name + '</div>' +
                    '<div class="iw-content">' +
                    '<img src="<?= $this->config->base_url() ?>' + feature.avatar + '" alt="Profile pic" height="115" width="83">' +
                    '<div class="iw-subTitle">Contacts</div>' +
                    '<br>Phone. ' + feature.mobile + ' &nbsp;&nbsp;&nbsp;&nbsp e-mail: ' + feature.email + '</p>' +
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
                infowindow.open(map, marker);
            });

            google.maps.event.addListener(map, 'click', function () {
                infowindow.close();
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
            map.fitBounds(bounds);

        });
    }

    function initMap() {

        var features = <?= $res ?>

        set_marker(features)


    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?= $this->session->userdata('user')->google_api_key ?>&callback=initMap">
</script>
<div class="vd_content-wrapper">
    <div class="vd_container">
        <div class="vd_content clearfix">
            <div class="vd_content-section clearfix">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>
