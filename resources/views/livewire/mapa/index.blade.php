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
                            {{-- <x-maps-google id="map" :mapType="'satellite'"></x-maps-google> --}}
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
                position: new google.maps.LatLng({{$geopunto->lat}},{{$geopunto->lon}}),
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
