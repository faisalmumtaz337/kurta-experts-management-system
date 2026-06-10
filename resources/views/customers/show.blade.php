<x-dashboard-imports title="Customers">
  <x-header />
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <x-side-navbar />
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col sm 12">
            <x-flash-message />
          </div>
          <div class="col-sm-12 d-flex justify-content-between">
            <h3 class="mb-2 font-weight-bold article-title">Customers</h3>
          </div>
          <div class="col-sm-12 mb-3">
            <x-breadcrumb :items="[
                ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
                ['title' => 'Customers', 'url' => route('customers.index'), 'icon' => 'fa-solid fa-users'],
                ['title' => 'Customer Details', 'url' => '', 'icon' => 'fa-solid fa-circle-info'],
            ]" />
          </div>
          <div class="col-sm-12 d-flex justify-content-end mb-3">
            <div class="d-flex justify_content_end">
              <a class="btn-sm btn-inverse-warning custom-btn" href="{{ route('measurement-invoice', $customer->id) }}">
                <i class="fa-solid fa-print"></i> Print
              </a>
              <a class="btn-sm btn-inverse-light cancel-btn table-link mx-3" href="{{ route('customers.edit', $customer->id) }}">
                <i class="fa fa-pencil"></i> Edit
              </a>
              <a class="btn-sm btn-inverse-danger delete-btn table-link" data-toggle="modal" data-target="#deleteCustomer{{ $customer->id }}">
                <i class="fa-solid fa-trash-can"></i> Delete
              </a>

              <div class="modal fade" id="deleteCustomer{{ $customer->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5>Confirm Delete</h5>
                      <button class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                      Are you sure you want to delete this customer?
                    </div>

                    <div class="modal-footer">
                      <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-lighter cancel-btn" data-dismiss="modal"><i class="fa fa-circle-xmark"></i> Cancel</button>
                        <button type="submit" class="btn btn-inverse-warning custom-btn"><i class="fa-solid fa-trash-can"></i> Delete</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 profile_card">
            <div class="card text-center">
              <div class="card-body d-flex flex-column align-items-center justify-content-center">

                <div class="profile-img-wrapper mb-3">
                  <img 
                    src="{{ asset('storage/' . $customer->profile_image) }}"
                    alt="Profile Image"
                  >
                </div>

                <h3 class="profile_title pb-2">
                  {{ $customer->name . ' ' . $customer->caste }}
                </h3>

                <h5>{{ $customer->customer_number }}</h5>

              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Customers Information</h4>
                <div class="row">
                  <div class="col-md-6 mb-1">
                    <x-text-input type="text" label="Contact" value="{{ $customer->phone }}" />
                  </div>
                  <div class="col-md-6 mb-1">
                    <x-text-input type="text" label="Address" value="{{ $customer->address }}" />
                  </div>

                  {{-- Length --}}

                  <div class="col-md-12 mt-2">
                    <h4 class="card-title"><i class="fa fa-ruler"></i> Length</h4>
                  </div>
                  @if($customer->measurement->length_value)
                  <div class="col-md-6">
                    <x-text-input type="text" label="Length (Aam)" value="{{ $customer->measurement->length_value . ' in' }}" disabled />
                  </div>
                  @endif
                  @if($customer->measurement->length_cotton)
                  <div class="col-md-6">
                    <x-text-input type="text" label="Length (Cotton)" value="{{ $customer->measurement->length_cotton . ' in' }}" disabled />
                  </div>
                  @endif
                  @if($customer->measurement->length_washing_wear)
                  <div class="col-md-6">
                    <x-text-input type="text" label="Length (Washing Wear)" value="{{ $customer->measurement->length_washing_wear . ' in' }}" disabled />
                  </div>
                  @endif
                  <div class="col-md-6">
                    <x-text-input type="text" label="Length Type (Daaman)" value="{{ $customer->measurement->length_type }}" disabled />
                  </div>

                  {{-- Shoulder --}}

                  <div class="col-md-12 mt-2">
                    <h4 class="card-title"><i class="fa fa-User"></i> Shoulder</h4>
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Shoulder" value="{{ $customer->measurement->shoulder . ' in' }}" disabled />
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Shoulder Type" value="{{ $customer->measurement->shoulder_type }}" disabled />
                  </div>

                  {{-- Sleeve --}}

                  <div class="col-md-12 mt-2">
                    <h4 class="card-title"><i class="fa fa-thumbs-up"></i> Sleeve</h4>
                  </div>
                  <div class="col-md-12">
                    <x-text-input type="text" label="Sleeve" value="{{ $customer->measurement->sleeve . ' in' }}" disabled />
                  </div>

                  @if($customer->measurement->cuff_type === 'Cuff')
                  <div class="col-md-6">
                    <x-text-input type="text" label="Cuff Type" value="{{ $customer->measurement->cuff_type }}" disabled />
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Cuff Size" value="{{ $customer->measurement->cuff . ' in' }}" disabled />
                  </div>

                  @elseif($customer->measurement->cuff_type === 'Cuffing Single')
                  <div class="col-md-6">
                    <x-text-input type="text" label="Cuff Type" value="{{ $customer->measurement->cuff_type }}" disabled />
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Cuff Size" value="{{ $customer->measurement->cuff_single . ' in' }}" disabled />
                  </div>

                  @elseif($customer->measurement->cuff_type === 'Cuffing Double')
                  <div class="col-md-6">
                    <x-text-input type="text" label="Cuff Type" value="{{ $customer->measurement->cuff_type }}" disabled />
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Cuff Size" value="{{ $customer->measurement->cuff_double . ' in' }}" disabled />
                  </div>

                  @elseif($customer->measurement->cuff_type === 'Gol Bazu Pati')
                  <div class="col-md-6">
                    <x-text-input type="text" label="Cuff Type" value="{{ $customer->measurement->cuff_type }}" disabled />
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Cuff Size" value="{{ $customer->measurement->golpati . ' in' }}" disabled />
                  </div>

                  @elseif($customer->measurement->cuff_type === 'Gol Bazu Kani')
                  <div class="col-md-6">
                    <x-text-input type="text" label="Cuff Type" value="{{ $customer->measurement->cuff_type }}" disabled />
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Cuff Size" value="{{ $customer->measurement->golkani . ' in' }}" disabled />
                  </div>

                  @endif

                  {{-- Body --}}

                  <div class="col-md-12 mt-2">
                    <h4 class="card-title"><i class="fa fa-person"></i> Body</h4>
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Hips" value="{{ $customer->measurement->hips . ' in' }}" disabled />
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Waist" value="{{ $customer->measurement->waist . ' in' }}" disabled />
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Chhati" value="{{ $customer->measurement->chhati . ' in' }}" disabled />
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Chest (All around)" value="{{ $customer->measurement->chest . ' in' }}" disabled />
                  </div>

                  @if($customer->measurement->extra_request_waist) 
                  <div class="col-md-12">
                    <x-text-input type="text" label="Extra (Izafi Farmaish)" value="{{ $customer->measurement->extra_request_waist }}" disabled />
                  </div>
                  @endif

                  {{-- Collar --}}

                  {{-- <div class="col-md-12 mt-4">
                    <h4 class="card-title"><i class="fa-solid fa-user-tie"></i> Collar</h4>
                  </div>
                  <div class="{{ $customer->measurement->collar_nok ? 'col-md-4' : 'col-md-6' }}">
                    <x-text-input type="text" label="Collar Size" value="{{ $customer->measurement->collar_value . ' in' }}" disabled />
                  </div>

                  @if($customer->measurement->collar)
                  <div class="{{ $customer->measurement->collar_nok ? 'col-md-4' : 'col-md-6' }}">
                    <x-text-input type="text" label="Collar" value="{{ $customer->measurement->collar }}" disabled />
                  </div>
                  @elseif($customer->measurement->collar_nok)
                  <div class="{{ $customer->measurement->collar_nok ? 'col-md-4' : 'col-md-6' }}">
                    <x-text-input type="text" label="Collar Nok Size" value="{{ $customer->measurement->collar_nok . ' in' }}" disabled />
                  </div>
                  @endif
                  @if($customer->measurement->sherwani)
                  <div class="{{ $customer->measurement->sherwani ? 'col-md-4' : 'col-md-6' }}">
                    <x-text-input type="text" label="Sherwani" value="{{ $customer->measurement->sherwani }}" disabled />
                  </div>
                  @elseif($customer->measurement->khasi)
                  <div class="col-md-6">
                    <x-text-input type="text" label="Khasi" value="{{ $customer->measurement->khasi }}" disabled />
                  </div>
                  @endif --}}


                  @php
                      $measurement = $customer->measurement;

                      $items = 1; // Collar Size hamesha show hoga

                      if ($measurement->collar || $measurement->collar_nok) {
                          $items++;
                      }

                      if ($measurement->sherwani) {
                          $items++;
                      }

                      if ($measurement->khasi) {
                          $items++;
                      }

                      $colClass = match(true) {
                          $items >= 4 => 'col-md-3', // 4 items
                          $items == 3 => 'col-md-4', // 3 items
                          default => 'col-md-6',     // 2 items
                      };
                  @endphp

                  <div class="col-md-12 mt-2">
                      <h4 class="card-title">
                          <i class="fa-solid fa-user-tie"></i> Collar
                      </h4>
                  </div>

                  {{-- Collar Size --}}
                  <div class="{{ $colClass }}">
                      <x-text-input
                          type="text"
                          label="Collar Size"
                          value="{{ $measurement->collar_value . ' in' }}"
                          disabled
                      />
                  </div>

                  {{-- Collar / Collar Nok --}}
                  @if($measurement->collar)
                      <div class="{{ $colClass }}">
                          <x-text-input
                              type="text"
                              label="Collar"
                              value="{{ $measurement->collar }}"
                              disabled
                          />
                      </div>
                  @elseif($measurement->collar_nok)
                      <div class="{{ $colClass }}">
                          <x-text-input
                              type="text"
                              label="Collar Nok Size"
                              value="{{ $measurement->collar_nok . ' in' }}"
                              disabled
                          />
                      </div>
                  @endif

                  {{-- Sherwani --}}
                  @if($measurement->sherwani)
                      <div class="{{ $colClass }}">
                          <x-text-input
                              type="text"
                              label="Sherwani"
                              value="{{ $measurement->sherwani }}"
                              disabled
                          />
                      </div>
                  @endif

                  {{-- Khasi --}}
                  @if($measurement->khasi)
                      <div class="{{ $colClass }}">
                          <x-text-input
                              type="text"
                              label="Khasi"
                              value="{{ $measurement->khasi }}"
                              disabled
                          />
                      </div>
                  @endif

                  {{-- Shalwar --}}

                  <div class="col-md-12 mt-2">
                    <h4 class="card-title"><i class="fa-brands fa-google-wallet"></i> Shalwar</h4>
                  </div>
                  <div class="col-md-4">
                    <x-text-input type="text" label="Shalwar" value="{{ $customer->measurement->shalwar_value . ' in' }}" disabled />
                  </div>
                  <div class="col-md-4">
                    <x-text-input type="text" label="Shalwar Type" value="{{ $customer->measurement->shalwar_type }}" disabled />
                  </div>
                  <div class="col-md-4">
                    <x-text-input type="text" label="Aasam" value="{{ $customer->measurement->aasam . ' in' }}" disabled />
                  </div>
                      
                  {{-- Bottom (Pacho) --}}
                  <div class="col-md-12 mt-2">
                    <h4 class="card-title"><i class="fa fa-ruler"></i> Bottom (Pacho)</h4>
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Pacho Size" value="{{ $customer->measurement->ankle_opening_value . ' in' }}" disabled />
                  </div>
                  <div class="col-md-6">
                    <x-text-input type="text" label="Pacho Type" value="{{ $customer->measurement->ankle_type }}" disabled />
                  </div>
                  <div class="col-md-12">
                    <x-text-input type="text" label="Izafi Farmaish" value="{{ $customer->measurement->pacho_extra }}" disabled />
                  </div>

                  {{-- Pocket --}}

                  <div class="col-md-12 mt-2">
                    <h4 class="card-title"><i class="fa-brands fa-shirtsinbulk"></i> Pockets</h4>
                  </div>
                  <div class="col-md-4">
                    <x-text-input type="text" label="Pocket Type" value="{{ $customer->measurement->pocket_type }}" disabled />
                  </div>
                  <div class="col-md-4">
                    <x-text-input type="text" label="Pocket Style" value="{{ $customer->measurement->pocket_style }}" disabled />
                  </div>
                  <div class="col-md-4">
                    <x-text-input type="text" label="Pocket Size" value="{{ $customer->measurement->pocket_size }}" disabled />
                  </div>
                  @if($customer->measurement->extra_pocket_style)
                  <div class="col-md-12">
                    <x-text-input type="text" label="Izafi Farmaish" value="{{ $customer->measurement->extra_pocket_style }}" disabled />
                  </div>
                  @endif

                  {{-- Shirt --}}

                  <div class="col-md-12 mt-2">
                    <h4 class="card-title"><i class="fa fa-shirt"></i> Shirt</h4>
                  </div>
                  <div class="col-md-12">
                    <x-text-input type="text" label="Shirt Type" value="{{ $customer->measurement->shirt_type }}" disabled />
                  </div>

                  {{-- Front Pati --}}

                  <div class="col-md-12 mt-2">
                    <h4 class="card-title"><i class="fa-solid fa-chart-simple"></i> Front Pati</h4>
                  </div>
                  <div class="{{$customer->measurement->cover_pati ? 'col-md-4' : 'col-md-6' }}">
                    <x-text-input type="text" label="Front Pati Height" value="{{ $customer->measurement->front_pati . ' in' }}" disabled />
                  </div>
                  <div class="{{$customer->measurement->cover_pati ? 'col-md-4' : 'col-md-6' }}">
                    <x-text-input type="text" label="Front Pati Length" value="{{ $customer->measurement->front_pati_length }}" disabled />
                  </div>
                  @if($customer->measurement->cover_pati)
                  <div class="col-md-4">
                    <x-text-input type="text" label="Cover Pati" value="{{ $customer->measurement->cover_pati }}" disabled />
                  </div>
                  @endif

                  {{-- Stitching Type --}}

                  <div class="col-md-12 mt-2">
                    <h4 class="card-title"><i class="fa-solid fa-chart-simple"></i> Stitching Type</h4>
                  </div>
                  <div class="col-md-12">
                    <x-text-input type="text" label="Stitching Type" value="{{ $customer->measurement->sewing_type }}" disabled />
                  </div>

                  @if($customer->measurement->notes) 
                  {{-- Extra Note --}}

                  <div class="col-md-12 mt-2">
                    <h4 class="card-title"><i class="fa-solid fa-book"></i> Extra Notes</h4>
                  </div>
                  <div class="col-md-12">
                    <textarea name="notes" class="form-control" rows="4" disabled>{{ $customer->measurement->notes }}</textarea>
                  </div>
                  @endif

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <x-footer />
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
</x-dashboard-imports>