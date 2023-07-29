<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- CSS Stylesheet -->
  <link rel="stylesheet" href="./assets/css/shipping-label.css" />
  <title>Document</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap");

    :root {
      --color-black: #000;

      --font-family: "Roboto", sans-serif;

      --container-xl: 2000px;
      --container-lg: 1440px;
      --container-md: 90%;
      --container-sm: 95%;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: var(--font-family);
    }

    .shippinglabel__container {
      width: var(--container-lg);
      padding: 30px 0;
      margin: 0px auto;
    }

    /* Shipping Head */

    .shipping__head {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
    }

    .shipping__head p {
      border: 1px solid var(--color-black);
      width: 50%;
      text-align: center;
      padding: 7px 0;
    }

    .traking__img {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      margin: 10px 0;
    }

    .traking__img img {
      width: 100%;
      max-width: 500px;
      /* height: 100px; */
    }

    /* Table */

    .shippinglabel__table {
      width: 100%;
    }

    .shippinglabel__table img {
      width: 100%;
      height: 200px;
      max-height: auto;
      max-width: 200px;
    }

    .shippinglabel__table .brand {
      width: 100%;
      max-width: 200px;
      height: 150px;
      margin: 20px 10px;
    }

    .shippinglabel__table,
    .shippinglabel__table th,
    .shippinglabel__table td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    .shippinglabel__table td {
      padding: 7px;
    }

    .shippinglabel__table td p {
      line-height: 1.5;
    }

    /* Media Queries */

    @media print {
      body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      .shippinglabel__container {
        page-break-after: always;
      }

      .shippinglabel__container:last-of-type {
        page-break-after: avoid;
      }

      .shippinglabel__table img {
        max-height: none;
      }
    }

    @media (max-width: 1440px) {
      .shippinglabel__container {
        width: var(--container-md);
      }
    }

    @media (max-width: 500px) {
      .shippinglabel__container {
        width: var(--container-sm);
      }

      .shippinglabel__table .brand {
        width: 160px;
        height: 130px;
        margin: 10px 5px;
      }

      .shippinglabel__table {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
<div id="print-container">
  @foreach ($orders as $order)
    <div class="shippinglabel__container">
      <div class="shipping__head">
        <p class="salesorder">Sales Order</p>
        <p class="marketplace">Market Place</p>
      </div>
      <div class="traking__img">
        <img src="{{ asset('assets/admin/img') }}/Capture2.PNG" alt="" />
      </div>
      <table class="shippinglabel__table">
        <thead>
        <tr>
          <th rowspan="5" colspan="6">
            <img class="brand" src="{{ asset('storage/'. $logo) }}" alt="" />
            <p>D-032-01712</p>
          </th>
          <th colspan="2">STANDARD</th>
        </tr>
        <tr>
          <th colspan="2">0.4 KG</th>
        </tr>
        <tr>
          <th colspan="2">STANDARD</th>
        </tr>
        <tr>
          <th colspan="2">COD</th>
        </tr>
        <tr>
          <th colspan="2">PKR: &nbsp; {{ $order->total_amount }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td align="center" colspan="7">Order Number: {{ $order->order_no }}</td>
        </tr>
        <tr>
          <td colspan="4">Order Creation Date {{ \Carbon\Carbon::parse($order->received_at)->format('F j, Y') }}</td>
          <td colspan="5">AWB Print Date {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('F j, Y') }}</td>
        </tr>
        <tr>
          <td align="center" rowspan="2" colspan="3">
            <img src="{{ asset('assets/admin/img') }}/Capture.PNG" alt="" />
          </td>
          <td colspan="4">
            <b>Recipient:</b>
            <p>{{ $order->address->fname .' '. $order->address->lname }}</p>
            <p>{{ $order->address->address }}</p>
            <p>{{ $order->address->city }}</p>
            <p>{{ $order->address->state }}</p>
            <p>Phone {{ $order->address->phone }}</p>
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <p><b>Sender:</b></p>
            <p>Kitchen Designer</p>
            <p>Shop no 16 New Musaib Khan Market Near</p>
            <p>Nadeem Variety Store Zahid Colony</p>
            <p>Gujranwala,Punjab,Gujranwala -</p>
            <p>Shaheenabad,Zahid Colony</p>
            <p>Phone 03030126345</p>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  @endforeach
</div>
<script>
  window.onload = function() {
    window.print();
  };
</script>
</body>
</html>
