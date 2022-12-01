
<div>
    <!-- CONTENT AREA -->
    <div class="row">
        <div class="col-lg-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-10">
                            <h4><b> CLIENTES  </b>
                            </h4>
                        </div>

                        <div class="col-sm-12 col-md-2 d-flex justify-content-end p-3">
                            <button class="btn btn-primary btn-sm" wire:click="Add" type="button">Agregar Cliente Nuevo</button>
                        </div>

                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Telefono</th>
                                    <th class="text-center">Dpi</th>
                                    <th class="text-center">Direccion</th>
                                    <th class="text-center">Referencia</th>
                                    <th class="text-center">Foto 1</th>
                                    <th class="text-center">Foto 2</th>
                                    <th class="text-center">Foto 3</th>

                                    <th class="text-center">Acciones</th>
                                </tr>

                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                <tr>
                                    <td class="text-left">
                                        {{$customer->id}} 
                                    </td>
                                    <td class="text-center">{{$customer->name}}</td>
                                    <td class="text-center">{{$customer->phone}}</td>
                                    <td class="text-center">{{$customer->dpi}}</td>
                                    <td class="text-center">{{$customer->address}}</td>
                                    <td class="text-center">{{$customer->referencia}}</td>
                                    <td class="text-center">
                                        @if ($customer->foto1)        
                                        <a target="_blank" href="{{asset('storage/customers/'.$customer->foto1)}}">
                                          <img src="{{asset('img/uploads/'.$customer->foto1)}}" class="img-fluid" width="64px" alt="">
                                         </a>
                                         @else
                                         no foto
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($customer->foto2)
                                        <a target="_blank" href="{{url('storage/customers/'.$customer->foto2)}}">
                                            <img src="/public/customers/'.{{$customer->foto2}}" class="img-fluid" width="64px" alt="">
                                         </a>
                                         @else
                                         No foto
                                        @endif  
                                     </td>
                                     <td class="text-center">
                                        @if ($customer->foto3)
                                        <a target="_blank" href="{{url('storage/customers/'.$customer->foto3)}}">
                                            <img src="{{asset('/storage/customers/'.$customer->foto3)}}" class="img-fluid" width="64px" alt="">
                                         </a>
                                         @else
                                         No foto
                                        @endif  
                                     </td>
                                    <td class="text-center">

                                        <button wire:click="Edit({{ $customer->id }}, false)" class="btn btn-info btn-sm">
                                            <i class="far fa-eye fa-lg "></i>
                                        </button>

                                        <button wire:click="Edit({{ $customer->id }})" class="btn btn-warning btn-sm">
                                            <i class="far fa-edit fa-lg "></i>
                                        </button>

                                        <button onclick="Confirmar({{ $customer->id }})" class="btn btn-danger btn-sm">
                                            <i class="far fa-trash-alt fa-lg "></i>
                                        </button>

                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="6">
                                        NO DATA
                                    </td>
                                </tr>
                                @endforelse


                            </tbody>
                        </table>

                    </div>
                    <div class="mt-2">
                        {{$customers->links()}}
                    </div>

                </div>
            </div>
        </div>


    </div>

    @include('livewire.customers.form')
    @include('livewire.customers.scripts')






</div>
