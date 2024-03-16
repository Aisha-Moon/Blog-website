
@extends('backend.layouts.app')
 @section('style')
 @endsection
 @section('content')



  <section class="section">
    <div class="row">


      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
                Users List
                <a href="" style="float:right;" class="btn btn-primary">Add New</a>
            </h5>



            <table class="table table-striped">
              <thead>

                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Email Verified at</th>
                  <th scope="col">Status</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($getRecord as $value)
                <tr>
                    <th scope="row">{{ $value->id }}</th>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ !empty($value->email_verified_at) ? 'Yes' : 'No' }}</td>
                    <td>{{ !empty($value->status) ? 'Verified' : 'Not Verified' }}</td>
                    <td>{{ date('d-m-Y H:i',strtotime($value->created_at)) }}</td>
                    <td>
                        <a href="{{ url('panel/user/edit') }}" class="btn btn-success">Edit</a>
                        <a href="{{ url('panel/user/delete') }}" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                @empty
                  <tr style="color:red;">
                    <td colspan="100%">Record Not Found </td>
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
