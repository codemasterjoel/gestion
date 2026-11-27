<div class="main-content mt-5">
    <div class="content" id="page-content-wrapper">
        <div class="container card bg-white">
            <div class="section">
                <h3 class="text-2xl text-cyan-400 font-semibold text-center">MAPA DE LOS NBC</h3>
                <div class="team">
                    <div class="row">
                        <div style="margin-bottom: 10px;">
                            <select wire:model.live="estadoId" id="filtroEstado" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                <option value="">Todos</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div wire:ignore id="map" style= "width: 100%; height: 600px;" class="mb-4"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <!-- Estilos de Leaflet -->
                                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

                                <div class="mb-4 flex justify-between items-center">
                                    <h2 class="text-xl font-bold text-gray-800">Visor Territorial - Comunas y Circuitos</h2>
                                    <button
                                        type="button"
                                        wire:click="cargarPoligonos"
                                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                        Actualizar Capa
                                    </button>
                                </div>

                                <!-- Contenedor protegido con wire:ignore -->
                                <div wire:ignore>
                                    <div id="mapa-gis" style="height: 600px; width: 100%; border-radius: 8px; z-index: 1;"></div>
                                </div>

                                <!-- Script de Leaflet -->
                                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
                                <script>
                                    document.addEventListener('livewire:init', () => {
                                        const map = L.map('mapa-gis').setView([10.4806, -66.9036], 12);

                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            maxZoom: 19,
                                            attribution: '&copy; OpenStreetMap contributors'
                                        }).addTo(map);

                                        let capaPoligonos = null;

                                        function estiloPoligono(feature) {
                                            return {
                                                fillColor: '#2563eb',
                                                weight: 2,
                                                opacity: 1,
                                                color: '#1e3a8a',
                                                dashArray: '3',
                                                fillOpacity: 0.35
                                            };
                                        }

                                        function enCadaPoligono(feature, layer) {
                                            if (feature.properties && feature.properties.ComuCircu) {
                                                layer.bindPopup(`
                                                    <div class="p-1">
                                                        <span class="text-xs text-gray-500 uppercase font-semibold">Comuna / Circuito</span>
                                                        <p class="text-sm font-bold text-gray-900">${feature.properties.ComuCircu}</p>
                                                    </div>
                                                `);
                                            }

                                            layer.on({
                                                mouseover: function (e) {
                                                    const target = e.target;
                                                    target.setStyle({
                                                        weight: 3,
                                                        color: '#f59e0b',
                                                        fillOpacity: 0.6
                                                    });
                                                    target.bringToFront();
                                                },
                                                mouseout: function (e) {
                                                    if (capaPoligonos) {
                                                        capaPoligonos.resetStyle(e.target);
                                                    }
                                                }
                                            });
                                        }

                                        function renderizarCapa(geoJsonData) {
                                            if (capaPoligonos) {
                                                map.removeLayer(capaPoligonos);
                                            }

                                            capaPoligonos = L.geoJSON(geoJsonData, {
                                                style: estiloPoligono,
                                                onEachFeature: enCadaPoligono
                                            }).addTo(map);

                                            if (geoJsonData && geoJsonData.features && geoJsonData.features.length > 0) {
                                                map.fitBounds(capaPoligonos.getBounds(), { padding: [20, 20] });
                                            }
                                        }

                                        // Carga inicial
                                        renderizarCapa(@json(json_decode($geoJsonPoligonos)));

                                        // Actualización dinámica cuando se dispara 'poligonos-actualizados' desde Livewire
                                        Livewire.on('poligonos-actualizados', ({ geojson }) => {
                                            renderizarCapa(geojson);
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <x-maps-google id="map" :mapType="'satellite'"></x-maps-google> --}}
                            <!-- Add script to the <head> of your page to load the embeddable map component -->
                            <script type="module" src="https://js.arcgis.com/5.1/embeddable-components/"></script>
                            <!-- Add custom element to <body> of your page -->
                            <arcgis-embedded-map style="height:200%;width:100%;" item-id="9d204897e0934abea2a3fa4310767913" theme="light" legend-enabled basemap-gallery-enabled time-zone-label-enabled center="-67.00621692898312,10.468939978585597"scale="144447.638572" portal-url="https://innovartech.maps.arcgis.com"></arcgis-embedded-map>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function initMap() 
    {
        var map = new google.maps.Map(document.getElementById('map'),
        {
            zoom: 6.5,
            center:new google.maps.LatLng(7.735217273856046,-65.326115365625),
        });

        @foreach ($geopuntos as $geopunto)
            var marker{{$geopunto->id}}
            const contentString{{ $geopunto->id }} =
                '<div id="content" style="color:black;">' +
                    '<p class="uppercase"><b>{{ $geopunto->nombre }}</b></p><br>' +
                    '<div id="bodyContent">'+   
                    "</div>" +
                "</div>";
                const infowindow{{$geopunto->id}} = new google.maps.InfoWindow({
                content: contentString{{$geopunto->id}},
                });    

            marker{{$geopunto->id}} = new google.maps.Marker({
                map: map,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng({{$geopunto->latitud}},{{$geopunto->longitud}}),
                title: '{{ $geopunto->nombre }}',
            });

            marker{{$geopunto->id}}.addListener("click", () => {
                infowindow{{$geopunto->id}}.open({
                    anchor: marker{{$geopunto->id}},
                    map,
                    shouldFocus: false,
                });
            });                       
        @endforeach   
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZhH6WXRQpmvkrpZ6w-kBIQTqOwHuPncI&callback=initMap&v=weekly" defer></script>
