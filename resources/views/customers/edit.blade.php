<x-dashboard-imports title="Measurements">
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
        <form class="forms-sample" action="{{ route('measurements.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="col-sm-12 d-flex justify-content-between">
              <h3 class="mb-2 font-weight-bold article-title">Customer & Measurements</h3>
            </div>
            <div class="col-sm-12 mb-3">
              <x-breadcrumb :items="[
                  ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
                  ['title' => 'Customers', 'url' => route('customers.index'), 'icon' => 'fa-solid fa-users'],
                  ['title' => 'Edit Customer Information', 'url' => '', 'icon' => 'fa fa-pencil']
              ]" />
            </div>
            {{-- Customer Information --}}  
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Customer & Measurement Information</h4>
                  <div class="row">
                    <div class="col-sm-6">    
                      {{-- Name --}}    
                      
                      <div class="form-group">
                        <x-text-input name="name" label="Name" value="{{ $customer->name }}" />
                      </div>
                        
                    </div>
                    <div class="col-sm-6">
                      {{-- Caste --}}
    
                      <div class="form-group">
                        <x-text-input name="caste" label="Caste" value="{{ $customer->caste }}" />
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      {{-- Phone --}}
  
                      <div class="form-group">
                        <x-text-input type="number" name="phone" label="Phone" placeholder="Phone" value="{{ $customer->phone }}" />
                      </div>
                    </div>
    
                    <div class="col-sm-6">
                      {{-- Address --}}
  
                      <div class="form-group">
                        <x-text-input name="address" label="Address" placeholder="Address" value="{{ $customer->address }}" />
                      </div>
                    </div>

                    <div class="col-sm-12">
                      {{-- Profile Image --}}
                      
                      <div class="form-group">
                        <label>Profile Image</label>
                        <input type="file" name="profile_image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-light" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            
            {{-- Length / Shoulder --}}
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h4 class="card-title"><i class="fa fa-ruler"></i> Length</h4>
                      <x-text-input class="mb-3" type="number" name="length_value" label="Length" placeholder="Length in (inches)" value="{{ $customer->measurement->length_value }}" />
                      <x-text-input class="mb-3" type="number" name="length_cotton" label="Length (Cotton)" placeholder="Length in (inches)" value="{{ $customer->measurement->length_cotton }}" />
                      <x-text-input class="mb-3" type="number" name="length_washing_wear" label="Length (Washing Wear)" placeholder="Length in (inches)" value="{{ $customer->measurement->length_washing_wear }}" />
                      <div class="form-group row">
                        <div class="col-sm-12 mt-2">
                          <span>Daaman</span>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="circle" class="form-check-label">
                              <input type="radio" class="form-check-input" name="length_type" id="circle" value="Gol" {{ $customer->measurement->length_type === 'Gol' ? 'checked' : '' }}>
                              Gol
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="square" class="form-check-label">
                              <input type="radio" class="form-check-input" name="length_type" id="square" value="Choras" {{ $customer->measurement->length_type === 'Choras' ? 'checked' : '' }}>
                              Choras
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="cds" class="form-check-label">
                              <input type="radio" class="form-check-input" name="length_type" id="cds" value="Gol Double" {{ $customer->measurement->length_type === 'Gol Double' ? 'checked' : '' }}>
                              Gol Double
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="kwk" class="form-check-label">
                              <input type="radio" class="form-check-input" name="length_type" id="kwk" value="Kaliwala Kurta" {{ $customer->measurement->length_type === 'Kaliwala Kurta' ? 'checked' : '' }}>
                              Kaliwala Kurta
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <h4 class="card-title"><i class="fa fa-user"></i> Shoulder</h4>
                      <x-text-input type="number" name="shoulder" label="Shoulder" placeholder="Shoulder in (inches)" value="{{ $customer->measurement->shoulder }}" />
                      <div class="row">
                        <div class="col-sm-12 mt-2">
                          <span>Shoulder Type</span>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <div class="form-check">
                                <label for="kandha_down" class="form-check-label">
                                  <input type="radio" class="form-check-input" name="shoulder_type" id="kandha_down" value="Kandha Down" {{ $customer->measurement->shoulder_type === 'Kandha Down' ? 'checked' : '' }}>
                                  Kandha Down
                                <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-check">
                                <label for="kandha_straight" class="form-check-label">
                                  <input type="radio" class="form-check-input" name="shoulder_type" id="kandha_straight" value="Kandha Straight" {{ $customer->measurement->shoulder_type === 'Kandha Straight' ? 'checked' : '' }}>
                                  Kandha Straight
                                <i class="input-helper"></i></label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Sleeve --}}
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h4 class="card-title"><i class="fa fa-thumbs-up"></i> Sleeve</h4>
                      <x-text-input class="mb-2" type="number" name="sleeve" label="Sleeve" placeholder="Sleeve in (inches)" value="{{ $customer->measurement->sleeve }}" />
                    </div>
                    <div class="col-md-6 row">
                      <div class="col-md-12 mb-3">
                        <label class="col-form-label py-0 my-0">Cuff Type</label>
                      </div>
                      <div class="col-md-12">
                        <div class="row d-flex mb-2">
                          <div class="col">
                            <div class="form-check">
                              <label for="cuff" class="form-check-label">
                                <input type="radio" class="form-check-input" name="cuff_type" id="cuff" value="Cuff" {{ $customer->measurement->cuff_type === 'Cuff' ? 'checked' : '' }}>
                                Cuff
                                <i class="input-helper"></i>
                              </label>
                            </div>
                          </div>
                          <div class="col">
                            <x-text-input type="number" name="cuff" placeholder="Cuff Size" value="{{ $customer->measurement->cuff != null ? $customer->measurement->cuff : '' }}" />
                          </div>
                        </div>
                        <div class="row d-flex mb-2">
                          <div class="col">
                            <div class="form-check">
                              <label for="cuffing-single" class="form-check-label">
                                <input type="radio" class="form-check-input" name="cuff_type" id="cuffing-single" value="Cuffing Single" {{ $customer->measurement->cuff_type === 'Cuffing Single' ? 'checked' : '' }}>
                                Cuffing Single
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col">
                            <x-text-input type="number" name="cuff_single" placeholder="Cuff Single Size" value="{{ $customer->measurement->cuff_single != null ? $customer->measurement->cuff_single : '' }}" />
                          </div>
                        </div>
                        <div class="row d-flex mb-2">
                          <div class="col">
                            <div class="form-check">
                              <label for="cuffing_double" class="form-check-label">
                                <input type="radio" class="form-check-input" name="cuff_type" id="cuffing_double" value="Cuffing Double" {{ $customer->measurement->cuff_type === 'Cuffing Double' ? 'checked' : '' }}>
                                Cuffing Double
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col">
                            <x-text-input type="number" name="cuff_double" placeholder="Cuff Double Size" value="{{ $customer->measurement->cuff_double != null ? $customer->measurement->cuff_double : '' }}" />
                          </div>
                        </div>
                        <div class="row d-flex mb-2">
                          <div class="col">
                            <div class="form-check">
                              <label for="golpati" class="form-check-label">
                                <input type="radio" class="form-check-input" name="cuff_type" id="golpati" value="Gol Bazu Pati" {{ $customer->measurement->cuff_type === 'Gol Bazu Pati' ? 'checked' : '' }}>
                                Gol Bazu Pati
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col">
                            <x-text-input type="number" name="golpati" placeholder="Gol Bazu Pati Size" value="{{ $customer->measurement->golpati != null ? $customer->measurement->golpati : '' }}" />
                          </div>
                        </div>
                        <div class="row d-flex mb-2">
                          <div class="col">
                            <div class="form-check">
                              <label for="golkani" class="form-check-label">
                                <input type="radio" class="form-check-input" name="cuff_type" id="golkani" value="Gol Bazu Kani" {{ $customer->measurement->cuff_type === 'Gol Bazu Kani' ? 'checked' : '' }}>
                                Gol Bazu Kani
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col">
                            <x-text-input type="number" name="golkani" placeholder="Gol Bazu Kani Size" value="{{ $customer->measurement->golkani != null ? $customer->measurement->golkani : '' }}" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Body --}}
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><i class="fa fa-person"></i> Body</h4>
                  <div class="row">
                    <div class="col-md-3">
                      <x-text-input type="number" name="hips" label="Hips" placeholder="Hips in (inches)" class="mb-3" value="{{ $customer->measurement->hips }}" />
                    </div>
                    <div class="col-md-3">
                      <x-text-input type="number" name="waist" label="Waist" placeholder="Waist in (inches)" class="mb-3" value="{{ $customer->measurement->waist }}" />
                    </div>
                    <div class="col-md-3">
                      <x-text-input type="number" name="chhati" label="Chhati" placeholder="Chhati in (inches)" class="mb-3" value="{{ $customer->measurement->chhati }}" />
                    </div>
                    <div class="col-md-3">
                      <x-text-input type="number" name="chest" label="Chest (All Around)" placeholder="Chest in (inches)" class="mb-3" value="{{ $customer->measurement->chest }}" />
                    </div>
                    <div class="col-md-12">
                      <x-text-input type="text" name="extra_request_waist" label="Extra" placeholder="Izafi Farmaish Details" class="mb-3" value="{{ $customer->measurement->extra_request_waist }}" />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Collar --}}
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><i class="fa-solid fa-user-tie"></i> Collar</h4>
                  <x-text-input type="number" name="collar_value" label="Collar Size" placeholder="Collar in (inches)" class="mb-3" value="{{ $customer->measurement->collar_value }}" />
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <div class="col-sm-3">
                          <label class="col-form-label">Collar</label>
                        </div>
                        <div class="col-sm-9 row">
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="collar" value="Straight" class="form-check-input" 
                                {{ $customer->measurement->collar === 'Straight' ? 'checked' : '' }}
                              >
                              Straight
                            </label>
                          </div>
  
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="collar" value="Arrow" class="form-check-input"
                                {{ $customer->measurement->collar === 'Arrow' ? 'checked' : '' }}
                              >
                              Arrow
                            </label>
                          </div>
  
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="collar" value="Normal" class="form-check-input"
                                {{ $customer->measurement->collar === 'Normal' ? 'checked' : '' }}
                              >
                              Normal
                            </label>
                          </div>
                          <div class="col-sm-12">
                            <span>Collar Nok</span>
                          </div>
                          <div class="col-sm-12">
                            <div class="row d-flex">
                              <div class="col">
                                <div class="form-check">
                                  <label for="nok1" class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="collar_nok" id="nok1" value="1.5"
                                      {{ $customer->measurement->collar_nok === '1.5' ? 'checked' : '' }}
                                    >
                                    1.5 in
                                  <i class="input-helper"></i></label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check">
                                  <label for="nok2" class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="collar_nok" id="nok2" value="2"
                                      {{ $customer->measurement->collar_nok === '2' ? 'checked' : '' }}
                                    >
                                    2 in
                                  <i class="input-helper"></i></label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check">
                                  <label for="nok3" class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="collar_nok" id="nok3" value="2.25"
                                      {{ $customer->measurement->collar_nok === '2.25' ? 'checked' : '' }}
                                    >
                                    2.25 in
                                  <i class="input-helper"></i></label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check">
                                  <label for="nok4" class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="collar_nok" id="nok4" value="2.5"
                                      {{ $customer->measurement->collar_nok === '2.5' ? 'checked' : '' }}
                                    >
                                    2.5 in
                                  <i class="input-helper"></i></label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check">
                                  <label for="nok5" class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="collar_nok" id="nok5" value="2.75"
                                      {{ $customer->measurement->collar_nok === '2.75' ? 'checked' : '' }}
                                    >
                                    2.75 in
                                  <i class="input-helper"></i></label>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sherwani</label>
                        <div class="col-md-9 row">
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="sherwani" value="Square" class="form-check-input"
                                {{ $customer->measurement->sherwani === 'Square' ? 'checked' : '' }}
                              >
                              Square
                            </label>
                          </div>
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="sherwani" value="Inch Round" class="form-check-input"
                                {{ $customer->measurement->sherwani === 'Inch Round' ? 'checked' : '' }}
                              >
                              Inch Round
                            </label>
                          </div>
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="sherwani" value="Mono 0.75 Inch" class="form-check-input"
                                {{ $customer->measurement->sherwani === 'Mono 0.75 Inch' ? 'checked' : '' }}
                              >
                              Mono 0.75 Inch
                            </label>
                          </div>
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="sherwani" value="Haf Inch" class="form-check-input"
                                {{ $customer->measurement->sherwani === 'Haf Inch' ? 'checked' : '' }}
                              >
                              Haf Inch
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Khasi</label>
                        <div class="col-md-9 row">
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="khasi" value="Khasi Gala" class="form-check-input"
                                {{ $customer->measurement->khasi === 'Khasi Gala' ? 'checked' : '' }}
                              >
                              Khasi Gala
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Shalwar --}}
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h4 class="card-title"><i class="fa-brands fa-google-wallet"></i> Shalwar</h4>
                      <x-text-input type="number" name="shalwar_value" label="Shalwar" placeholder="Shalwar in (inches)" value="{{ $customer->measurement->shalwar_value }}" />
                      <div class="form-group row">
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="common" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="common" value="Aam Shalwar"
                               {{ $customer->measurement->shalwar_type === 'Aam Shalwar' ? 'checked' : '' }}
                              >
                              Aam Shalwar
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="gher" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="gher" value="Gher Shalwar"
                                {{ $customer->measurement->shalwar_type === 'Gher Shalwar' ? 'checked' : '' }}
                              >
                              Gher Shalwar
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pent" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="pent" value="Pent Pajama Pocket"
                                {{ $customer->measurement->shalwar_type === 'Pent Pajama Pocket' ? 'checked' : '' }}
                              >
                              Pent Pajama Pocket
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="choori" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="choori" value="Choori Pajama"
                                {{ $customer->measurement->shalwar_type === 'Choori Pajama' ? 'checked' : '' }}
                              >
                              Choori Pajama
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="staight" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="staight" value="Straight Pajama"
                                {{ $customer->measurement->shalwar_type === 'Straight Pajama' ? 'checked' : '' }}
                              >
                              Straight Pajama
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="staight" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="staight" value="Zip Pocket"
                                {{ $customer->measurement->shalwar_type === 'Zip Pocket' ? 'checked' : '' }}
                              >
                              Zip Pocket
                            <i class="input-helper"></i></label>
                          </div>
                        </div>

                      </div>
                      <x-text-input type="number" name="aasam" label="Aasam" placeholder="Aasaam in (inches)" value="{{ $customer->measurement->aasam }}" />
                    </div>

                    {{-- Bottom Pacho --}}

                    <div class="col-md-6">
                      <h4 class="card-title"><i class="fa fa-ruler"></i> Bottom (Pacho)</h4>
                      <x-text-input type="number" name="ankle_opening_value" placeholder="Pacho in (inches)" value="{{ $customer->measurement->ankle_opening_value }}" />
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <div class="form-check">
                                <label for="sado" class="form-check-label">
                                  <input type="radio" class="form-check-input" name="ankle_type" id="sado" value="Kandro (Machine)" 
                                    {{ $customer->measurement->ankle_type === 'Kandro (Machine)' ? 'checked' : '' }}
                                  >
                                  Kandro (Machine)
                                <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-check">
                                <label for="kandro" class="form-check-label">
                                  <input type="radio" class="form-check-input" name="ankle_type" id="kandro" value="Kandro (Bharth)" 
                                    {{ $customer->measurement->ankle_type === 'Kandro (Bharth)' ? 'checked' : '' }}
                                  >
                                  Kandro (Bharth)
                                <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-check">
                                <label for="doro" class="form-check-label">
                                  <input type="radio" class="form-check-input" name="ankle_type" id="doro" value="Kandro (Doro)"
                                    {{ $customer->measurement->ankle_type === 'Doro Style' ? 'checked' : '' }}
                                  >
                                  Doro Style
                                <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <x-text-input name="pacho_extra" placeholder="Extra Farmaish" value="{{ $customer->measurement->pacho_extra }}" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Pockets --}}
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h4 class="card-title"><i class="fa-brands fa-shirtsinbulk"></i> Pockets</h4>
                      <span>Pocket Type</span>
                      <div class="form-group row">
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="xx" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_type" id="xx" value="XX" 
                                {{ $customer->measurement->pocket_type === 'XX' ? 'checked' : '' }}
                              >
                              XX
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="xxo" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_type" id="xxo" value="XXO"
                                {{ $customer->measurement->pocket_type === 'XXO' ? 'checked' : '' }}
                              >
                              XXO
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="xo" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_type" id="xo" value="XO"
                                {{ $customer->measurement->pocket_type === 'XO' ? 'checked' : '' }}
                              >
                              XO
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="XOO" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_type" id="XOO" value="XOO"
                                {{ $customer->measurement->pocket_type === 'XOO' ? 'checked' : '' }}
                              >
                              XOO
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                      <span>Pocket Style</span>
                      <div class="form-group row">
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="gol" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="gol" value="Gol"
                                {{ $customer->measurement->pocket_style === 'Gol' ? 'checked' : '' }}
                              >
                              Gol
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="athas" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="athas" value="Athas"
                                {{ $customer->measurement->pocket_style === 'Athas' ? 'checked' : '' }}
                              >
                              Athas
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="american" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="american" value="American"
                                {{ $customer->measurement->pocket_style === 'American' ? 'checked' : '' }}
                              >
                              American
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="choras" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="choras" value="Choras"
                                {{ $customer->measurement->pocket_style === 'Choras' ? 'checked' : '' }}
                              >
                              Choras
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="contrast" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="contrast" value="Design Contrast"
                                {{ $customer->measurement->pocket_style === 'Design Contrast' ? 'checked' : '' }}
                              >
                              Design Contrast
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="same" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="same" value="Design Same"
                                {{ $customer->measurement->pocket_style === 'Design Same' ? 'checked' : '' }}
                              >
                              Design Same
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="pipe" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="pipe" value="Pipe"
                                {{ $customer->measurement->pocket_style === 'Pipe' ? 'checked' : '' }}
                              >
                              Pipe
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <x-text-input name="extra_pocket_style" placeholder="Izafi Farmaish Details" value="{{ $customer->measurement->extra_pocket_style }}" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <span>Pocket Size</span>
                      <div class="form-group row">
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size1" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size1" value="5.5 - 6.25"
                                {{ $customer->measurement->pocket_size === '5.5 - 6.25' ? 'checked' : '' }}
                              >
                              5.5 - 6.25
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size2" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size2" value="5.25 - 6"
                                {{ $customer->measurement->pocket_size === '5.25 - 6' ? 'checked' : '' }}
                              >
                              5.25 - 6
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size3" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size3" value="5 - 5.75"
                                {{ $customer->measurement->pocket_size === '5 - 5.75' ? 'checked' : '' }}
                              >
                              5 - 5.75
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size4" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size4" value="4.75 - 5.5"
                                {{ $customer->measurement->pocket_size === '4.75 - 5.5' ? 'checked' : '' }}
                              >
                              4.75 - 5.5
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size5" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size5" value="4.5 - 5.25"
                                {{ $customer->measurement->pocket_size === '4.5 - 5.25' ? 'checked' : '' }}
                              >
                              4.5 - 5.25
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size6" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size6" value="4.25 - 5"
                                {{ $customer->measurement->pocket_size === '4.25 - 5' ? 'checked' : '' }}
                              >
                              4.25 - 5
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size7" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size7" value="4 - 4.75"
                                {{ $customer->measurement->pocket_size === '4 - 4.75' ? 'checked' : '' }}
                              >
                              4 - 4.75
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                      <x-text-input name="extra_request_pocket" placeholder="Izafi Farmaish Details" value="{{ $customer->measurement->extra_request_pocket }}" />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Front Pati --}}
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><i class="fa-solid fa-chart-simple"></i> Front Pati</h4>
                  <div class="row">
                    <div class="col-md-4">
                      <span>Front Pati Height</span>
                      <div class="form-group row">                        
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="nok1" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati" id="pati1" value="10"
                                {{ $customer->measurement->front_pati == '10' ? 'checked' : '' }}
                              >
                              10 in
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pati6" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati" id="pati6" value="11"
                                {{ $customer->measurement->front_pati == '11' ? 'checked' : '' }}
                              >
                              11 in
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pati2" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati" id="pati2" value="12"
                                {{ $customer->measurement->front_pati == '12' ? 'checked' : '' }}
                              >
                              12 in
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pati3" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati" id="pati3" value="13"
                                {{ $customer->measurement->front_pati == '13' ? 'checked' : '' }}
                              >
                              13 in
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pati4" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati" id="pati4" value="13.5"
                                {{ $customer->measurement->front_pati == '13.5' ? 'checked' : '' }}
                              >
                              13.5 in
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pati5" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati" id="pati5" value="14"
                                {{ $customer->measurement->front_pati == '14' ? 'checked' : '' }}
                              >
                              14 in
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 front-pati-border">
                      <span>Front-Pati Length</span>
                      <div class="form-group row">                        
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="length_pati1" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati_length" id="length_pati1" value="Inch Soot Kam"
                                {{ $customer->measurement->front_pati_length == 'Inch Soot Kam' ? 'checked' : '' }}
                              >
                              Inch Soot Kam
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="length_pati2" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati_length" id="length_pati2" value="Inch"
                                {{ $customer->measurement->front_pati_length == 'Inch' ? 'checked' : '' }}
                              >
                              Inch
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="length_pati3" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati_length" id="length_pati3" value="Inch Soot"
                                {{ $customer->measurement->front_pati_length == 'Inch Soot' ? 'checked' : '' }}
                              >
                              Inch Soot
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="length_pati4" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati_length" id="length_pati4" value="Sawa Inch"
                                {{ $customer->measurement->front_pati_length == 'Sawa Inch' ? 'checked' : '' }}
                              >
                              Sawa Inch
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="length_pati5" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati_length" id="length_pati5" value="Mono Inch"
                                {{ $customer->measurement->front_pati_length == 'Mono Inch' ? 'checked' : '' }}
                              >
                              Mono Inch
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 front-pati-border">
                      <span>Cover Pati</span>
                      <div class="form-group row">                        
                        <div class="col-sm-12">
                          <div class="form-check">
                            <label for="cover_pati" class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="cover_pati" id="cover_pati" value="Cover Pati"
                                {{ $customer->measurement->cover_pati === 'Cover Pati' ? 'checked' : '' }}
                              >
                              Cover Pati
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Shirt --}}
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><i class="fa fa-shirt"></i> Shirt</h4>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">                        
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="simple" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shirt_type" id="simple" value="Simple" 
                                {{ $customer->measurement->shirt_type === 'Simple' ? 'checked' : '' }}
                              >
                              Simple
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="kurta" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shirt_type" id="kurta" value="Kurta"
                                {{ $customer->measurement->shirt_type === 'Kurta' ? 'checked' : '' }}
                              >
                              Kurta
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="design" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shirt_type" id="design" value="Design"
                                {{ $customer->measurement->shirt_type === 'Design' ? 'checked' : '' }}
                              >
                              Design
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pehriyan" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shirt_type" id="pehriyan" value="Pehriyan"
                                {{ $customer->measurement->shirt_type === 'Pehriyan' ? 'checked' : '' }}
                              >
                              Pehriyan
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>            

            {{-- Stitching Type --}}
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><i class="fa-solid fa-diagram-project"></i> Stitching Type</h4>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <div class="col-sm-4">
                          <div class="form-check">
                            <label for="simpleSewing" class="form-check-label">
                              <input type="radio" class="form-check-input" name="sewing_type" id="simpleSewing" value="Simple"
                                {{ $customer->measurement->sewing_type === 'Simple' ? 'checked' : '' }}
                              >
                              Simple
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-check">
                            <label for="double" class="form-check-label">
                              <input type="radio" class="form-check-input" name="sewing_type" id="double" value="Double"
                                {{ $customer->measurement->sewing_type === 'Double' ? 'checked' : '' }}
                              >
                              Double
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-check">
                            <label for="doubleFull" class="form-check-label">
                              <input type="radio" class="form-check-input" name="sewing_type" id="doubleFull" value="Double Full"
                                {{ $customer->measurement->sewing_type === 'Double Full' ? 'checked' : '' }}
                              >
                              Double Full
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Extra Note --}}
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><i class="fa-solid fa-book"></i> Extra Notes</h4>
                  <div class="form-group">
                      <label>Notes</label>
                      <textarea name="notes" class="form-control" rows="4">{{ $customer->measurement->notes }}</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <input type="hidden" name="customer_id" value="{{ $customer->id }}" />
          <div class="d-flex justify-content-end">
            <a href="{{route('customers.index')}}" class="btn btn-light mr-2 cancel-btn"><i class="fa fa-circle-xmark"></i> Cancel</a>
            <button type="submit" class="btn btn-primary mr-2 custom-btn"><i class="fa fa-pencil"></i> Update</button>
          </div>
        </form>

      </div>

      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <x-footer />
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
</x-dashboard-imports>