<!DOCTYPE html>
<html>
<head>
    <title>Geojson</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    background-color: #198754 !important; /* Ganti dengan warna tombol yang diinginkan saat aktif */
    color: #fff !important; /* Warna teks putih */
    border: 1px solid #198754 !important;
}
.yearButton:active {
        background-color: #198754 !important; /* Ubah latar belakang menjadi biru saat tombol ditekan */
        color: #fff !important; /* Warna teks menjadi putih saat tombol ditekan */
        border: 1px solid #198754 !important; /* Ubah warna border saat tombol ditekan */
    }
html, body {
    overflow: hidden;
}
        #toggleMarkers {
    position: absolute;
    top: 133px;
    left: 210px;
    z-index: 1000;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;

}
/* CSS untuk memberi border hitam pada tombol */
.button-with-border {
    border: 1px solid black;
}/* CSS untuk kontainer tombol-tombol */
.kedalaman-buttons {
  position: absolute;
  bottom: 10px; /* Sesuaikan dengan jarak dari bawah */
  left: 10px; /* Sesuaikan dengan jarak dari kiri */
  padding: 10px;
  
  border-radius: 5px;
  z-index: 1000; /* Pastikan tombol-tombol ini muncul di atas peta */
}

/* CSS untuk tombol-tombol */
.kedalamanButton {
  margin: 5px;
  padding: 5px 10px;
  background-color: #198754;
  color: white;
  border: #198754;
  border-radius: 100px;
  cursor: pointer;
}

.kedalamanButton:hover {
  background-color: #198754;
}

.kedalamanButton.danger {
            background-color: #DC3545;
        }


        .sidebar {
        height: 40%;
        width: 290px;
        position: fixed;
        top: 50%;
        bottom: 500px; /* Atur margin bawah sesuai kebutuhan Anda */
        left: 10px; /* Atur margin kiri sesuai kebutuhan Anda */
        background-color: #fff;
        overflow-y: auto !important;
        padding: 15px;
        display: block !important;
        z-index: 950 !important;
        transform: translateY(-50%);
        border-radius: 0; /* Menghilangkan sudut runcing */
    }

    /* Gaya untuk konten di dalam sidebar */
    .sidebar-content {
        margin-bottom: 50px;
    }

    .legend-item {
        display: flex;
        align-items: center;
    }

    .legend-color {
        background-color: #98DAF1;
        width: 20px;
        height: 20px;
        margin-right: 10px;
        border: 1px solid #FFA500;
    }

    .legend-text {
        font-size: 16px;
    }

    .form-check {
        margin-left: auto;
    }

    .vr {
        border-left: 1px solid #FFA500;
        height: 40px;
        margin: 0 10px;
    }

    .form-check-input:checked {
            background-color: green !important;
        }

    
    </style>
</head>
<body>
<div id="map"></div> 

//fluktuasi
<button class="btn btn-warning text-white button"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#customModal"
        style="position: absolute; top: 133px; left: 5px; z-index: 1000;">Fluktuasi <i class="fa-solid fa-chart-simple" style="color: #198754;"></i>
</button>
<!-- Modal -->
<div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customModalLabel">Grafik Fluktuasi</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="grafik-container">
                    <div class="grafik-item">
                        <h6>Total Luas Wilayah (Kedalaman &lt; 1M)</h6>
                        <canvas id="chart_total_luas_kedalaman_1m" width="800" height="400"></canvas>
                    </div>
                    <div class="grafik-item">
                        <h6>Total Luas Wilayah (Kedalaman 1-2 M)</h6>
                        <canvas id="chart_total_luas_kedalaman_1_2m" width="800" height="400"></canvas>
                    </div>
                    <div class="grafik-item">
                        <h6>Total Luas Wilayah (Kedalaman 2-3 M)</h6>
                        <canvas id="chart_total_luas_kedalaman_2_3m" width="800" height="400"></canvas>
                    </div>
                    <div class="grafik-item">
                        <h6>Total Luas Wilayah (Kedalaman 3-5 M)</h6>
                        <canvas id="chart_total_luas_kedalaman_3_5m" width="800" height="400"></canvas>
                    </div>
                    <div class="grafik-item">
                        <h6>Total Luas Wilayah (Kedalaman &gt; 5M)</h6>
                        <canvas id="chart_total_luas_kedalaman_5m" width="800" height="400"></canvas>
                    </div>
                    <div class="grafik-item">
                        <h6>Total Luas Wilayah (Seluruh Kedalaman)</h6>
                        <canvas id="chart_total_luas_kedalaman_seluruh" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
//year
<div id="yearButtons" style="display: flex; flex-direction: column; align-items: center;">
    <div style="padding: 10px 0; border-top: 2px solid #198754; border-bottom: 2px solid #198754; text-align: center; width: 100%;">
        <strong style="color: #FFA500;">POTENSI BANJIR SUB DAS BENGKULU HILIR INTEGRASI HEC-RAS&ensp;</strong> <i style="color: #198754;" class="material-icons">flood</i>
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
//kerawanan
<div id="toggleKerawanan" style="position: absolute; top: 133px; left: 130px; z-index: 1000;">
    <button id="toggleKerawananButton" class="btn btn-success" type="button" style="font-size: 14px; padding: 7px 10px;">
        <i class="fa-solid fa-map" style="color: #ffa200;"></i>
        <span id="kerawananStatusText">Aktif</span>
    </button>
</div>
//marker
<div>
    <button id="toggleMarkers" class="btn btn-success" style="font-size: 14px; padding: 7px 10px;">
    <i class="fa-solid fa-location-dot" style="color: #FFA500;"></i>
        <span id="markerStatusText">Aktif</span>
    </button>
</div>

<div class="sidebar" style="border: 3px solid #FFA500; border-radius: 10px;">

    <div class="sidebar-content">
        <h2 style="color: #006200; text-align: center;">LEGENDA</h2>
     
        <div class="legend-item" style="padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #FFA500;">
            <span class="legend-color"></span>
            <span class="legend-text" data-kedalaman="< 1 m">Kedalaman &lt; 1 m</span>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="kedalamanButton1" data-kedalaman="< 1 m" checked>
                <label class="form-check-label" for="kedalamanButton1"></label>
            </div>
        </div>

        <div class="legend-item" style="padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #FFA500;">
            <span class="legend-color" style="background-color: #8F97E2;"></span>
            <span class="legend-text" data-kedalaman="1 - 2 m">Kedalaman 1 - 2 m</span>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="kedalamanButton2" data-kedalaman="1 - 2 m" checked>
                <label class="form-check-label" for="kedalamanButton2"></label>
            </div>
        </div>

        <div class="legend-item" style="padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #FFA500;">
            <span class="legend-color" style="background-color: #556CC9;"></span>
            <span class="legend-text" data-kedalaman="2 - 3 m">Kedalaman 2 - 3 m</span>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="kedalamanButton3" data-kedalaman="2 - 3 m" checked>
                <label class="form-check-label" for="kedalamanButton3"></label>
            </div>
        </div>

        <div class="legend-item" style="padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #FFA500;">
            <span class="legend-color" style="background-color: #234EAD;"></span>
            <span class="legend-text" data-kedalaman="3 - 5 m">Kedalaman 3 - 5 m</span>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="kedalamanButton4" data-kedalaman="3 - 5 m" checked>
                <label class="form-check-label" for="kedalamanButton4"></label>
            </div>
        </div>

        <div class="legend-item" style="padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #FFA500;">
            <span class="legend-color" style="background-color: #003895;"></span>
            <span class="legend-text" data-kedalaman="> 5 m">Kedalaman &gt; 5 m</span>
     
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="kedalamanButton5" data-kedalaman="> 5 m" checked>
                <label class="form-check-label" for="kedalamanButton5"></label>
            </div>
        </div>
    </div>
</div>

















<script>
var southWest = L.latLng(-4.0, 102.0); // Koordinat sudut barat daya batasan
var northEast = L.latLng(-3.5, 102.7); // Koordinat sudut timur laut batasan
var bounds = L.latLngBounds(southWest, northEast); // Buat batasan

var map = L.map('map', {
    center: [-3.783477635115412, 102.31586327842393],
    zoom: 13.1,
    minZoom: 12,
    maxBounds: bounds // Terapkan batasan area pada peta
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
        "Streets Map": mapboxStreets,
        "Satellite Map": mapboxSatellite,
        "Light Map": mapboxLight,
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
            document.getElementById('toggleMarkers').classList.remove('btn-success');
            document.getElementById('toggleMarkers').classList.add('btn-danger');
        } else {
            // Jika marker disembunyikan, tampilkan mereka
            markers.addTo(map);
            markersVisible = true;
            document.getElementById('markerStatusText').textContent = 'Aktif';
            document.getElementById('toggleMarkers').classList.remove('btn-danger');
            document.getElementById('toggleMarkers').classList.add('btn-success');
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
                weight: 0,
                fillOpacity: 0.7,
                smoothFactor: 0.2
            };
        }
    }).addTo(map);
    // Setel teks tombol ke "Matikan Kerawanan"    
    geoJsonLayer.addTo(map);
});
// Tombol untuk mengaktifkan atau menonaktifkan layer kerawanan
var kerawananAktif = true;
var geoJsonLayerKedalamanData = [];
// Tangani klik tombol "Matikan Kerawanan"
document.getElementById('toggleKerawananButton').addEventListener('click', function () {
    if (kerawananAktif) {
        map.removeLayer(kerawananLayer);
        kerawananAktif = false;
        document.getElementById('kerawananStatusText').textContent = 'Mati ';
        document.getElementById('toggleKerawananButton').classList.remove('btn-success');
        document.getElementById('toggleKerawananButton').classList.add('btn-danger');
    } else {
        // Hapus dulu layer kerawanan dari peta jika ada
        if (map.hasLayer(kerawananLayer)) {
            map.removeLayer(kerawananLayer);
        }
        // Tambahkan layer kerawanan kembali ke peta
        kerawananLayer.addTo(map).bringToBack(); // Menggunakan .bringToBack() untuk memastikan berada di bawah layer lain

        kerawananAktif = true;
        document.getElementById('kerawananStatusText').textContent = 'Aktif ';
        document.getElementById('toggleKerawananButton').classList.remove('btn-danger');
        document.getElementById('toggleKerawananButton').classList.add('btn-success');
    }
});


//tahun
{

    var borderLayer = null;
var geoJsonLayer = L.geoJSON().addTo(map); // Inisialisasi GeoJSON Layer
var activeYear = '2'; // Default year is '2'

// Perbarui lapisan GeoJSON saat halaman dimuat
updateGeoJsonLayer(activeYear);

// Tambahkan kelas 'active' ke tombol tahun 2
document.querySelector('button[data-year="2"]').classList.add('active');
document.querySelector('button[data-year="2"]').style.backgroundColor = "#007BFF";

// Fungsi untuk membuat atau memperbarui lapisan GeoJSON berdasarkan tahun
function updateGeoJsonLayer(year) {
    var url = "<?= base_url('geojson/') ?>" + year + "tahun.geojson";

    // Hapus lapisan yang ada jika ada
    if (geoJsonLayer) {
        map.removeLayer(geoJsonLayer);
    }

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
            function onFeatureClick(e) {
                var layer = e.target;
                var feature = layer.feature;

                // Hapus border dari polygon sebelumnya
                if (borderLayer) {
                    map.removeLayer(borderLayer);
                }

                // Buat border baru untuk polygon yang diklik
                borderLayer = L.geoJSON(feature, {
                    style: function (feature) {
                        return {
                            fillColor: '#ce318a',
                            fillOpacity: 1,
                            color: '#f6dbeb',
                            weight: 2,
                            smoothFactor: 1,
                        };
                    },
                }).addTo(map);
            }

            // Tambahkan event click pada setiap polygon
            layer.on('click', onFeatureClick);

            // Buat pop-up
            function createPopupText(properties) {
                return `
                    <b>KOTA/KABUPATEN:</b> ${properties.WADMKK}<br>
                    <b>KECAMATAN:</b> ${properties.NAMOBJ}<br>
                    <b>KEDALAMAN:</b> ${properties.Kedalaman}<br>
                    <b>LUAS WILAYAH:</b> ${properties.Luas_Wilay} Ha
                `;
            }

            layer.bindPopup(createPopupText(feature.properties));

            // Hapus border ketika pop-up ditutup
            layer.on('popupclose', function () {
                if (borderLayer) {
                    map.removeLayer(borderLayer);
                }
            });
        },
    });

    // Ambil data GeoJSON dari URL dan tambahkan ke peta
    $.getJSON(url, function (data) {
        geoJsonLayer.addData(data);
    });

    // Tambahkan lapisan GeoJSON ke peta
    geoJsonLayer.addTo(map);
    activeYear = year;
}

// Tangani klik tombol tahun
var yearButtons = document.getElementsByClassName('yearButton');
for (var i = 0; i < yearButtons.length; i++) {
    yearButtons[i].addEventListener('click', function () {
        var year = this.getAttribute('data-year');
        
        // Periksa apakah tahun yang dipilih sudah aktif atau tidak
        var isActive = this.classList.contains('active');
        
        // Hapus kelas 'active' dari semua tombol tahun
        for (var j = 0; j < yearButtons.length; j++) {
            yearButtons[j].classList.remove('active');
            yearButtons[j].style.backgroundColor = yearButtons[j].getAttribute('data-default-color');
            yearButtons[j].style.color = '#FFA500';
        }

        // Jika tahun yang dipilih belum aktif, aktifkan
        if (!isActive) {
            this.classList.add('active');
            this.style.backgroundColor = "#198754";

            // Update activeYear
            activeYear = year;

            // Perbarui lapisan sesuai dengan tahun yang dipilih
            updateGeoJsonLayer(activeYear);
        } else {
            // Jika tahun yang dipilih sudah aktif, nonaktifkan
            activeYear = null;
            updateGeoJsonLayer('semua');
        }

        // Hapus semua status penghapusan sebelumnya
        removedPolygons = {};

        // Mengaktifkan atau menonaktifkan tombol kedalaman sesuai dengan tahun yang dipilih
        enableKedalamanButtonsForYear(activeYear);
        
    });
}



enableKedalamanButtonsForYear(activeYear);

// Objek untuk melacak status polygon yang dihapus
var removedPolygons = {};

// Fungsi untuk mengaktifkan atau menonaktifkan tombol kedalaman sesuai dengan tahun yang dipilih
function enableKedalamanButtonsForYear(year) {
    var kedalamanButtons = document.getElementsByClassName('form-check-input');

    // Loop melalui semua checkbox kedalaman
    for (var i = 0; i < kedalamanButtons.length; i++) {
        if (year === 'semua' || year === activeYear) {
            // Aktifkan checkbox
            kedalamanButtons[i].disabled = false;
            kedalamanButtons[i].checked = true; // Set checkbox ke status tercentang
        } else {
            // Nonaktifkan checkbox
            kedalamanButtons[i].disabled = true;
            kedalamanButtons[i].checked = false; // Set checkbox ke status tidak tercentang
        }
    }
}

// Fungsi yang dipanggil saat checkbox berubah status
function handleCheckboxChange(checkbox) {
    var selectedKedalaman = checkbox.getAttribute('data-kedalaman');

    if (checkbox.checked) {
        activatePolygonByKedalaman(selectedKedalaman);
    } else {
        removePolygonByKedalaman(selectedKedalaman);
    }
}

// Ambil semua checkbox
var checkboxes = document.querySelectorAll('.form-check-input');
checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        handleCheckboxChange(this);
    });
});

// Fungsi untuk menghapus polygon berdasarkan kedalaman
function removePolygonByKedalaman(selectedKedalaman) {
    geoJsonLayer.eachLayer(function (layer) {
        var kedalaman = layer.feature.properties.Kedalaman;
        // Cek apakah kedalaman fitur sama dengan yang dipilih oleh pengguna
        if (kedalaman === selectedKedalaman) {
            // Hilangkan layer yang sesuai
            map.removeLayer(layer);
        }
    });
}

// Fungsi untuk mengaktifkan kembali polygon berdasarkan kedalaman
function activatePolygonByKedalaman(selectedKedalaman) {
    geoJsonLayer.eachLayer(function (layer) {
        var kedalaman = layer.feature.properties.Kedalaman;
        // Cek apakah kedalaman fitur sama dengan yang dipilih oleh pengguna
        if (kedalaman === selectedKedalaman) {
            // Periksa apakah layer sudah ada di peta sebelum menambahkannya
            if (!map.hasLayer(layer)) {
                // Tambahkan layer yang sesuai kembali ke peta
                map.addLayer(layer);
            }
        }
    });
}


}

{
 // Fungsi untuk mengambil dan menjumlahkan Luas_Wilay dari berkas GeoJSON dengan Kedalaman "< 1 m"
 function hitungTotalLuasWilayah(geoJSONFile, kedalaman, label, chartId, keterangan) {
        fetch(geoJSONFile)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Inisialisasi totalLuasWilayah menjadi 0
                let totalLuasWilayah = 0;
                // Loop melalui setiap fitur dalam data GeoJSON
                data.features.forEach(feature => {
                    // Ambil nilai "Kedalaman" dari setiap fitur
                    const kedalamanGeoJSON = feature.properties.Kedalaman;
                    // Periksa apakah "Kedalaman" sesuai dengan yang diharapkan
                    if (kedalamanGeoJSON === kedalaman) {
                        // Ambil nilai Luas_Wilay dari setiap fitur
                        const luasWilayah = feature.properties.Luas_Wilay;
                        // Jumlahkan ke totalLuasWilayah
                        totalLuasWilayah += luasWilayah;
                    }
                });
                console.log(`Total Luas Wilayah (Kedalaman ${keterangan}) ${label}:`, totalLuasWilayah);

                // Panggil fungsi untuk membuat atau memperbarui grafik dengan label yang sesuai
                updateChart(totalLuasWilayah, label, chartId, keterangan);
            })
            .catch(error => {
                console.error('Terjadi kesalahan saat membaca berkas GeoJSON:', error);
            });       
    }
    // Fungsi untuk mengambil dan menjumlahkan Luas_Wilay dari berkas GeoJSON dengan Kedalaman "< 1 m"
    function hitungTotalLuasWilayah1(geoJSONFile, kedalaman, label, chartId, keterangan) {
        fetch(geoJSONFile)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Inisialisasi totalLuasWilayah menjadi 0
                let totalLuasWilayah = 0;
                // Loop melalui setiap fitur dalam data GeoJSON
                data.features.forEach(feature => {
                    // Ambil nilai "Kedalaman" dari setiap fitur
                    const kedalamanGeoJSON = feature.properties.Kedalaman;
                    if (kedalamanGeoJSON) {
                        // Ambil nilai Luas_Wilay dari setiap fitur
                        const luasWilayah = feature.properties.Luas_Wilay;
                        // Jumlahkan ke totalLuasWilayah
                        totalLuasWilayah += luasWilayah;
                    }
                });
                // Debug: Log totalLuasWilayah
                console.log(`Total Luas Wilayah (Kedalaman ${keterangan}) ${label}:`, totalLuasWilayah);

                // Panggil fungsi untuk membuat atau memperbarui grafik dengan label yang sesuai
                updateChart(totalLuasWilayah, label, chartId, keterangan);
            })
            .catch(error => {
                console.error('Terjadi kesalahan saat membaca berkas GeoJSON:', error);
            });
            
    }
    // Data awal untuk X-axis dan dataset kosong
    const initialLabels = ['2 Tahun', '5 Tahun', '10 Tahun', '25 Tahun', '50 Tahun', '100 Tahun'];
    let datasetData1M = [];
    let datasetData1_2M = [];
    let datasetData2_3M = [];
    let datasetData3_5M = [];
    let datasetData5M = [];
    let datasetDataSeluruh = [];

    function updateChart(totalLuasWilayah, label, chartId, keterangan) {
        let datasetData;
        let backgroundColor;
        let borderColor;
        if (chartId === 'chart_total_luas_kedalaman_1m') {
            datasetData = datasetData1M;
            backgroundColor = '#98DAF180';
        } else if (chartId === 'chart_total_luas_kedalaman_1_2m') {
            datasetData = datasetData1_2M;
            backgroundColor = '#8F97E280';
        } else if (chartId === 'chart_total_luas_kedalaman_2_3m') {
            datasetData = datasetData2_3M;
            backgroundColor = '#556CC980';
        } else if (chartId === 'chart_total_luas_kedalaman_3_5m') {
            datasetData = datasetData3_5M;
            backgroundColor = '#234EAD80';
        } else if (chartId === 'chart_total_luas_kedalaman_5m') {
            datasetData = datasetData5M;
            backgroundColor = '#00389580';
        } else if (chartId === 'chart_total_luas_kedalaman_seluruh') {
            datasetData = datasetDataSeluruh;
            backgroundColor = '#FF573380'; // Ganti dengan warna sesuai kebutuhan
        }
        // Cek apakah label sudah ada di daftar labels
        const labelIndex = initialLabels.indexOf(label);
        if (labelIndex !== -1) {
            // Jika label sudah ada, update data di dataset sesuai dengan indeksnya
            datasetData[labelIndex] = totalLuasWilayah;
        } else {
            // Jika label belum ada, tambahkan label baru ke daftar labels dan data baru ke dataset
            initialLabels.push(label);
            datasetData.push(totalLuasWilayah);
        }
        var ctx = document.getElementById(chartId).getContext('2d');
        new Chart(ctx, {
    type: 'line', // Jenis grafik
    data: {
        labels: initialLabels, // Label X-axis
        datasets: [{
            label: `Total Luas Wilayah ${keterangan} (Ha)`, // Label untuk dataset
            data: datasetData, // Data grafik (total Luas Wilayah)
            backgroundColor:backgroundColor, // Warna area di bawah garis dengan alpha 0.5
            borderColor: backgroundColor, // Warna garis
            borderWidth: 1,
            fill: true, // Mengisi area di bawah garis
        }]
    },
    options: {
        plugins: {
            filler: {
                propagate: true
            }
        }
    }
});


    }
    // Panggil fungsi dengan berkas GeoJSON yang sesuai dan label yang sesuai untuk masing-masing tahun dan kedalaman
    hitungTotalLuasWilayah('geojson/2tahun.geojson', "< 1 m", '2 Tahun', 'chart_total_luas_kedalaman_1m', '< 1M');
    hitungTotalLuasWilayah('geojson/5tahun.geojson', "< 1 m", '5 Tahun', 'chart_total_luas_kedalaman_1m', '< 1M');
    hitungTotalLuasWilayah('geojson/10tahun.geojson', "< 1 m", '10 Tahun', 'chart_total_luas_kedalaman_1m', '< 1M');
    hitungTotalLuasWilayah('geojson/25tahun.geojson', "< 1 m", '25 Tahun', 'chart_total_luas_kedalaman_1m', '< 1M');
    hitungTotalLuasWilayah('geojson/50tahun.geojson', "< 1 m", '50 Tahun', 'chart_total_luas_kedalaman_1m', '< 1M');
    hitungTotalLuasWilayah('geojson/100tahun.geojson', "< 1 m", '100 Tahun', 'chart_total_luas_kedalaman_1m', '< 1M');

    hitungTotalLuasWilayah('geojson/2tahun.geojson', "1 - 2 m", '2 Tahun', 'chart_total_luas_kedalaman_1_2m', '1-2M');
    hitungTotalLuasWilayah('geojson/5tahun.geojson', "1 - 2 m", '5 Tahun', 'chart_total_luas_kedalaman_1_2m', '1-2M');
    hitungTotalLuasWilayah('geojson/10tahun.geojson', "1 - 2 m", '10 Tahun', 'chart_total_luas_kedalaman_1_2m', '1-2M');
    hitungTotalLuasWilayah('geojson/25tahun.geojson', "1 - 2 m", '25 Tahun', 'chart_total_luas_kedalaman_1_2m', '1-2M');
    hitungTotalLuasWilayah('geojson/50tahun.geojson', "1 - 2 m", '50 Tahun', 'chart_total_luas_kedalaman_1_2m', '1-2M');
    hitungTotalLuasWilayah('geojson/100tahun.geojson', "1 - 2 m", '100 Tahun', 'chart_total_luas_kedalaman_1_2m', '1-2M');

    hitungTotalLuasWilayah('geojson/2tahun.geojson', "2 - 3 m", '2 Tahun', 'chart_total_luas_kedalaman_2_3m', '2-3M');
    hitungTotalLuasWilayah('geojson/5tahun.geojson', "2 - 3 m", '5 Tahun', 'chart_total_luas_kedalaman_2_3m', '2-3M');
    hitungTotalLuasWilayah('geojson/10tahun.geojson', "2 - 3 m", '10 Tahun', 'chart_total_luas_kedalaman_2_3m', '2-3M');
    hitungTotalLuasWilayah('geojson/25tahun.geojson', "2 - 3 m", '25 Tahun', 'chart_total_luas_kedalaman_2_3m', '2-3M');
    hitungTotalLuasWilayah('geojson/50tahun.geojson', "2 - 3 m", '50 Tahun', 'chart_total_luas_kedalaman_2_3m', '2-3M');
    hitungTotalLuasWilayah('geojson/100tahun.geojson', "2 - 3 m", '100 Tahun', 'chart_total_luas_kedalaman_2_3m', '2-3M');

    hitungTotalLuasWilayah('geojson/2tahun.geojson', "3 - 5 m", '2 Tahun', 'chart_total_luas_kedalaman_3_5m', '3-5M');
    hitungTotalLuasWilayah('geojson/5tahun.geojson', "3 - 5 m", '5 Tahun', 'chart_total_luas_kedalaman_3_5m', '3-5M');
    hitungTotalLuasWilayah('geojson/10tahun.geojson', "3 - 5 m", '10 Tahun', 'chart_total_luas_kedalaman_3_5m', '3-5M');
    hitungTotalLuasWilayah('geojson/25tahun.geojson', "3 - 5 m", '25 Tahun', 'chart_total_luas_kedalaman_3_5m', '3-5M');
    hitungTotalLuasWilayah('geojson/50tahun.geojson', "3 - 5 m", '50 Tahun', 'chart_total_luas_kedalaman_3_5m', '3-5M');
    hitungTotalLuasWilayah('geojson/100tahun.geojson', "3 - 5 m", '100 Tahun', 'chart_total_luas_kedalaman_3_5m', '3-5M');

    hitungTotalLuasWilayah('geojson/2tahun.geojson', "> 5 m", '2 Tahun', 'chart_total_luas_kedalaman_5m', '> 5M');
    hitungTotalLuasWilayah('geojson/5tahun.geojson', "> 5 m", '5 Tahun', 'chart_total_luas_kedalaman_5m', '> 5M');
    hitungTotalLuasWilayah('geojson/10tahun.geojson', "> 5 m", '10 Tahun', 'chart_total_luas_kedalaman_5m', '> 5M');
    hitungTotalLuasWilayah('geojson/25tahun.geojson', "> 5 m", '25 Tahun', 'chart_total_luas_kedalaman_5m', '> 5M');
    hitungTotalLuasWilayah('geojson/50tahun.geojson', "> 5 m", '50 Tahun', 'chart_total_luas_kedalaman_5m', '> 5M');
    hitungTotalLuasWilayah('geojson/100tahun.geojson', "> 5 m", '100 Tahun', 'chart_total_luas_kedalaman_5m', '> 5M');

hitungTotalLuasWilayah1('geojson/2tahun.geojson', "", '2 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');
hitungTotalLuasWilayah1('geojson/5tahun.geojson', "", '5 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');
hitungTotalLuasWilayah1('geojson/10tahun.geojson', "", '10 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');
hitungTotalLuasWilayah1('geojson/25tahun.geojson', "", '25 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');
hitungTotalLuasWilayah1('geojson/50tahun.geojson', "", '50 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');
hitungTotalLuasWilayah1('geojson/100tahun.geojson', "", '100 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');
}
updateGeoJsonLayer(activeYear);
kerawananLayer.addTo(map).bringToBack();





</script>
</body>
</html>
