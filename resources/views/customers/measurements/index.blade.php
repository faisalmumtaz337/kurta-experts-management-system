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
        <form class="forms-sample" action="{{ route('measurements.store') }}" method="POST">
          @csrf 
          <div class="row">
            <div class="col-sm-12 d-flex justify-content-between">
              <h3 class="mb-2 font-weight-bold article-title">Measurements</h3>
            </div>
            <div class="col-sm-12 mb-3">
              <x-breadcrumb :items="[
                  ['title' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'fa-solid fa-chart-line'],
                  ['title' => 'Customers', 'url' => route('customers.index'), 'icon' => 'fa-solid fa-users'],
                  ['title' => 'Add New Customer', 'url' => route('customers.create'), 'icon' => 'fa-solid fa-plus'],
                  ['title' => 'Measurement', 'url' => '', 'icon' => 'fa-solid fa-pen-ruler'],
              ]" />
            </div>
            {{-- Customer Information --}}  
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Customer</h4>
                  <div class="row">
                    <div class="col-sm-6">
    
                      {{-- Name --}}
    
                      <div class="form-group">
                        <x-text-input name="name" label="Name" disabled value="{{ $customer->name }}" />
                      </div>
                    </div>
                    <div class="col-sm-6">
    
                      {{-- Caste --}}
    
                      <div class="form-group">
                        <x-text-input name="caste" label="Caste" disabled value="{{ $customer->caste }}" />
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
                      <x-text-input class="mb-3" type="number" name="length_value" label="Length (Aam)" placeholder="Length in (inches)" />
                      <x-text-input class="mb-3" type="number" name="length_cotton" label="Length (Cotton)" placeholder="Length in (inches)" />
                      <x-text-input class="mb-3" type="number" name="length_washing_wear" label="Length (Washing Wear)" placeholder="Length in (inches)" />
                      <div class="form-group row">
                        <div class="col-sm-12 mt-2">
                          <span>Daaman</span>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="circle" class="form-check-label">
                              <input type="radio" class="form-check-input" name="length_type" id="circle" value="Gol" checked>
                              Gol
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="square" class="form-check-label">
                              <input type="radio" class="form-check-input" name="length_type" id="square" value="Choras">
                              Choras
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="cds" class="form-check-label">
                              <input type="radio" class="form-check-input" name="length_type" id="cds" value="Gol Double">
                              Gol Double
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="kwk" class="form-check-label">
                              <input type="radio" class="form-check-input" name="length_type" id="kwk" value="Kaliwala Kurta">
                              Kaliwala Kurta
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <h4 class="card-title"><i class="fa fa-user"></i> Shoulder</h4>
                      <x-text-input class="mb-3" type="number" name="shoulder" label="Shoulder" placeholder="Shoulder in (inches)" />
                      <div class="row">
                        <div class="col-sm-12 mt-2">
                          <span>Shoulder Type</span>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <div class="form-check">
                                <label for="kandha_down" class="form-check-label">
                                  <input type="radio" class="form-check-input" name="shoulder_type" id="kandha_down" value="Kandha Down" checked>
                                  Kandha Down
                                <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-check">
                                <label for="kandha_straight" class="form-check-label">
                                  <input type="radio" class="form-check-input" name="shoulder_type" id="kandha_straight" value="Kandha Straight">
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
                      <x-text-input class="mb-2" type="number" name="sleeve" label="Sleeve" placeholder="Sleeve in (inches)" />
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
                                <input type="radio" class="form-check-input" name="cuff_type" id="cuff" value="Cuff" checked>
                                Cuff
                                <i class="input-helper"></i>
                              </label>
                            </div>
                          </div>
                          <div class="col">
                            <x-text-input class="cuff-input" type="number" name="cuff" placeholder="Cuff Size" />
                          </div>
                        </div>
                        <div class="row d-flex mb-2">
                          <div class="col">
                            <div class="form-check">
                              <label for="cuffing-single" class="form-check-label">
                                <input type="radio" class="form-check-input" name="cuff_type" id="cuffing-single" value="Cuffing Single">
                                Cuffing Single
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col">
                            <x-text-input class="cuff-input" type="number" name="cuff_single" placeholder="Cuff Single Size" />
                          </div>
                        </div>
                        <div class="row d-flex mb-2">
                          <div class="col">
                            <div class="form-check">
                              <label for="cuffing_double" class="form-check-label">
                                <input type="radio" class="form-check-input" name="cuff_type" id="cuffing_double" value="Cuffing Double">
                                Cuffing Double
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col">
                            <x-text-input class="cuff-input" type="number" name="cuff_double" placeholder="Cuff Double Size" />
                          </div>
                        </div>
                        <div class="row d-flex mb-2">
                          <div class="col">
                            <div class="form-check">
                              <label for="golpati" class="form-check-label">
                                <input type="radio" class="form-check-input" name="cuff_type" id="golpati" value="Gol Bazu Pati">
                                Gol Bazu Pati
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col">
                            <x-text-input class="cuff-input" type="number" name="golpati" placeholder="Gol Bazu Pati Size" />
                          </div>
                        </div>
                        <div class="row d-flex mb-2">
                          <div class="col">
                            <div class="form-check">
                              <label for="golkani" class="form-check-label">
                                <input type="radio" class="form-check-input" name="cuff_type" id="golkani" value="Gol Bazu Kani">
                                Gol Bazu Kani
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col">
                            <x-text-input class="cuff-input" type="number" name="golkani" placeholder="Gol Bazu Kani Size" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Waist --}}
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><i class="fa fa-person"></i> Body</h4>
                  <div class="row">
                    <div class="col-md-3">
                      <x-text-input type="number" name="hips" label="Hips" placeholder="Hips in (inches)" class="mb-3" />
                    </div>
                    <div class="col-md-3">
                      <x-text-input type="number" name="waist" label="Waist" placeholder="Waist in (inches)" class="mb-3" />
                    </div>
                    <div class="col-md-3">
                      <x-text-input type="number" name="chhati" label="Chhati" placeholder="Chhati in (inches)" class="mb-3" />
                    </div>
                    <div class="col-md-3">
                      <x-text-input type="number" name="chest" label="Chest (All Around)" placeholder="Chest in (inches)" class="mb-3" />
                    </div>
                    <div class="col-md-12">
                      <x-text-input type="text" name="extra_request_waist" label="Extra" placeholder="Izafi Farmaish Details" class="mb-3" />
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
                  <x-text-input type="number" name="collar_value" label="Collar Size" placeholder="Collar in (inches)" class="mb-3" />
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <div class="col-sm-3">
                          <label class="col-form-label">Collar</label>
                        </div>
                        <div class="col-sm-9 row">
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="collar" value="Straight" class="form-check-input">
                              Straight
                            </label>
                          </div>
  
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="collar" value="Arrow" class="form-check-input">
                              Arrow
                            </label>
                          </div>
  
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="collar" value="Normal" class="form-check-input">
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
                                    <input type="checkbox" class="form-check-input" name="collar_nok" id="nok1" value="1.5">
                                    1.5 in
                                  <i class="input-helper"></i></label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check">
                                  <label for="nok2" class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="collar_nok" id="nok2" value="2">
                                    2 in
                                  <i class="input-helper"></i></label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check">
                                  <label for="nok3" class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="collar_nok" id="nok3" value="2.25">
                                    2.25 in
                                  <i class="input-helper"></i></label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check">
                                  <label for="nok4" class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="collar_nok" id="nok4" value="2.5">
                                    2.5 in
                                  <i class="input-helper"></i></label>
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-check">
                                  <label for="nok5" class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="collar_nok" id="nok5" value="2.75">
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
                              <input type="checkbox" name="sherwani" value="Square" class="form-check-input">
                              Square
                            </label>
                          </div>
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="sherwani" value="Inch Round" class="form-check-input">
                              Inch Round
                            </label>
                          </div>
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="sherwani" value="Mono 0.75 Inch" class="form-check-input">
                              Mono 0.75 Inch
                            </label>
                          </div>
                          <div class="col-sm-3 form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="sherwani" value="Haf Inch" class="form-check-input">
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
                              <input type="checkbox" name="khasi" value="Khasi Gala" class="form-check-input">
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
                      <x-text-input type="number" name="shalwar_value" placeholder="Shalwar in (inches)" />
                      <div class="form-group row">
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="common" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="common" value="Aam Shalwar" checked>
                              Aam Shalwar
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="gher" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="gher" value="Gher Shalwar">
                              Gher Shalwar
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pent" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="pent" value="Pent Pajama Pocket">
                              Pent Pajama Pocket
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="choori" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="choori" value="Choori Pajama">
                              Choori Pajama
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="staight" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="staight" value="Straight Pajama">
                              Straight Pajama
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="staight" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shalwar_type" id="staight" value="Zip Pocket">
                              Zip Pocket
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                      <x-text-input type="number" name="aasam" label="Aasam" placeholder="Aasaam in (inches)" />
                    </div>

                    {{-- Bottom Pacho --}}

                    <div class="col-md-6">
                      <h4 class="card-title"><i class="fa fa-ruler"></i> Bottom (Pacho)</h4>
                      <x-text-input type="number" name="ankle_opening_value" placeholder="Pacho in (inches)" />
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <div class="col-sm-6">
                              <div class="form-check">
                                <label for="sado" class="form-check-label">
                                  <input type="radio" class="form-check-input" name="ankle_type" id="sado" value="Kandro (Machine)" checked>
                                  Kandro (Machine)
                                <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-check">
                                <label for="kandro" class="form-check-label">
                                  <input type="radio" class="form-check-input" name="ankle_type" id="kandro" value="Kandro (Bharth)">
                                  Kandro (Bharth)
                                <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-check">
                                <label for="doro" class="form-check-label">
                                  <input type="radio" class="form-check-input" name="ankle_type" id="doro" value="Doro Style">
                                  Doro Style
                                <i class="input-helper"></i></label>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <x-text-input name="pacho_extra" placeholder="Extra Farmaish" />
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
                              <input type="radio" class="form-check-input" name="pocket_type" id="xx" value="XX" checked>
                              XX
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="xxo" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_type" id="xxo" value="XXO">
                              XXO
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="xo" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_type" id="xo" value="XO">
                              XO
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="XOO" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_type" id="XOO" value="XOO">
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
                              <input type="radio" class="form-check-input" name="pocket_style" id="gol" value="Gol" checked>
                              Gol
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="athas" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="athas" value="Athas">
                              Athas
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="american" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="american" value="American">
                              American
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="choras" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="choras" value="Choras">
                              Choras
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="contrast" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="contrast" value="Design Contrast">
                              Design Contrast
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="same" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="same" value="Design Same">
                              Design Same
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="pipe" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_style" id="pipe" value="Pipe">
                              Pipe
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <x-text-input name="extra_pocket_style" placeholder="Izafi Farmaish Details" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <span>Pocket Size</span>
                      <div class="form-group row">
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size1" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size1" value="5.5 - 6.25" checked>
                              5.5 - 6.25
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size2" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size2" value="5.25 - 6">
                              5.25 - 6
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size3" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size3" value="5 - 5.75">
                              5 - 5.75
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size4" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size4" value="4.75 - 5.5">
                              4.75 - 5.5
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size5" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size5" value="4.5 - 5.25">
                              4.5 - 5.25
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size6" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size6" value="4.25 - 5">
                              4.25 - 5
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label for="size7" class="form-check-label">
                              <input type="radio" class="form-check-input" name="pocket_size" id="size7" value="4 - 4.75">
                              4 - 4.75
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>
                      <x-text-input name="extra_request_pocket" placeholder="Izafi Farmaish Details" />
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
                              <input type="radio" class="form-check-input" name="front_pati" id="pati1" value="10" checked>
                              10 in
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pati6" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati" id="pati6" value="11">
                              11 in
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pati2" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati" id="pati2" value="12">
                              12 in
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pati3" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati" id="pati3" value="13">
                              13 in
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pati4" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati" id="pati4" value="13.5">
                              13.5 in
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pati5" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati" id="pati5" value="14">
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
                              <input type="radio" class="form-check-input" name="front_pati_length" id="length_pati1" value="Inch Soot Kam" checked>
                              Inch Soot Kam
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="length_pati2" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati_length" id="length_pati2" value="Inch">
                              Inch
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="length_pati3" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati_length" id="length_pati3" value="Inch Soot">
                              Inch Soot
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="length_pati4" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati_length" id="length_pati4" value="Sawa Inch">
                              Sawa Inch
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="length_pati5" class="form-check-label">
                              <input type="radio" class="form-check-input" name="front_pati_length" id="length_pati5" value="Mono Inch">
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
                              <input type="checkbox" class="form-check-input" name="cover_pati" id="cover_pati" value="Cover Pati">
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
                              <input type="radio" class="form-check-input" name="shirt_type" id="simple" value="Simple" checked>
                              Simple
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="kurta" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shirt_type" id="kurta" value="Kurta">
                              Kurta
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="design" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shirt_type" id="design" value="Design">
                              Design
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="pehriyan" class="form-check-label">
                              <input type="radio" class="form-check-input" name="shirt_type" id="pehriyan" value="Pehriyan">
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
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="simpleSewing" class="form-check-label">
                              <input type="radio" class="form-check-input" name="sewing_type" id="simpleSewing" value="Simple" checked>
                              Simple
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="double" class="form-check-label">
                              <input type="radio" class="form-check-input" name="sewing_type" id="double" value="Double">
                              Double
                            <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-check">
                            <label for="doubleFull" class="form-check-label">
                              <input type="radio" class="form-check-input" name="sewing_type" id="doubleFull" value="Double Full">
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
                      <textarea name="notes" class="form-control" rows="4"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mr-2 custom-btn"><i class="fa-solid fa-floppy-disk"></i> Save</button>
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