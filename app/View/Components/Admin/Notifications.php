<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    /**
     * Create a new component instance.
     */

    public $notifications; 
    public $unread;


    public function __construct()
    {
        $user = Auth::user();
        $this->notifications  = $user->notifications()->limit(5)->get();
        $this->unread  = $user->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.notifications');
    }
}
