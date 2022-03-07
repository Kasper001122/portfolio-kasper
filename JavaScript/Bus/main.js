// IIFE
(() => {

    //create map in leaflet and tie it to the div called 'theMap'
    let map = L.map('theMap').setView([44.650627, -63.597140], 14);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    //references
    //https://leafletjs.com/examples/custom-icons/
    //https://gis.stackexchange.com/questions/179912/leaflet-html-geojson-how-to-put-a-pop-up-on-a-geojson-point
    //https://stackoverflow.com/questions/41256026/clear-marker-layers-leaflet
    //https://stackoverflow.//com/questions/28636723/how-to-clear-leaflet-map-of-all-markers-and-layers-before-adding-new-ones
    //DOC REFERENCES
    //https://github.com/bbecquet/Leaflet.RotatedMarker
    //https://macwright.com/2015/03/23/geojson-second-bite.html
    //https://leafletjs.com/examples/geojson/
    // L.marker([44.650690, -63.596537]).addTo(map)
    //     .bindPopup('This is a sample popup. You can put any html structure in this including extra bus data. You can also swap this icon out for a custom icon. A png file has been provided for you to use if you wish.')
    //     .openPopup();
    
    var myLayer = L.geoJSON().addTo(map);
    var busIcon = L.icon({
        iconUrl: 'bus.png',
        iconSize:[15,25]
        
    });
    
    
    
    const placeMarkers=()=>{
  
       myLayer.clearLayers();

        
        fetch('https://hrmbusapi.herokuapp.com/')
            
            .then(function(response){
                return response.json();
            })
            .then(function(data){
                
                
                oneToTen= data.entity.filter((bus)=> bus.vehicle.trip.routeId<=10)
                oneToTen.filter(bus=> {
                    var geojsonFeature = {
                        "type": "Feature",
                        "properties": {
                            "name": bus.vehicle.trip.routeId,
                            "amenity": "Bus",
                            "popupContent": bus.vehicle.occupancyStatus,
                            
                        },
                        "geometry": {
                            "type": "Point",
                            "coordinates": [bus.vehicle.position.longitude, bus.vehicle.position.latitude]
                        }
                    };
                    L.geoJson(geojsonFeature  ,{
                        pointToLayer: function(feature,latlng){
                          return L.marker(latlng,{icon: busIcon, rotationAngle:bus.vehicle.position.bearing});
                        }
                      }).bindPopup("Route: "+bus.vehicle.trip.routeId+"\nUnique ID: "+ bus.vehicle.vehicle.id+"\nOccupancy Status: "+bus.vehicle.occupancyStatus).addTo(myLayer);
                    
                });
                
                
            })
        }
        placeMarkers();
        const myTimeout = setInterval(placeMarkers, 7000);
        
})()