 
 @extends('admin.admin_master')

 @section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h4>Home About</h4>
                <a href="{{route('add.about')}}"><button class="btn btn-info">Add About</button></a>
                <br><br>
                <div class="col-md-12">
                    <div class="card">

                        @if(session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                          @endif
                        <div class="card-header">All About Data </div>
>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width="5%">SL No</th>
                        <th scope="col" width="15%">Home Title</th>
                        <th scope="col" width="25%">Short Description</th>
                        <th scope="col" width="15%">Long Description</th>
                        <th scope="col" width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        <!-- loop through each from the users data-->
                             @php($i = 1) 
                            @foreach($homeabout as $about)
                      <tr>
                        <th scope="row"> {{ $i++  }}</th>
                        <td> {{ $about->title }}</td>
                        <td> {{ $about->short_dis }}</td>
                        <td> {{ $about->long_dis }}</td>


                        <td> 

                        
                        </td>
                        <td>
                          <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>  
                          <a href="{{ url('about/delete/'.$about->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>  


                        </td>

                                                    <!-- function to change the sate-->
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>




                

            </div>

        </div>



    </div>
@endsection
