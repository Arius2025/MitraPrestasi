<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlogGallery extends Component
{
    public $blogs;

    public function __construct($blogs)
    {
        $this->blogs = $blogs;
    }

    public function render()
    {
        return view('components.blog-gallery');
    }
}
