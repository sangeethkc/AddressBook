@extends('layouts.app')
@section('content')
<h2>Edit student</h2>
<div>
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
<div class="m-1">
    <form action="{{ route('student.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{ $student->name }}" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="address">address</label>
            <input type="text" value="{{ $student->address }}" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="email">email</label>
            <input type="text" value="{{ $student->email }}" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="mobile">mobile</label>
            <input type="text" value="{{ $student->mobile }}" class="form-control" id="mobile" name="mobile">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection