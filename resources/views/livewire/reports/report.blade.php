

<div>
    <!-- CONTENT AREA -->
    <div class="row">
        <div class="col-lg-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-10">
                            <h4><b> REPORTES </b>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="{{route('customers')}}"class="btn btn-primary">Imprimir</a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div wire:ignore class="col-sm-12 col-md-3">
                            CLIENTE
                            <input type="date" wire:model="fecha" id="" class="form-control">
                            <a href="">Agregar Cliente</a>
                        </div>
                       
                     
                    
                      
                     
                    </div>
                    <div class="table-responsive mt-4">
                        {{$statusComponent}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">PRESTAMO</th>
                                    <th class="text-center">DIA</th>
                                    <th class="text-center">PAGO Q</th>
                                    <th class="text-center">BALANCE</th>
                                    <th class="text-center">ACCION</th>

                                </tr>

                            </thead>
                            <tbody>
                                @forelse($pagos as $key => $item)
                                {{-- @if($key > 0) --}}
                                <tr>
                                    <td class="text-center">{{ $key}}</td>
                                    <td class="text-center">{{ $item->loan_id}}</td>
                                    <td class="text-center">{{ $item->date}}</td>
                                    <td class="text-center">{{ $item->payment}} %</td>
                                    <td class="text-center">{{ $item->balance}}</td>
                                    
                                    <td class="text-center">
                                        <a class="btn btn-success" href="{{ route('pagos',['id'=>$item->id,'name'=>$item->name])}}"> ver</a>
                                    </td>

                                </tr>
                                {{-- @endif --}}
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