<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Frecuency;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $dpi, $phone, $address, $salary, $referencia, $age, $gender = 'Select', $avatar, $selected_id = 0;
    public $componentName = 'CUSTOMERS', $action = 'Listado', $photo, $btnSaveEdit = true;
    public $search;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|min:3|unique:customers',
        'dpi' => 'required|max:15',
        'phone' => 'required|max:10',
        'address' => 'required|min:10|max:255',
        'salary' => 'required',
        'age' => 'required',
        'gender' => 'required|not_in:Select',
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
            $customers = Customer::orderBy('name', 'desc')->paginate(5);
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
        $this->action = 'Create';
        $this->dispatchBrowserEvent('modal-open');
    }

    public function Edit(Customer $customer, $btnEnable = true)
    {
        $this->selected_id = $customer->id;
        $this->name = $customer->name;
        $this->dpi = $customer->dpi;
        $this->phone = $customer->phone;
        $this->address = $customer->address;
        $this->salary = $customer->salary;
        $this->age = $customer->age;
        $this->gender = $customer->gender;
        $this->referencia = $customer->referencia;

        $this->avatar = null;
        $this->action = 'Edit';
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

        $customer = Customer::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'name' => $this->name,
                'dpi' => $this->dpi,
                'phone' => $this->phone,
                'address' => $this->address,
                'salary' => $this->salary,
                'age' => $this->age,
                'gender' => $this->gender,
                'referencia'=>$this->referencia,
            ]
        );

        if (!empty($this->avatar)) {
            if ($this->selected_id > 0) {
                $tmpImg = $customer->avatar;
                if ($tmpImg != null && file_exists('storage/customers/' . $tmpImg)) {
                    unlink('storage/customers/' . $tmpImg);
                }
            }

            $customAvatarName = uniqid() . '.' . $this->avatar->extension(); // 321654.png
            $this->avatar->storeAs('storage/customers/', $customAvatarName);

            $customer->avatar = $customAvatarName;
            $customer->save();
        }

        $this->dispatchBrowserEvent('noty', ['msg' => $this->selected_id > 0 ? 'Customer Updated' : 'Cliente Created', 'action' => 'close-modal']);
        $this->reset('name', 'address', 'salary', 'avatar', 'age', 'gender', 'selected_id', 'phone','dpi', 'referencia');
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
        //dd($customer);
        $customer->delete();
        $this->dispatchBrowserEvent('noty', ['msg' => 'Customer Deleted']);
    }
}
