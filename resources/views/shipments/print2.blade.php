<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        body{
            font-family: 'XBRiyaz' , Sans-Serif;
        }
        table.fatoora,.fatoora th,.fatoora td {
            border: 1px solid #0000003d;
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
    </style>
</head>

<body>
<div class="invoice-box rtl">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="https://www.sparksuite.com/images/logo.png" style="width: 100%; max-width: 300px" />
                        </td>

                        <td>
                            رقم الفاتورة #: 123<br />
                            التاريخ: {{Carbon\Carbon::now()->format('Y-m-d')}}<br />

                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2" align="right">
                <table>
                    <tr>
                        <td>
                            <h2>شركة خيرات العادل للتوصيل السريع</h2>
                        </td>

                        <td>
                            <h4>
                                الفرع الرئيسى<br />

                                بغداد - المنصور - الداوودي
                            </h4>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>


    </table>

    <table class="fatoora" style="width:100%">
        <tr>
            <th>اسم الفرع:</th>
            <td>رع البصرة</td>
        </tr>
        <tr>
            <th>رقم الوصل:</th>
            <td>10001648560796559</td>
        </tr>
        <tr>
            <th>التاريخ:</th>
            <td>2022-03-29</td>
        </tr>
        <tr>
            <th>اسم العميل:</th>
            <td>ايروس ستور</td>
        </tr>
        <tr>
            <th>االسم التجارى:</th>
            <td>ايروس ستور</td>
        </tr>
        <tr>
            <th>هاتف المستلم:</th>
            <td>07713419994</td>
        </tr>
        <tr>
            <th>المحافظه:</th>
            <td>صالح الدين</td>
        </tr>
        <tr>
            <th>المنطقه:</th>
            <td>مركز</td>
        </tr>   <tr>
            <th>العنوان:</th>
            <td>سامراء/السكك</td>
        </tr>   <tr>
            <th>مبلغ الشحن:</th>
            <td>30000.0</td>
        </tr>
    </table>

</div>
</body>
</html>
