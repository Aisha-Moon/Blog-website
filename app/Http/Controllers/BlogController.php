<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Blog;
use App\Models\BlogTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class BlogController extends Controller
{
   public function list(){
      $data['getRecord']=Blog::getRecord();
    return view('backend.blog.list',$data);
   }
   public function add_blog(){
    $data['getCategory']=Category::getCategory();
    return view('backend.blog.add',$data);
   }

   public function insert_blog(Request $request){

     $blog=new Blog;
     $blog->user_id=Auth::user()->id;

     $blog->title=trim($request->title);
     $slug=Str::slug($request->title);
     $blog->category_id=trim($request->category_id);
     $blog->description=trim($request->description);
     $blog->meta_description=trim($request->meta_description);
     $blog->meta_keywords=trim($request->meta_keywords);
     $blog->is_publish=trim($request->is_publish);
     $blog->status=trim($request->status);
     $blog->save();



     $checkslug=Blog::where('slug',$slug)->first();

     if(!empty($checkslug)){
        $dbslug=Str::slug($request->title).'-'.$blog->id;
     }else{
        $dbslug=$slug;
     }

     $blog->slug=$dbslug;

     if (!empty($request->file('image'))) {
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension(); // Get the original extension
        $filename = $dbslug . '.' . $ext; // Set the filename with the original extension
        $file->move('upload/blog/', $filename); // Move the file with the new filename

        $blog->image = $filename;
    }


     $blog->save();
     BlogTag::InsertDeleteTag($blog->id,$request->tags);


     return redirect('panel/blog/list')->with('success','Blog successfully uploaded');


   }

   public function edit_blog($id){

    $data['getCategory']=Category::getCategory();
    $data['getRecord']=Blog::getSingle($id);
    return view('backend.blog.edit',$data);
   }

   public function update_blog(Request $request,$id){

    $blog=Blog::getSingle($id);

    $blog->title=trim($request->title);
    $slug=Str::slug($request->title);
    $blog->category_id=trim($request->category_id);
    $blog->description=trim($request->description);
    $blog->meta_description=trim($request->meta_description);
    $blog->meta_keywords=trim($request->meta_keywords);
    $blog->is_publish=trim($request->is_publish);
    $blog->status=trim($request->status);


    if (!empty($request->file('image'))) {

        if(!empty($blog->getImage())){
            unlink('upload/blog/' . $blog->image);
        }
       $file = $request->file('image');
       $ext = $file->getClientOriginalExtension(); // Get the original extension
       $filename = $blog->slug . '.' . $ext; // Set the filename with the original extension
       $file->move('upload/blog/', $filename); // Move the file with the new filename

       $blog->image = $filename;
   }


    $blog->save();
   BlogTag::InsertDeleteTag($blog->id,$request->tags);


    return redirect('panel/blog/list')->with('success','Blog successfully updated');


  }

  public function delete_blog($id){
    $blog=Blog::getSingle($id);
    $blog->is_delete=1;
    $blog->save();


    return redirect('panel/blog/list')->with('success','Blog successfully DELETED');

  }


}
