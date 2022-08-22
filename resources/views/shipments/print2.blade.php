<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>
    <style>
        @page { sheet-size: 80mm 100mm; }
        h1.bigsection {
            page-break-before: always;
            page: bigger;
        }
        body{
            font-family: 'XBRiyaz' , Sans-Serif;
        }
        table.fatoora,.fatoora th,.fatoora td {
            border: 1px solid #0000003d;
            border-collapse: collapse;
        }
        .fatoora th{
            width: 30%;
            font-size: 12px;
            font-weight: bold;

        }
        .fatoora th,.fatoora td {
            padding: 4px;
            text-align: right;
            font-weight: bold;
        }
        .fatoora td {
            text-align: right !important;
            font-size: 12px;
            font-weight: bold;
        }
        .invoice-box {
            font-size: 7px;
            line-height: 24px;
            font-family: 'XBRiyaz' , Sans-Serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {

            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }


        .invoice-box table tr.top table td.title {
            font-size: 7px;

            color: #333;
        }


        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }



        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: 'XBRiyaz' , Sans-Serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .invoice-box.rtl .totalammount{
            text-align: center !important;
        }
        .invoice-box.rtl .totalammount h5{
          color: black;
        }

        .invoice-box.rtl .totalammount img{
            width: 50px;
            height: 50px;
        }
        .totalammount h5,.totalammount h6 , .totalammount svg{

            margin: 0px;
        }

    </style>
</head>

<body>
@php
    $company = App\Models\CompanyInfo::where('branch_',Auth::user()->branch)->first() ;
@endphp

@for ($i = 0; $i < count($all); $i++)
    <div class="invoice-box rtl">
        <table cellpadding="0" cellspacing="0">
            <tr class="">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title" style="padding-right: 20px;">
                                <span style="font-size:13px;padding-right: 20px; font-weight: bold;">{{$company->name_}}</span>

                            </td>
                            <td class="title">
                                <img src="assets/{{$company->image_data}}"  alt=""  style="width:10mm; height: 7mm!important;"> </td>


                        </tr>
                    </table>
                </td>
            </tr>




        </table>

        <table class="fatoora" style="width:90% ;font-size:7px; margin:auto;">
            @if(isset($all[$i]->reciver_name_)&& $all[$i]->reciver_name_ != '')
                <tr>
                    <th style="width: 60px;">اسم الزبون:</th>
                    <td style="text-align: center;">{{$all[$i]->reciver_name_}}</td>
                </tr>
            @endif
            @if(isset($all[$i]->reciver_phone_)&& $all[$i]->reciver_phone_ != '')
                <tr>
                    <th style="width: 60px;">هاتف الزبون:</th>
                    <td style="text-align: center;">{{$all[$i]->reciver_phone_}}</td>
                </tr>
            @endif
            @if(isset($all[$i]->mo7afza_)&& $all[$i]->mo7afza_!= '')
                <tr>
                    <th>المحافظه:</th>
                    <td style="text-align: center;">{{$all[$i]->mo7afza_}}</td>
                </tr>
            @endif
            @if(isset($all[$i]->el3nwan)&& $all[$i]->el3nwan != '')
                <tr>
                    <th>العنوان:</th>
                    <td style="text-align: center;">{{$all[$i]->el3nwan}}</td>
                </tr>
            @endif
            @if(isset($all[$i]->commercial_name_)&& $all[$i]->commercial_name_ != '')
                <tr>
                    <th>اسم المتجر:</th>
                    <td style="text-align: center;">{{$all[$i]->commercial_name_}}</td>
                </tr>

            @endif
            @if(isset($all[$i]->code_)&& $all[$i]->code_ != '')
                <tr>
                    <th>رقم الشحنه:</th>
                    <td style="text-align: center;">{{$all[$i]->code_}}</td>
                </tr>
            @endif
            @if(isset($all[$i]->ship_type)&& $all[$i]->ship_type != '')
                <tr>
                    <th>نوع الشحنة:</th>
                    <td style="text-align: center;">{{$all[$i]->ship_type}}</td>
                </tr>
            @endif
            @if(isset($all[$i]->notes_)&& $all[$i]->notes_ != '')
                <tr>
                    <th>الملاحظات:</th>
                    <td style="text-align: center;">{{$all[$i]->notes_}}</td>
                </tr>
            @endif

        </table>

        <div class="totalammount" style="font-size: 10px;">
            <h5  style="font-size: 14px">مبلغ الشحنه : {{number_format($all[$i]->shipment_coast_)}}</h5>

            <table class="" cellpadding="0" cellspacing="0" style="width:90% ;font-size:7px; margin:auto; padding-top: 20px">
                <tr>
                    <span id='mark'></span>
                    <th style="width: 60px;padding-right: 20px">{!! $qrcode[$i]!!}</th>
                    <td style="text-align: center; padding-top: 30px;font-size: 9px"> <h3>{{Carbon\Carbon::now()->format('Y-m-d  g:i:s A')}}</h3>
                        <p style="font-size: 10px">ust.center</p></td>
                </tr>
            </table>
        </div>

    </div>
    @if($i != count($all)-1)
        <pagebreak></pagebreak>
    @endif



@endfor

</body>

</html>
