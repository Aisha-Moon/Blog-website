
@extends('backend.layouts.app')
 @section('style')
 @endsection
 @section('content')

 <section class="section">
    <div class="row">

      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Category</h5>


            <form class="row g-3" action="" method="post">
                @csrf
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Name</label>
                <input type="text" name="name" value="{{ $getCategory->name }}" class="form-control" id="inputNanme4">
                <div style="color:red;">{{ $errors->first('name') }}</div>
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Title</label>
                <input type="text" name="title" value="{{ $getCategory->title }}" class="form-control" id="inputEmail4">
                <div style="color:red;">{{ $errors->first('title') }}</div>

              </div>
              <hr>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Meta Title</label>
                <input type="text" name="meta_title" value="{{ $getCategory->meta_title }}" class="form-control" id="inputEmail4">
                <div style="color:red;">{{ $errors->first('meta_title') }}</div>

              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Meta Description</label>
                <input type="text" name="meta_description" value="{{ $getCategory->meta_description }}" class="form-control" id="inputEmail4">
                <div style="color:red;">{{ $errors->first('meta_description') }}</div>

              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ $getCategory->meta_keywords }}" class="form-control" id="inputEmail4">
                <div style="color:red;">{{ $errors->first('meta_keywords') }}</div>

              </div>

              <div class="col-12">
                <label for="inputAddress" class="form-label">Status</label>
                <select name="status" id="" class="form-control">
                    <option {{ ($getCategory->status) == 1 ? 'selected' : '' }}  value="1">Active</option>
                    <option {{ ($getCategory->status) == 0 ? 'selected' : '' }}  value="0">Inactive</option>


                </select>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form><!-- Vertical Form -->

          </div>
        </div>


      </div>
    </div>
  </section>


 @endsection
 @section('script')
 @endsection
