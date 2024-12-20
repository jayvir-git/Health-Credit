<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function ShowImportForm(Request $request)
    {
        return view('admin');
    }

    public function BatchImportCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        try {
            // Get the uploaded file
            $csvFile = $request->file('csv_file');

            // Open the CSV file
            $csvData = file_get_contents($csvFile->getRealPath());

            // Split the CSV data into rows
            $rows = array_filter(explode("\n", $csvData)); // Remove empty rows

            // Skip the header row
            $header = array_shift($rows);

            // Expected number of columns
            $expectedColumns = 8;

            // Track successful and failed rows
            $successCount = 0;
            $failedRows = [];

            // Insert the data into the database
            foreach ($rows as $index => $row) {
                $data = str_getcsv($row);

                // Skip empty rows
                if (empty(array_filter($data))) {
                    continue;
                }

                // Validate row data
                if (count($data) < $expectedColumns) {
                    $failedRows[] = [
                        'row' => $index + 2, // Adding 2 to account for 0-based index and header row
                        'data' => $row,
                        'reason' => 'Missing columns'
                    ];
                    continue;
                }

                try {
                    DB::table('providers')->insert([
                        'name' => $data[0] ?? null,
                        'specialty' => $data[1] ?? null,
                        'address' => $data[2] ?? null,
                        'lattitude' => $data[3] ?? null,
                        'longitude' => $data[4] ?? null,
                        'zipcode' => $data[5] ?? null,
                        'city' => $data[6] ?? null,
                        'state' => $data[7] ?? null,
                    ]);
                    $successCount++;
                } catch (\Exception $e) {
                    $failedRows[] = [
                        'row' => $index + 2,
                        'data' => $row,
                        'reason' => $e->getMessage()
                    ];
                }
            }

            // Prepare the response message
            $message = "$successCount rows imported successfully.";
            if (!empty($failedRows)) {
                $message .= " " . count($failedRows) . " rows failed.";
                // Store failed rows in session for detailed review
                session(['failed_rows' => $failedRows]);
            }

            return redirect('/');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error processing CSV file: ' . $e->getMessage());
        }
    }
}
