var myGMap = (function(){
    var gmap0infoWindow;
    var gmap0;
    var gmarker = [];
    var container;
    var mapOptions;
    
    function myGMap(){
        this.canvas = 'gmap0-map-canvas';
        this.lat = 43.7621527000;
        this.long = 2.9246927000;
        this.zoom = 7;
        
        for(var prop in arguments[0])   {
            if(this.hasOwnProperty(prop))   {
                this[prop]=arguments[0][prop];   
            }
        }
        
        mapOptions = {"center":new google.maps.LatLng( this.lat, this.long ),"zoom": this.zoom};
        console.log('set map canvas:' + this.canvas);
        console.log(this);
        
        container = document.getElementById( this.canvas );
        
        if (container)
        {
            container.style.width = '100%';
            container.style.height = '512px';
            gmap0 = new google.maps.Map(container, mapOptions);

            gmap0infoWindow = new google.maps.InfoWindow();
        }
    //    google.maps.event.addDomListener(window, 'load', initialize);
    }

    myGMap.prototype.getMap = function() {
            return gmap0;
    }
    myGMap.prototype.addMarker = function(lat, lng, title, content, iconFile) {
        count = gmarker.length;

        gmarker[count] = new google.maps.Marker({
            "map": gmap0,
            "position": new google.maps.LatLng(lat, lng),
            "title": title,
            "icon": iconFile
        });

        google.maps.event.addListener(gmarker[count], 'click', function(event){

            gmap0infoWindow.setContent( content );

            gmap0infoWindow.open(gmap0, this);
        });
    }

    myGMap.prototype.clearMarkers = function() {
      for (var i = 0; i < gmarker.length; i++) {
        gmarker[i].setMap( null );
      }
      gmarker = [];
    }

    return myGMap;

})();
