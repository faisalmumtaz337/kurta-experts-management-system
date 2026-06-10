@forelse($payments as $payment)
<tr>
  <td>{{ $payment->order->order_number }}</td>
  <td>{{ $payment->customer->name . ' ' . $payment->customer->caste }}</td>
  <td>{{ number_format($payment->amount, 0) }}</td>
  <td>{{ number_format($payment->order->total_amount, 0) }}</td>
  <td>{{ ucfirst($payment->payment_method) }}</td>
  <td>{{ ucfirst($payment->payment_type) }}</td>
  <td>{{ date('d-m-Y', strtotime($payment->payment_date)) }}</td>
  <td class="d-flex justify-content-end">
    <a class="btn-sm btn-light cancel-btn table-link" href="{{ route('payments.show', $payment->id) }}">
      <i class="fa-solid fa-info-circle"></i> Details
    </a>
  </td>
</tr>
@empty 
<tr>
  <td colspan="8" class="text-center text-muted">
    No Record Found
  </td>
</tr>
@endforelse