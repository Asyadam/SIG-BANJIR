<!DOCTYPE html>
<html>
<div id="map-controls">
    
</div>
<head>
    <title>Geojson</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    

    
    <style>
        /* Style peta */
        #map {
            width: 100%;
            height: 100vh;
        }
        #toggleMarkers {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000; /* Pastikan tombol ini muncul di atas peta */
        }
    </style>
</head>
<body>
<div id="map-container">
    <div id="map"></div>
    <button 
    class="btn btn-success" id="toggleMarkers">
        <span id="markerStatusText">Marker Aktif</span>
        <i class="fa-solid fa-location-dot" style="color: #ff0000;"></i>
    </button>
</div>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


    <script>
        // Basemap OpenStreetMap
        var openStreetMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        // Basemap Mapbox Streets
        var mapboxStreets = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={access_token}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            access_token: 'pk.eyJ1Ijoic3lhZGFtIiwiYSI6ImNsbWhoczd3dDIyeXQzcnB4bzh3bHFudGwifQ.g2S_RFr5h5P_6i6OD65AVQ' // Gantilah dengan token Mapbox Anda
        });

        // Basemap Mapbox Satellite
        var mapboxSatellite = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={access_token}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/satellite-v9',
            access_token: 'pk.eyJ1Ijoic3lhZGFtIiwiYSI6ImNsbWhoczd3dDIyeXQzcnB4bzh3bHFudGwifQ.g2S_RFr5h5P_6i6OD65AVQ' // Gantilah dengan token Mapbox Anda
        });

        var map = L.map('map', {
            center: [-3.783477635115412, 102.31586327842393],
            zoom: 13.1,
            layers: [openStreetMap] // Basemap OpenStreetMap sebagai basemap awal
        });

        // Kontrol layer untuk beralih antara basemap
        var baseMaps = {
            "OpenStreetMap": openStreetMap,
            "Mapbox Streets": mapboxStreets,
            "Mapbox Satellite": mapboxSatellite
        };

        L.control.layers(baseMaps).addTo(map);

        //geojson

        
       
        $.getJSON("<?= base_url('geojson/kerawanan.geojson') ?>", function(data) {
    L.geoJson(data, {
        style: function(feature) {
            var kondisi = feature.properties.KONDISI;
            var fillColor;

            switch (kondisi) {
                case 'Tidak Rawan':
                    fillColor = '#006200';
                    break;
                case 'Cukup Rawan':
                    fillColor = '#A4C400';
                    break;
                case 'Rawan':
                    fillColor = '#FFBB00';
                    break;
                case 'Sangat Rawan':
                    fillColor = '#FF2600';
                    break;
                default:
                    fillColor = 'gray';
                    break;
            }

            return {
                fillColor: fillColor,
                color: 'transparent', // Atur warna batas menjadi transparan
                weight: 1, // Atur ketebalan batas
                fillOpacity: 0.7, // Atur opasitas area diisi
                smoothFactor: 0.5 // Atur tingkat kurva sesuai kebutuhan Anda
            };
        }
    }).addTo(map);
});


// Grup marker
var markers = L.layerGroup();

// Icon marker
var markerIcon = L.icon({
    iconUrl: '<?= base_url('gambar/marker.png')?>',
    iconSize: [30, 30],
    iconAnchor: [15, 30],
    popupAnchor: [0, -30]
});

// Tambahkan marker ke dalam grup
var marker1 = L.marker([-3.7789200612676463, 102.29415636754202], { icon: markerIcon })
    .bindPopup(
        "<div style='text-align: center;'>" +
        "<img src='<?= base_url('gambar/fotobanjir1.jpg')?>' width='250px'><br>"+
        "<b>Lokasi: Bentiring Permai, Kec. Muara Bangka Hulu, Kota Bengkulu</b><br>" +
        "23-January-2023" +
        "</div>"
    )
    .addTo(markers)
    .on('click', function() {
        map.setView([-3.7789200612676463, 102.29415636754202], 13); // Ganti koordinat dan level zoom sesuai kebutuhan
    });

var marker2 = L.marker([-3.778882308952989, 102.2719299657643], { icon: markerIcon })
    .bindPopup(
        "<div style='text-align: center;'>" +
        "<img src='<?= base_url('gambar/banjir2.jpg')?>' width='250px'><br>" +
        "<b>Lokasi: Jl. Kalimantan Rw. Makmur, Kec. Muara Bangka Hulu, Kota Bengkulu, Bengkulu</b><br>" +
        "30-August-2022" +
        "</div>"
    )
    .addTo(markers)
    .on('click', function() {
        map.setView([-3.778882308952989, 102.2719299657643], 13); // Ganti koordinat dan level zoom sesuai kebutuhan
    });

// Tambahkan grup marker ke peta
markers.addTo(map);

// Status marker terlihat
var markersVisible = true;

// Fungsi untuk menampilkan atau menyembunyikan marker
// Fungsi untuk menampilkan atau menyembunyikan marker
function toggleMarkers() {
    if (markersVisible) {
        // Jika marker terlihat, sembunyikan mereka
        map.removeLayer(markers);
        markersVisible = false;
        document.getElementById('markerStatusText').textContent = 'Marker Mati';
        document.getElementById('toggleMarkers').classList.remove('btn-primary');
        document.getElementById('toggleMarkers').classList.add('btn-danger');
    } else {
        // Jika marker disembunyikan, tampilkan mereka
        markers.addTo(map);
        markersVisible = true;
        document.getElementById('markerStatusText').textContent = 'Marker Aktif';
        document.getElementById('toggleMarkers').classList.remove('btn-danger');
        document.getElementById('toggleMarkers').classList.add('btn-primary');
    }
}


// Tangani klik tombol "Tampilkan/sembunyikan Marker"
document.getElementById('toggleMarkers').addEventListener('click', function () {
    toggleMarkers();
});




var geojsonLayers = {
    "2 Tahun": createGeoJsonLayer("<?= base_url('geojson/2tahun.geojson') ?>", 2),
    "5 Tahun": createGeoJsonLayer("<?= base_url('geojson/5tahun.geojson') ?>", 5),
    "10 Tahun": createGeoJsonLayer("<?= base_url('geojson/10tahun.geojson') ?>", 10),
    "25 Tahun": createGeoJsonLayer("<?= base_url('geojson/25tahun.geojson') ?>", 25),
    "50 Tahun": createGeoJsonLayer("<?= base_url('geojson/50tahun.geojson') ?>", 50),
    "100 Tahun": createGeoJsonLayer("<?= base_url('geojson/100tahun.geojson') ?>", 100)
};

// Buat kontrol lapisan dengan kotak centang
var layerControl = L.control.layers(geojsonLayers, null, { position: 'topleft' }).addTo(map);

// Variabel untuk melacak lapisan yang aktif
var activeLayers = [];

// Variabel untuk melacak status lapisan (aktif atau nonaktif)
var layerStatus = {
    "2 Tahun": true,
    "5 Tahun": false,
    "10 Tahun": false,
    "25 Tahun": false,
    "50 Tahun": false,
    "100 Tahun": false
};


// Fungsi untuk membuat lapisan GeoJSON
function createGeoJsonLayer(url, year) {
    var geoJsonLayer = L.geoJson(null, {
        style: function (feature) {
            var kedalaman = feature.properties.Kedalaman;
            var fillColor;

            if (kedalaman === "< 1 m") {
                fillColor = '#98DAF1'; // Warna untuk "< 1 m"
            } else if (kedalaman === "1 - 2 m") {
                fillColor = '#8F97E2'; // Warna untuk "1 - 2 m"
            } else if (kedalaman === "2 - 3 m") {
                fillColor = '#556CC9'; // Warna untuk "2 - 3 m"
            } else if (kedalaman === "3 - 5 m") {
                fillColor = '#234EAD'; // Warna untuk "3 - 5 m"
            } else if (kedalaman === "> 5 m") {
                fillColor = '#003895'; // Warna untuk "> 5 m"
            }

            return {
                color: 'none',
                fillColor: fillColor,
                fillOpacity: 1.0,
                weight: 0,
                smoothFactor: 0.5,
                zIndex: year // Mengatur indeks Z berdasarkan tahun
            };
        }
    });

    // Menggunakan AJAX untuk mengambil data GeoJSON dari URL
    $.getJSON(url, function (data) {
        geoJsonLayer.addData(data);

        // Tambahkan lapisan ke peta saat data GeoJSON diambil jika tahun ini aktif
        if (layerStatus[year + " Tahun"]) {
            geoJsonLayer.addTo(map);
        }
    });

    return geoJsonLayer;
}

// Merekam perubahan saat pengguna memilih lapisan
layerControl.on('overlayadd', function (e) {
    var year = e.name;
    if (!layerStatus[year + " Tahun"]) {
        activeLayers.push(e.layer);
        layerStatus[year + " Tahun"] = true;
    }
});

// Merekam perubahan saat pengguna melepas lapisan
layerControl.on('overlayremove', function (e) {
    var year = e.name;
    var index = activeLayers.indexOf(e.layer);
    if (index > -1) {
        activeLayers.splice(index, 1);
        layerStatus[year + " Tahun"] = false;
    }
});

// Dapatkan semua lapisan yang aktif saat ini
function getActiveLayers() {
    return activeLayers;
}




       
    </script>

</body>
</html>