@extends('admin/layouts/admin')

@section('content')

<div class="app-content my-3 my-md-5">
    <div class="side-app">
        <div class="page-header"></div>
        <div class="container-fluid">
            <h1 class="h3 mb-0 text-gray-800 text-center">Admin Profile</h1>

            <div class="d-flex justify-content-center">
                <div class="card shadow mb-4 w-75"> <!-- Adjust width as needed -->
                    <div class="card-body" style="background-color: azure;">
                        <div class="row">
                            <div class="col-md-4 text-center position-relative"> <!-- Position relative for the profile image -->
                                <img src="{{ asset('assets/img/home/testimonial-1.jpg') }}" alt="Profile Image" class="rounded-circle" style="width: 150px; height: 150px;"> <!-- Adjust size as needed -->
                                
                                <!-- Edit Icon -->
                                <a href="{{ route('admin.profile.edit') }}" class="position-absolute" style="top: 5px; right: 5px; color: white;">
                                    <i class="fas fa-edit fa-lg"></i> <!-- Font Awesome edit icon -->
                                </a>
                            </div>
                            <div class="col-md-8"> <!-- Column for Admin Details -->
                                <table class="table table-bordered">
                                    <tr>
                                        <th>First Name</th>
                                        <td>{{ $admin->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{ $admin->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number</th>
                                        <td>{{ $admin->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $admin->email }}</td>
                                    </tr>
                                    <!-- Add more fields as necessary -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
