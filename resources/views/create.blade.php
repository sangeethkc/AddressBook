@extends('layouts.app')
@section('content')
<h2>Create student</h2>
<div class="m-1">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
    <form action="{{ route('student.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" rows="3">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection