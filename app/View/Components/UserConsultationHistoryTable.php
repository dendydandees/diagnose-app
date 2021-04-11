<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserConsultationHistoryTable extends Component
{
    public $history;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($history)
    {
        $this->history = $history;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-consultation-history-table');
    }
}
