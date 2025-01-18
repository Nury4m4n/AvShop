<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UmrahPackagesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithCustomStartCell
{
    protected $umrahPackages;

    public function __construct($umrahPackages)
    {
        $this->umrahPackages = $umrahPackages;
    }

    /**
     * Mengumpulkan data paket umrah dan varian untuk diekspor.
     */
    public function collection()
    {
        $rowNumber = 1;

        return $this->umrahPackages->flatMap(function ($umrahPackage) use (&$rowNumber) {

            // Iterasi pada packageVariants terkait dengan umrahPackage
            return $umrahPackage->packageVariants->map(function ($variant) use (&$rowNumber, $umrahPackage) {
                // Menghitung kursi terjual
                $variant->totalQuantity = $variant->cartsItem
                    ->filter(function ($cartItem) {
                        return $cartItem->order && $cartItem->order->status === 'Paid';
                    })
                    ->sum(function ($cartItem) {
                        return $cartItem->quantity;
                    });

                return [
                    'No' => $rowNumber++,
                    'Nama Paket' => $umrahPackage->main_package_name,
                    'Nama Varian' => $variant->variant,
                    'Harga Dasar' => 'Rp ' . number_format($umrahPackage->price, 0, ',', '.'),
                    'Harga Tambahan' => 'Rp ' . number_format($variant->price, 0, ',', '.'),
                    'Harga Akhir' => 'Rp ' . number_format($umrahPackage->price + $variant->price, 0, ',', '.'),
                    'Stok Tersedia' => $variant->stock,
                    'Produk Terjual' => $variant->totalQuantity,
                    'Sisa Stok' => $variant->stock - $variant->totalQuantity,
                ];
            });
        });
    }

    /**
     * Mendefinisikan header kolom.
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Paket',
            'Nama Varian',
            'Harga Dasar',
            'Harga Tambahan',
            'Harga Akhir',
            'Stok Tersedia',
            'Produk Terjual',
            'Sisa Stok',
        ];
    }

    /**
     * Memetakan data yang akan diekspor ke file Excel.
     */
    public function map($row): array
    {
        return [
            $row['No'],
            $row['Nama Paket'],
            $row['Nama Varian'],
            $row['Harga Dasar'],
            $row['Harga Tambahan'],
            $row['Harga Akhir'],
            $row['Stok Tersedia'],
            $row['Produk Terjual'],
            $row['Sisa Stok'],
        ];
    }

    /**
     * Menentukan gaya untuk lembar kerja Excel.
     */
    public function styles(Worksheet $sheet)
    {
        // Merge cells untuk judul
        $sheet->mergeCells('A1:I1');

        // Set gaya untuk judul
        $sheet->setCellValue('A1', 'Laporan Penjualan AverseShop');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
                'color' => ['argb' => 'BLACK'], // Teks hitam
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Set gaya untuk header kolom
        $sheet->getStyle('A2:I2')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'], // Teks putih
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['argb' => '78036e'], // Warna maroon
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Set gaya untuk data tabel
        $sheet->getStyle('A3:I' . ($sheet->getHighestRow()))->applyFromArray([
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Atur lebar kolom otomatis
        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        return [];
    }

    /**
     * Menentukan sel awal untuk data.
     */
    public function startCell(): string
    {
        return 'A2'; // Memulai data dari baris ke-3 (baris 1 untuk judul, baris 2 untuk header)
    }
}
