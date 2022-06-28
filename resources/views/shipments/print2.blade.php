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
				padding: 5px;
				/* border: 1px solid #eee; */
				
			
				line-height: 6px;
                font-family: 'XBRiyaz' , Sans-Serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: center;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				/* padding-bottom: 20px; */
			}

			.invoice-box table tr.top table td.title {
				
				
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
				text-align: center;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
      
			.invoice-box.rtl .totalammount{
        text-align: center !important;
      }
      .invoice-box.rtl .totalammount img{
      
      }
      *{
        font-size: 4px !important; 
      }
      @page  { sheet-size: 80mm 100mm; }
		</style>
	</head>

	<body>
        @php
            $company = App\Models\CompanyInfo::where('branch_',Auth::user()->branch)->first() ;
        @endphp
		<div class="invoice-box rtl">
            <table cellpadding="0" cellspacing="0">
                <tr class="">
                    <td colspan="2">
                        <table>
                            <tr>
                              <td>
                                <span style="font-size:10px;">{{$company->name_}}</span>
    
                            </td>
                                <td class="title">
            <img src="{{asset('assets/'.$company->image_data)}}"  alt=""  style="width:30px; height: 30px!important; margin-bottom: 5px ;margin-right:1% margin-left:-5px;">

                                    {{-- <img src="https://www.sparksuite.com/images/logo.png" style="width: 100%; max-width: 300px" /> --}}
                                </td>
        
                             
                            </tr>
                        </table>
                    </td>
                </tr>
        
                
        
        
            </table>
	
<table class="fatoora" style="width:90% ;font-size:7px; margin:auto;">
  
    <tr>
      <th style="width: 60px;">هاتف الزبون:</th>
      <td style="text-align: center;">{{$all->reciver_phone_}}</td>
    </tr>
    <tr>
      <th>المحافظه:</th>
      <td style="text-align: center;">{{$all->mo7afza_}}</td>
    </tr>
    <tr>
      <th>العنوان:</th>
      <td style="text-align: center;">{{$all->el3nwan}}</td>
    </tr>
    <tr>
      <th>اسم المتجر:</th>
      <td style="text-align: center;">{{$all->commercial_name_}}</td>
    </tr>
    <tr>
      <th>رقم الشحنه:</th>
      <td style="text-align: center;">{{$all->code_}}</td>
    </tr> 

     
  </table>
  <div class="totalammount" style="font-size: 8px;">
    <h5>مبلغ الشحنه : {{$all->shipment_coast_}}</h5>
<span id='mark'></span>
{!! $qrcode!!}

    <h6>{{Carbon\Carbon::now()->format('Y-m-d  g:i:s A')}}<br>
        ust.center</h6>
  </div>
  
		</div>
	</body>
    <script>
        var str = `<div></div>
<!-- some comment -->
<p></p>
<!-- some comment -->`
str = str.replace(/<\!--.*?-->/g, "");
// console.log(str);
        // notACommentHere()
        // document.getElementById("mark").nextSibling.remove();
        // document.getElementById("mark").nextSibling.remove();
        // document.getElementById("mark").nextSibling.remove();
     </script>
</html>