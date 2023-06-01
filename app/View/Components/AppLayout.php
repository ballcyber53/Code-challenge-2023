<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        if(Auth::user()->is_admin == true)
        {
            return view('layouts.app');
        }else{
            $profile_id = Employee::where('user_id',Auth::id())->first();
            return view('layouts.app',[
                'profile_id' => $profile_id,
            ]);
        }
    }
}
