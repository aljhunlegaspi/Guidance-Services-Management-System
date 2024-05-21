@extends('layout.sidebar')

@section('search')
   <div class="search">
       <form action="{{route('users.search')}}" method="POST" id="serach">
        @csrf
             <label>
              <input type="text" placeholder="Search Here" name="search" id="search"
                     onabort="event.preventDefault(); document.getElementById('serach').submit();">
              <ion-icon name="search"></ion-icon>
            </label>
        </form>
    </div>
@endsection

@section('content')
    <div class="Users-CardBox">
      <div class="Card">
          <div>
              <div class="numbers">{{$usersCount}}</div>
              <div class="CardName">Users</div>
          </div>
          <div class="iconBox"><ion-icon name="person"></ion-icon></div>
      </div>
      <div class="Card">
          <div>
              <div class="numbers">{{$usersArchivedCount}}</div>
              <div class="CardName">User Archive</div>
          </div>
          <div class="iconBox"><ion-icon name="archive"></ion-icon></div>
      </div>
  </div>

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
                                  <a href="{{ route('User.create') }}" class="btn btn-primary">Add User</a>
                              </div>
                          </div>
                      </div>
                      <div class="cat-details">
                          <div class="list">
                              <div class="cartHeader">
                                  <h2>Users</h2>
                                  <a class="btn btn-sm btn-success mr-0" href="{{ route('users-export') }}" title="Export All users">
                                      <i class="fa-solid fa-download text-white"></i>
                                  </a>
                                  @if (Route::currentRouteName() == 'users.archive')
                                      <a href="{{route('users.index')}}" class="btn">View Users</a>
                                  @else
                                      <a href="{{route('users.archive')}}" class="btn">View Archived Users</a>
                                  @endif
                              </div>
                              <div class="table-responsive">
                                  <table>
                                      <thead>
                                          <tr>
                                              <td>#ID</td>
                                              <td>Image</td>
                                              <td>Name</td>
                                              <td>email</td>
                                              <td>Year level</td>
                                              <td class="text-center">Action</td>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($users as $user)
                                          @if (!$user->admin)
                                              <tr>
                                                  <td>{{$user->id}}</td>
                                                  <td>
                                                      @if ($user->image !== 'image')
                                                          <img src="{{asset('images/profile/'.$user->image)}}" class="img-fluid rounded-circle"
                                                               alt="" width="50" height="50">
                                                      @else
                                                          <img src="{{asset('images/profile/userImage.png')}}" class="img-fluid rounded-circle"
                                                               alt="" width="50" height="50">
                                                      @endif
                                                  </td>
                                                  <td>{{$user->name}}</td>
                                                  <td>{{$user->email}}</td>
                                                  <td>{{$user->year_level}}</td>
                                                  <td class="d-flex flex-row justify-content-center align-items-center">
                                                      <a class="btn btn-sm btn-success" href="{{ route('Export-User', $user->id) }}" title="Export user">
                                                          <i class="fa-solid fa-download text-white"></i>
                                                      </a>
                                                      <button class="btn btn-warning btn-sm" title="Add Violation" onclick="openAddViolationModal({{ $user }})">
                                                          <i class="fa fa-exclamation-triangle"></i>
                                                      </button>
                                                      <a class="btn btn-info btn-sm" title="View Student Details" href="{{ route('users.details', $user->id) }}">
                                                          <i class="fa fa-info-circle"></i>
                                                      </a>
                                                      @if ($user->deleted_at)
                                                          <form id="{{$user->id}}" action="{{route('user.unarchive', $user->id)}}" method="Post" style="margin-left: 4px !important">
                                                              @csrf
                                                              @method('PUT')
                                                              <button class="btn btn-pr btn-sm" title="Unarchive this User Account"
                                                                      onclick="event.preventDefault(); document.getElementById({{$user->id}}).submit();">
                                                                  <i class="fa-solid fa-diagram-next text-white"></i>
                                                              </button>
                                                          </form>
                                                      @else
                                                          <form id="{{$user->id}}" action="{{route('users.remove', $user->id)}}" method="post" style="margin-left: 4px !important">
                                                              @csrf
                                                              @method('DELETE')
                                                              <button class="btn btn-danger btn-sm" title="Archive User Account"
                                                                      onclick="event.preventDefault(); Swal.fire({
                                                                          title: 'Are you sure?',
                                                                          text: 'Do you want to Arhive User {{$user->name}} Account',
                                                                          icon: 'warning',
                                                                          showCancelButton: true,
                                                                          confirmButtonColor: '#3085d6',
                                                                          cancelButtonColor: '#d33',
                                                                          confirmButtonText: 'Yes, Archive it!'
                                                                      }).then((result) => {
                                                                          if (result.isConfirmed) {
                                                                              document.getElementById('{{$user->id}}').submit();
                                                                              Swal.fire('Deleted!', 'The User Account has been Archived.', 'success')
                                                                          }
                                                                      })">
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
                          <div class="justify-content-center d-flex">
                              {{$users->links("pagination::bootstrap-4")}}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Add Violation Modal -->
  <div class="modal fade" id="addViolationModal" tabindex="-1" role="dialog" aria-labelledby="addViolationModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="addViolationModalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form id="addViolationForm" method="POST">
                      @csrf
                      <div class="form-group mb-3">
                            <select class="form-control" name="violation" id="violationDropdown" required>
                                <option value="" disabled selected>Select a Violation</option>
                                @foreach ($Violations as $violation)
                                    <option value="{{ $violation->id }}" data-description="{{ $violation->description }}" data-type="{{ $violation->type }}" data-penalty="{{ $violation->penalty_type }}">{{ $violation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="violationDetails" class="mb-3 alert alert-info" style="display: none;">
                            <div style="width: 100%; text-align: center">
                                <h5><strong>Violation Details</strong></h5>
                            </div>
                            <p id="violationDescription"></p>
                            <p id="violationType"></p>
                            <p id="violationPenalty"></p>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Add Violation">
                        </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <!-- View Student Details Modal -->
  <div class="modal fade" id="viewStudentModal" tabindex="-1" role="dialog" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="viewStudentModalLabel">Student Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div id="studentDetails">
                      <!-- Student details will be populated here by JavaScript -->
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    function openAddViolationModal(user) {
        const form = document.getElementById('addViolationForm');
        const label = document.getElementById('addViolationModalLabel');
        
        form.action = `/users/${user.id}/add-violation`;
        label.innerHTML  = `Add violation to <strong>${user.name}</strong>`;
        $('#addViolationModal').modal('show');
    }

    function openViewStudentModal(user) {
        // Fetch student details and violations using AJAX
        console.log(user);
        $('#studentDetails').html(user);
        $('#viewStudentModal').modal('show');
    }

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#violationDropdown').change(function() {
            const selectedOption = $(this).find('option:selected');
            const description = selectedOption.data('description');
            const type = selectedOption.data('type');
            const penalty = selectedOption.data('penalty');

            $('#violationDescription').text('Description: ' + description);
            $('#violationType').text('Type: ' + type);
            $('#violationPenalty').text('Penalty: ' + penalty);

            $('#violationDetails').show();
        });
    });
</script>
@endsection