<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Account extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($account)
    {
        $this->account = $account;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.account', ['account'=>$this->account]);
    }
}
