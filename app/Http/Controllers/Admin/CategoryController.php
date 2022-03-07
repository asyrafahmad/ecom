<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Category;
use Session;

class CategoryController extends Controller
{
    public function categories(){
        Session::put('page','categories');
        $categories = Category::get();

        // $categories = json_decode(json_encode($categories));
        // echo"<pre>"; print_r($categories); die;

        return view('layouts.admin.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }

            Category::where('id', $data['category_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }else{

        }
    }

    public function addEditCategory(Request $request, $id=null){

        if($id==""){
            $title = "Add Category";
            // Add Category Functionality
        }
        else{
            $title = "Edit Category";
            // Edit Category Functionality
        }

        // Get All Sections
        $getSections = Section::get();

        return view('layouts.admin.categories.add_edit_category')->with(compact('title', 'getSections'));
    }

    public function appendCategoryLevel(Request $request){
        if($request->ajax()){
            $data = $request->all();

            $getCategories = Category::with('subCategories')->where([
                'section_id' => $data['section_id'],
                'parent_id' => 0,
                'status' => 1
            ])->get();

            $getCategories = json_decode(json_encode($getCategories),true );
            // echo "<pre>"; print_r($getCategories); die;

            return view('layouts.admin.categories.append_categories_level')->with(compact('getCategories'));
        }
    }
}

