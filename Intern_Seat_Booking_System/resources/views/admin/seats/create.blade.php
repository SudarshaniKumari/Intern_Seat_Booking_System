@extends('admin/layouts/admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="text-center">
                    <h3>Add New Seat</h3>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <br>

                <form method="POST" id="Register" action="{{ route('admin.seats.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Number of Seats<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="seat_count" name="seat_count" min="1" max="50" required>
                    </div>

                    <br>

                    <div class="form-group mb-0">
                        <div class="checkbox checkbox-secondary d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary rounded-pill me-2">Add Seats</button>
                            <a href="{{ route('admin.seats.index') }}" class="btn btn-danger rounded-pill ">Close</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection