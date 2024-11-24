@extends('admin/layouts/admin')

@section('content')

<div class="container-fluid pt-4 px-4 pb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-center">Attendance</h1>
        <div class="d-flex align-items-center">
            <!-- Search Form -->
            <div class="input-group">
                <input type="date" id="attendanceDate" class="form-control" />
                <div class="input-group-append">
                    <button id="fetchAttendance" class="btn btn-primary ms-2">Fetch Attendance</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered" style="border-color: black; background-color:#FFFFE0;" id="attendanceTable">
        <thead style="background-color: #EEE8AA;">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Training ID</th>
                <th>Seat Number</th>
                <th>Attendance</th>
                <th>Action</th> <!-- New Action Column -->
            </tr>
        </thead>
        <tbody>
            <!-- User details will be appended here via AJAX -->
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fetchAttendance').click(function() {
            let selectedDate = $('#attendanceDate').val();
            if (selectedDate) {
                $.ajax({
                    url: "{{ route('attendance.getUserDetails') }}",
                    method: 'GET',
                    data: {
                        date: selectedDate
                    },
                    success: function(data) {
                        let tbody = $('#attendanceTable tbody');
                        tbody.empty(); // Clear previous data
                        if (data.length > 0) {
                            data.forEach(user => {
                                tbody.append(`
                                    <tr>
                                        <td>${user.first_name}</td>
                                        <td>${user.last_name}</td>
                                        <td>${user.email}</td>
                                        <td>${user.training_id}</td>
                                        <td>${user.seat_no}</td>
                                        <td>${user.is_present}</td>
                                        <td>
                                            <button class="btn btn-secondary btn-rounded me-1" onclick="downloadFile('csv', '${selectedDate}')">CSV</button>
                                            <button class="btn btn-secondary me-1" onclick="downloadFile('excel', '${selectedDate}')">Excel</button>
                                            <button class="btn btn-secondary me-1" onclick="downloadFile('pdf', '${selectedDate}')">PDF</button>
                                            <button class="btn btn-secondary" onclick="downloadFile('jpg', '${selectedDate}')">Image</button>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            tbody.append('<tr><td colspan="7">No records found.</td></tr>');
                        }
                    },
                    error: function() {
                        alert('An error occurred while fetching attendance details.');
                    }
                });
            } else {
                alert('Please select a date.');
            }
        });
    });

    function downloadFile(format, date) {
        if (date) {
            window.location.href = "{{ route('attendance.export') }}?date=" + date + "&format=" + format;
        } else {
            alert('Please select a date.');
        }
    }
</script>

@endsection
