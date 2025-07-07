<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CategoryCheckbox extends Component
{
    public $selected;
    public $categories;

    public function __construct($selected = [])
    {
        $this->selected = is_array($selected)
            ? $selected
            : json_decode($selected, true);

        // Default kategori bisa kamu ambil dari DB kalau mau
        $this->categories = ['sd', 'smp', 'sma'];
    }

    public function render()
    {
        return view('components.category-checkbox');
    }
}

