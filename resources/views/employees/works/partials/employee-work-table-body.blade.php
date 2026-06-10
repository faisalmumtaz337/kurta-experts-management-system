@forelse($employees as $employee)
<tr>
  <td>{{ $loop->iteration }}</td>
  <td>{{ $employee->employee->name . ' ' . $employee->employee->caste }}</td>
  <td>{{ $employee->order->order_number ?? 'N/A' }}</td>
  <td>{{ $employee->qty }}</td>
  <td>{{ number_format($employee->rate, 1) }}</td>
  <td>{{ number_format($employee->amount, 1) }}</td>
  <td>{{ $employee->work_type }}</td>
  <td>{{ date('d-m-Y', strtotime($employee->work_date)) }}</td>
  <td>{{ $employee->notes }}</td>
  <td class="d-flex justify-content-end">
    {{-- <a class="btn-sm btn-light cancel-btn table-link mr-2" href="{{ route('employee-works.edit', $employee->id) }}">
      <i class="fa-solid fa-pencil"></i> Edit
    </a> --}}
  </td>
</tr>
@empty 
<tr>
  <td colspan="9" class="text-center text-muted">
    No Employee Found
  </td>
</tr>
@endforelse