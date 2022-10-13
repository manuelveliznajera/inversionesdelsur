<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class Dashboard extends Component
{
    public $search;
    protected $paginationTheme = 'bootstrap';

    public function loadCustomers()
    {
        if (strlen($this->search)) {
            $this->resetPage();
            $customers = Customer::where('name', 'like', "%{$this->search}%")
                ->orWhere('address', 'like', "%{$this->search}%")
                ->orWhere('phone', 'like', "%{$this->search}%")
                ->paginate(5);
        } else {
            $customers = Customer::orderBy('name', 'desc')->paginate(5);
        }

        return $customers;
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'customers' => $this->loadCustomers()
        ])->layout('layouts.theme.app');
    }

    
}
