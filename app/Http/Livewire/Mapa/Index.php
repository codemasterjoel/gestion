<?php

namespace App\Http\Livewire\Mapa;

use Livewire\Component;
use App\Models\Geopunto;


class Index extends Component
{
    public $estadoId, $divmapa = null;

    public function render()
    {
        //$this->nbcs = NBC::where('latitud', "<>", "")->get();
        $geopuntos = Geopunto::where('latitud', "<>", "")->get();

        return view('livewire.mapa.index', [
            'geopuntos' => $geopuntos,
        ]);
    }
    // public function updatedEstadoId($id)
    // {
    //     $geopuntos = Geopunto::where('estado_id', $this->estadoId);
    //     return view('livewire.mapa.index', [
    //         'nbcs' => $nbcs->get(),
    //     ]);
    // }
}