<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        if (Auth::check()) {

            if (Auth::user()->role === 'admin') {
                return view('layouts.app_admin');
            }

            if (Auth::user()->role === 'apoteker') {
                return view('layouts.app_operator');
            }

            if (Auth::user()->role === 'operator') {
                return view('layouts.app_operator');
            }
        }

        // default: user / pasien
        return view('layouts.app_user');
    }
}
