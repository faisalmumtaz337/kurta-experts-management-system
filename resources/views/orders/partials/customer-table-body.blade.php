@forelse($customers as $customer)
<tr>
  <td>    
    <div class="col-sm-6">
      <div class="form-check">
        <label class="form-check-label">
          <input 
            type="radio"
            name="customer_select"
            value="{{ $customer->id }}"
            class="customer-checkbox form-check-input"
          >
          <i class="input-helper"></i>
        </label>
      </div>
    </div>
  </td>

  <td>
    <img src="{{ asset('storage/' . $customer->profile_image) }}" alt="image"/>
    <span class="pl-2">
      {{ $customer->name . ' ' . $customer->caste }}
    </span>
  </td>

  <td>{{ $customer->customer_number }}</td>
</tr>
@empty 
<tr>
  <td colspan="7" class="text-center text-muted">
    No Customer for order
  </td>
</tr>
@endforelse