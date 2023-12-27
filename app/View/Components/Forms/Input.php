<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Input extends Component
{
    public $label,$type,$name,$placeholder,$multiple,$default;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label="Input Label",$type="text",$name="input_name",$placeholder="Somethng write down...",$multiple=false,$default=null)
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->multiple = $multiple;
        $this->default = $default;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
