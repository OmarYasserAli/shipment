<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        body{
            font-family: 'XBRiyaz' , Sans-Serif;
        }
        table.tabel_data, .tabel_data td,.tabel_data th {
            border: 2px solid #00000099;
            text-align: center;
        }

        table.tabel_data {
            border-collapse: collapse;
            width: 100%;
        }
        table.data_of_number,.data_of_number th,.data_of_number td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .data_of_number{
            margin-bottom: 25px;
        }
        .data_of_number th,.data_of_number td {

            text-align: right;
            width: 46px;
        }
        .data_of_number td{
            padding-bottom: 0px !important;
        }
        .tabel_data th,.tabel_data  td {
            padding: 15px;
            font-weight: bold;
            font-size: 19px !important;
        }
        .data_of_title{
            text-align: center;
            background: #8080801f;
            padding: 2px;
            margin-bottom: 28px;
            border-radius: 8px;
            color: white;
        }
        span{
            font-size: 15px;
        }

        .data_of_number th{
            background: grey;
            color: white;

        }
        @page {
            header: page-header;
            footer: page-footer;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 16px;
            line-height: 24px;
            font-family:'XBRiyaz' , Sans-Serif;
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
        .invoice-box table tr td {
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
            font-family: 'XBRiyaz' , Sans-Serif;        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: center;
        }
    </style>
</head>

<body>
@php
    $company = App\Models\CompanyInfo::where('branch_',Auth::user()->branch)->first() ;
@endphp
<div class="invoice-box rtl">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <h3>{{$company->name_}} <br><br><span>{{$company->Tel_}} </span> </h3>
                        </td>
                        <td class="title" style="">
                            {{-- <img style="width: 130px;" src="{{asset('assets/'.$company->image_data)}}"  alt="" class="ml-auto" style="height: 130px!important; margin-bottom: 30px"> --}}
                        </td>
                        <td>
                            <h4>
                                {{$company->branch_}}<br />
                                {{$company->address_}}
                            </h4>
                        </td>


                    </tr>
                </table>
            </td>
        </tr>




    </table>
    <div class="data_of_title">
        <h2>{{$title}}</h2>
    </div>
    <div class="number_of_shipment">
        {{--    <div class="data_of_number">--}}
        {{--    <span>عدد الشحنات</span>--}}
        {{--    <span>{{count($all)}}</span>--}}
        {{--    </div>--}}


        <table class="tabel_data" align="center">
            <tr>
                <th >عدد الشحنات</th>
                <th >اجمالي مبلغ الشحنة</th>

                <th>اجمالي اجرة الشركة</th>


                <th >اجمالي الصافي</th>
                <th >التاريخ</th>


            </tr>


                <tr >
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>

        </table>
    </div>
    <br><br><br><br>

    <table class="tabel_data" align="center">
        <tr>

            <th>التاريخ</th>
            <th>الرقم</th>
            <th>نوع الحركة</th>
            <th>نوع المستفيد</th>
            <th>المتسفيد</th>
            <th>بيان</th>
            <th>حركة دائنة</th>
            <th>حركة مدينة</th>
            <th>رصيد دائن</th>
            <th>رصيد مدين</th>
        </tr>
        @php
            $i=0;
            $raseed=$safiKhazna;
            $T7rkaDa2en=0;
            $T7rkaMaden=0;
            $TrasedDa2en=0;
            $TrasedMaden=0;
        @endphp
        @foreach($sanadat as $sanad)
            @php
                $i++;
                if($sanad->type =='صرف') {$raseed -= $sanad->amount;}
                if($sanad->type =='قبض') {$raseed += $sanad->amount;}
                if($raseed < 0){$da2en= -$raseed;   $madeen = 0;}
                else{$da2en= 0;   $madeen = $raseed;}
                $TrasedDa2en = $da2en;
                $TrasedMaden = $madeen;
            @endphp
            <tr   >

                <td><?php echo $i;?></td>
                <td >{{$sanad->created_at }}</td>
                <td >{{$sanad->code }}</td>
                <td >{{$sanad->type}} @if($sanad->is_solfa) سلفة @endif</td>
                <td>{{$sanad->mostafed_type()}}</td>
                <td >{{$sanad->sanadable->name_}}</td>
                <td{{$sanad->notes}}</td>

                <td >@if($sanad->type =='صرف')  {{number_format($sanad->amount , 0)}} @php $T7rkaDa2en+= $sanad->amount; @endphp @else 0 @endif</td>
                <td >@if($sanad->type =='قبض'){{number_format($sanad->amount , 0)}} @php $T7rkaMaden+= $sanad->amount; @endphp @else 0 @endif</td>
                <td>{{number_format($da2en , 0)}} </td>
                <td >{{number_format($madeen , 0)}}</td>

            </tr>
        @endforeach
    </table>

{{--ZIAD ABO ALKAMAR--}}
{{--Omar Yasser--}}

</div>
</body>
</html>

