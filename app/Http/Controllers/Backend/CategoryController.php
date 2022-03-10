<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categoryForm(){
        return view('backend.pages.category.create');
    }

    public function categoryPost(Request $request){
        // dd($request->all());
        Category::create([
            // coloum name of DB || name of input field
            'name'=>$request->category_name,
            'details'=>$request->category_details
        ]);

        return redirect()->back();
    }
}
