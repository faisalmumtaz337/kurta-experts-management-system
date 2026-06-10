<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="{{ public_path('css/invoices.css') }}">
  </head>
  <body>
    <style>
        @font-face {
            font-family: 'Lobster';
            src: url("{{ public_path('fonts/Lobster-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        .center {
            font-family: 'Lobster';
            font-size: 20px;
            text-align: center;
        }
    </style>
    <div class="container">

      <!-- Logo -->
      <div class="logo-container">
        <img src="{{ public_path('images/receipt_logo.png') }}" class="logo">
      </div>

      <!-- Shop Name -->
      <div class="center">
          Kurta Experts
      </div>

      <div class="line"></div>

      <div class="data-container">
        <!-- Customer Info -->
        <div class="customer-info">
            <span class="customer-name">Customer: {{ $order->customer->name . ' ' . $order->customer->caste ?? 'N/A' }}</span>
            <span class="customer-number">Customer No. {{ $order->customer->customer_number }}</span>
        </div>
    
        <div class="line"></div>
    
        <!-- Order Info -->
        <table class="order-table">
            <tr>
                <td>Order No.</td>
                <td class="right">{{ $order->order_number }}</td>
            </tr>

            <tr>
                <td>Booking Date</td>
                <td class="right">{{ $order->order_date }}</td>
            </tr>

            <tr>
                <td>Delivery Date</td>
                <td class="right">{{ $order->delivery_date }}</td>
            </tr>
    
            <tr>
                <td>Suit Quantity</td>
                <td class="right">{{ $order->suit_quantity }}</td>
            </tr>

            <tr>
                <td>Delivery Type</td>
                <td class="right">{{ $order->is_urgent === 1 ? 'Urgent' : 'Normal' }}</td>
            </tr>
    
            <tr>
                <td>Total Amount</td>
                <td class="right">{{ $order->total_amount }}</td>
            </tr>
    
            <tr>
                <td>Paid Amount</td>
                <td class="right">{{ $order->paid_amount }}</td>
            </tr>
        </table>
    
        <div class="line"></div>
    
        <!-- Footer -->
        <div class="thankful">
            ** Thank you for choosing us! **
        </div>

        <div class="line"></div>

        <div class="developer">
            <span>Software Designed and Developed By</span>
            <span class="developer-name">Faisal Mumtaz Depar</span>
            <span>Contact: 03037340121</span>
        </div>
      </div>

    </div>
  </body>
</html>