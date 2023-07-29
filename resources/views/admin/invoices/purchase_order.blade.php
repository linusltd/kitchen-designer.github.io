

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>Purchase Order Invoice</title>
  <link rel="stylesheet" href="{{ asset('assets/admin/invoices/css/style.css') }}">
</head>

<body>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_align_center tm_mb20">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="{{ asset('assets/admin/img/logo.png') }}" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <div class="tm_primary_color tm_f50 tm_text_uppercase">PO Invoice</div>
            </div>
          </div>
          <div class="tm_invoice_info tm_mb20">
            <div class="tm_invoice_seperator tm_gray_bg"></div>
            <div class="tm_invoice_info_list">
              <p class="tm_invoice_number tm_m0">PO No: <b class="tm_primary_color">#{{ $order->order_no }}</b></p>
              <p class="tm_invoice_date tm_m0">Date: <b class="tm_primary_color">{{ $order->issue_date }}</b></p>
            </div>
          </div>
          <div class="tm_invoice_head tm_mb10">
            <div class="tm_invoice_left">
              <p class="tm_mb2"><b class="tm_primary_color">Invoice To:</b></p>
              <p>
                {{ $order->supplier->name }}<br>
                {{$order->supplier->contact_person}} <br>
                {{ $order->supplier->address }} <br>
                {{ $order->supplier->mobile }}
              </p>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <p class="tm_mb2"><b class="tm_primary_color">Ship To:</b></p>
              <p>
                Kitchen Designer <br>
                Hamza Ashraf <br>
                Office No 16, New Musaib Khan Market,<br>
                Mohallah Zahid Colony, Gujranwala. <br>
                +923110767466 <br>
              </p>
            </div>
          </div>
          <div class="tm_table tm_style1 tm_mb30">
            <div class="tm_round_border">
              <div class="tm_table_responsive">
                <table>
                  <thead>
                    <tr>
                      <th class="tm_width_5 tm_semi_bold tm_primary_color tm_gray_bg">Book Name</th>
                      <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">Price</th>
                      <th class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg">Disc.</th>
                      <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg tm_text_right">Qty</th>
                      <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg tm_text_right">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($order->order_items->count())
                        @foreach ($order->order_items as $key =>  $item)
                        <tr>
                            <td class="tm_width_3">{{ ++$key }}. {{ $item->book->name }}</td>
                            <td class="tm_width_4">{{ $item->price }}</td>
                            <td class="tm_width_2">{{ $item->discount }}</td>
                            <td class="tm_width_1">{{ $item->qty }}</td>
                            <td class="tm_width_2 tm_text_right">{{ $item->total_amount }}</td>
                          </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer">
              <div class="tm_left_footer">
              </div>
              <div class="tm_right_footer">
                <table>
                  <tbody>
                    <tr>
                      <td class="tm_width_3 tm_primary_color tm_border_none tm_bold">Subtoal</td>
                      <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold">{{ $order->qty }}</td>
                      <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold">{{ $order->total_amount }}</td>
                    </tr>
                    <tr>
                      <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Tax <span class="tm_ternary_color">(0%)</span></td>
                      <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0"></td>
                      <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">+0</td>
                    </tr>
                    <tr class="tm_border_top tm_border_bottom">
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color">Grand Total	</td>
                      <td class="tm_width_1 tm_border_top_0 tm_bold tm_f16 tm_primary_color tm_text_right"></td>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color tm_text_right">{{ $order->total_amount }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tm_padd_15_20 tm_round_border">
            <p class="tm_mb5"><b class="tm_primary_color">Terms & Conditions:</b></p>
            <ul class="tm_m0 tm_note_list">
              <li>اگر کوئی کتاب خراب پائی گئی تو واپس کر دی جائے گی۔.</li>
            </ul>
          </div><!-- .tm_note -->
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Print</span>
        </a>
        <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
          <span class="tm_btn_text">Download</span>
        </button>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/admin/invoices/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/admin/invoices/js/jspdf.min.js') }}"></script>
  <script src="{{ asset('assets/admin/invoices/js/html2canvas.min.js') }}"></script>
  <script src="{{ asset('assets/admin/invoices/js/main.js') }}"></script>
</body>
</html>
