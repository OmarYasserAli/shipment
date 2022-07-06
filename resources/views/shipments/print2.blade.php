<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>A simple, clean, and responsive HTML invoice template</title>
  <style>
        @page { sheet-size: 100mm 150mm; }
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
            font-size: 13px;
            font-weight: bold;

         }
        .fatoora th,.fatoora td {
            /*padding: 0px;*/
            /*text-align: right;*/
           font-weight: bold;
            text-align: center !important;
        }
        .fatoora td {
            text-align: right !important;
            font-size: 13px;
 font-weight: bold;
        }
        .invoice-box {
            font-size: 5px;
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
            font-size: 5px;
            text-align: center !important;
            color: #333;
        }
tr{
    text-align: center!important;
}
         hr{
            width: 80mm;
            margin: 0 auto;
            color: gray;
             margin-top: 4mm;
             margin-bottom: 4mm

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
        .invoice-box.rtl .totalammount img{
            width: 50px;
            height: 50px;
        }
        .totalammount p,.totalammount h6 , .totalammount svg{

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

            <div class="totalammount" style="font-size: 8px;">
                 <img src="{{asset('assets/'.$company->image_data)}}"  alt=""  style="width:30mm; height: 30mm!important; margin-bottom: 5px ;margin-right:1%; margin-left:-5px;">
                 <br>
                <span style="font-size:12px;padding-top: 10px; font-weight: bold;">{{$company->name_}}</span><br>
                <span style="font-size:8px;padding-top: 10px; font-weight: bold;">{{$company->address_}}</span>
                

            </div>
            <hr>
<table class="fatoora" style="width:90% ;font-size:7px; margin:auto;">
    <tr>
        <th>اسم الفرع:</th>
        <td style="text-align: center;">{{$all[$i]->branch_}}</td>
    </tr>
    <tr>
        <th>رقم الشحنة:</th>
        <td style="text-align: center;">{{$all[$i]->code_}}</td>
    </tr>
    <tr>
        <th>التاريخ:</th>
        <td style="text-align: center;">{{$all[$i]->date_}}</td>
    </tr>
    <tr>
        <th>اسم التجاري:</th>
        <td style="text-align: center;">{{$all[$i]->commercial_name_}}</td>
    </tr>
    <tr>
        <th>رقم العميل:</th>
        <td style="text-align: center;">{{$all[$i]->clinet_phone_}}</td>
    </tr>
    <tr>
        <th>اسم المستلم:</th>
        <td style="text-align: center;">{{$all[$i]->reciver_name_}}</td>
    </tr>
    <tr>
      <th style="width: 60px;">هاتف المستلم:</th>
      <td style="text-align: center;">{{$all[$i]->reciver_phone_}}</td>
    </tr>
    <tr>
      <th>محافظه:</th>
      <td style="text-align: center;">{{$all[$i]->mo7afza_}}</td>
    </tr>
    <tr>
      <th>العنوان:</th>
      <td style="text-align: center;">{{$all[$i]->el3nwan}}</td>
    </tr>
    <tr>
        <th>مبلغ الشحنة:</th>
        <td style="text-align: center;">{{number_format($all[$i]->shipment_coast_, 2)}}</td>
    </tr>
    <tr>
        <th>الملاحظات:</th>
        <td style="text-align: center;">{{$all[$i]->notes_}}</td>
    </tr>



  </table>
            <hr>
  <div class="totalammount" style="font-size: 8px;">
<span id='mark'></span>
{!! $qrcode[$i]!!}

    <h6>{{Carbon\Carbon::now()->format('Y-m-d  g:i:s A')}}    <p style="font-size: 10px">صمم بواسطة: شركة كاش بوكس للحلول البرمجية</p></h6>

  </div>

        </div>
        @if($i != count($all)-1)

      <pagebreak></pagebreak>
        @endif




@endfor

    </body>

</html>
