<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $label,$name,$row,$placeholder,$default;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label="Input Label",$name="input_name",$row="5",$placeholder="Something write down...",$default=null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->row = $row;
        $this->placeholder = $placeholder;
        $this->default = $default;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.textarea');
    }
}
