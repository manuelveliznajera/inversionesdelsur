<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <!-- Site Title -->
    <title>Plan de Pagos</title>

    <!-- cargar a través de la url del sistema 
        <link rel="stylesheet" href="{{ asset('css/style_pdf.css') }}">
    -->

    <!-- ruta física relativa al OS -->
    <link rel="stylesheet" href="{{ public_path('css/style_pdf.css') }}">
    <style>
        @page {
            margin-top: 0px !important;
            margin-bottom: 5px;
            margin-left: 0.5cm;
            margin-right: 0;
        }
    </style>
</head>

<body>
    <div class="">
        <div class="tm_invoice_wrap">
            <div class="tm_invoice tm_style1" id="tm_download_section">
                <div class="tm_invoice_in">
                    <div class="tm_invoice_head tm_align_center tm_mb20">
                        <div class="tm_invoice_left">
                            <div class="tm_logo"><img src="{{ asset('logo.png') }}" alt="Logo"></div>
                        </div>
                        <div class="tm_invoice_right tm_text_right">
                            <div class="tm_primary_color tm_f50 tm_text_uppercase">SISTEMA CASHAPP</div>
                            <h6>Plan de Pagos al {{\Carbon\Carbon::now()->format('Y-m-d')}}</h6>
                        </div>
                    </div>
                    <div class="tm_invoice_info tm_mb20">
                        <div class="tm_invoice_seperator tm_gray_bg"></div>
                        <div class="tm_invoice_info_list">
                            <p class="tm_invoice_number tm_m0">
                                Socio: <b class="tm_primary_color">#{{str_pad($loan->customer->id, 5, "0", STR_PAD_LEFT)}} {{$loan->customer->name}}</b>
                                Frecuencia: <b class="tm_primary_color">{{$loan->frecuency->name}}</b>
                            </p>
                            <p class="tm_invoice_date tm_m0">
                                Monto Prestado: <b class="tm_primary_color">Q {{number_format($loan->amount,2)}}</b>
                                Tasa: <b class="tm_primary_color">{{number_format($loan->rate->percent,0)}}%</b>
                                Interés Mora: <b class="tm_primary_color">{{number_format($loan->rate->fee,0)}}%</b>
                                Método: <b class="tm_primary_color">{{$method}}</b>
                            </p>
                        </div>
                    </div>

                    <div class="tm_table tm_style1 tm_mb30">
                        <div class="tm_round_border">
                            <div class="tm_table_responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg">#</th>
                                            <th class="tm_width_3 tm_semi_bold tm_primary_color tm_gray_bg">FECHA</th>
                                            <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">CUOTA</th>
                                            <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">CAPITAL</th>
                                            <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">INTERES</th>
                                            <th class="tm_width_3 tm_semi_bold tm_primary_color tm_gray_bg">BALANCE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($loan->plan as $pay)
                                        <tr>
                                            <td class="tm_width_1">{{$pay->number}}</td>
                                            <td class="tm_width_3">{{$pay->date}}</td>
                                            <td class="tm_width_2">Q{{ number_format($pay->payment,2)}}</td>
                                            <td class="tm_width_2">Q{{ number_format($pay->amort,2)}}</td>
                                            <td class="tm_width_2">Q{{ number_format($pay->interest,2)}}</td>
                                            <td class="tm_width_3">Q{{ number_format($pay->balance,2)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="tm_padd_15_20 tm_round_border">
                        <p class="tm_mb5"><b class="tm_primary_color">Firma de conformidad</b></p>
                        <hr>
                        <p style="margin-top: 25px;">
                            Socio: {{$loan->customer->name}}
                        </p>
                    </div><!-- .tm_note -->
                </div>
            </div>

        </div>
    </div>

</body>

</html>