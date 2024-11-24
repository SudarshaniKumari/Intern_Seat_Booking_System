<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Models\Attendance;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\Response;




class AttendanceController extends Controller
{
    // Method to display the attendance page
    public function index()
    {
        return view('admin.attendance.index'); // Return the attendance index view
    }

    // Method to fetch user details based on the selected date
    public function getUserDetails(Request $request)
    {
        // Validate the incoming request to ensure a date is provided
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = $request->input('date'); // Get the selected date from the request

        // Query to get user details based on the selected date
        $userDetails = DB::table('bookings')
            ->join('users', 'bookings.training_id', '=', 'users.training_id')
            ->where('bookings.booking_date', $date) // Filter by the selected date
            ->select('bookings.*', 'users.first_name', 'users.last_name', 'users.email')
            ->get(); // Execute the query and get results

        return response()->json($userDetails); // Return the results as JSON
    }

    public function export(Request $request)
    {
        $date = $request->input('date');
        $format = $request->input('format');

        // Fetch attendance data for the specified date from the bookings table
        $attendanceData = Booking::whereDate('booking_date', $date)->get();

        if ($format === 'csv') {
            return $this->exportCsv($attendanceData, $date);
        } elseif ($format === 'excel') {
            return $this->exportExcel($attendanceData, $date);
        } elseif ($format === 'pdf') {
            return $this->exportPdf($attendanceData, $date);
        } elseif ($format === 'jpg') {
            return $this->exportImage($attendanceData, $date);
        } else {
            return response()->json(['error' => 'Invalid format selected.'], 400);
        }
    }
    protected function exportCsv($data, $date)
    {
        $filename = "attendance_{$date}.csv";
        $csvData = "First Name,Last Name,Email,Training ID,Seat Number,Attendance\n";

        foreach ($data as $record) {
            $csvData .= "{$record->user->first_name},{$record->user->last_name},{$record->user->email},{$record->training_id},{$record->seat_no}," . ($record->is_present ? 'Present' : 'Absent') . "\n";
        }

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    protected function exportExcel($data, $date)
    {
        // Use Maatwebsite Excel package to generate Excel file
        $filename = "attendance_{$date}.xlsx";
        return Excel::download(new AttendanceExport($data), $filename);
    }

    protected function exportPdf($data, $date)
    {
        // Use Barryvdh DomPDF package to generate PDF file
        $pdf = PDF::loadView('admin.attendance.pdf', compact('data', 'date'));
        return $pdf->download("attendance_{$date}.pdf");
    }
    

    protected function exportImage($data, $date)
    {
        // Use Intervention Image package to generate an image
        $image = Image::canvas(800, 600, '#fff');
        $image->text("Attendance for {$date}", 400, 50, function($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(24);
            $font->color('#000');
            $font->align('center');
        });
        
        // Add attendance data as text
        $y = 100;
        foreach ($data as $record) {
            $image->text("{$record->first_name} {$record->last_name} - {$record->is_present}", 400, $y, function($font) {
                $font->file(public_path('fonts/arial.ttf'));
                $font->size(16);
                $font->color('#333');
                $font->align('center');
            });
            $y += 30;
        }

        // Save as image file and return download
        $filename = "attendance_{$date}.jpg";
        $image->save(public_path($filename));
        return response()->download(public_path($filename))->deleteFileAfterSend(true);
    }
}

