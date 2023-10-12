<!DOCTYPE html>
<html>
<head>

    <title>Geojson</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Mts2brVq2XxDvzqFqUfXSHcc5FV0eNocgaHJ3ZLHMq1caYO6tyxubndyRb2/7W+ptT4DxHzcfuPcdpxQ4i0Xa2w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Mts2brVq2XxDvzqFqUfXSHcc5FV0eNocgaHJ3ZLHMq1caYO6tyxubndyRb2/7W+ptT4DxHzcfuPcdpxQ4i0Xa2w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>
        /* Style peta */
        #map {
            width: 100%;
            height: 100vh; /* Ubah tinggi peta sesuai kebutuhan Anda */
        }

        .material-icons {
    position: relative; /* Anda juga bisa mencoba "absolute" tergantung pada kebutuhan */
    top: 2.5px; /* Sesuaikan dengan nilai yang Anda inginkan */
    left: 0px; /* Sesuaikan dengan nilai yang Anda inginkan */
}
.material-icons {
    font-size: 20px; /* Sesuaikan dengan ukuran yang Anda inginkan, misalnya 24px */
}

        #yearButtons {
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 1000;
    padding: 10px;
    border-radius: 5px;
    overflow: hidden; /* Menyembunyikan latar belakang tombol yang terpotong */
}



#yearButtons::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    border-radius: inhersit;
    z-index: -1;
}

/* Gaya untuk tombol tahun */
.yearButton {
    margin-right: 5px;
    cursor: pointer;
    color: #FFA500; /* Warna teks oranye */
    background-color: white; /* Ubah latar belakang tombol menjadi transparan */
    border: 1px solid #FFA500; /* Border berwarna oranye */
    border-radius: 5px;
    padding: 5px 15px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Gaya hover untuk tombol tahun */
.yearButton:hover {
    background-color: #FFA500 !important; /* Warna latar belakang saat dihover */
    color: white !important; /* Warna teks saat dihover */
}

/* Tambahkan gaya untuk tombol yang aktif */
.yearButton.active {
    background-color: #002dff !important; /* Ganti dengan warna tombol yang diinginkan saat aktif */
    color: #fff !important; /* Warna teks putih */
    border: 1px solid #002dff !important;
}
.yearButton:active {
        background-color: #002dff !important; /* Ubah latar belakang menjadi biru saat tombol ditekan */
        color: #fff !important; /* Warna teks menjadi putih saat tombol ditekan */
        border: 1px solid #002dff !important; /* Ubah warna border saat tombol ditekan */
    }

   


html, body {
    overflow: hidden;
}
        #toggleMarkers {
    position: absolute;
    top: 30px;
    right: 110px;
    z-index: 1000;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;

}
    </style>
</head>
<body>

<div id="map"></div>


<button class="btn btn-warning text-white" type="button" data-bs-toggle="modal" data-bs-target="#customModal" style="position: absolute; top: 70px; right: 30px; z-index: 1000;">
        Grafik Fluktuasi <i class="fa-solid fa-chart-simple" style="color: #004cff;"></i>
    </button>

    <!-- Modal grafik -->
    <div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customModalLabel">Grafik Fluktuasi</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="grafik-container">
                        <!-- Grafik pertama -->
                        <div class="grafik-item">
                            <h6>Kedalaman < 1m</h6>
                            <canvas id="chart1" width="800" height="400"></canvas>
                        </div>

                        <!-- Grafik kedua -->
                        <div class="grafik-item">
                            <h6>Kedalaman 1-2m</h6>
                            <canvas id="chart2" width="800" height="400"></canvas>
                        </div>

                        <!-- Dan seterusnya untuk grafik lainnya -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sisipkan semua link JavaScript dan CSS yang diperlukan di sini -->

    <script>
        // Data dan label untuk grafik pertama
        var labels1 = ['< 1 m', '1 - 2 m', '2 - 3 m', '3 - 5 m', '> 5 m'];
        var data1 = [10, 15, 7, 20, 5];

        // Data dan label untuk grafik kedua
        var labels2 = ['Label A', 'Label B', 'Label C', 'Label D', 'Label E'];
        var data2 = [5, 8, 12, 15, 18];

        // Panggil fungsi untuk membuat grafik batang pertama
        createBarChart('chart1', labels1, data1);

        // Panggil fungsi untuk membuat grafik batang kedua
        createBarChart('chart2', labels2, data2);

        // Fungsi untuk membuat grafik batang
        function createBarChart(canvasId, labels, data) {
            var ctx = document.getElementById(canvasId).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar', // Jenis grafik adalah bar chart
                data: {
                    labels: labels, // Label pada sumbu x
                    datasets: [{
                        label: 'Luas Kedalaman', // Label untuk dataset
                        data: data, // Data jumlah
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang batang
                        borderColor: 'rgba(75, 192, 192, 1)', // Warna garis tepi batang
                        borderWidth: 1 // Lebar garis tepi batang
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true // Mulai dari 0 pada sumbu Y
                        }
                    }
                }
            });
        }
    </script>










<div id="yearButtons" style="display: flex; flex-direction: column; align-items: center;">
    <div style="padding: 10px 0; border-top: 2px solid #002dff; border-bottom: 2px solid #002dff; text-align: center; width: 100%;">
        <strong style="color: #FFA500;">POTENSI BANJIR SUB DAS BENGKULU HILIR INTEGRASI HEC-RAS&ensp;</strong> <i style="color: #002dff;" class="material-icons">flood</i>
    </div>
    <div style="padding: 10px 0;">
        
        <button class="btn btn-outline-warning yearButton" data-year="2">2 Tahun</button>
        <button class="btn btn-outline-warning yearButton" data-year="5">5 Tahun</button>
        <button class="btn btn-outline-warning yearButton" data-year="10">10 Tahun</button>
        <button class="btn btn-outline-warning yearButton" data-year="25">25 Tahun</button>
        <button class="btn btn-outline-warning yearButton" data-year="50">50 Tahun</button>
        <button class="btn btn-outline-warning yearButton" data-year="100">100 Tahun</button>
    </div>
</div>

<div id="toggleKerawanan" style="position: absolute; top: 30px; right: 20px; z-index: 1000;">
    <button id="toggleKerawananButton" class="btn btn-primary" type="button" style="font-size: 14px; padding: 7px 10px;">
        <i class="fa-solid fa-map" style="color: #ffa200;"></i>
        <span id="kerawananStatusText">Aktif</span>
    </button>
</div>




<div>
    <button id="toggleMarkers" class="btn btn-primary" style="font-size: 14px; padding: 7px 10px;">
    <i class="fa-solid fa-location-dot" style="color: #FFA500;"></i>
        <span id="markerStatusText">Aktif</span>
    </button>
</div>




<script>
    var map = L.map('map', {
        center: [-3.783477635115412, 102.31586327842393],
        zoom: 13.1
    });

    // Basemap OpenStreetMap
    var openStreetMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

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

    var mapboxLight = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={access_token}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/light-v10', // Ini adalah ID untuk Mapbox Light
    access_token: 'pk.eyJ1Ijoic3lhZGFtIiwiYSI6ImNsbWhoczd3dDIyeXQzcnB4bzh3bHFudGwifQ.g2S_RFr5h5P_6i6OD65AVQ' // Gantilah dengan token Mapbox Anda
});


    // Kontrol layer untuk beralih antara basemap
    var baseMaps = {
        "OpenStreetMap": openStreetMap,
        "Mapbox Streets": mapboxStreets,
        "Mapbox Satellite": mapboxSatellite,
        "Mapbox Light": mapboxLight,
    };

    L.control.layers(baseMaps, null, { position: 'bottomright' }).addTo(map);

    // Lapisan marker
    var markers = L.layerGroup();

    // Icon marker
    var markerIcon = L.icon({
        iconUrl: '<?= base_url('gambar/marker.png') ?>',
        iconSize: [30, 30],
        iconAnchor: [15, 30],
        popupAnchor: [0, -30]
    });

    // Tambahkan marker ke dalam grup
    var marker1 = L.marker([-3.7789200612676463, 102.29415636754202], { icon: markerIcon })
        .bindPopup(
            "<div style='text-align: center;'>" +
            "<img src='<?= base_url('gambar/fotobanjir1.jpg') ?>' width='250px'><br>" +
            "<b>Lokasi: Bentiring Permai, Kec. Muara Bangka Hulu, Kota Bengkulu</b><br>" +
            "23-January-2023" +
            "</div>"
        )
        .addTo(markers)
        .on('click', function () {
            map.setView([-3.7789200612676463, 102.29415636754202], 13); // Ganti koordinat dan level zoom sesuai kebutuhan
        });

    var marker2 = L.marker([-3.778882308952989, 102.2719299657643], { icon: markerIcon })
        .bindPopup(
            "<div style='text-align: center;'>" +
            "<img src='<?= base_url('gambar/banjir2.jpg') ?>' width='250px'><br>" +
            "<b>Lokasi: Jl. Kalimantan Rw. Makmur, Kec. Muara Bangka Hulu, Kota Bengkulu, Bengkulu</b><br>" +
            "30-August-2022" +
            "</div>"
        )
        .addTo(markers)
        .on('click', function () {
            map.setView([-3.778882308952989, 102.2719299657643], 13); // Ganti koordinat dan level zoom sesuai kebutuhan
        });

    // Tambahkan grup marker ke peta
    markers.addTo(map);

    // Status marker terlihat
    var markersVisible = true;

    // Fungsi untuk menampilkan atau menyembunyikan marker
    function toggleMarkers() {
        if (markersVisible) {
            // Jika marker terlihat, sembunyikan mereka
            map.removeLayer(markers);
            markersVisible = false;
            document.getElementById('markerStatusText').textContent = 'Mati ';
            document.getElementById('toggleMarkers').classList.remove('btn-primary');
            document.getElementById('toggleMarkers').classList.add('btn-danger');
        } else {
            // Jika marker disembunyikan, tampilkan mereka
            markers.addTo(map);
            markersVisible = true;
            document.getElementById('markerStatusText').textContent = 'Aktif';
            document.getElementById('toggleMarkers').classList.remove('btn-danger');
            document.getElementById('toggleMarkers').classList.add('btn-primary');
        }
    }

    // Tangani klik tombol "Tampilkan/sembunyikan Marker"
    document.getElementById('toggleMarkers').addEventListener('click', function () {
        toggleMarkers();
    });


    var kerawananLayer = null; // Variabel untuk menyimpan layer GeoJSON kerawanan

// Memuat data GeoJSON kerawanan saat halaman dimuat
$.getJSON("<?= base_url('geojson/kerawanan.geojson') ?>", function(data) {
    kerawananLayer = L.geoJson(data, {
        style: function(feature) {
            // Tentukan gaya sesuai dengan atribut kerawanan
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
                color: 'transparent',
                weight: 1,
                fillOpacity: 0.8,
                smoothFactor: 0.5
            };
        }
    }).addTo(map);

    // Setel teks tombol ke "Matikan Kerawanan"    
    geoJsonLayer.addTo(map);
});

// Tombol untuk mengaktifkan atau menonaktifkan layer kerawanan
var kerawananAktif = true;

// Tangani klik tombol "Matikan Kerawanan"
document.getElementById('toggleKerawananButton').addEventListener('click', function () {
    if (kerawananAktif) {
        map.removeLayer(kerawananLayer);
        kerawananAktif = false;
        document.getElementById('kerawananStatusText').textContent = 'Mati ';
        document.getElementById('toggleKerawananButton').classList.remove('btn-primary');
            document.getElementById('toggleKerawananButton').classList.add('btn-danger');
        

    } else {
        updateGeoJsonLayer(activeYear);
        kerawananLayer.addTo(map);
        kerawananAktif = true;
        document.getElementById('kerawananStatusText').textContent = 'Aktif ';
        document.getElementById('toggleKerawananButton').classList.remove('btn-danger');
            document.getElementById('toggleKerawananButton').classList.add('btn-primary');

        // Aktifkan kembali semua tombol tahun
       
    }
});



var kedalamanLayer = null;


    // Inisialisasi variabel untuk melacak tombol tahun yang aktif
    var borderLayer = null; // Menyimpan referensi ke polygon yang memiliki border
    var activeYear = null;
    var geoJsonLayer = null;
    var activeYear = '2'; // Default year is '2'
// Perbarui lapisan GeoJSON secara otomatis saat halaman dimuat
updateGeoJsonLayer(activeYear);

// Tambahkan kelas 'active' ke tombol tahun 2
document.querySelector('button[data-year="2"]').classList.add('active');
document.querySelector('button[data-year="2"]').style.backgroundColor = "#007BFF";

    // Fungsi untuk membuat atau memperbarui lapisan GeoJSON berdasarkan tahun
    function updateGeoJsonLayer(year) {
    var url = "<?= base_url('geojson/') ?>" + year + "tahun.geojson";

    // Hapus lapisan GeoJSON yang ada jika ada
    if (geoJsonLayer) {
        map.removeLayer(geoJsonLayer);
    }

    if (borderLayer) {
        map.removeLayer(borderLayer);
        borderLayer = null; // Hapus referensi ke borderLayer
    }
    activeYear = year;

    // Jika Anda ingin melakukan sesuatu setelah mengganti tahun, Anda bisa menambahkannya di sini


   

  // Buat lapisan GeoJSON baru
geoJsonLayer = L.geoJson(null, {
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
        };

        
    },
    onEachFeature: function (feature, layer) {
    // Dapatkan GeoJSON dari layer yang diklik
    function onFeatureClick(e) {
    var layer = e.target; // Dapatkan lapisan yang diklik
    var feature = layer.feature; // Dapatkan fitur GeoJSON dari lapisan

    // Cek apakah borderLayer ada atau tidak
    if (borderLayer) {
        map.removeLayer(borderLayer); // Hapus jika sudah ada
        borderLayer = null;
    }

    // Buat borderLayer baru berdasarkan fitur yang diklik
    borderLayer = L.geoJSON(feature, {
    style: function (feature) {
        return {
            fillColor: '#ce318a', // Ganti 'warna-fill' dengan warna isi yang Anda inginkan
            fillOpacity: 0.7,
            color: '#ffffffff', // Ganti 'warna-stroke' dengan warna garis tepi yang Anda inginkan
            weight: 2, // Ganti dengan ketebalan garis yang Anda inginkan
            smoothFactor: 0.8,
           
        };
    }
}).addTo(map);


}
geoJsonLayer.eachLayer(function (layer) {
    layer.on('click', onFeatureClick);
});

        
        layer.bindPopup(
            "<b>KOTA/KABUPATEN:</b> " + feature.properties.WADMKK + "<br>" +
            "<b>KECATMATAN:</b> " + feature.properties.NAMOBJ + "<br>" +
            "<b>KEDALAMAN:</b> " + feature.properties.Kedalaman + "<br>" +
            "<b>LUAS WILAYAH:</b> " + feature.properties.Luas_Wilay+ " Ha"
        );


        layer.on('popupclose', function () {
        // Hapus borderLayer jika popup ditutup
        if (borderLayer) {
            map.removeLayer(borderLayer);
            borderLayer = null;
        }
    });
    }

    
});

// Ambil data GeoJSON dan tambahkan ke lapisan
$.getJSON(url, function (data) {
    geoJsonLayer.addData(data);
    geoJsonLayer.addTo(map);
});

// Update tombol tahun yang aktif
activeYear = year;

// Jika Anda ingin melakukan sesuatu setelah mengganti tahun, Anda bisa menambahkannya di sini


        // Jika Anda ingin melakukan sesuatu setelah mengganti tahun, Anda bisa menambahkannya di sini
    }
    
// Tangani klik tombol tahun
var yearButtons = document.getElementsByClassName('yearButton');
for (var i = 0; i < yearButtons.length; i++) {
    yearButtons[i].addEventListener('click', function () {
        // Periksa apakah tombol yang ditekan memiliki kelas 'active'
        var isActive = this.classList.contains('active');

        // Hapus kelas 'active' dari semua tombol tahun
        for (var j = 0; j < yearButtons.length; j++) {
            yearButtons[j].classList.remove('active');

            // Kembalikan warna default
            yearButtons[j].style.backgroundColor = yearButtons[j].getAttribute('data-default-color');

            // Kembalikan warna teks menjadi putih
            yearButtons[j].style.color = '#FFA500';
        }

        if (!isActive) {
            // Jika tombol tidak aktif, tambahkan kelas 'active' ke tombol yang ditekan
            this.classList.add('active');
            
            // Ganti warna tombol saat ditekan menjadi biru (#FFA500)
            this.style.backgroundColor = "#007BFF";

            var year = this.getAttribute('data-year');
            // Hanya memperbarui lapisan jika tahun yang berbeda ditekan
            if (year !== activeYear) {
                updateGeoJsonLayer(year);
            }
        } else {
            // Jika tombol aktif, hapus kelas 'active' dan perbarui lapisan ke default (semua tahun)
            activeYear = null;
            updateGeoJsonLayer('semua'); // Gantilah 'semua' dengan nilai default Anda jika ada
        }
        
    });
}
updateGeoJsonLayer(activeYear);







</script>



</body>
</html>
