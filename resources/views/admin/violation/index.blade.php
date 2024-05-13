@extends('layout.sidebar')


@section('search')
   {{-- section   shearch   --}}
   <div class="search">
       <form action="{{route('violation.search')}}" method="POST" id="serach">
        @csrf
             <label>
              <input type="text" placeholder="Search Here" name="search" id="search"
                     onabort="event.preventDefault();
                         document.getElementById('serach').submit();
                     "
              >
              <ion-icon name="search"></ion-icon>

            </label>
        </form>
    </div>
@endsection
@section('content')
  <!-- Cards -->
            <div class="Users-CardBox">
                <div class="Card">
                    <div>
                        <div class="numbers">{{$violationCount}}</div>
                        <div class="CardName">Violations</div>
                    </div>
                    <div class="iconBox"><ion-icon name="person"></ion-icon></div>
                </div>
                <div class="Card">
                    <div>
                        <div class="numbers">{{$userWithViolationCount}}</div>
                        <div class="CardName">User With Violation Count</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="archive"></ion-icon>
                    </div>
                </div>
               
            </div>
    {{-- Violation list --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="div-header d-flex flex-row justify-content-between align-item-center border-bottom p-2">
                            <h3>
                                <ion-icon name="list"></ion-icon>
                            </h3>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <a href="{{ route('Violation.create') }}" class="btn btn-primary">Add Violation</a>
                                    <!-- <button type="button" class="btn btn-primary" onclick="$('#addUserModal').modal('show')">Add User</button> -->
                                </div>
                            </div>
                        </div>
                        <!--- details Lists --->
                        <div class="cat-details">
                                <!--- category details List -->
                                <div class="list">
                                    <div class="cartHeader">
                                        <h2>Violations</h2>
                                        {{-- Export violation  --}}
                                        <a  title="Export All users"
                                        class="btn  btn-sm btn-success mr-0"
                                            href="{{ route('users-export') }}">
                                            <i class="fa-solid fa-download text-white"></i>
                                        </a>
                                        @if (Route::currentRouteName() == 'violation.archive')
                                            <a href="{{route('violation.index')}}" class="btn">View Violations</a>
                                        @else
                                            <a href="{{route('violation.archive')}}" class="btn">View Archived Violations</a>
                                        @endif

                                    </div>
                                    <div class="table-responsive">
                                            <table>
                                            <thead>
                                                <tr>
                                                    <td>#ID</td>
                                                    <td>Name</td>
                                                    <td>Type</td>
                                                    <td>Description</td>
                                                    <td>Penalty Type</td>
                                                    <td>Submission Type</td>
                                                    <td class="text-center">Action</td>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($violations as $violation)
                                                @if ($violation)
                                                    <tr>
                                                        <td>{{$violation->id}}</td>
                                                        <td>
                                                           {{$violation->name}}

                                                        </td>
                                                        <td>{{$violation->type}}</td>
                                                        <td>{{$violation->description}}</td>
                                                        <td>{{$violation->penalty_type}}</td>
                                                        <td>{{$violation->submission_status}}</td>

                                                        <td class="d-flex flex-row justify-content-center align-items-center ">
                                                            {{-- Export user  --}}
                                                            <a  title="Export Violation"
                                                            class="btn  btn-sm btn-success"
                                                                href="{{ route('Export-Violation',$violation->id) }}">
                                                                <i class="fa-solid fa-download text-white"></i>
                                                            </a>
                                                            @if ($violation->deleted_at)
                                                            {{-- Unarchive form --}}
                                                            <form  id="{{$violation->id}}"
                                                                        action="{{route("violation.unarchive",$violation->id)}}"
                                                                        method="Post"
                                                                        style="margin-left: 4px !important">
                                                                        @csrf
                                                                        @method("PUT")
                                                                    <button
                                                                    title="Unarchive Violation"
                                                                    onclick="event.preventDefault();
                                                                    document.getElementById({{$violation->id}}).submit();"
                                                                    class="btn  btn-pr  btn-sm" >
                                                                        <i class="fa-solid fa-diagram-next text-white"></i>
                                                                    </button>
                                                                    </form>
                                                            @else
                                                                {{-- Archive form --}}
                                                            <form id="{{$violation->id}}" action="{{route("violation.remove",$violation->id)}}" method="post" style="margin-left: 4px !important">
                                                            @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm "
                                                                title="Archive Violation"
                                                                onclick="event.preventDefault();

                                                                        Swal.fire({
                                                                        title: 'Are you sure?',
                                                                        text: 'Do you want to Arhive Violation  {{$violation->name}}',
                                                                        icon: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#3085d6',
                                                                        cancelButtonColor: '#d33',
                                                                        confirmButtonText: 'Yes, Archive it!'
                                                                        }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            document.getElementById('{{$violation->id}}').submit();
                                                                            Swal.fire(
                                                                            'Deleted!',
                                                                            'The Violation has been Archived.',
                                                                            'success'
                                                                            )
                                                                        }
                                                                        })
                                                                "
                                                                >
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>

                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endif

                                                @endforeach
                                        </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>
                             {{-- Pagination --}}
                                    <div class="justify-content-center d-flex">
                                           {{$violations->links("pagination::bootstrap-4")}}
                                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('user.register') }}" class="myForm text-center" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Username" name="name" id="username" required>
                            <div class="invalid-feedback">Please fill out field</div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="Email" id="email" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-solid fa-city"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Ville" name="ville" id="ville" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" min="9" name="password" placeholder="Password" id="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Create user">
                    </div>
                </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endsection
