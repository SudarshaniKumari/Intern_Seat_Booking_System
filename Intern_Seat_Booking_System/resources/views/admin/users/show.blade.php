@extends('admin/layouts/admin')

@section('content')
<div class="app-content my-3 my-md-5">
    <div class="side-app">
        <div class="page-header"></div>
        <div class="container-fluid">
            <h1 class="h3 mb-0 text-gray-800 text-center">User Details</h1>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>First Name</th>
                            <td>{{ $user->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>{{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Training ID</th>
                            <td>{{ $user->training_id }}</td>
                        </tr>
                        <tr>
                            <th>Department No</th>
                            <td>{{ $user->dep_no }}</td>
                        </tr>
                        <tr>
                            <th>Department Name</th>
                            <td>{{ $user->dep_name }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $user->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Unversity</th>
                            <td>{{ $user->university_name }}</td>
                        </tr>
                        <!-- university_name -->
                        <!-- Add more fields as necessary -->
                    </table>

                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-danger m-2">Close</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection