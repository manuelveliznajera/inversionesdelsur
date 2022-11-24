<?php

namespace App\Http\Livewire\Reports;

use App\Models\Customer;
use App\Models\Frecuency;
use Livewire\Component;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Rate;
use Carbon\Carbon;
use Livewire\WithPagination;

class Report extends Component
{
    use WithPagination;
 
    protected $paginationTheme = 'bootstrap';

    public $customer_id = 0, $amount = 0, $rate = 0, $rate_id = 1, $years = 1, $frecuency_id = 0, $method = 'Diario', $plan = [],$plans;
    public $statusComponent = '',$fecha;

    public function loadpagos()
    {
        if (strlen($this->fecha)) {
            $this->resetPage();
            $pagos = Plan::where('date', $this->fecha)
                ->paginate(5);
        } else {
            $pagos = Plan::orderBy('id', 'desc')->paginate(10);
        }

        return $pagos;
    }
    public function render()
    {
        $daynow = Carbon::now();
        return view('livewire.reports.report', [
            'customers' => Customer::orderBy('name', 'asc')->get(),
            'rates' => Rate::where('state', 'Active')->orderBy('id', 'asc')->get(),
            'frecuencies' => Frecuency::orderBy('name', 'asc')->get(),
            'loans'=>Loan::orderBy('id','asc')->get(),
            'pagos'=> $this->loadpagos(),
        ])->layout('layouts.theme.app');
    }
}
