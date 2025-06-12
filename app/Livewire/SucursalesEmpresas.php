<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\Sucursal;
use Livewire\Component;

class SucursalesEmpresas extends Component
{
    public $empresas;
    public $sucursales = [];
    public $empresaId = null;
    public $sucursalId = null;
    public $sucursal = null;

    public function mount(){
        $this->empresas = Cliente::all();
        $this->sucursales = collect();
    }

    public function render()
    {
        return view('livewire.sucursales-empresas');
    }

    public function updatedEmpresaId($id):void{
        $this->sucursales = Sucursal::where('id_cliente', $id)->get();
        if($this->sucursal && $this->sucursal->first()){
            $this->sucursal =  $this->sucursal->first()['id_sucursal'];
        }else{
            $this->sucursal = null;
        }
    }
}
