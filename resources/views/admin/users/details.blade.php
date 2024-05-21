@extends('layout.sidebar')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="card-title margin-bottom">
                                <h3><i class="fas fa-user"></i> Student Details</h3>
                            </div>
                            <div class="card-body">
                                <div>
                                    <h5>Student Name: {{ $user->name }}</h5>
                                    <p>Email: {{ $user->email }}</p>
                                    <p>Year Level: {{ $user->year_level }}</p>
                                    <p>Number of Violations: {{ $violationsCount }}</p>
                                    
                                    <hr>
                                    <!-- {{count($violations)}} -->
                                    <div class="list">
                                        <div class="cartHeader">
                                            <h2>List of Violations</h2>
                                        </div>
                                        <div class="table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <td>#ID</td>
                                                        <td class="text-center">Violation name</td>
                                                        <td>Description</td>
                                                        <!-- <td>Status</td>
                                                        <td class="text-center">Action</td> -->
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($violations as $violation)
                                                        <tr>
                                                            <td>{{$violation['id']}}</td>
                                                            <td class="text-center">{{$violation['name']}}</td>
                                                            <td>{{$violation['description']}}</td>
                                                            
                                                        </tr>
                                                    @endforeach
                                            </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
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