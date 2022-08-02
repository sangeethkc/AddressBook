@extends('layouts.app')
@section('content')

    <body>
        {{-- <a class="btn btn-primary" href="{{ route('student.create') }}">Add Student</a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
            Add User
        </button>

        <!-- Add Modal -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="adduser" action="{{ route('student.store') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter name" minlength="5" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" placeholder="Enter address" rows="3" minlength="10"
                                    required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="number" class="form-control" id="mobile" name="mobile"
                                    placeholder="Enter mobile" minlength="8">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="edituser" action="{{ route('student.update') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">

                                <input type="hidden" id="stud_id" value="" name="stud_id">

                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="xname" name="name"
                                    placeholder="Enter name" minlength="5" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="xaddress" name="address" placeholder="Enter address" rows="3"
                                    minlength="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="xemail" name="email"
                                    placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="number" class="form-control" id="xmobile" name="mobile"
                                    placeholder="Enter mobile" minlength="8">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="search">
                <input type="search" name="search" id="search" placeholder="Search" class="form-control">
            </div>
        </div>
        <h2>Students</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="alldata">
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->mobile }}</td>
                        <td><button value="{{ $student->id }}" class="btn editbtn btn-warning">Edit</button></td>
                @endforeach

            </tbody>
            <tbody id="Content" class="searchdata"></tbody>
        </table>

        {!! $students->links() !!}
    </body>

    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();

            if ($value) {
                $('.alldata').hide();
                $('.searchdata').show();
            } else {
                $('.alldata').show();
                $('.searchdata').hide();
            }

            $.ajax({
                type: 'GET',
                url: '{{ URL::to('search') }}',
                data: {
                    'search': $value
                },
                success: function(data) {
                    console.log(data);
                    $('#Content').html(data);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $("#adduser").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
                address: {
                    required: true,
                    minlength: 10
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    number: true,
                    minlength: 8
                },
            },
            messages: {
                name: {
                    required: "Name is a required field!!!",
                    minlength: "Name must be at least 5 characters long!!!",
                },
                address: {
                    required: "Address is a required field!!!",
                    minlength: "Address must be at least 10 characters long!!!",
                },
                email: {
                    required: "Email is a required field!!!",
                    email: "Please enter a valid email address",
                },
                mobile: {
                    required: "Mobile is a required field!!!",
                    minlength: "Mobile must be at least 8 characters long!!!",
                    number: "Mobile must be numeric",
                },
            }
        });
    </script>
    <script type="text/javascript">
        $("#edituser").validate({
            rules: {
                xname: {
                    required: true,
                    minlength: 5
                },
                xaddress: {
                    required: true,
                    minlength: 10
                },
                xemail: {
                    required: true,
                    email: true
                },
                xmobile: {
                    required: true,
                    number: true,
                    minlength: 8
                },
            },
            messages: {
                xname: {
                    required: "Name is a required field!!!",
                    minlength: "Name must be at least 5 characters long!!!",
                },
                xaddress: {
                    required: "Address is a required field!!!",
                    minlength: "Address must be at least 10 characters long!!!",
                },
                xemail: {
                    required: "Email is a required field!!!",
                    email: "Please enter a valid email address",
                },
                xmobile: {
                    required: "Mobile is a required field!!!",
                    minlength: "Mobile must be at least 8 characters long!!!",
                    number: "Mobile must be numeric",
                },
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready().on('click', '.editbtn', function() {
            var stud_id = $(this).val();
            $('#edit').modal('show');

            $.ajax({
                type: 'GET',
                url: 'students/edit/' + stud_id,
                success: (response) => {
                    // console.log(response.student.name);
                    $('#xname').val(response.student.name);
                    $('#xaddress').val(response.student.address);
                    $('#xemail').val(response.student.email);
                    $('#xmobile').val(response.student.mobile);
                    $('#stud_id').val(stud_id);
                }
            })
        })
    </script>
@endsection
