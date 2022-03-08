<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Category;
use Session;
use Image;

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

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Category Validations
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
                'category_image' => 'image',
            ];

            $customMessages = [
                'category_name.required' => 'Name is required',
                'category_name.regex' => 'Valid Name is required',
                'section_id.required' => 'Mobile is required',
                'url.numeric' => 'Valid Mobile is required',
                'category_image.image' => 'Valid Image is required',
            ];

            $this->validate($request, $rules, $customMessages);


            if($request->hasFile('category_image')){
                $image_tmp = $request->file('category_image');
                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'images/category_images/'.$imageName;
                    // Upload the image
                    Image::make($image_tmp)->resize(300,400)->save($imagePath);
                    // Save Category Image
                    $category->category_image = $imageName;
                }
            }

            if(empty($data['category_discount'])){
                $data['category_discount'] = "";
            }
            if(empty($data['meta_title'])){
                $data['description'] = "";
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = "";
            }

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();

            session::flash('success_message', 'Category added successfuly!');
            return redirect('admin/categories');
        }

        // Get All Sections
        $getSections = Section::get();

        return view('layouts.admin.categories.add_edit_category')->with(compact('title', 'getSections'));
    }
}

