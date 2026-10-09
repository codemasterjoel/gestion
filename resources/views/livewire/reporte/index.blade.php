<div class="main-content mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div>
                        <h3 class="text-2xl text-cyan-400 font-semibold text-center">REPORTES DE GEOPUNTOS</h3>
                    </div>
                </div>

                <div class="col-md-12 px-4 pt-4">
                    <form action="/reportegeopunto" method="GET">
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 mb-xl-0 pt-4">
                                <div class="flex items-center justify-center">
                                    <div class="w-full rounded-lg">
                                        <div class="flex">
                                            <span class="bg-cyan-400 px-3 py-[0.25rem] rounded-tl-lg rounded-bl-lg text-white font-bold">PARROQUIA</span>
                                            <select class="w-full pl-3 border rounded-r-lg text-neutral-900 border-solid border-neutral-900 outline-2 font-bold" wire:model.live="parroquiaId" required>
                                                <option value="">Seleccione</option>
                                                @foreach( $parroquias as $parroquia )
                                                    <option value="{{ $parroquia->id }}">{{ $parroquia->nombre }}</option>
                                                @endforeach
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
                                            <span class="bg-cyan-400 px-3 py-[0.25rem] rounded-tl-lg rounded-bl-lg text-white font-bold">EJE</span>
                                            <select class="w-full pl-3 border rounded-r-lg text-neutral-900 border-solid border-neutral-900 outline-2 font-bold" wire:model.live="ejeId" required>
                                                @if (is_null($ejesparroquias))
                                                    <option value="">SELECCIONE PARROQUIA PRIMERO</option>
                                                @else
                                                    
                                                    <option value="">Seleccione</option>
                                                    @foreach( $ejesparroquias as $ejeparroquia )
                                                        <option value="{{ $ejeparroquia->eje->id }}">{{ $ejeparroquia->eje->nombre }}</option>
                                                    @endforeach
                                                @endif
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
                                                @if (is_null($comunas))
                                                    <option value="">SELECCIONE PARROQUIA PRIMERO</option>
                                                @else
                                                    <option value="">Seleccione</option>
                                                    @foreach( $comunas as $comuna )
                                                        <option value="{{ $comuna->id }}">{{ $comuna->nombre }}</option>
                                                    @endforeach
                                                @endif
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
                                                @foreach( $categorias as $categoria )
                                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('categoriaId') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 pt-2">
                                <button type="submit" class="bg-gradient-to-r btn from-cyan-400 to-cyan-600 text-white" wire:click.prevent="guardar()">GENERAR REPORTE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>