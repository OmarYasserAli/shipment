<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        @php
            $companyMainData = \App\Models\CompanyInfo::where('branch_','الفرع الرئيسى')->first();
        @endphp

        <link rel="icon" type="image/x-icon" href="assets/{{$companyMainData->image_data}}">
        <title>طباعه الوصول</title>
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
            /*border: 1px solid #0000003d;*/
            /*border-collapse: collapse;*/
        }
         .fatoora th{
            width: 30%;
            font-size: 15px;
            font-weight: bold;

         }
        .fatoora th,.fatoora td {
            padding: 1px;
            /*margin-top: 1mm;*/
            /*margin-bottom: 1mm;*/
            /*text-align: right;*/
           font-weight: bold;
            text-align: right !important;
        }
        .fatoora td {
            text-align: right !important;
            font-size: 15px;
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
               <img src="assets/{{$company->image_data}}"  alt=""  style="width:20mm; height: 20mm!important; margin-bottom: 5px ;margin-right:1%; margin-left:-5px;">
                 <br>
                <span style="font-size:12px;padding-top: 10px;font-family: 'XBRiyaz' , Sans-Serif;font-weight: bold;">{{$company->name_}}</span><br>
                <span style="font-size:10px;padding-top: 10px; font-weight: bold;">{{$company->address_}}</span>


            </div>
            <hr>
<table class="fatoora" cellpadding="0" cellspacing="0" style="width: 90%;ont-size:7px; margin:auto;">
    @if(isset($all[$i]->branch_)&& $all[$i]->branch_ != '')
    <tr>
        <th>اسم الفرع:</th>
        <td style="text-align: left;">{{$all[$i]->branch_}}</td>
    </tr>
    @endif
        @if(isset($all[$i]->code_)&& $all[$i]->code_ != '')
    <tr>
        <th>رقم الشحنة:</th>
        <td style="text-align: left;">{{$all[$i]->code_}}</td>
    </tr>
        @endif
        @if(isset($all[$i]->date_)&& $all[$i]->date_ != '')
    <tr>
        <th>التاريخ:</th>
        <td style="text-align: left;">{{$all[$i]->date_}}</td>
    </tr>
        @endif
        @if(isset($all[$i]->commercial_name)&& $all[$i]->commercial_name_ != '')
    <tr>
        <th>اسم التجاري:</th>
        <td style="text-align: left;">{{$all[$i]->commercial_name_}}</td>
    </tr>
        @endif
        @if(isset($all[$i]->clinet_phone_)&& $all[$i]->clinet_phone_ != '')
    <tr>
        <th>رقم العميل:</th>
        <td style="text-align: left;">{{$all[$i]->clinet_phone_}}</td>
    </tr>
        @endif
        @if(isset($all[$i]->reciver_name_) && $all[$i]->reciver_name_ != '')
    <tr>
        <th>اسم المستلم:</th>
        <td style="text-align: left;">{{$all[$i]->reciver_name_}}</td>
    </tr>
        @endif
        @if(isset($all[$i]->reciver_phone_)&& $all[$i]->reciver_phone_ != '')
    <tr>
      <th style="width: 60px;">هاتف المستلم:</th>
      <td style="text-align: left;">{{$all[$i]->reciver_phone_}}</td>
    </tr>
        @endif
        @if(isset($all[$i]->mo7afza_)&& $all[$i]->mo7afza_ != '')
    <tr>
      <th>محافظه:</th>
      <td style="text-align: left;">{{$all[$i]->mo7afza_}}</td>
    </tr>
        @endif
        @if(isset($all[$i]->el3nwan)&& $all[$i]->el3nwan != '')
    <tr>
      <th>العنوان:</th>
      <td style="text-align: left;">{{$all[$i]->el3nwan}}</td>
    </tr>
        @endif
        @if(isset($all[$i]->shipment_coast_)&& $all[$i]->shipment_coast_ != '')
    <tr>
        <th>مبلغ الشحنة:</th>
        <td style="text-align: left;">{{number_format($all[$i]->shipment_coast_, 2)}}</td>
    </tr>
        @endif
        @if(isset($all[$i]->ship_type)&& $all[$i]->ship_type != '')
    <tr>
        <th>نوع الشحنة:</th>
        <td style="text-align: left;">{{$all[$i]->ship_type}}</td>
    </tr>
        @endif
        @if(isset($all[$i]->notes_)&& $all[$i]->notes_ != '')
    <tr>
        <th>الملاحظات:</th>
        <td style="text-align: left;">{{$all[$i]->notes_}}</td>
    </tr>
        @endif


  </table>
            <hr>
  <div class="totalammount" style="font-size: 8px;">
<span id='mark'></span>
{!! $qrcode[$i]!!}

    <h6>{{Carbon\Carbon::now()->format('Y-m-d  g:i:s A')}}    <p style="font-size: 13px">صمم بواسطة: شركة كاش بوكس للحلول البرمجية</p></h6>

  </div>

        </div>
        @if($i != count($all)-1)

      <pagebreak></pagebreak>
        @endif




@endfor

    </body>

</html>
