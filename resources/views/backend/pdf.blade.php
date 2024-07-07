<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="app-assets/images/logo/livshem9.png">
      </div>
      <h1>INVOICE</h1>
      <div id="company" class="clearfix">
        <div>Company Name</div>
        <div>DevIkTech</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:deviktech0@gmail.com">deviktech0@gmail.com</a></div>
      </div>
      <div id="project">
        <div><span>CLIENT</span> {{$user->name}}</div>
        <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
        <div><span>EMAIL</span> <a href="{{$user->email}}">{{$user->email}}</a></div>
        <div><span>DATE</span> {{$date}}</div>
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
          @foreach ($list as $order_list)
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
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>