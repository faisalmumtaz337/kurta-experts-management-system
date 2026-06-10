<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="{{ public_path('css/invoices.css') }}">
  </head>
  <body>
    <style>
      @font-face {
          font-family: 'Lobster';
          src: url("{{ public_path('fonts/Lobster-Regular.ttf') }}") format('truetype');
          font-weight: normal;
          font-style: normal;
      }

      .center {
          font-family: 'Lobster';
          font-size: 20px;
          text-align: center;
      }
    </style>
    <div class="container">

      <!-- Logo -->
      <div class="logo-container">
        <img src="{{ public_path('images/receipt_logo.png') }}" class="logo">
      </div>

      <!-- Shop Name -->
      <div class="center">
          Kurta Experts
      </div>

      <div class="line"></div>

      <div class="data-container">
        <!-- Customer Info -->
        <div class="customer-info">
            <span class="customer-name">Customer: {{ $customer->name . ' ' . $customer->caste ?? 'N/A' }}</span>
            <span class="customer-number">Customer No. {{ $customer->customer_number }}</span>
        </div>
    
        <div class="line"></div>
    
        <!-- Customer Measurement Info -->
        <table class="measurement-table">

            {{-- Length --}}
            <tr>
              <td class="label">LENGTH</td>
            </tr>
            <tr>
              @if($customer->measurement->length_value)
              <td>Length: {{ $customer->measurement->length_type }}</td>
              <td class="right">
                {{ $customer->measurement->length_value }}
              </td>
              @elseif($customer->measurement->length_cotton)
              <td>Length: {{ $customer->measurement->length_type }}</td>
              <td class="right">
                {{ $customer->measurement->length_cotton }}
              </td>
              @elseif($customer->measurement->length_washing_wear)
              <td>Length: {{ $customer->measurement->length_type }}</td>
              <td class="right">
                {{ $customer->measurement->length_washing_wear }}
              </td>
              @endif
            </tr>

            {{-- Shoulder --}}
            <tr>
              <td class="label label-space">SHOULDER</td>
            </tr>

            <tr>
              <td>Shoulder: {{ $customer->measurement->shoulder_type }}</td>
              <td class="right">
                {{ $customer->measurement->shoulder }}
              </td>
            </tr>

            {{-- SLEEVE --}}
            <tr>
              <td class="label label-space">SLEEVE</td>
            </tr>

            <tr>
              <td>Sleeve: 
                @if($customer->measurement->cuff_type === 'Cuff')
                  {{ $customer->measurement->cuff_type }}
                @elseif($customer->measurement->cuff_type === 'Cuffing Single')
                  {{ $customer->measurement->cuff_type }}
                @elseif($customer->measurement->cuff_type === 'Cuffing Double')
                  {{ $customer->measurement->cuff_type }}
                @elseif($customer->measurement->cuff_type === 'Gol Bazu Pati')
                  {{ $customer->measurement->cuff_type }}
                @elseif($customer->measurement->cuff_type === 'Gol Bazu Kani')
                  {{ $customer->measurement->cuff_type }}

                @endif
              </td>
              <td class="right">
                {{ $customer->measurement->sleeve }}
              </td>
            </tr>

            @if($customer->measurement->cuff_type === 'Cuff')
            <tr>
              <td>Cuff Size</td>
              <td class="right">
                {{ $customer->measurement->cuff }}
              </td>
            </tr>
            @elseif($customer->measurement->cuff_type === 'Cuffing Single')
            <tr>
              <td>Cuff Size</td>
              <td class="right">
                {{ $customer->measurement->cuff_single }}
              </td>
            </tr>
            @elseif($customer->measurement->cuff_type === 'Cuffing Double')
            <tr>
              <td>Cuff Size</td>
              <td class="right">
                {{ $customer->measurement->cuff_double }}
              </td>
            </tr>
            @elseif($customer->measurement->cuff_type === 'Gol Bazu Pati')
            <tr>
              <td>Cuff Size</td>
              <td class="right">
                {{ $customer->measurement->golpati }}
              </td>
            </tr>
            @elseif($customer->measurement->cuff_type === 'Gol Bazu Kani')
            <tr>
              <td>Cuff Size</td>
              <td class="right">
                {{ $customer->measurement->golkani }}
              </td>
            </tr>
            @endif

            {{-- Body --}}
            <tr>
              <td class="label label-space">BODY</td>
            </tr>
            
            <tr>
              <td>Chhati (All Around)</td>
              <td class="right">
                {{ $customer->measurement->chhati }}
              </td>
            </tr>
            
            <tr>
              <td>Chest</td>
              <td class="right">
                {{ $customer->measurement->chest }}
              </td>
            </tr>

            <tr>
              <td>Waist</td>
              <td class="right">
                {{ $customer->measurement->waist }}
              </td>
            </tr>
            
            <tr>
              <td>Hips</td>
              <td class="right">
                {{ $customer->measurement->hips }}
              </td>
            </tr>


            @if($customer->measurement->extra_request_waist)
            <tr>
              <td>
                {{ $customer->measurement->extra_request_waist }}
              </td>
              <td></td>
            </tr>
            @endif

            
            {{-- Collar --}}
            <tr>
              <td class="label label-space">COLLAR</td>
            </tr>

            <tr>
              <td>Collar Size</td>
              <td class="right">
                {{ $customer->measurement->collar_value }}
              </td>
            </tr>

            @if($customer->measurement->collar)
            <tr>
              <td>Collar Style</td>
              <td class="right">
                {{ $customer->measurement->collar }}
              </td>
            </tr>
            @elseif($customer->measurement->collar_nok)
            <tr>
              <td>Collar Nok Size</td>
              <td class="right">
                {{ $customer->measurement->collar_nok }}
              </td>
            </tr>
            @endif

            @if($customer->measurement->sherwani)
            <tr>
              <td>Sherwani</td>
              <td class="right">
                {{ $customer->measurement->sherwani }}
              </td>
            </tr>
            @endif

            @if($customer->measurement->khasi)
            <tr>
              <td>Gala Type</td>
              <td class="right">
                {{ $customer->measurement->khasi }}
              </td>
            </tr>
            @endif

                        
            {{-- Shalwar --}}
            <tr>
              <td class="label label-space">SHALWAR</td>
            </tr>

            <tr>
              <td>Shalwar: {{ $customer->measurement->shalwar_type }}</td>
              <td class="right">
                {{ $customer->measurement->shalwar_value }}
              </td>
            </tr>

            <tr>
              <td>Aasam Size</td>
              <td class="right">
                {{ $customer->measurement->aasam }}
              </td>
            </tr>

                                    
            {{-- Bottom (Pacho) --}}
            <tr>
              <td class="label label-space">BOTTOM (PACHO)</td>
            </tr>
            
            <tr>
              <td>Pacho: {{ $customer->measurement->ankle_type }}</td>
              <td class="right">
                {{ $customer->measurement->ankle_opening_value }}
              </td>
            </tr>

            <tr>
              <td>{{ $customer->measurement->pacho_extra }}</td>
              <td></td>
            </tr>

            {{-- Pockets --}}
            <tr>
              <td class="label label-space">POCKETS</td>
            </tr>

            <tr>
              <td>Pocket: {{ 
                $customer->measurement->pocket_type . ', ' . 
                $customer->measurement->pocket_style 
              }}
              </td>
              <td class="right">
                {{ $customer->measurement->pocket_size }}
              </td>
            </tr>

            @if($customer->measurement->extra_pocket_style)
            <tr>
              <td>{{ $customer->measurement->extra_pocket_style }}</td>
              <td></td>
            </tr>
            @endif

            {{-- Shirt --}}
            <tr>
              <td class="label label-space">SHIRT</td>
            </tr>     
            
            <tr>
              <td>Shirt Style</td>
              <td class="right">
                {{ $customer->measurement->shirt_type }}
              </td>
            </tr>

            {{-- Front Pati --}}
            <tr>
              <td class="label label-space">FRONT PATI</td>
            </tr>     
            
            <tr>
              <td>Front Pati Height</td>
              <td class="right">
                {{ $customer->measurement->front_pati }}
              </td>
            </tr>
            
            <tr>
              <td>Front Pati Length</td>
              <td class="right">
                {{ $customer->measurement->front_pati_length }}
              </td>
            </tr>
            
            @if($customer->measurement->cover_pati)
            <tr>
              <td>Cover Pati</td>
              <td class="right">
                {{ $customer->measurement->cover_pati }}
              </td>
            </tr>
            @endif

            {{-- Stitching --}}
            <tr>
              <td class="label label-space">STITCHING</td>
            </tr>  

            <tr>
              <td>Stitching Style</td>
              <td class="right">
                {{ $customer->measurement->sewing_type }}
              </td>
            </tr>

            @if($customer->measurement->notes)
            {{-- Extra Note --}}
            <tr>
              <td class="label label-space">EXTRA NOTE</td>
            </tr>  

            <tr>
              <td>{{ $customer->measurement->notes }}</td>
              <td></td>
            </tr>
            @endif

        </table>
      </div>
      
      <div class="line"></div>

      <div class="developer">
          <span>Software Designed and Developed By</span>
          <span class="developer-name">Faisal Mumtaz Depar</span>
          <span>Contact: 03037340121</span>
      </div>

    </div>
  </body>
</html>