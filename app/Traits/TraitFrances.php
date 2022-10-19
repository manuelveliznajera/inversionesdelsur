<?php

namespace App\Traits;

use Carbon\Carbon;

trait TraitFrances
{
    private static $decimales = 2;
    // monto de pago
    function PMT($interest, $num_of_payments, $pv, $fv = 0.00, $Type = 0)
    {
        $expo = pow((1 + $interest), $num_of_payments);

        return ($pv * $interest * $expo / ($expo - 1) + $interest / ($expo - 1) * $fv) *
            ($Type == 0 ? 1 : 1 / ($interest + 1));
    }

    public function PayM($rate, $amount, $years) // pagos mensuales (1,2,3)
    {
        $interes = (0.01 * ($rate)) / 12;
        $monto = $amount;
        $periods = $years * 12;

        $pay = $this->PMT($interes, $periods, $monto);
        return $pay;
    }

    public function PlanMensual($rate, $amount, $years)
    {
        $prestamo = $amount;
        $tipo = (0.01 * ($rate)) / 12;
        $meses = $years * 12;
        $cuota = round($this->PayM($rate, $amount, $years), 2);
        $tabla = collect();
        //dd($cuota);

        //variables dinámicas
        $INTERESES = 0;
        $TINTERESES = 0;
        $AMORTIZACION = 0;
        $TAMORTIZACION = 0;
        $TCUOTAS = 0;
        $PENDIENTE = $prestamo;

        for ($i = 1; $i <= $meses; $i++) {
            $INTERESES = round($PENDIENTE * $tipo, 2);
            $TINTERESES += $INTERESES;
            $AMORTIZACION = round($cuota - $INTERESES, 2);
            $TAMORTIZACION += $AMORTIZACION;
            $PENDIENTE -= $AMORTIZACION;
            $TCUOTAS += $cuota;

            $payDate = Carbon::now()->addMonth($i == 1 ? 1 : $i);

            if ($i == 1) {
                $tabla = collect([[
                    'FECHA' => $payDate->toDateString(),
                    'CUOTA' => $cuota,
                    'AMORTIZACION' => $AMORTIZACION,
                    'INTERESES' => $INTERESES,
                    'PENDIENTE' => $PENDIENTE
                ]]);
            } else {
                $tabla->push([
                    'FECHA' => $payDate->toDateString(),
                    'CUOTA' => $cuota,
                    'AMORTIZACION' => $AMORTIZACION,
                    'INTERESES' => $INTERESES,
                    'PENDIENTE' => $PENDIENTE
                ]);
            }
        }
        // add totales / sumatoria
        $tabla->prepend([
            'RESUMEN' => '',
            'TOTAL PAGADO' => $TCUOTAS,
            'AMORTIZACION' => $TAMORTIZACION,
            'INTERESES' => $TINTERESES,
            'PENDIENTE' => $PENDIENTE
        ]);

        return $tabla;
    }
    public function PlanDiario( $cantidad)
    {
        $prestamo = intval($cantidad);
        $porcentajeSum=$cantidad/2;
        $dias = 100;
        $cuotaDiaria = ($prestamo+$porcentajeSum)/100;
        $pagointeres=$cuotaDiaria/3;
        $tabla = collect();
        $PENDIENTE = $prestamo+$porcentajeSum;
        $INTERESES = $porcentajeSum;
        $AMORTIZACION = $prestamo;
        $TCUOTAS = 0;

        

        for ($i = 0; $i < $dias; $i++) {
            
              
                 $INTERESES -= $pagointeres; 
                 $AMORTIZACION -=$pagointeres*2;
                 $PENDIENTE -= $cuotaDiaria;

            $payDate = Carbon::now()->addDay($i);
            
            if ($i == 0) {
            $payDate = Carbon::now();

            

                $tabla = collect([[
                   // 'FECHA' => $payDate->toDateString(),
                   'FECHA'=>$payDate->toDateString(),
                    'CUOTA' => $cuotaDiaria,
                    'PENDIENTE' => $prestamo+$porcentajeSum,
                    'INTERESES'=>$porcentajeSum,
                    'AMORTIZACION' => $prestamo,

                ]]);
                $INTERESES += $pagointeres; 
                $AMORTIZACION +=$pagointeres*2;
                $PENDIENTE += $cuotaDiaria;
            } else {
                $tabla->push([
                    'FECHA' => $payDate->toDateString(),
                    'CUOTA' => $cuotaDiaria,
                    'PENDIENTE' => $PENDIENTE,
                    'INTERESES'=>$INTERESES,
                    'AMORTIZACION' => $AMORTIZACION,
                       
                ]);
            }
        }
        // add totales / sumatoria
        $tabla->prepend([
            'RESUMEN' => '',
            'TOTAL PAGADO' => $TCUOTAS,
            'PENDIENTE' => $PENDIENTE
        ]);

        return $tabla;
    }
    public function PlanSemanal( $cantidad )
    {
        $prestamo = intval($cantidad);
       // $porcentaje = $interes*10;
        $porcentajeSum=$cantidad/2;
        $prestamoMasInteres = $prestamo+$porcentajeSum;
        $cuotaDiaria = ($prestamo+$porcentajeSum)/100;
        $prestamoTotal = $prestamo+$porcentajeSum;
        $cuotaSemanal =$cuotaDiaria*7;
        $tabla = collect();
        //dd($cuota);

        //variables dinámicas
        $INTERESES = $porcentajeSum;
        $TINTERESES = 0;
        $AMORTIZACION = $prestamo;
        $TCUOTAS = 0;
        $PENDIENTE = $prestamoMasInteres;
        $pagointeres=$cuotaSemanal/3;
        $pendienteTemp=false;

        for ($i = 0; $i <= 15; $i++) {
            if ($PENDIENTE<$cuotaSemanal) {
                $cuotaTemp = $PENDIENTE/3;
                $INTERESES=$cuotaTemp;
                $AMORTIZACION =$cuotaTemp*2;
                $cuotaSemanal=$PENDIENTE;
               $pendienteTemp=true;

            }else{
                 $INTERESES -= $pagointeres; 
                 $AMORTIZACION -=$pagointeres*2;
                 $PENDIENTE -= $cuotaSemanal;
            }
            
            // $TINTERESES += $INTERESES;
            // $TAMORTIZACION = round( $PENDIENTE-$cuotaSemanal, 2);
            // //$TAMORTIZACION += $AMORTIZACION;
            // $TCUOTAS += $cuotaSemanal;
           
            $payDate = Carbon::now()->addDay($i*7);
            

            if ($i == 0) {
                $fechaAlta=Carbon::now();
                $tabla = collect([[
                   // 'FECHA' => $payDate->toDateString(),
                   
                   'FECHA'=>$fechaAlta->toDateString(),
                    'CUOTA' => $cuotaSemanal,
                    'INTERESES'=>$porcentajeSum,
                    'AMORTIZACION' => $prestamo,
                    'PENDIENTE' => $prestamoMasInteres
                ]]);
                $INTERESES += $pagointeres; 
                 $AMORTIZACION +=$pagointeres*2;
                 $PENDIENTE += $cuotaSemanal;
            } else {
                if ($pendienteTemp) {
                    $tabla->push([
                        'FECHA' => $payDate->toDateString(),
                        'CUOTA' => $cuotaSemanal,
                        'INTERESES'=>$INTERESES,
                        'AMORTIZACION' => $AMORTIZACION,
                        'PENDIENTE'=>0,
                    ]);
                  
                }else{

                    $tabla->push([
                        'FECHA' => $payDate->toDateString(),
                        'CUOTA' => $cuotaSemanal,
                        'INTERESES'=>$INTERESES,
                        'AMORTIZACION' => $AMORTIZACION,
                        'PENDIENTE'=>$PENDIENTE,
                    ]);
                }
            }
        }
        // add totales / sumatoria
        $tabla->prepend([
            'RESUMEN' => '',
            'TOTAL PAGADO' => $TCUOTAS,
            'PENDIENTE' => $PENDIENTE
        ]);

        return $tabla;
    }
    public function PayB($rate, $amount, $years) // pagos BIMESTRALES
    {
        $periods = ($years * 12) / 2; // PERIODOS EN BIMESTRES
        $interes = (0.01 * ($rate)) / 6;
        $monto = $amount;

        $pay = $this->PMT($interes, $periods, $monto);
        return $pay;
    }

    public function PlanBimestral($rate, $amount, $years)
    {
        $prestamo = $amount;
        $meses = ($years * 12) / 2;
        $tipo = (0.01 * ($rate)) / 6;
        $cuota = round($this->PayB($rate, $amount, $years), 2);
        $tabla = collect();

        //variables dinámicas
        $INTERESES = 0;
        $TINTERESES = 0;
        $AMORTIZACION = 0;
        $TAMORTIZACION = 0;
        $TCUOTAS = 0;
        $PENDIENTE = $prestamo;
        $PIVOTE = 0;
        for ($i = 1; $i <= $meses; $i++) {
            $INTERESES = round($PENDIENTE * $tipo, 2);
            $TINTERESES += $INTERESES;
            $AMORTIZACION = round($cuota - $INTERESES, 2);
            $TAMORTIZACION += $AMORTIZACION;
            $PENDIENTE -= $AMORTIZACION;
            $TCUOTAS += $cuota;
            $PIVOTE += 2;

            $payDate = Carbon::now()->addMonth($PIVOTE);

            if ($i == 1) {
                $tabla = collect([[
                    'FECHA' => $payDate->toDateString(),
                    'CUOTA' => $cuota,
                    'AMORTIZACION' => $AMORTIZACION,
                    'INTERESES' => $INTERESES,
                    'PENDIENTE' => $PENDIENTE
                ]]);
            } else {
                $tabla->push([
                    'FECHA' => $payDate->toDateString(),
                    'CUOTA' => $cuota,
                    'AMORTIZACION' => $AMORTIZACION,
                    'INTERESES' => $INTERESES,
                    'PENDIENTE' => $PENDIENTE
                ]);
            }
        }

        // add totales / sumatoria
        $tabla->prepend([
            'RESUMEN' => '',
            'TOTAL PAGADO' => $TCUOTAS,
            'AMORTIZACION' => $TAMORTIZACION,
            'INTERESES' => $TINTERESES,
            'PENDIENTE' => $PENDIENTE
        ]);

        return $tabla;
    }

    public function PayT($rate, $amount, $years) // pagos TRIMESTRAL
    {
        $periods = ($years * 12) / 3; // PERIODOS TRIMESTRALES
        $interes = (0.01 * ($rate)) / 4;
        $monto = $amount;

        $pay = $this->PMT($interes, $periods, $monto);
        return $pay;
    }

    public function PlanTrimestral($rate, $amount, $years)
    {
        $prestamo = $amount;
        $meses = ($years * 12) / 3;
        $tipo = (0.01 * ($rate)) / 4;
        $cuota = round($this->PayT($rate, $amount, $years), 2);
        $tabla = collect();

        //variables dinámicas
        $INTERESES = 0;
        $TINTERESES = 0;
        $AMORTIZACION = 0;
        $TAMORTIZACION = 0;
        $TCUOTAS = 0;
        $PENDIENTE = $prestamo;
        //$PIVOTE = 0;

        $payDate = null;
        for ($i = 1; $i <= $meses; $i++) {
            $INTERESES = round($PENDIENTE * $tipo, 2);
            $TINTERESES += $INTERESES;
            $AMORTIZACION = round($cuota - $INTERESES, 2);
           // $TAMORTIZACION += $AMORTIZACION;
            $PENDIENTE -= $AMORTIZACION;
            $TCUOTAS += $cuota;


            if ($payDate == null) {
                $payDate = Carbon::now()->addMonth(3);
            } else {
                $payDate = $payDate->addMonth(3);
            }

            if ($i == 1) {
                $tabla = collect([[
                    'FECHA' => $payDate->toDateString(),
                    'CUOTA' => $cuota,
                    'AMORTIZACION' => $AMORTIZACION,
                    'INTERESES' => $INTERESES,
                    'PENDIENTE' => $PENDIENTE
                ]]);
            } else {
                $tabla->push([
                    'FECHA' => $payDate->toDateString(),
                    'CUOTA' => $cuota,
                //    'AMORTIZACION' => $AMORTIZACION,
                    'INTERESES' => $INTERESES,
                    'PENDIENTE' => $PENDIENTE
                ]);
            }
        }

        // add totales / sumatoria
        $tabla->prepend([
            'RESUMEN' => '',
            'TOTAL PAGADO' => $TCUOTAS,
            'AMORTIZACION' => $TAMORTIZACION,
            'INTERESES' => $TINTERESES,
            'PENDIENTE' => $PENDIENTE
        ]);

        return $tabla;
    }
}
