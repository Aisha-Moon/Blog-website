<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function category(){

        $data['getRecord']=Category::getRecord();

        return view('backend.category.list',$data);
    }
    public function add_category(){


        return view('backend.category.add');
    }


    public function insert_category(Request $request){

        $user=new Category;
        $user->name=trim($request->name);
        $user->slug=trim(Str::slug($request->name));
        $user->title=trim($request->title);
        $user->meta_title=trim($request->meta_title);
        $user->meta_description=trim($request->meta_description);
        $user->meta_keywords=trim($request->meta_keywords);
        $user->status=trim($request->status);
        $user->save();

        return redirect('panel/category/list')->with('success','Category Successfully Created');

    }

    public function edit_category($id){

        $data['getCategory']=Category::getSingle($id);

        return view('backend.category.edit',$data);

    }

    public function update_category(Request $request,$id){

        $user=Category::getSingle($id);
        $user->name=trim($request->name);
        $user->slug=trim(Str::slug($request->name));
        $user->title=trim($request->title);
        $user->meta_title=trim($request->meta_title);
        $user->meta_description=trim($request->meta_description);
        $user->meta_keywords=trim($request->meta_keywords);
        $user->status=trim($request->status);
        $user->save();

        return redirect('panel/category/list')->with('success','Category Successfully Updated');

    }
    public function delete_category($id){

        $user=Category::getSingle($id);
        $user->is_delete=1;
        $user->save();

        return redirect('panel/category/list')->with('success','Category Deleted');
    }




}
