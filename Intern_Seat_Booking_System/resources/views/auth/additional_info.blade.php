@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Complete Your Profile</h2>
    <form action="{{ route('additional.info') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="training_id">Training ID</label>
            <input type="text" id="training_id" name="training_id" class="form-control" required>
            @error('training_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="department_id">Department</label>
            <select id="department" name="department" class="form-control" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->dep_no }}">{{ $department->dep_name }}</option>
                @endforeach
            </select>
            @error('department_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
