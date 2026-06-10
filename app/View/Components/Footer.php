<?php

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Current year
        $currentYear = Carbon::now()->year;

        // App version
        $version = 'v1.0.0';

        return view('components.layouts.footer', compact('currentYear', 'version'));
    }
}
