<?php

namespace App\Http\Livewire\Geopunto;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Geopunto;
use App\Models\Parroquia;
use App\Models\Comuna;
use App\Models\Eje;
use App\Models\Categoria;
use App\Models\EjeParroquia;


class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $parroquias, $ejesparroquias, $comunas, $ejes, $categorias, $geopuntos, $nombreResponsable, $telefonoResponsable;
    public $nombre, $latitud, $longitud, $parroquiaId, $comunaId, $ejeId, $categoriaId, $id, $foto;
    public $search = '';

    public function render()
    {
        $this->parroquias = Parroquia::all();
        // $this->comunas = Comuna::all();
        //$this->ejes = Eje::all();
        $this->categorias = Categoria::all();
        $this->geopuntos = Geopunto::all();

        // dd($geopuntos);
        return view('livewire.geopunto.index', ['geopuntos' => $this->geopuntos, 'categorias' => $this->categorias, 'parroquias' => $this->parroquias]);
    }
    public function updatedParroquiaId($id){
        $this->comunaId = null;
        $this->comunas = Comuna::where('parroquia_id', $id)->get();
        $this->ejesparroquias = EjeParroquia::where('parroquia_id', $id)->get();
        // dd($this->ejes);
        //dd($this->parroquiaId);
        // $this->ejes = Eje::whereHas('parroquias', function($query) use ($id) {
        //     $query->where('parroquia_id', $id);
        // })->get();
    }
    public function limpiarCampos(){
        $this->resetValidation();
        $this->reset();
    }
    public function save(){
        // $this->validate([
        //     'nombre' => 'required|string|max:255',
        //     'lat' => 'required|numeric',
        //     'lon' => 'required|numeric',
        //     'parroquiaId' => 'required|exists:parroquias,id',
        //     'comunaId' => 'required|exists:comunas,id',
        //     'ejeId' => 'required|exists:ejes,id',
        //     'categoriaId' => 'required|exists:categorias,id',
        // ]);

        Geopunto::updateOrCreate(['id'=> $this->id], [
            'nombre' => $this->nombre,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'parroquia_id' => $this->parroquiaId,
            'comuna_id' => $this->comunaId,
            'eje_id' => $this->ejeId,
            'categoria_id' => $this->categoriaId,
            //'direccion'=> $this->direccion,
            //'descripcion'=> $this->descripcion,
            'nombreResponsable'=> $this->nombreResponsable,
            'telefonoResponsable'=> $this->telefonoResponsable,
            'foto'=> $this->foto,
        ]);

        session()->flash('success', 'Geopunto creado exitosamente');
        $this->reset();
        $this->dispatch('cerrarModal');
    }
    public function editar($id){
        $geopunto = Geopunto::find($id);
        $this->id = $geopunto->id;
        $this->nombre = $geopunto->nombre;
        $this->latitud = $geopunto->latitud;
        $this->longitud = $geopunto->longitud;
        $this->parroquiaId = $geopunto->parroquia_id;
        $this->comunaId = $geopunto->comuna_id;
        $this->ejeId = $geopunto->eje_id;
        $this->ejesparroquias = EjeParroquia::where('parroquia_id', $this->parroquiaId)->get();
        $this->categoriaId = $geopunto->categoria_id;
        $this->nombreResponsable = $geopunto->nombreResponsable;
        $this->telefonoResponsable = $geopunto->telefonoResponsable;
    }
    public function updatedEjeId($id){
        $this->comunaId = null;
        $this->comunas = Comuna::where('parroquia_id', $id)->get();
        $this->ejesparroquias = EjeParroquia::where('parroquia_id', $id)->get();
        // dd($this->ejes);
        //dd($this->parroquiaId);
        // $this->ejes = Eje::whereHas('parroquias', function($query) use ($id) {
        //     $query->where('parroquia_id', $id);
        // })->get();
    }
}
