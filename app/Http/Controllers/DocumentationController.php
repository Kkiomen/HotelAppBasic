<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function documentation(){
        return view('documentation.documentation');
    }

    public function documentationSave(){
        return view('documentation.documentation-post');
    }

    public function documentationSend(){
        return view('documentation.documentation-send');
    }
}
