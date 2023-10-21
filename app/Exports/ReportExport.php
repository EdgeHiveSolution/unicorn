<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        // Define the headings for your report
        return [
            ['KPI Metric', 'Current Month', 'Previous Month', 'MOM Change'],
        ];
    }

    public function title(): array
    {
        // Define the KPI titles dynamically
        $titles = [];

        foreach ($this->data as $row) {
            if (!in_array($row['kpi_title'], $titles)) {
                $titles[] = $row['kpi_title'];
            }
        }

        return $titles;
    }
}
