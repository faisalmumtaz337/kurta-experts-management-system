@forelse($payments as $payment)
<tr>
  <td>{{ $loop->iteration }}</td>
  <td>{{ $payment->employee->name . ' ' . $payment->employee->caste }}</td>
  <td>{{ $payment->amount }}</td>
  <td>{{ date('d-m-Y', strtotime($payment->payment_date)) }}</td>
  <td class="d-flex justify-content-end">
    <a class="btn-sm btn-light cancel-btn table-link mr-2" href="{{ route('employee-payments.show', $payment->id) }}">
      <i class="fa-solid fa-info-circle"></i> Details
    </a>
  </td>
</tr>
@empty 
<tr>
  <td colspan="5" class="text-center text-muted">
    No Record Found
  </td>
</tr>
@endforelse