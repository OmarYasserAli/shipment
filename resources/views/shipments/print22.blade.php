<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8" />
    <title>طباعه الوصل</title>

    <style>

@page bigger { sheet-size: 80mm 100mm; }
        body{
            font-family: 'XBRiyaz' , Sans-Serif;
        }
        table.fatoora,.fatoora th,.fatoora td {
            border: 0px solid #0000003d;
            border-collapse: collapse;
        }
        .fatoora th,.fatoora td {
            padding: 5px;
            text-align: right;
        }
        .fatoora td {
            text-align: right !important;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
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
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
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
        @page  { sheet-size: 80mm 100mm; }
    </style>
</head>

<body>
    @php
    $company = App\Models\CompanyInfo::where('branch_',Auth::user()->branch)->first() ;
@endphp
<div class="invoice-box rtl">
    <div cellpadding="0" cellspacing="0">
        <div class="top" >
            {{-- <img  src="https://www.sparksuite.com/images/logo.png" style=" max-width: 300px; margin-right:50%;"/> --}}
            {{-- <img src="{{asset('assets/'.$company->image_data)}}"  alt="" class="ml-auto" style="height: 80px!important; margin-bottom: 30px ;margin-right:45%;"> --}}


          
        </div>

        <div class="information">
            
                            <h2 style="text-align:center;">{{$company->name_}}</h2>
                       
                </div>
                <div >

                    <h4 style="text-align:center;">
                    
                {{$company->branch_}}<br />
                {{$company->address_}}

                    </h4>

                </div>
            </div>
            

    <table class="fatoora" style="width:100%">
        <tr>
            <th>اسم الفرع:</th>
            <td>{{$all->branch_}}</td>
        </tr>
        <tr>
            <th>رقم الوصل:</th>
            <td>{{$all->code_}}</td>
        </tr>
        <tr>
            <th>التاريخ:</th>
            <td>{{$all->date_}}</td>
        </tr>
        <tr>
            <th>اسم العميل:</th>
            <td>{{$all->client_name_}}</td>
        </tr>
        <tr>
            <th>االسم التجارى:</th>
            <td>{{$all->commercial_name_}}</td>
        </tr>
        <tr>
            <th>هاتف المستلم:</th>
            <td>{{$all->reciver_phone_}}</td>
        </tr>
        <tr>
            <th>المحافظه:</th>
            <td>{{$all->mo7afza_}}</td>
        </tr>
        <tr>
            <th>المنطقه:</th>
            <td>{{$all->mantqa_}}</td>
        </tr>   <tr>
            <th>العنوان:</th>
            <td>{{$all->el3nwan}}</td>
        </tr>   <tr>
            <th>مبلغ الشحن:</th>
            <td>{{$all->shipment_coast_}}</td>
        </tr>
    </table>

</div>
</body>
</html>
