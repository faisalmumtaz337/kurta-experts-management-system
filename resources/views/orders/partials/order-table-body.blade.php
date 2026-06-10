@forelse($orders as $order)
<tr>
  <td>{{ $order->order_number }}</td>
  <td>
    <span class="pl-2">{{ $order->customer->name . ' ' . $order->customer->caste }}</span>
  </td>
  <td>{{ number_format($order->total_amount, 1) }}</td>
  <td>{{ number_format($order->paid_amount, 1) }}</td>
  <td>{{ $order->suit_quantity }}</td>
  <td>{{ date('d-m-Y', strtotime($order->order_date)) }}</td>
  <td>{{ $order->delivery_date ? date('d-m-Y', strtotime($order->delivery_date)) : '-' }}</td>
  <td>
    <x-badge type="{{ 
        $order->status === 'Pending' ? 'warning' : 
        ($order->status === 'Cutting' ? 'primary' : 
        ($order->status === 'Stitching' ? 'secondary' : 
        ($order->status === 'Packing' ? 'info' : 
        ($order->status === 'Delivered' ? 'success' : ''))))
    }}">
    {{ ucfirst($order->status) }}</x-badge>
  </td>
  <td class="d-flex justify-content-end">
    <a class="btn-sm btn-light cancel-btn table-link" href="{{ route('orders.show', $order->id) }}">
      <i class="fa-solid fa-circle-info"></i> Details
    </a>
  </td>
</tr>
@empty 
<tr>
  <td colspan="9" class="text-center text-muted">
    No Orders Found
  </td>
</tr>
@endforelse