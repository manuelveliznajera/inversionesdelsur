<div>
    <!-- CONTENT AREA -->
    <div class="row">
        <div class="col-lg-12 layout-spacing layout-top-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    
                </div>
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between ">
                        <div class="col-sm-12 col-md-10">
                            <h4><b>  PRESTAMO A NOMBRE DE: {{ $loans[0]->customer->name }}  </b>
                            </h4>
                            <h5><b>  PRESTAMO NUMERO: 0000{{ $loans[0]->id }}  </b>
                            </h5>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 mr-5 p-3">
                            <h1 class="badge badge-light-success">  TOTAL DE PRESTAMO: Q{{ $loans[0]->amount }}  
                            </h1>
                           
                        </div>
                       

                    </div>
                   
                    <div class="table-responsive mt-4">
                        {{$statusComponent}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#PAGO</th>
                                    <th class="text-center">FECHA</th>
                                    <th class="text-center">CUOTA</th>
                                    <th class="text-center">INTERES</th>
                                    <th class="text-center">CAPITAL</th>
                                    <th class="text-center">PENDIENTE</th>



                                    <th class="text-center">ESTADO</th>
                                    <th class="text-center">ACCION</th>

                                </tr>

                            </thead>
                            <tbody>
                                @forelse($plans as $key => $item)
                              
                                <tr>
                                    <td class="text-center">{{ $item->number}}</td>
                                    <td class="text-center">{{ $item->date}}</td>
                                    <td class="text-center">{{ $item->payment}}</td>
                                    <td class="text-center">{{ $item->interest}}</td>
                                    <td class="text-center">{{ $item->amort}}</td>

                                    <td class="text-center">{{ $item->balance}}</td>


                                    @if ($item->proceso=='pendiente')
                                    <td class="  text-center"> <span class="badge badge-info">{{ $item->proceso}}</span></td>
                                @else
                                <td class="  text-center"> <span class="badge badge-danger">{{ $item->proceso}}</span></td>

                                    @endif

                                    <td class="text-center">
                                        {{-- <a class="btn btn-warning" href="{{ route('pagos',['id'=>$item->id,'name'=>$item->name])}}"> Abonar</a> --}}
                                        {{-- <a class="btn btn-success" href="{{ route('pagos',['id'=>$item->id,'name'=>$item->name])}}"> Cancelar</a> --}}

                                        <button wire:click="Pago({{$item->number}}, {{$item->loan_id}})" class="btn btn-success btn-sm">
                                            <i class="far fa-edit fa-lg ">Pagar</i>
                                        </button>
                                    </td>
                                   
                                </tr>
                               
                                @empty
                                <tr>
                                    <td>NO TIENE PRESTAMO</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                {{-- @if(count($plans)>0)
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





    @include('livewire.payments.form')
    @include('livewire.payments.scripts')
</div>
