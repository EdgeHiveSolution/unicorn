<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ReportExport implements FromCollection, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect();
    }

    public function registerEvents(): array
    {
        $events = [
            BeforeSheet::class => function (BeforeSheet $event) {
                $kpiRow = 1;

                foreach ($this->data as $kpiTitle => $metrics) {
                    // Set KPI title
                    $cell = 'A' . $kpiRow;
                    $event->sheet->setCellValue($cell, $kpiTitle);
                    $event->sheet->getStyle($cell)->getFont()->setBold(true);
    
                    // Apply bottom border to the KPI title cell
                    $event->sheet->getStyle($cell)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


                    // Set header row
                    $rowNumber = $kpiRow + 2;
                    $event->sheet->setCellValue('A' . $rowNumber, 'Metric');
                    $event->sheet->setCellValue('B' . $rowNumber, 'Current Month');
                    $event->sheet->setCellValue('C' . $rowNumber, 'Previous Month');
                    $event->sheet->setCellValue('D' . $rowNumber, 'MOM Change');
                    $event->sheet->setCellValue('E' . $rowNumber, 'Current Quarter');
                    $event->sheet->setCellValue('F' . $rowNumber, 'Previous Quarter');
                    $event->sheet->setCellValue('G' . $rowNumber, 'QOQ Change');
                    $event->sheet->getStyle('A' . $rowNumber . ':G' . $rowNumber)->getFont()->setBold(true);

                   

                    // Set data rows
                    $rowNumber++;
                    foreach ($metrics as $index => $metric) {
                        $event->sheet->setCellValue('A' . $rowNumber, $metric['kpi_metric']);
                        $event->sheet->setCellValue('B' . $rowNumber, $metric['current_month']);
                        $event->sheet->setCellValue('C' . $rowNumber, $metric['previous_month']);
                        $event->sheet->setCellValue('D' . $rowNumber, $metric['mom_change']);
                        $rowNumber++;
                    }

                    $kpiRow = $rowNumber + 2; 
                }
            },
        ];

        return $events;
    }
}
