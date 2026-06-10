@forelse($customers as $customer)
<tr>
  <td>{{ $loop->iteration }}</td>
  <td>
    <img src="{{ asset('storage/' . $customer->profile_image) }}" alt="image"/>
    <span class="pl-2">{{ $customer->name . ' ' . $customer->caste }}</span>
  </td>
  <td>{{ $customer->phone }}</td>
  <td>{{ $customer->customer_number }}</td>
  <td>{{ $customer->address }}</td>
  <td class="d-flex justify-content-end">
    <a class="btn-sm btn-light cancel-btn table-link" href="{{ route('customers.show', $customer->id) }}">
      <i class="fa-solid fa-info-circle"></i> Details
    </a>
  </td>
</tr>
@empty 
<tr>
  <td colspan="7" class="text-center text-muted">
    No Customer Found
  </td>
</tr>
@endforelse