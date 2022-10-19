<?php

namespace App\Http\Livewire;

use App\Models\Frecuency;
use Livewire\Component;

class Frecuencies extends Component
{

    public Frecuency $frecuencia;
    public $name, $days; 
    public $componentName = 'FRECUENCIAS', $action = 'Listado', $search;

    public function mount()
    {
        $this->frecuencia = new Frecuency();
    }
    protected $rules = [
        'frecuencia.name' => 'required',
        'frecuencia.days' => 'required'
    ];

    public function loadFre()
    {
        if (strlen($this->search) > 0) {
            $this->resetPage();
            $frecuencias = Frecuency::where('name', 'like', "%{$this->search}%")
                ->orWhere('days', 'like', "%{$this->search}%")
                ->get();
        } else {
            $frecuencias = Frecuency::orderBy('name', 'desc')->get();
        }
        return $frecuencias;
    }
    public function render()
    {
        return view('livewire.frecuencies.component', [
            'frecuencias' => $this->loadFre()
        ])->layout('layouts.theme.app');
    }

    public function Add()
    {
        $this->frecuencia = new Frecuency();
        $this->action = 'Create';
        $this->dispatchBrowserEvent('modal-open');
    }

    public function Store()
    {
        sleep(2);
        $this->frecuencia['name']=$this->name;
        $this->frecuencia['days']=$this->days;

       // dd($this->frecuencia);
 
        $this->frecuencia->save();

        $this->dispatchBrowserEvent('noty', ['msg' => 'Frecuencia Agregada', 'action' => 'close-modal']);
        $this->frecuencia = new Frecuency();
    }
}
