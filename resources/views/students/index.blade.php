@extends('students.layout')
@section('content')

<div class="container mt-5">
    <div class="container mt-5">
      
    <div class="card">
        <div class="card-body" id="main">
            <h1 class="display-one mt-5 text-center">PHP Laravel Project - CRUD</h1>
            <p class="text-center">Welcome to the PHP Laravel project demo for beginners</p>
            <br>
            <div class="text-center">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    Add New
                </button>
                
            </div>
            <br><br>
            <!-- Modal -->
              <!-- Modal -->
              <div class="modal fade @if($errors->any()) show @endif" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" @if($errors->any()) style="display: block;" @endif>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b>Add New Student</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if ($errors->any())
                               <div class="alert alert-danger">
                                  <ul>
                                       @foreach ($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                       @endforeach
                                  </ul>
                               </div>
                            @endif
                            <form action="{{ url('student') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <input type="text" class="form-control @error('adress') is-invalid @enderror" id="adress" name="adress" placeholder="Address" value="{{ old('adress') }}">
                                    @error('adress')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" placeholder="Mobile Number" value="{{ old('mobile') }}">
                                    @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
           
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Mobile Number</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $item)
                        <tr>
                            
                                <td>{{ $item -> id }}</td>
                                <td>{{ $item -> name }}</td>
                                <td>{{ $item -> adress }}</td>
                                <td>{{ $item -> mobile }}</td>
                            
                                <td>
                                    <!-- View Button -->
                                   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewModal-{{ $item->id }}"><i class="fa fa-eye" aria-hidden="true"></i> View </button>

                                     <!-- Edit Button -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{ $item->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ url('student/' . $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirm Delete?')">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                        </button>
                                    </form>
                                </td>
                        </tr>
                        <!-- View Modal -->
                        <div class="modal fade" id="viewModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel-{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel-{{ $item->id }}"><b>View Student</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="card-title">Name: {{ $item->name }}</h5>
                                        <p class="card-text">Address: {{ $item->adress }}</p>
                                        <p class="card-text">Mobile: {{ $item->mobile }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of View Modal -->
                        
                         <!-- Edit Modal -->
                         <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel-{{ $item->id }}"><b>Edit Student</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('student/' . $item->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
                                                <br>
                                                <input type="text" class="form-control" id="adress" name="adress" value="{{ $item->adress }}">
                                                <br>
                                                <input type="number" class="form-control" id="mobile" name="mobile" value="{{ $item->mobile }}">
                                                <br>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" value="update">Update</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End of Edit Modal -->
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function validateForm(event) {
        var isValid = true;

        // Get form elements
        var name = document.getElementById('name').value.trim();
        var address = document.getElementById('adress').value.trim();
        var mobile = document.getElementById('mobile').value.trim();

        // Reset any previous error messages
        document.querySelectorAll('.is-invalid').forEach(function(el) {
            el.classList.remove('is-invalid');
        });

        // Validate each field
        if (name === "") {
            alert("Full Name is required.");
            document.getElementById('name').classList.add('is-invalid');
            isValid = false;
        }

        if (address === "") {
            alert("Address is required.");
            document.getElementById('adress').classList.add('is-invalid');
            isValid = false;
        }

        if (mobile === "") {
            alert("Mobile Number is required.");
            document.getElementById('mobile').classList.add('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Prevent form submission if any field is invalid
        }
    }

    // Attach the validation function to the form's submit event
    document.querySelector('form').addEventListener('submit', validateForm);
</script>

@stop

