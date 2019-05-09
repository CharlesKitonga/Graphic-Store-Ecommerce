@component('mail::message')
# Order Received

Thank you for your order.

**Order ID:** {{ $order->id }}

**Order Email:** {{ $order->email }}

**Order Name:** {{ $order->name }}

**Order Total:** {{ round($order->total) }}

**Items Ordered**

@foreach ($order->products as $product)
Name: {{ $product->category_name }} <br>
Price: ${{ round($product->price)}} <br>
Designs: {{ $product->design }} <br>
@endforeach

You can get further details about your order by logging into our website.

@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Go to Website
@endcomponent

Thank you again for choosing us.

Regards,<br>
{{ config('app.name') }}
@endcomponent