@php
    // Map session keys to Bootstrap 4 class + Font Awesome icon
    $messageTypes = [
        'success'           => ['class' => 'alert-success', 'icon' => 'fa-check-circle'],
        'error'             => ['class' => 'alert-danger',  'icon' => 'fa-times-circle'],
        'warning'           => ['class' => 'alert-warning', 'icon' => 'fa-exclamation-triangle'],
        'info'              => ['class' => 'alert-info',    'icon' => 'fa-info-circle'],
        'duplicate_warning' => ['class' => 'alert-warning', 'icon' => 'fa-exclamation-triangle'],
    ];

    $flashMessage = null;
    $flashType = null;
    $showSaveAgain = false;

    foreach ($messageTypes as $key => $data) {
        if (session()->has($key)) {
            $flashMessage = session($key);
            $flashType = $data;

            break;
        }
    }
@endphp

@if($flashMessage)
    <div class="alert {{ $flashType['class'] }} shadow-sm d-flex align-items-center justify-content-between mb-3 py-2 px-3"
         role="alert"
         style="font-size: 0.95rem; border-radius: 0.2rem;">
        
        <div class="d-flex align-items-center">
            <i class="fas {{ $flashType['icon'] }} mr-2" style="font-size: 1.1rem;"></i>
            <div>{{ $flashMessage }}</div>
        </div>

        @if($showSaveAgain)
            <button type="submit" form="studentForm" class="btn btn-sm btn-danger"
                    onclick="document.getElementById('confirm_duplicate').value = 1;">
                Save Again
            </button>
        @endif
    </div>

    {{-- Auto-hide after 15 seconds
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(300, 0).slideUp(300, function(){
                $(this).remove();
            });
        }, 15000);
    </script> --}}
@endif
