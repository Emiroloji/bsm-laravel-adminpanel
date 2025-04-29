{{-- resources/views/deals/proposal.blade.php --}}

<table>
    <tr>
        <th>Ürün veya Hizmet</th>
        <th>Adet</th>
        <th>Ücret</th>
        <th>Toplam</th>
    </tr>

    @foreach ($deal->items ?? [] as $item)
        <tr>
            <td>{{ $item['name'] ?? '' }}</td>
            <td>{{ $item['quantity'] ?? '' }}</td>
            <td>{{ isset($item['unit_price']) ? number_format($item['unit_price'], 2) . ' TL' : '' }}
            </td>
            <td>{{ isset($item['quantity'], $item['unit_price'])
                ? number_format($item['quantity'] * $item['unit_price'], 2) . ' TL'
                : '' }}
            </td>
        </tr>
    @endforeach

    <tr>
        <td colspan="3" style="text-align:right"><strong>+ KDV Toplam</strong></td>
        <td>{{ number_format($deal->vat_total ?? 0, 2) }} TL</td>
    </tr>
</table>
