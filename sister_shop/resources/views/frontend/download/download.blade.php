<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 18cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="https://i.postimg.cc/g2s2g877/260px-svg.png" width="70" height="70">
        </div>
        <h1>INVOICE {{ $order_id }}</h1>
        <div id="company" class="clearfix">
            <div>Company Name: Sister Shop</div>
            <div>Gabtoli,<br /> Dhaka, Bangladesh</div>
            <div>01831917228</div>
            <div><a href="mojiburr395@gmail.com">mojiburr395@gmail.com</a></div>
        </div>
        <div id="project">
           Name:{{ App\Models\Billing_Details::where('order_id', $order_id)->first()->customer_name }}<br>
            Email:{{ App\Models\Billing_Details::where('order_id', $order_id)->first()->email }}<br>
            Address:{{ App\Models\Billing_Details::where('order_id', $order_id)->first()->customer_address }}<br>
            Phone:{{ App\Models\Billing_Details::where('order_id', $order_id)->first()->customer_number }}<br>
            Order Date:{{ App\Models\Billing_Details::where('order_id', $order_id)->first()->created_at->format('d-M-Y') }}

        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>
                    <th>Charge</th>
                    <th>Discount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sub = 0;
                @endphp
                @foreach (App\Models\OrderProduct::where('order_id', $order_id)->get() as $order_product)
                    <tr>
                        <td>{{ $order_product->rel_to_product->product_name }}</td>
                        <td>{{ $order_product->rel_to_product->product_after_discount_price }}</td>
                        <td>{{ $order_product->quantity }}</td>
                        <td>{{ $order_product->rel_to_product->product_after_discount_price * $order_product->quantity }}
                        </td>
                        <td> {{ App\Models\Order::where('order_id', $order_id)->first()->charge }}</td>
                        <td>{{ App\Models\Order::where('order_id', $order_id)->first()->discount }}</td>
                        <td>{{ App\Models\Order::where('order_id', $order_id)->first()->total }}</td>
                    </tr>
                    @php
                        $sub = $sub + $order_product->rel_to_product->product_after_discount_price * $order_product->quantity;
                    @endphp
                @endforeach
            </tbody>
        </table>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>
