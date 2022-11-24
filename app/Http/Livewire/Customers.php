<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Frecuency;
use App\Models\Loan;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Customers extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    public $name, $dpi, $phone, $address, $salary, $referencia, $age, $gender = 'Select', $foto1, $foto2, $foto3, $selected_id = 0;
    public $componentName = 'CLIENTES', $action = 'Listado', $photo, $btnSaveEdit = true;
    public $search;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|min:3|unique:customers',
        'dpi' => 'required|max:15',
        'phone' => 'required|max:10',
        'address' => 'required|min:10|max:255',
        'referencia'=>'required|min:10',
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function loadCustomers()
    {
        if (strlen($this->search)) {
            $this->resetPage();
            $customers = Customer::where('name', 'like', "%{$this->search}%")
                ->orWhere('address', 'like', "%{$this->search}%")
                ->orWhere('phone', 'like', "%{$this->search}%")
                ->paginate(5);
        } else {
            $customers = Customer::orderBy('id', 'desc')->paginate(10);
        }

        return $customers;
    }

    /*
    public function updatingSearch()
    {
        $this->resetPage();
    }
    */

    public function fPMT($rate, $num_of_payments, $PV, $FV = 0.00, $Type = 0)
    {
        $interest = $rate; // / 100;
        $xp = pow((1 + $interest), $num_of_payments);
        return ($PV * $interest * $xp / ($xp - 1) + $interest / ($xp - 1) * $FV) *
            ($Type == 0 ? 1 : 1 / ($interest + 1));
    }

    public function render()
    {

        return view('livewire.customers.component', [
            'customers' => $this->loadCustomers()
        ])->layout('layouts.theme.app');
    }
    public function dashboard()
    {

        return view('livewire.dashboard.component', [
            'customers' => $this->loadCustomers()
        ])->layout('layouts.theme.app');
    }
    public function Add()
    {
        $this->resetValidation();
        $this->action = 'CREAR NUEVO';
        $this->dispatchBrowserEvent('modal-open');
    }

    public function Edit(Customer $customer, $btnEnable = true)
    {
        $this->selected_id = $customer->id;
        $this->name = $customer->name;
        $this->dpi = $customer->dpi;
        $this->phone = $customer->phone;
        $this->address = $customer->address;
        $this->referencia = $customer->referencia;

        $this->foto1 = null;
        $this->foto2 = null;
        $this->foto3 = null;

        $this->action = 'EDITAR CLIENTE';
        $this->btnSaveEdit = $btnEnable;
        $this->dispatchBrowserEvent('modal-open');
    }

    public function showInfo(Customer $customer)
    {
        dd($customer);
    }

    public function Store()
    {
        sleep(2);

        $this->rules['name'] = $this->selected_id > 0 ? "required|min:3|unique:customers,name,{$this->selected_id}" : 'required|min:3|unique:customers';
        //$this->rules['dpi'] = $this->selected_id > 0 ? "nullable|unique:customers,dpi,{$this->selected_id}" : 'nullable|unique:customers|dpi';

        $validateDate = $this->validate();

        $foto1=null;
        $foto2=null;
        $foto3=null;

        if (!empty($this->foto1)) {
            if ($this->selected_id > 0) {
           
            }
      
            

            $foto1n = Str::random(10).'.'.$this->foto1->extension(); // 321654.png
            // $this->foto1->storeAs('public/customers', $foto1);
           
            $base=base_path().'/img';
            $this->foto1->storeAs($base, $foto1n); 
            // move_uploaded_file($this->foto1,'img/'.$foto1);
            //  $this->foto1->storeAs('uploads', $foto1);

         
            
            
            }
            if (!empty($this->foto2)) {
                $foto2 = uniqid() . '.' . $this->foto2->extension(); // 321654.png
                $base=base_path().'/public/img/';
                $this->foto2->storeAs($base, $foto2);  
                
            }if (!empty($this->foto3)) {
                $foto3 = uniqid() . '.' . $this->foto3->extension(); // 321654.png
                $this->foto3->storeAs('public/customers', $foto3);     
            }
            //dd($customer);
            $customer = Customer::updateOrCreate(
                ['id' => $this->selected_id],
                [
                'name'=>$validateDate['name'],
                'address'=>$validateDate['address'],
                'phone'=>$validateDate['phone'],
                'dpi'=>$validateDate['dpi'],
                'referencia'=>$validateDate['referencia'],
                'foto1'=>$foto1,
                'foto2'=>$foto2,
                'foto3'=>$foto3
              ]);
             
            
            $customer->save();
        $this->dispatchBrowserEvent('noty', ['msg' => $this->selected_id > 0 ? 'Cliente Actualizado' : 'Cliente Creado', 'action' => 'close-modal']);
        $this->reset('name', 'address',  'foto1', 'foto2','foto3',  'selected_id', 'phone','dpi', 'referencia');
    }



    public function updatedName()
    {
        $this->email = $this->name;
    }

    protected $listeners = ['searching'];

    public function searching($textValue)
    {
        $this->search = $textValue;
    }


    public function Destroy(Customer $customer)
    {
      //  dd($customer->id);
        $customerIn=Loan::where('customer_id',$customer->id)->first();
      //  $customer=Loan::where('customer_id')
      if ($customerIn!=null) {
        $this->dispatchBrowserEvent('noty', ['msg' => 'Cliente  No se puede Eliminar, tiene prestamos asignado']);
          return;
      }
     // dd($customerIn);
        $customer->delete();
        $this->dispatchBrowserEvent('noty', ['msg' => 'Cliente  Eliminado']);
    }
}
