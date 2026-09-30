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

    public $parroquias, $comunas, $ejes, $categorias, $geopuntos;
    public $parroquia_id, $comuna_id, $eje_id, $categoria_id;
    public $search = '';

    public function render()
    {
        $this->parroquias = Parroquia::all();
        $this->comunas = Comuna::all();
        $this->ejes = Eje::all();
        $this->categorias = Categoria::all();
        $this->geopuntos = Geopunto::all();

        // dd($geopuntos);
        return view('livewire.geopunto.index', ['geopuntos' => $this->geopuntos, 'categorias' => $this->categorias]);
    }
}
