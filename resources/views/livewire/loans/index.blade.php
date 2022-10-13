

<div>
    <!-- CONTENT AREA -->
    <div class="row">
        <div class="col-lg-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-10">
                            <h4><b> Nuevo Prestamo </b>
                            </h4>
                        </div>

                        <div class="col-sm-12 col-md-2 d-flex justify-content-end p-3">
                            <div class="btn-group" role="group">
                                <button wire:click.prevent="Save" class="btn btn-sm btn-dark">SAVE LOAN </button>
                                <button wire:click="previewPDF" class="btn btn-sm btn-primary">PREVIEW PDF </button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="{{route('customers')}}"class="btn btn-primary">Agregar Cliente</a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div wire:ignore class="col-sm-12 col-md-3">
                            CLIENTE
                            <select wire:model="customer_id" id="tomselect"  class="form-control form-control-sm bg-white">
                                <option value="" class="bg-white text-white">SELECCIONE EL CLIENTE</option>
                                @foreach($customers as $customer)
                                <option class="text-white" value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            <a href="">Agregar Cliente</a>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            CANTIDAD
                            <input wire:model.lazy="amount" type="number" id="amount" class="form-control form-control-sm text-center" min="1">
                        </div>
                        <div class="col-sm-12 col-md-2">
                            INTERESES (%)
                            <select wire:model="rate_id" wire:change="setValueRate" class="form-select form-select-sm">
                            
                                @foreach($rates as $rate)
                                @if ($rate->id==1)
                                <option selected value="{{ $rate->id }}">{{ number_format($rate->percent),0 }}</option>
                                    
                                @endif
                                @endforeach
                            </select>

                        </div>
{{--                         
                        <div class="col-sm-12 col-md-2">
                            FRECUENCY OF PAYMENT
                            <select wire:model="frecuency_id" class="form-select form-select-sm">
                                <option value="0" selected disabled>SELECT</option>
                                @foreach($frecuencies as $frecuency)
                                <option value="{{ $frecuency->id }}">{{ $frecuency->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="col-sm-12 col-md-2">
                            METODO DE PAGO
                            <select wire:model="method" class="form-select form-select-sm">
                                <option value="Diario">Método Diario</option>
                                <option value="Quincenal">Método Quincenal</option>
                                <option value="Mensual">Método Mensual</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        {{$statusComponent}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">CLIENTE</th>
                                    <th class="text-center">PRESTAMO</th>
                                    <th class="text-center">INTERESS</th>
                                    <th class="text-center">AUTORIZO</th>
                                    <th class="text-center">ACCION</th>

                                </tr>

                            </thead>
                            <tbody>
                                @forelse($loans as $key => $item)
                                @if($key > 0)
                                <tr>
                                    <td class="text-center">{{ $key}}</td>
                                    <td class="text-center">{{ $item->customer->name}}</td>
                                    <td class="text-center">{{ $item->amount}}</td>
                                    <td class="text-center">{{ $item->rate->percent}} %</td>
                                    <td class="text-center">{{ $item->user->name}}</td>
                                    <td class="text-center">{{ $item->created_at}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success" href="{{ route('pagos',['id'=>$item->id,'name'=>$item->name])}}"> ver</a>
                                    </td>

                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td>NO RESULTS</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                {{-- @if(count($plan)>0)
                                <tr class="text-warning">
                                    <td>RESUMEN</td>
                                    <td>TOTAL PAGADO: {{ $plan[0]['TOTAL PAGADO'] }}</td>
                                    <td>INTERESES: {{ $plan[0]['INTERESES'] }}</td>
                                    <td>AMORTIZACION:{{ $plan[0]['AMORTIZACION'] }}</td>
                                    <td>BALANCE: {{ $plan[0]['PENDIENTE'] }}</td>
                                </tr>
                                @endif --}}
                            </tfoot>
                        </table>

                    </div>
                    <div class="mt-2">

                    </div>

                </div>
            </div>
        </div>


    </div>





    @include('livewire.loans.script')
    <style>
        .ts-control {
            padding: 0px !important;
            border-style: none;
            border-width: 0px !important;
        }

        #tomselect-ts-control {
            background-color: #ffffff !important;
        }

        #tomselect-ts-dropdown {
            color: #009688 !important
        }

        .ts-control>.item {
            color: #009688 !important;
        }
    </style>
    <script>

    </script>
</div>