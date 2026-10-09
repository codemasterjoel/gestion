<?php

namespace App\Http\Livewire\Reporte;

use Livewire\Component;


use App\Models\Parroquia;
use App\Models\Geopunto;
use App\Models\Categoria;
use App\Models\EjeParroquia;
use App\Models\Comuna;


class Index extends Component
{
    public $geopuntos, $parroquias, $categorias, $categoriaId, $parroquiaId, $comunaId, $comunas, $ejeId, $ejesparroquias = null; //campos select

    public function render()
    {
        $this->parroquias = Parroquia::all();
        $this->geopuntos = Geopunto::all();
        $this->categorias = Categoria::all();

        return view('livewire.reporte.index');
    }
    public function updatedparroquiaId($id)
    {
        $this->geopuntos = Geopunto::where('parroquia_id', $id)->get();
        $this->ejesparroquias = EjeParroquia::where('parroquia_id', $id)->get();
        $this->comunas = Comuna::where('parroquia_id', $id)->get();
    }
    
}
