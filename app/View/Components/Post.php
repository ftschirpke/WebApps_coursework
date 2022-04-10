<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Post extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post, $report = false)
    {
        $this->post = $post;
        $this->report = filter_var($report, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post', ['post'=>$this->post, 'report'=>$this->report]);
    }
}
