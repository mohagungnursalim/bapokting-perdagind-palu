<?php


namespace App\Exports;

use App\Models\Pangan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use NumberFormatter;
class DataTableExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings, WithStyles
{

   

    public function query()
    {
        // return Pangan::query();
        
        if (auth()->user()->operator == 'hanyalihat') {

            
            if (request('exportperiode')) {
                return Pangan::query()->where('periode','like', '%' . request('exportperiode') . '%')->orderBy('periode', 'desc');
            } 
            
            if (request('exportkomoditas')) {
                return Pangan::query()->where('komoditas','like', '%' . request('exportkomoditas') . '%')->orderBy('periode', 'desc');
            }

            // return Pangan::query();
            return Pangan::query()->orderBy('periode', 'desc');
                
         } else {
            
                
                if (request('exportperiode')) {
                    return Pangan::query()->where('periode','like', '%' . request('exportperiode') . '%')->where('user_id', auth()->user()->id)->orderBy('periode', 'desc');
                } 
                
                if (request('exportkomoditas')) {
                    return Pangan::query()->where('komoditas','like', '%' . request('exportkomoditas') . '%')->where('user_id', auth()->user()->id)->orderBy('periode', 'desc');
                }

                // return Pangan::query();
                return Pangan::query()->where('user_id', auth()->user()->id)->orderBy('periode', 'desc');
         }
    }                                                                                                                                                                                                                                                                                                                                   

    public function headings(): array
    {
        return [
            'Pasar',   
            'Komoditas',
            'Jenis Barang',
            'Satuan',
            'Harga',
            'Periode',
            'Keterangan'
        ];
    }

    public function map($pangan): array
    {

        
        return [
            $pangan->pasar,
            $pangan->komoditas,
            $pangan->jenis_barang,
            $pangan->satuan,
            number_format($pangan->harga),
            Carbon::parse($pangan->periode)->format('d/M/Y'),
            $pangan->keterangan
        ];
    }

    
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

           
        ];
    }
    
    
}
