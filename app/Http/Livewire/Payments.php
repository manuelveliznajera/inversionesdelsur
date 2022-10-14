<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\Plan;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Payments extends Component
{
    public Payment $pay;
    public  $plan;
    public  $selected_id = 0;
    public $customer_id = 0, $date='', $amount = 0, $rate = 0,$start, $end, $frecuency_id = 0, $day=0,$method = 'Diario', $dias = []; 
   
    public $statusComponent = '';
    public $componentName = 'PAGOS', $action = 'Listado', $photo, $btnSaveEdit = true;
     
    public function mount($id){

        $this->plans=Plan::where('loan_id',$id)->get();
        $this->loans=Loan::where('id',$id)->get();
    }
    public function render()
    {

        return view('livewire.payments.component',[
            'plans'=>$this->plans,
            'loans'=>$this->loans,
            'customers' => Customer::orderBy('name', 'asc')->get(),
        ])->layout('layouts.theme.app');
    }

    public function Pago($plan,$id)
    {
        $planUpdate=Plan::where('number', $plan)->where('loan_id', $id)->get();
        $this->plan=$planUpdate;
       // dd($planUpdate);

        $this->action = 'Create';
        $this->dispatchBrowserEvent('modal-abrir');
    }
    public function Store()
    {
        //dd($this->plan[0]->loan_id);
        sleep(2);
//dd($this->amount);
        $interes=$this->amount/3;
        $capital=$interes*2;
        $payment = Payment::Create(
            [
                'user_id' =>Auth()->user()->id,
                'loan_id' => $this->plan[0]->loan_id,
                'amount' => floatval($this->amount),
                'interest' => floatval($interes),
                'amort' =>floatval($capital),
                'type' => 'ONTIME'
            ]
        );
        $payment->save();
        $total = floatval($this->plan[0]->payment);
        if ($this->amount==$total) {
            $this->plan[0]->proceso='cancelado';
        }else{
            $resta=floatval($total-$this->amount);
            $this->plan[0]->proceso='resta: '.strval($resta);
            $this->plan[0]->payment=$resta;



        }
        $this->plan[0]->save();
           
        $this->dispatchBrowserEvent('noty', ['msg' =>  'Pago Ejecutado', 'action' => 'close-modal']);
        $this->reset('amount');
        
    }

}
