<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LabController extends Controller
{

    public function __construct()
    {
        $this->navActive = 'lab';
    }

    public function index()
    {
      return view('lab.upload');
    }

   public function extractLabResults(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|file|mimes:pdf',
        ]);

        $pdf = $request->file('pdf_file');
        $pdfPath = $pdf->storeAs('temp', uniqid() . '.pdf');

        $excelPath = storage_path('app/temp/' . uniqid() . '.xlsx');

        // Convert PDF to Excel using LibreOffice
        $command = "libreoffice --headless --convert-to xlsx --outdir " . storage_path('app/temp') . ' ' . storage_path('app/' . $pdfPath);
        shell_exec($command);

        // Find the generated xlsx file (the same name but with .xlsx extension)
        $xlsxFile = str_replace('.pdf', '.xlsx', $pdfPath);
        $xlsxFullPath = storage_path('app/' . $xlsxFile);

        // Load Excel and parse data
        $spreadsheet = IOFactory::load($xlsxFullPath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $results = [];
        foreach ($rows as $row) {
            // Example: find rows where column A has pemeriksaan and B has hasil
            if (isset($row[0], $row[1]) && is_numeric($row[1])) {
                $results[] = [
                    'pemeriksaan' => trim($row[0]),
                    'hasil' => $row[1],
                ];
            }
        }

        return response()->json([
            'results' => $results,
        ]);
    }
}
