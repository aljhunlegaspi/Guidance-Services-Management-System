@extends('layout.sidebar')

@section('content')

    {{-- User registration form --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="card-title margin-bottom">
                                <h3><i class="fas fa-user-plus"></i> Add New User</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.addUser') }}" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="first_name" class="col-md-2 col-sm-3 form-label">First Name:</label>
                                        <input type="text" id="first_name" name="first_name" class="col form-control" placeholder="Enter First Name">
                                    </div>
                                    <div class="row mb-3">
                                        <label for="last_name" class="col-md-2 col-sm-3 form-label">Last Name:</label>
                                        <input type="text" id="last_name" name="last_name" class="col form-control" placeholder="Enter Last Name">
                                    </div>
                                    <div class="row mb-3">
                                        <label for="middle_name" class="col-md-2 col-sm-3 form-label">Middle Name:</label>
                                        <input type="text" id="middle_name" name="middle_name" class="col form-control" placeholder="Enter Middle Name">
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-2 col-sm-3 form-label">Email:</label>
                                        <input type="email" id="email" name="email" class="col form-control" placeholder="Enter Email">
                                    </div>
                                    <div class="row mb-3">
                                        <label for="address" class="col-md-2 col-sm-3 form-label">Address:</label>
                                        <input type="text" id="address" name="address" class="col form-control" placeholder="Enter Address">
                                    </div>
                                    <div class="row mb-3">
                                        <label for="age" class="col-md-2 col-sm-3 form-label">Age:</label>
                                        <input type="number" id="age" name="age" class="col form-control" placeholder="Enter Age">
                                    </div>
                                    <div class="row mb-3">
                                        <label for="gender" class="col-md-2 col-sm-3 form-label">Gender:</label>
                                        <select class="form-select col" id="gender" name="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="year_level" class="col-md-2 col-sm-3 form-label">Year Level:</label>
                                        <input type="text" id="year_level" name="year_level" class="col form-control" placeholder="Enter Year Level">
                                    </div>
                                    <div class="row mb-3">
                                        <label for="course" class="col-md-2 col-sm-3 form-label">Course:</label>
                                        <input type="text" id="course" name="course" class="col form-control" placeholder="Enter Course">
                                    </div>
                                    <div class="row mb-3">
                                        <label for="student_id" class="col-md-2 col-sm-3 form-label">Student ID:</label>
                                        <input type="text" id="student_id" name="student_id" class="col form-control" placeholder="Enter Student ID">
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="Register" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection