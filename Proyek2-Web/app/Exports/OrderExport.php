<?php

namespace App\Exports;

use App\Models\Loan;
use App\Models\LoanAsset;
use App\Models\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


// use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements WithHeadings, WithEvents, WithHeadingRow, WithColumnWidths
{
    public function columnWidths(): array
    {
        return [
            'A' => 3,
            'B' => 6,
            'C' => 5,
            'E' => 30,
            'F' => 40,
            'K' => 8,
        ];
    }
    public function headings(): array
    {
        return [
            // 'Nama',
            // 'Unit',
            // 'Disetujui Oleh',
            // 'Nama Barang',
            // 'Kategori Barang Peminjaman',
            // 'Tanggal Peminjaman',
            // 'Tanggal Pengembalian',      
            // 'Status'
        ];
    }
    /**
     * @return array
     */
    public function registerEvents(): array
    {
        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 12
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,

                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $center = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $styleTitle = [
            'font' => [
                'bold' => true,
                'size' => 12
            ],
        ];
        $styleTitleDate = [
            'font' => [
                'bold' => true,
                'size' => 11
            ],
        ];
        $styleContent = [
            'font' => [
                'bold' => false,
                'size' => 11
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

                ],
            ],

        ];
        return [
            AfterSheet::class    => function (AfterSheet $event) use ($styleArray, $styleTitle, $styleTitleDate, $styleContent, $center) {
                $event->sheet->getDelegate()->getRowDimension('10')->setRowHeight(27);
                $event->sheet->getStyle('A1:A4')->applyFromArray($styleTitle);
                $event->sheet->getStyle('F')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('E')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('K')->getAlignment()->setWrapText(true);
                $event->sheet->setCellValue('A1', 'UD. Keramik Kinasih');
                $event->sheet->setCellValue('A2', 'Cangkring, Kota Probolinggo');
                $event->sheet->setCellValue('A4', 'Laporan Penjualan');
                $event->sheet->setCellValue('A6', 'Tanggal: ');
                $event->sheet->setCellValue('C6', Carbon::now()->isoFormat('DD MMMM YYYY'))->getStyle('C6')->applyFromArray($styleTitleDate);
                $event->sheet->setCellValue('H5', 'Periode: ');
                $event->sheet->setCellValue('H6', Carbon::now()->isoFormat('MMMM YYYY'))->getStyle('H6')->applyFromArray($styleTitleDate)->getAlignment()->setWrapText(false);
                $event->sheet->setCellValue('B9', 'No')->mergeCells("B9:B10")->getStyle('B9:B10')->applyFromArray($styleArray);
                $event->sheet->setCellValue('C9', 'Nama Pemesan')->mergeCells("C9:D10")->getStyle('C9:D10')->applyFromArray($styleArray);
                $event->sheet->setCellValue('E9', 'Nomor HP')->mergeCells("E9:E10")->getStyle('E9:E10')->applyFromArray($styleArray);
                $event->sheet->setCellValue('F9', 'Alamat')->mergeCells("F9:F10")->getStyle('F9:F10')->applyFromArray($styleArray);
                $event->sheet->setCellValue('G9', 'Pesanan')->mergeCells("G9:H9")->getStyle('G9:H9')->applyFromArray($styleArray, $center);
                $event->sheet->setCellValue('G10', 'Tanggal Pemesanan')->getStyle('G10')->applyFromArray($styleArray);
                $event->sheet->setCellValue('H10', 'Nomor Pesanan')->getStyle('H10')->applyFromArray($styleArray); 
                $event->sheet->setCellValue('I9', 'Produk')->mergeCells("I9:J9")->getStyle('I9:J9')->applyFromArray($styleArray, $center);
                $event->sheet->setCellValue('I10', 'Nama Produk')->getStyle('I10')->applyFromArray($styleArray);
                $event->sheet->setCellValue('J10', 'Nomor Resi')->getStyle('J10')->applyFromArray($styleArray);
                $event->sheet->setCellValue('K9', 'Total')->mergeCells("K9:K10")->getStyle('K9:K10')->applyFromArray($styleArray);

                // $event->sheet->setCellValue('E9', 'Kategori Barang Peminjaman');
                // $event->sheet->setCellValue('H9', 'Tanggal Peminjaman')->mergeCells("H9:H10")->getStyle('H9:H10')->applyFromArray($styleArray);
                // $event->sheet->setCellValue('H2', 'Status');

                foreach (range('D', 'J') as $col) {
                    // if ($col === 'I') {
                    //     continue;
                    // }
                    // // if ($col === 'F') {
                    // //     continue;
                    // // }
                    $event->sheet->getColumnDimension($col)->setAutoSize(true);
                }
                $cell = 11;
                $i = 1;
                $loan_date = Order::getDate();
                // dd($loan_date);
                foreach ($loan_date as $date) {
                    // dd($date->loan_date);
                    $event->sheet->setCellValue('B' . $cell, $i . '. ')->getStyle('B' . $cell)
                        ->getFill()
                        ->applyFromArray([
                            $styleTitleDate,
                            'fillType' => 'solid',
                            'rotation' => 0,
                            'color' => [
                                'rgb' => 'D8E4BC'
                            ],
                        ]);
                    $event->sheet->setCellValue('C' . $cell, Carbon::parse($date->order_date)->isoFormat('DD MMMM YYYY'))->mergeCells('C' . $cell . ':K' . $cell)->getStyle('C' . $cell . ':K' . $cell)->applyFromArray($styleTitleDate);
                    $event->sheet->setCellValue('C' . $cell, Carbon::parse($date->order_date)->isoFormat('DD MMMM YYYY'))->mergeCells('C' . $cell . ':K' . $cell)->getStyle('C' . $cell . ':K' . $cell)->getFill()->applyFromArray([
                        'fillType' => 'solid',
                        'rotation' => 0,
                        'color' => [
                            'rgb' => 'D8E4BC'
                        ],

                    ]);
                    $cell++;
                    $loans = Order::getOrderPerDate($date->order_date);
                    $i_data = 1;
                    foreach ($loans as $row) {
                        $cellData = $cell;
                        $event->sheet->getStyle('B' . $cell . ':' . 'K' . $cellData)->applyFromArray($styleContent);
                        $loanAssets = Order::getOrderProduct($row->id);
                        $event->sheet->setCellValue('C' . $cellData, $i_data . '. ')->getStyle('C' . $cellData)->applyFromArray($center);
                        $event->sheet->setCellValue('D' . $cellData, $row->nama);
                        $event->sheet->setCellValue('E' . $cellData, $row->phone_number)->getStyle('E' . $cellData)->applyFromArray($center);
                        $event->sheet->setCellValue('F' . $cellData, $row->alamat)->getStyle('F' . $cellData)->applyFromArray($center);
                        $event->sheet->setCellValue('G' . $cellData, Carbon::parse($row->order_date)->isoFormat('DD MMMM YYYY'))->getStyle('G' . $cellData)->applyFromArray($center);
                        $event->sheet->setCellValue('H' . $cellData, $row->merchant_ref)->getStyle('H' . $cellData)->applyFromArray($center);
                        $event->sheet->setCellValue(
                            'I' . $cellData,
                            implode(',' . PHP_EOL, $loanAssets)
                        );
                        $event->sheet->setCellValue('J' . $cellData, $row->resi)->getStyle('J' . $cellData)->applyFromArray($center);
                        // $event->sheet->setCellValue('K' . $cellData, $row->amount);

                        // $from = \Carbon\Carbon::createFromFormat('Y-m-d', $row->loan_date);
                        // $to = Carbon::createFromFormat('Y-m-d', $row->real_return_date);                        
                        $event->sheet->setCellValue('K' . $cellData, 'Rp.'.$row->amount)->getStyle('K' . $cellData)->applyFromArray($center);

                        // $event->sheet->setCellValue('H' . $cellData, Carbon::parse(date($row->loan_date))->toFormattedDateString());

                        $endRow = $cellData;
                        $cellData++;
                        $cell = $cellData;
                        $i_data++;
                    }
                    $i++;
                }
                // content outside border
                //left
                $event->sheet->getStyle('B11:B' . $endRow)->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'borders' => [
                        'left' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ],
                        'right' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ]
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                //right
                $event->sheet->getStyle('I11:K' . $endRow)->applyFromArray([
                    'borders' => [
                        'right' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ]
                    ],
                ]);
                //bottom
                $event->sheet->getStyle('B' . $endRow . ':K' . $endRow)->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ]
                    ],
                ]);
            },
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //return Loan::all();
        return collect(Order::getOrder());
    }
    // public function styles(Worksheet $sheet)
    // {
    //     return [
    //         // Style the first row as bold text.
    //         'A1:W1'    => ['font' => ['bold' => true]],
    //     ];
    // }
}