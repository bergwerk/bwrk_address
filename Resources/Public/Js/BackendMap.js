var MarkerMap = {
    entityUid: null,
    modelName: null,
    addressFieldName: null,
    defaultLat: null,
    defaultLng: null,
    geoCoder: null,
    init: function(mapId)
    {
        this.initMap(mapId);
        this.initGeoCoder();
        //this.reverseGeoCode(this.defaultLat, this.defaultLng, this.addressFieldName);
        //this.eventOnDrag();
    },
    marker: null,
    map: null,
    initMap: function(mapId)
    {
        this.map = new google.maps.Map(document.getElementById(mapId), this.getOptions());
        this.marker = this.defaultMarker();
    },
    initGeoCoder: function()
    {
        this.geoCoder = new google.maps.Geocoder();
    },
    getOptions: function()
    {
        return {
            lat: this.defaultLat,
            zoom: 13,
            center: this.mapOrigin(),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        };
    },
    mapOrigin: function()
    {
        return new google.maps.LatLng(this.defaultLat, this.defaultLng);
    },
    defaultMarker: function()
    {
        return new google.maps.Marker({
            map: this.map,
            position: this.mapOrigin(),
            draggable: false
        });
    },
    refreshMap: function()
    {
        google.maps.event.trigger(this.map, 'resize');
    },
    reverseGeoCode:  function(lat, lng, addressFieldName) {
        var latLng = new google.maps.LatLng(lat, lng);
        this.geoCoder.geocode({'latLng': latLng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK && results[1] && typeof addressFieldName != 'undefined') {
                var address = document.getElementsByName(addressFieldName)[0];
                address.value = results[1].formatted_address;
            }
        });
    },
    codeAddress : function(address) {
        // called with button click
        var that = this;

        this.geoCoder.geocode({'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {

                var lat = results[0].geometry.location.lat();
                var lng = results[0].geometry.location.lng();

                // Update fields
                that.fields.set(lat, lng);

                TYPO3.jQuery.ajax(
                    TYPO3.settings.ajaxUrls["BackendController::saveFields"],
                    {
                        "type":"post",
                        "data": {
                            latitude: lat,
                            longitude: lng,
                            uid: MarkerMap.entityUid
                        }
                    }
                ).done(function(result) {

                });


                that.map.setCenter(results[0].geometry.location);
                that.marker.setPosition(results[0].geometry.location);
            } else {
                TYPO3.Flashmessage.display(
                    TYPO3.Severity.error,
                    'Error',
                    "Die Geocodierung hat einen Fehler: " + status,
                    5
                );
            }
        });
    },
    fields: {
        lat: null,
        lng: null,
        set: function(lat, lng) {
            this.lat = lat;
            this.lng = lng;

            var fieldName = 'data['+MarkerMap.modelName+']['+MarkerMap.entityUid+']';

            document.getElementsByName(fieldName+'[latitude]')[0].value = lat;
            document.querySelectorAll('[data-formengine-input-name="'+fieldName+'[latitude]"]')[0].value = lat;

            document.getElementsByName(fieldName+'[longitude]')[0].value = lng;
            document.querySelectorAll('[data-formengine-input-name="'+fieldName+'[longitude]"]')[0].value = lng;
        }
    },
    eventOnDrag: function()
    {
        var that = this;

        google.maps.event.addListener(this.marker, 'dragend', function() {
            var marker = that.marker;
            var markerPosition = marker.getPosition();

            var lat = markerPosition.lat().toFixed(6);
            var lng = markerPosition.lng().toFixed(6);

            // Update Fields
            that.fields.set(lat, lng);

            // Update address
            //that.reverseGeoCode(markerPosition.lat(), markerPosition.lng());
        });
    }

};