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
    top: 175px;
    right: 40px;
    z-index: 1000;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;

}
    </style>
</head>
<body>
//,map
<div id="map"></div> 


//fluktuasi
  <button class="btn btn-warning text-white"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#customModal"
        style="position: absolute; top: 70px; right: 40px; z-index: 1000;">Fluktuasi <i class="fa-solid fa-chart-simple" style="color: #004cff;"></i>
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

                    <!-- Grafik Seluruh Kedalaman -->
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

<button class="btn btn-warning text-white"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#customKedalamanModal"
        style="position: absolute; top: 120px; right: 40px; z-index: 1000;">
    Kedalaman <i class="fa fa-tint" aria-hidden="true" style="color: #004cff;"></i>
</button>

<!-- Modal "Kedalaman" -->
<div class="modal fade" id="customKedalamanModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="customModalLabel">Pilih Kedalaman</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox1m" checked>
                    <label class="form-check-label" for="checkbox1m">&lt;1m</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox2m" checked>
                    <label class="form-check-label" for="checkbox2m">1-2m</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox3m" checked>
                    <label class="form-check-label" for="checkbox3m">2-3m</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox5m" checked>
                    <label class="form-check-label" for="checkbox5m">3-5m</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="checkbox5mPlus" checked>
                    <label class="form-check-label" for="checkbox5mPlus">&gt;5m</label>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Close</button>
                <button id="saveChangesButton" class="btn btn-primary" type="button" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>










//year

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
//kerawanan
<div id="toggleKerawanan" style="position: absolute; top: 220px; right: 40px; z-index: 1000;">
    <button id="toggleKerawananButton" class="btn btn-primary" type="button" style="font-size: 14px; padding: 7px 10px;">
        <i class="fa-solid fa-map" style="color: #ffa200;"></i>
        <span id="kerawananStatusText">Aktif</span>
    </button>
</div>



//marker
<div>
    <button id="toggleMarkers" class="btn btn-primary" style="font-size: 14px; padding: 7px 10px;">
    <i class="fa-solid fa-location-dot" style="color: #FFA500;"></i>
        <span id="markerStatusText">Aktif</span>
    </button>
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
var borderLayer = null;
var geoJsonLayer = L.geoJSON().addTo(map); // Inisialisasi GeoJSON Layer
var activeYear = '2'; // Default year is '2'

// Perbarui lapisan GeoJSON saat halaman dimuat
updateGeoJsonLayer(activeYear);

// Tambahkan kelas 'active' ke tombol tahun 2
document.querySelector('button[data-year="2"]').classList.add('active');
document.querySelector('button[data-year="2"]').style.backgroundColor = "#007BFF";

    // Fungsi untuk membuat atau memperbarui lapisan GeoJSON berdasarkan tahun
    function updateGeoJsonLayer(year, checkbox1mChecked, checkbox2mChecked, checkbox3mChecked, checkbox5mChecked, checkbox5mPlusChecked) {
    var url = "<?= base_url('geojson/') ?>" + year + "tahun.geojson";

    if (geoJsonLayer) {
        map.removeLayer(geoJsonLayer);
    }

    if (borderLayer) {
        map.removeLayer(borderLayer);
        borderLayer = null;
    }
    activeYear = year;

    // Ambil status checkbox
    var checkbox1mChecked = document.getElementById('checkbox1m').checked;
    var checkbox2mChecked = document.getElementById('checkbox2m').checked;
    var checkbox3mChecked = document.getElementById('checkbox3m').checked;
    var checkbox5mChecked = document.getElementById('checkbox5m').checked;
    var checkbox5mPlusChecked = document.getElementById('checkbox5mPlus').checked;

    geoJsonLayer = L.geoJson(null, {
        filter: function (feature) {
            var kedalaman = feature.properties.Kedalaman;
            return (checkbox1mChecked && kedalaman === "< 1 m") ||
                (checkbox2mChecked && kedalaman === "1 - 2 m") ||
                (checkbox3mChecked && kedalaman === "2 - 3 m") ||
                (checkbox5mChecked && kedalaman === "3 - 5 m") ||
                (checkbox5mPlusChecked && kedalaman === "> 5 m");
        },
        style: function (feature) {
            var kedalaman = feature.properties.Kedalaman;
            var fillColor;

            if (kedalaman === "< 1 m") {
                fillColor = '#98DAF1';
            } else if (kedalaman === "1 - 2 m") {
                fillColor = '#8F97E2';
            } else if (kedalaman === "2 - 3 m") {
                fillColor = '#556CC9';
            } else if (kedalaman === "3 - 5 m") {
                fillColor = '#234EAD';
            } else if (kedalaman === "> 5 m") {
                fillColor = '#003895';
            }

            return {
                color: 'none',
                fillColor: fillColor,
                fillOpacity: 1.0,
                weight: 0,

            };
        },
        onEachFeature: function (feature, layer) {
            function onFeatureClick(e) {
                var layer = e.target;
                var feature = layer.feature;

                if (borderLayer) {
                    map.removeLayer(borderLayer);
                    borderLayer = null;
                }

                borderLayer = L.geoJSON(feature, {
                    style: function (feature) {
                        return {
                            fillColor: '#ce318a',
                            fillOpacity: 0.7,
                            color: '#f6dbeb',
                            weight: 2,
                            smoothFactor: 0.8,
                        };
                    }
                }).addTo(map);
            }

            geoJsonLayer.eachLayer(function (layer) {
                layer.on('click', onFeatureClick);
            });

            function createPopupText(properties) {
                return `
                    <b>KOTA/KABUPATEN:</b> ${properties.WADMKK}<br>
                    <b>KECAMATAN:</b> ${properties.NAMOBJ}<br>
                    <b>KEDALAMAN:</b> ${properties.Kedalaman}<br>
                    <b>LUAS WILAYAH:</b> ${properties.Luas_Wilay} Ha
                `;
            }

            layer.bindPopup(createPopupText(feature.properties));

            layer.on('popupclose', function () {
                if (borderLayer) {
                    map.removeLayer(borderLayer);
                    borderLayer = null;
                }
            });
        }
    });

    $.getJSON(url, function (data) {
        geoJsonLayer.addData(data);
        geoJsonLayer.addTo(map);
    });

    activeYear = year;

    document.getElementById('saveChangesButton').addEventListener('click', function () {
    var checkbox1mChecked = document.getElementById('checkbox1m').checked;
    var checkbox2mChecked = document.getElementById('checkbox2m').checked;
    var checkbox3mChecked = document.getElementById('checkbox3m').checked;
    var checkbox5mChecked = document.getElementById('checkbox5m').checked;
    var checkbox5mPlusChecked = document.getElementById('checkbox5mPlus').checked;

    updateGeoJsonLayer(activeYear, checkbox1mChecked, checkbox2mChecked, checkbox3mChecked, checkbox5mChecked, checkbox5mPlusChecked);
});



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

// Mendapatkan elemen-elemen yang dibutuhkan
var kedalamanModalButton = document.querySelector('[data-bs-target="#customKedalamanModal"]');
var saveChangesButton = document.getElementById('saveChangesButton');

// Variabel untuk melacak apakah tombol "Save Changes" dalam modal ditekan atau tidak
var saveChangesPressed = false;

// Fungsi untuk mengaktifkan perubahan ketika tombol "Save Changes" dalam modal ditekan
function activateChanges() {
    // Di sini, Anda dapat menambahkan kode untuk mengaktifkan perubahan sesuai dengan yang Anda butuhkan.
    // Contohnya, Anda bisa mengaktifkan checkbox atau menjalankan fungsi lain yang perlu diaktifkan.
    // Namun, saya tidak memiliki informasi detail tentang apa yang harus diaktifkan, jadi saya hanya akan memberikan contoh dasar.
    
    // Misalnya, kita akan mengaktifkan checkbox dengan ID "checkbox1m" ketika "Save Changes" ditekan:
    document.getElementById('checkbox1m').disabled = false;

    saveChangesPressed = true; // Menandai bahwa "Save Changes" telah ditekan
}

// Fungsi untuk mereset perubahan yang dilakukan oleh "Save Changes"
function resetChanges() {
    // Di sini, Anda dapat menambahkan kode untuk mereset perubahan yang dibuat oleh "Save Changes".
    // Contohnya, Anda bisa mereset checkbox ke keadaan awal atau menjalankan fungsi lain yang diperlukan untuk mereset perubahan.
    // Sama seperti sebelumnya, saya hanya akan memberikan contoh dasar.
    
    // Misalnya, kita akan mereset checkbox dengan ID "checkbox1m" ke keadaan awal:
    document.getElementById('checkbox1m').disabled = true;
    document.getElementById('checkbox1m').checked = true;

    saveChangesPressed = false; // Menandai bahwa perubahan telah direset
}

// Tangani klik tombol "Save Changes" dalam modal
saveChangesButton.addEventListener('click', function () {
    if (saveChangesPressed) {
        // Jika "Save Changes" telah ditekan sebelumnya, kita akan mereset perubahan
        resetChanges();
    } else {
        // Jika "Save Changes" belum pernah ditekan sebelumnya, kita akan mengaktifkan perubahan
        activateChanges();
    }
});

// Tangani klik tombol "Kedalaman"
kedalamanModalButton.addEventListener('click', function () {
    // Jika tombol "Kedalaman" ditekan, kita akan mereset perubahan (jika ada)
    resetChanges();
});










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

                // Debug: Log totalLuasWilayah
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

        if (chartId === 'chart_total_luas_kedalaman_1m') {
            datasetData = datasetData1M;
            backgroundColor = '#98DAF1';
        } else if (chartId === 'chart_total_luas_kedalaman_1_2m') {
            datasetData = datasetData1_2M;
            backgroundColor = '#8F97E2';
        } else if (chartId === 'chart_total_luas_kedalaman_2_3m') {
            datasetData = datasetData2_3M;
            backgroundColor = '#556CC9';
        } else if (chartId === 'chart_total_luas_kedalaman_3_5m') {
            datasetData = datasetData3_5M;
            backgroundColor = '#234EAD';
        } else if (chartId === 'chart_total_luas_kedalaman_5m') {
            datasetData = datasetData5M;
            backgroundColor = '#003895';
        } else if (chartId === 'chart_total_luas_kedalaman_seluruh') {
            datasetData = datasetDataSeluruh;
            backgroundColor = '#FF5733'; // Ganti dengan warna sesuai kebutuhan
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
            type: 'bar', // Jenis grafik
            data: {
                labels: initialLabels, // Label X-axis
                datasets: [{
                    label: `Total Luas Wilayah ${keterangan} (Ha)`, // Label untuk dataset
                    data: datasetData, // Data grafik (total Luas Wilayah)
                    backgroundColor: backgroundColor, // Ganti dengan warna sesuai kebutuhan
                    borderWidth: 1
                }]
            },
            options: {
                // Konfigurasi grafik disini
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

// Panggil fungsi dengan berkas GeoJSON yang sesuai untuk "Seluruh Kedalaman"
hitungTotalLuasWilayah1('geojson/2tahun.geojson', "", '2 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');
hitungTotalLuasWilayah1('geojson/5tahun.geojson', "", '5 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');
hitungTotalLuasWilayah1('geojson/10tahun.geojson', "", '10 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');
hitungTotalLuasWilayah1('geojson/25tahun.geojson', "", '25 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');
hitungTotalLuasWilayah1('geojson/50tahun.geojson', "", '50 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');
hitungTotalLuasWilayah1('geojson/100tahun.geojson', "", '100 Tahun', 'chart_total_luas_kedalaman_seluruh', 'Seluruh');

}







{updateGeoJsonLayer(activeYear);}







</script>



</body>
</html>
