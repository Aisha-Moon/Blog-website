
@extends('backend.layouts.app')
 @section('style')
 @endsection
 @section('content')



  <section class="section">
    <div class="row">


      <div class="col-lg-12">
        @include('layouts._message')

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
                Blog List
                <a href="{{ url('panel/blog/add') }}" style="float:right;" class="btn btn-primary">Add New Blog</a>
            </h5>



            <table class="table table-striped">
              <thead>

                <tr>
                    <td scope="col">#</td>
                    <td scope="col">Image</td>
                    <td scope="col">Username</td>
                    <td scope="col">Title</td>
                    <td scope="col">Category</td>
                    <td scope="col">Publish</td>
                    <td scope="col">Status</td>
                    <td scope="col">Created Date</td>
                    <td scope="col">Action</td>

                </tr>
              </thead>
              <tbody>
                @forelse ($getRecord as $value)
               <tr>
                <td scope="row">{{ $value->id }}</td>
                <td>
                    @if(!empty($value->getImage()))
                    <img src="{{ $value->getImage() }}" style="height:100px;width:100px;" alt="">
                    @endif
                </td>
                <td>{{ $value->user_name }}</td>
                <td>{{ $value->title }}</td>
                <td>{{ $value->category_name }}</td>
              

                <td>{{ !empty($value->status) ? 'Active' : 'Inactive' }}</td>
                <td>{{ !empty($value->is_publish) ? 'Yes' : 'No' }}</td>
                <td>{{ date('d-m-Y H:i',strtotime($value->created_at)) }}</td>
                <td>
                    <a  href="{{ url('panel/blog/edit/'.$value->id) }}" class="btn btn-success">Edit</a>
                    <a onclick="return confirm('Are you sure want to delete?')" href="{{ url('panel/blog/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>

                </td>


               </tr>
                @empty
                  <tr style="text-align: center">
                    <td style="color:red;" colspan="100%">Record Not Found </td>
                  </tr>

                @endforelse


              </tbody>
            </table>
            {!! $getRecord->appends(Request::except('page'))->links() !!}

          </div>
        </div>



      </div>
    </div>
  </section>


 @endsection
 @section('script')
 @endsection
