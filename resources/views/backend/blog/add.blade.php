
@extends('backend.layouts.app')
 @section('style')
 <link rel="stylesheet" type="text/css" href="{{ url('assets/tagsinput/') }}/bootstrap-tagsinput.css">
 @endsection
 @section('content')



 <section class="section">
    <div class="row">


      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add New Blog</h5>


            <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                @csrf

              <div class="col-12">
                <label for="inputEmail4" class="form-label">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                <div style="color:red;">{{ $errors->first('title') }}</div>

              </div>
              <hr>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Category</label>
                <select name="category_id" id="" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach ($getCategory as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div style="color:red;">{{ $errors->first('category_id') }}</div>

              </div>

              <div class="col-12">
                <label for="inputEmail4" class="form-label">Image</label>
                <input type="file" name="image"  class="form-control" required>
                <div style="color:red;">{{ $errors->first('image') }}</div>

              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Description</label>
                <textarea name="description" class="form-control tinymce-editor"></textarea>
                <div style="color:red;">{{ $errors->first('description') }}</div>

              </div>
              <div class="col-12">
                <label for="tags" class="form-label">Tags</label>
                <input type="text" id="tags" name="tags" value="{{ old('tags') }}" class="form-control" required>
                <div style="color:red;">{{ $errors->first('tags') }}</div>

              </div>
              <hr>

              <div class="col-12">
                <label for="inputEmail4" class="form-label">Meta Description</label>
                <input type="text" name="meta_description" value="{{ old('meta_description') }}" class="form-control" id="inputEmail4">
                <div style="color:red;">{{ $errors->first('meta_description') }}</div>

              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" class="form-control" id="inputEmail4">
                <div style="color:red;">{{ $errors->first('meta_keywords') }}</div>

              </div>

              <div class="col-12">
                <label for="inputAddress" class="form-label">Publish</label>
                <select name="is_publish" id="" class="form-control">
                    <option  value="1">Yes</option>
                    <option  value="0">No</option>


                </select>
              </div>
              <div class="col-12">
                <label for="inputAddress" class="form-label">Status</label>
                <select name="status" id="" class="form-control">
                    <option  value="1">Active</option>
                    <option  value="0">Inactive</option>


                </select>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </section>


 @endsection
 @section('script')
 <script src="url('assets/vendor/tinymce/tinymce.min.js')"></script>
 <script src="{{ url('assets/tagsinput/') }}/bootstrap-tagsinput.js"></script>

 <script type="text/javascript">
$("#tags").tagsinput();
</script>

 @endsection
