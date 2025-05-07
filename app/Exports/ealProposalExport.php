<?php
namespace App\Exports;

use App\Models\Deal;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DealProposalExport implements FromArray, WithEvents
{
    protected Deal $deal;

    public function __construct(Deal $deal)
    {
        $this->deal = $deal;
    }

    public function array(): array
    {
        $rows = [];

        $rows[] = ['Ürün veya Hizmet','Adet','Birim Fiyat','Toplam'];

        foreach ($this->deal->items as $item) {
            $rows[] = [
                $item->name,
                $item->quantity,
                number_format($item->unit_price,2).' TL',
                number_format($item->quantity * $item->unit_price,2).' TL',
            ];
        }

        $rows[] = [];
        $rows[] = ['+ KDV Toplam','','', number_format($this->deal->vat_total,2).' TL'];
        $rows[] = [];
        $rows[] = ['Ödeme Bilgileri:'];
        $rows[] = ['Banka', $this->deal->bank_name];
        $rows[] = ['IBAN', $this->deal->iban];
        $rows[] = ['E-mail', $this->deal->contact_email];
        $rows[] = [];
        $rows[] = ['Notlar:', $this->deal->notes];

        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                // Kolon genişlikleri
                foreach (['A','B','C','D'] as $col) {

                    $sheet->getColumnDimension($col)->setWidth(20);
                }
                // Başlık stil
                $sheet->getStyle('A1:D1')->getFont()->setBold(true);
            },
        ];
    }
}
// emircan uysal