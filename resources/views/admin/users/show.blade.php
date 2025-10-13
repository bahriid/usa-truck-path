@extends('admin.layouts.main')
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="row ">
      <div class="col-md-12 col-sm-12 d-flex justify-content-between align-items-center">
    <h2>User Details: {{ $user->name }}</h2>
    <a href="{{ route('admin.users.changePassword', $user->id) }}" class="btn btn-warning">Change Password</a>
</div>

        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row ">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-body">

                          <p>Email: {{ $user->email }}</p>
                          <p>Phone: {{ $user->purchasedCourses->first()->pivot->phone ?? 'N/A' }}</p>
                        
                          <h3>Purchased Courses</h3>
                          @if($courses->count())
                          <table class="table mb-3" >
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                   
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Active</th>
                              
                                </tr>
                            </thead>
                            <tbody  >
                                @php
                                $total =0;
                                @endphp
                                @forelse ($courses as $course)
                                
                                  @php
                                $total +=$course->price ;
                                @endphp
                                <tr >
                                    <td> <img src="{{ Storage::url($course->image) }}"  style="height: 50px; width: 50px;border-radius: 50%;"/></td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->category ?? '' }}</td>
                                   
                                    <td>{{ ucfirst($course->status) }}</td>
                                    <td>${{ $course->price }}</td>
                                    <td>{{ $course->is_active ? 'Yes' : 'No' }}</td>
                                    
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="7">No Course found !</td>
                                </tr>
                                @endforelse


                                
                            </tbody>
                        </table>

                        {{$courses->links('pagination::bootstrap-5')}}
  @else
    <p>No courses purchased.</p>
  @endif


</div>
                    <p class='mt-2'><strong>Subtotal : ${{$total?? 00.00}}</strong></p>
                </div>
            </div>
        </div>
    </div>
</main>




                      
                    

@endsection
