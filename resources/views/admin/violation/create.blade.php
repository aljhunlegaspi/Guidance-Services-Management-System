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
                                <h3><i class="fas fa-user-plus"></i> Add New Violation</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('violation.addViolation') }}" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-2 col-sm-3 form-label">Violation Name:</label>
                                        <input type="text" id="name" name="name" class="col form-control" placeholder="Enter Violation Name">
                                    </div>
                                    <div class="row mb-3">
                                        <label for="type" class="col-md-2 col-sm-3 form-label">Violation Type:</label>
                                        <!-- <input type="text" id="type" name="type" class="col form-control" placeholder="Enter Violation Type"> -->
                                        <select class="form-select col" id="type" name="type">
                                            <option value="Minor">Minor Violation</option>
                                            <option value="Major">Major Violation</option>
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="description" class="col-md-2 col-sm-3 form-label">Violation Description:</label>
                                        <textarea  id="description" name="description" class="col form-control" placeholder="Enter Description"></textarea >
                                    </div>
                                    <div class="row mb-3">
                                        <label for="penalty_type" class="col-md-2 col-sm-3 form-label">Violation Penalty Type:</label>
                                        <!-- <input type="email" id="penalty_type" name="penalty_type" class="col form-control" placeholder="Enter Penalty Type"> -->
                                        <select class="form-select col" id="penalty_type" name="penalty_type">
                                            <option value="Verbal warning with community service">Verbal warning with community service</option>
                                            <option value="Suspension minor 2 days">Suspension minor 2 days</option>
                                            <option value="Suspension major 5 days">Suspension major 5 days</option>
                                            <option value="dismissal/expulsion">dismissal/expulsion</option>
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="submission_status" class="col-md-2 col-sm-3 form-label">Violation Submission Status:</label>
                                        <!-- <input type="text" id="submission_status" name="submission_status" class="col form-control" placeholder="Enter Submission Status"> -->
                                        <select class="form-select col" id="submission_status" name="submission_status">
                                            <option value="Sensitive">Sensitive</option>
                                            <option value="Not sensitive">Not sensitive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="Add Violation" class="btn btn-primary">
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