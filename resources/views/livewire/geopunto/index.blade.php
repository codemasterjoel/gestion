<div class="main-content mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                        <div>
                            <h5 class="mb-2 font-bold">REGISTRO DE PUNTOS TERRITORIALES</h5>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <input wire:model.live="search" type="text" placeholder="Filtrar por Nombre" class="w-30 px-4 py-2 border border-solid rounded-lg outline-2 font-bold">
                            <!-- <button wire:click="crear()" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; NUEVO NBC</button> -->
                            <button type="button" class="btn bg-gradient-primary btn-sm mb-0 font-bold" data-bs-toggle="modal" data-bs-target="#exampleModal">NUEVO GEOPUNTO</button>
                            {{-- <a href="/nbc/crear/" wire:navigate class="btn bg-gradient-primary btn-sm mb-0 font-bold">+&nbsp; NUEVO NBC</a> --}}
                        </div>
                    </div>
                    @if(session()->has('success')== 'success')
                        @include('livewire.components.success')
                    @endif
                    @if(session()->has('editado')== 'editado')
                        @include('livewire.components.editado')
                    @endif
                    @if(session()->has('mensaje')== 'delete')
                        @include('livewire.components.delete')
                    @endif
                    @if ($geopuntos->count())
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-dark font-weight-bolder">#</th>
                                            <th class="text-uppercase text-dark font-weight-bolder ps-2">NOMBRE</th>
                                            <th class="text-center text-uppercase text-dark font-weight-bolder">PARROQUIA</th>
                                            <th class="text-center text-uppercase text-dark font-weight-bolder">EJES</th>
                                            <th class="text-center text-uppercase text-dark font-weight-bolder">COMUNA</th>
                                            <th class="text-center text-uppercase text-dark font-weight-bolder">CATEGORÍA</th>
                                            <th class="text-center text-uppercase text-dark font-weight-bolder">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $indice =0; ?>
                                        @foreach ($geopuntos as $valor)
                                        <?php $indice += 1; ?>
                                        <tr><td class="ps-4"><p class=" font-weight-bold mb-0"><?php echo $indice; ?></p></td>
                                            <td class="text-center text-uppercase"><p class=" text-dark font-weight-bold mb-0">{{$valor->nombre}}</p></td>
                                            <td class="text-center text-uppercase"><p class=" text-dark font-weight-bold mb-0">{{isset($valor->parroquia->nombre) ? $valor->parroquia->nombre : ''}}</p></td>
                                            <td class="text-center text-uppercase"><p class=" text-dark font-weight-bold mb-0">{{isset($valor->eje->nombre) ? $valor->eje->nombre : ''}}</p></td>
                                            <td class="text-center text-uppercase"><p class=" text-dark font-weight-bold mb-0">{{isset($valor->comuna->nombre) ? $valor->comuna->nombre : ''}}</p></td>
                                            <td class="text-center text-uppercase"><p class=" text-dark font-weight-bold mb-0">{{isset($valor->categoria->nombre) ? $valor->categoria->nombre : ''}}</p></td>
                                            {{-- <td class="text-center text-uppercase"><p class=" text-dark font-weight-bold">{{$lsb->estatus ? 'activo' : 'inactivo'}}</p></td> --}}
                                            <td class="text-center"><a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Editar NBC">
                                                {{-- <a wire:click="editar('{{$nbc->id}}')" class="text-success px-2 py-1 mb-0" type="button"><span class="material-symbols-outlined">person_edit</span></a> --}}
                                                <button wire:click="editar('{{$valor->id}}')" type="button" class="text-success px-2 py-1 mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="material-symbols-outlined">person_edit</span></button>                                                 
                                                {{-- <a href="{{route('nbc.editar', [$nbc->id])}}" class=" text-success px-2 py-1 mb-0" type="button"><span class="material-symbols-outlined">person_edit</span></a> --}}
                                                <a wire:click="borrar('{{$valor->id}}')" class=" text-danger font-bold py-2 px-4"><span class="material-symbols-outlined">person_cancel</span></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    @else
                        <div class="card-dody px-4 pt-2 py-8 pb-2">
                            <strong class="px-4 mt-8 font-bold">No existen Resultados</strong>
                        </div>
                    @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5 mt-4 text-2xl text-cyan-400 font-bold text-center">REGISTRAR NUEVO PUNTO TERRITORIAL COMUNITARIO</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 mb-xl-0 pt-4">
                                    <div class="flex items-center justify-center">
                                        <div class="w-full rounded-lg">
                                            <div class="flex">
                                                <span class="bg-cyan-400 px-3 py-[0.25rem] rounded-tl-lg rounded-bl-lg text-white font-bold">Parroquia</span>
                                                <select class="w-full pl-3 border rounded-r-lg text-neutral-900 border-solid border-neutral-900 outline-2 font-bold" wire:model.live="parroquiaId" required>
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                            @error('parroquiaId')<div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 mb-xl-0 pt-4">
                                    <div class="flex items-center justify-center">
                                        <div class="w-full rounded-lg">
                                            <div class="flex">
                                                <span class="bg-cyan-400 px-3 py-[0.25rem] rounded-tl-lg rounded-bl-lg text-white font-bold">Eje</span>
                                                <select class="w-full pl-3 border rounded-r-lg text-neutral-900 border-solid border-neutral-900 outline-2 font-bold" wire:model.live="ejeId" required>
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                            @error('ejeId')<div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-xl-0">
                                    <div class="flex items-center justify-center pt-4"> {{-- campo estado --}}
                                        <div class="w-full rounded-lg">
                                            <div class="flex">
                                                <span class="bg-cyan-400 py-[0.25rem] px-3 rounded-tl-lg rounded-bl-lg text-white font-bold">Comuna o Circuito Comunal</span>
                                                <select class="flex-auto w-[1px] pl-3 border border-solid rounded-r-lg border-slate-900 text-slate-900 outline-2 font-bold" wire:model="comunaId" required>
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                            @error('comunaId') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-xl-0">
                                    <div class="flex items-center justify-center pt-4"> {{-- campo categoria --}}
                                        <div class="w-full rounded-lg">
                                            <div class="flex">
                                                <span class="bg-cyan-400 py-[0.25rem] px-3 rounded-tl-lg rounded-bl-lg text-white font-bold">CATEGORÍA</span>
                                                <select class="flex-auto w-[1px] pl-3 border border-solid rounded-r-lg border-slate-900 text-slate-900 outline-2 font-bold" wire:model="categoriaId" required>
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                            @error('categoriaId') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="flex items-stretch pt-4"> {{-- campo Nombre del NBC --}}
                                <span class="flex bg-cyan-400 font-bold text-white items-center whitespace-nowrap rounded-l-lg border border-r-0 border-solid border-neutral-900 px-3 py-[0.25rem] text-center">Nombre</span>
                                <input wire:model="NombreNBC" type="text" class="w-full flex-auto relative pl-3 border border-solid rounded-r-lg font-bold text-neutral-900 text-uppercase outline-2 border-neutral-900" />
                            </div>
                            @error('NombreNBC')<div class="text-danger">{{ $message }}</div> @enderror

                            <div class="row"> {{-- campo responsable --}}
                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 mb-xl-0">
                                    <div class="flex items-center justify-center pt-4">
                                        <div class="w-full rounded-lg">
                                            <div class="flex">
                                                <span class="bg-cyan-400 px-3 py-[0.25rem] rounded-tl-lg rounded-bl-lg text-white font-bold">RESPONSABLE</span>
                                                <input wire:model="NombreResponsable" type="text" class="w-full pl-3 border border-solid uppercase rounded-r-lg font-bold text-neutral-900 outline-2 border-slate-900" />
                                            </div>
                                            @error('NombreResponsable')<div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 mb-xl-0">
                                    <div class="flex items-center justify-center pt-4">
                                        <div class="w-full rounded-lg">
                                            <div class="flex">
                                                <span class="bg-cyan-400 px-3 py-[0.25rem] rounded-tl-lg rounded-bl-lg text-white font-bold">TELEFONO</span>
                                                <input wire:model="TelefonoResponsable" type="text" class="w-full pl-3 border border-solid uppercase rounded-r-lg font-bold text-neutral-900 outline-2 border-slate-900" />
                                            </div>
                                            @error('TelefonoResponsable')<div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-subcategories card-plain">
                                <div class="card-body">
                                    <div class="col-sm-12">
                                        <h3 class=" mt-4 text-2xl text-cyan-400 font-bold text-center">GEOREFERENCIACIÓN</h3>
                                    </div>
                                    <div class="items-center">
                                        <div wire:ignore id="map" style= "width: 100%; height: 600px;" class="mb-4"></div>
                                    </div>
                                    <div class="row">
                                        <label>COORDENADAS UTM</label>
                                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 mb-xl-0 mt-2">
                                            <input wire:model="lat" type="text" name="latitud" value="" id="latitud" class="form-control">
                                            @error('lat')<div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 mb-xl-0 mt-2">
                                            <input wire:model="lon" type="text" name="longitud" value="" id="longitud" class="form-control">
                                            @error('lon')<div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="w-32 bg-gradient-to-r from-red-400 to-red-600 text-white py-2 rounded-lg mx-auto block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 mb-2" wire:click.prevent="limpiarCampos()" data-bs-dismiss="modal">Salir</button>
                    <button type="submit" class="w-32 bg-gradient-to-r from-cyan-400 to-cyan-600 text-white py-2 rounded-lg mx-auto block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 mb-2" wire:click.prevent="guardar()">GUARDAR</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
  var marker;
  var coords = {};
  initMap = function () 
  {
    navigator.geolocation.getCurrentPosition(
      function (position){
        coords =  {
          lng: position.coords.longitude,
          lat: position.coords.latitude
        };
        setMapa(coords);
      },function(error){console.log(error);});
  }
  function setMapa (coords)
  {
    var map = new google.maps.Map(document.getElementById('map'),
    {
      zoom: 13,
      center:new google.maps.LatLng(coords.lat,coords.lng),
    });
    marker = new google.maps.Marker({
      map: map,
      draggable: true,
      animation: google.maps.Animation.DROP,
      position: new google.maps.LatLng(coords.lat,coords.lng),

    });
    marker.addListener( 'dragend', function (event)
    {
        document.getElementById("latitud").value = this.getPosition().lat();
        document.getElementById("longitud").value = this.getPosition().lng();

        document.getElementById("latitud").dispatchEvent(new Event('input'));
        document.getElementById("longitud").dispatchEvent(new Event('input'));
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZhH6WXRQpmvkrpZ6w-kBIQTqOwHuPncI&callback=initMap&v=weekly" defer></script>

