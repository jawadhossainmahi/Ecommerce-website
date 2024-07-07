
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Order List</title>
  <link rel="stylesheet" href="style.css" media="all" />
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
  width: 100%;  
  height: 100%; 
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
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #066924;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(https://livshem.se/app-assets/images/dimension.png);
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
  color: #050506;
  font-weight: bold;
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
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}
#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}
  </style>
</head>

<body>
  <header class="clearfix">
    <div id="logo">
      <img src="{{ env("BASE_URL") }}app-assets/images/logo/livshem9.png">
    </div>
    <h1>Order List</h1>
    <div id="company" class="clearfix">
      <div>Company Name</div>
      <div>DevIkTech</div>
      <div>(602) 519-0450</div>
      <div><a href="mailto:deviktech0@gmail.com">deviktech0@gmail.com</a></div>
    </div>
    <div id="project">
      <div><span>CLIENT</span> {{auth()->user()->name}}</div>
      <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
      <div><span>EMAIL</span> <a href="{{auth()->user()->email}}">{{auth()->user()->email}}</a></div>
      <div><span>DATE</span> {{$order['date']}}</div>
    </div>
  </header>
  <main>
    <table>
      <thead>
        <tr>
          <th class="service">Product Name</th>
          <th>Category Name</th>
          <th>STATUS</th>
          <th>PRICE</th>
          <th>QTY</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>
        @php
        $subtotal =[];
        $taxRate=5;
        @endphp
        @foreach ($order ['list'] as $order_list)
        @foreach ($order_list->getorder as $product_list)
        <tr>
          <td class="service">{{$product_list->getproduct ? $product_list->getproduct->name : '-'}}</td>
          <td class="category name">{{$product_list->getproduct->getcategory->name}}</td>
          <td class="status">{{$order_list->status ? $order_list->status : '-'}}</td>
          <td class="price">{{$product_list->getproduct ? $product_list->getproduct->price : '-'}} $</td>
          <td class="qty">{{$product_list ? $product_list->qty : '-'}}</td>
          @php
          $total = $product_list->qty * $product_list->getproduct->price;
          array_push($subtotal,$total);
          @endphp
          <td class="total">${{$total}}</td>
        </tr>
        @endforeach
        @endforeach
        @php
        $price = array_sum($subtotal);
        $tax = $price*$taxRate/100;
        $tax_total = $tax + $price;
        // $grand_total = $tax_total + $price;
        @endphp

        <tr>
          <td colspan="5">SUBTOTAL</td>
          <td class="total">${{$price}}</td>
        </tr>

        <tr>
          <td colspan="5">TAX 5%</td>
          <td class="total">${{$tax}}</td>
        </tr>
        <tr>
          <td colspan="5" class="grand total">GRAND TOTAL</td>
          <td class="grand total">${{ $tax_total}}</td>
        </tr>
      </tbody>
    </table>
    <div id="thanks">Thank you!</div>
    <div id="notices">
      <div>NOTICE:</div>
      <div class="notice">A finance charge of 0.5% will be made on unpaid balances after 30 days.</div>
    </div>
  </main>
  <footer>
    OrderList was created on a computer and is valid without the signature and seal.
  </footer>
</body>

</html>
