<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Support\Facades\DB;

class ExportLaporanKeluar implements FromCollection, WithMapping, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $data;
    protected $dateFirst;
    protected $dateLast;
    private $row = 0;
    private $jenis = 'Pengeluaran';

    public function __construct($data,$dateFirst,$dateLast)
    {
        $this->data = $data;
        $this->dateFirst = $dateFirst;
        $this->dateLast = $dateLast;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($data): array
    {
        return [
            ++$this->row,
            $this->jenis,
            $data->nama_beras,
            $data->tanggal,
            'Rp. '.$data->harga_beli,
            $data->jumlah_masuk,
            $data->kategori,
            'Rp. '.$data->total_keluar,
        ];
    }

    public function headings(): array
    {
        return [
            [
                'LAPORAN KEUANGAN KELUAR TOKO BERAS MULIA',
            ],
            [' '],
            [$this->dateFirst.' s/d '.$this->dateLast],
            [' '],
            [
                'No',
                'Jenis Keuangan',
                'Nama Beras',
                'Tanggal',
                'Harga Beli(Rp)',
                'Jumlah Masuk',
                'Kategori',
                'Total Keluar(Rp)',
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->mergeCells('A3:B3');
        $sheet->getStyle('A3')->getFont()->setBold(true);
        $sheet->getStyle('A5:H5')->getFont()->setBold(true);
        $maxRow = $sheet->getHighestRow();
        $sheet->getStyle('A5:H'.$maxRow)->getAlignment()->setHorizontal('center');
    }
}
