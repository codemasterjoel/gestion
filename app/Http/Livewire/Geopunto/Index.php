<?php

namespace App\Http\Livewire\Geopunto;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Geopunto;
use App\Models\Parroquia;
use App\Models\Comuna;
use App\Models\Eje;
use App\Models\Categoria;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $parroquias, $comunas, $ejes, $categorias, $geopuntos, $nombreResponsable, $telefonoResponsable;
    public $nombre, $lat, $lon, $parroquiaId, $comunaId, $ejeId, $categoriaId;
    public $search = '';

    public function render()
    {
        $this->parroquias = Parroquia::all();
        // $this->comunas = Comuna::all();
        $this->ejes = Eje::all();
        $this->categorias = Categoria::all();
        $this->geopuntos = Geopunto::all();

        // dd($geopuntos);
        return view('livewire.geopunto.index', ['geopuntos' => $this->geopuntos, 'categorias' => $this->categorias, 'parroquias' => $this->parroquias]);
    }
    public function updatedParroquiaId($id){
        $this->comunaId = null;
        $this->comunas = Comuna::where('parroquia_id', $id)->get();
        // $this->ejes = Eje::whereHas('parroquias', function($query) use ($id) {
        //     $query->where('parroquia_id', $id);
        // })->get();
    }
    public function limpiarCampos(){
        $this->resetValidation();
        $this->reset();
    }
}
