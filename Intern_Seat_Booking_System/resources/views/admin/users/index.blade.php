@extends('admin/layouts/admin')

@section('content')

<div class="container-fluid pt-4 px-4 pb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-center">Users List</h1>
        <div class="d-flex align-items-center">
            <!-- Search Form -->
            <form method="GET" action="{{ route('admin.users.index') }}" class="mr-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Enter Training ID" value="{{ request('search') }}" style="background-color: #E0FFFF;">
                    <div class="input-group-append">
                        <button class="btn btn-primary ms-2" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered" style="border-color: black; background-color:#FFFFE0;">
        <thead style="background-color: #EEE8AA;">
            <tr>
                <!-- ID Column -->
                <th class="text-center" style="color: black;">
#
                </th>
                <!-- First Name Column -->
                <th class="text-center" style="font-weight: bold; color: black;">
                    <a href="{{ route('admin.users.index', ['sort_by' => 'first_name', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" style="color: black;">
                        First Name
                        <i class="fa-solid fa-arrow-up {{ request('sort_by') === 'first_name' && request('order') === 'asc' ? '' : 'text-muted' }}" style="color: black; margin-left: 8px;"></i>
                        <i class="fa-solid fa-arrow-down {{ request('sort_by') === 'first_name' && request('order') === 'desc' ? '' : 'text-muted' }}" style="color: black; margin-left: 8px;"></i>
                    </a>

                </th>
                <!-- Last Name Column -->
                <th class="text-center" style="font-weight: bold; color: black;">
                    <a href="{{ route('admin.users.index', ['sort_by' => 'last_name', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" style="color: black; ">
                        Last Name
                        <i class="fa-solid fa-arrow-up {{ request('sort_by') === 'last_name' && request('order') === 'asc' ? '' : 'text-muted' }}" style="color: black;  margin-left: 8px;"></i>
                        <i class="fa-solid fa-arrow-down {{ request('sort_by') === 'last_name' && request('order') === 'desc' ? '' : 'text-muted' }}" style="color: black;  margin-left:4px;"></i>
                    </a>
                </th>
                <!-- Training ID Column -->
                <th class="text-center" style="font-weight: bold; color: black;">
                    <a href="{{ route('admin.users.index', ['sort_by' => 'training_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" style="color: black;">
                        Training ID
                        <i class="fa-solid fa-arrow-up {{ request('sort_by') === 'training_id' && request('order') === 'asc' ? '' : 'text-muted' }}" style="color: black; margin-left: 8px;"></i>
                        <i class="fa-solid fa-arrow-down {{ request('sort_by') === 'training_id' && request('order') === 'desc' ? '' : 'text-muted' }}" style="color: black; margin-left: 4px;"></i>
                    </a>
                </th>
                <!-- Email Column -->
                <th class="text-center" style="font-weight: bold; color: black;">
                    <a href="{{ route('admin.users.index', ['sort_by' => 'email', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" style="color: black;">
                        Email
                        <i class="fa-solid fa-arrow-up {{ request('sort_by') === 'email' && request('order') === 'asc' ? '' : 'text-muted' }}" style="color: black; margin-left: 8px;"></i>
                        <i class="fa-solid fa-arrow-down {{ request('sort_by') === 'email' && request('order') === 'desc' ? '' : 'text-muted' }}" style="color: black; margin-left: 4px;"></i>
                    </a>
                </th>
                <!-- Action Column -->
                <th class="text-center" style="font-weight: bold; color: black;">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $key => $user)
            <tr class="{{ session('highlight_user_id') == $user->id ? 'table-warning' : '' }}">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $user->first_name }}</td>
                <td class="text-center">{{ $user->last_name }}</td>
                <td class="text-center">{{ $user->training_id }}</td>
                <td class="text-center">{{ $user->email }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary btn-sm text-black" data-toggle="tooltip" data-original-title="View"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('admin.users.pdf', $user->id) }}" class="btn btn-success btn-sm text-black" data-toggle="tooltip" data-original-title="Download"><i class="fas fa-file-download"></i></a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm text-black" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $users->appends(request()->input())->links() }}
    </div>
</div>
@endsection