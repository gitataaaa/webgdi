<table>
    <thead>
        <tr>
            <th><strong>Donatur</strong></th>
            <th><strong>Tanggal</strong></th>
            <th><strong>Nominal</strong></th>
            <th><strong>Program</strong></th>
        </tr>    
    </thead>
    <tbody>
        @php 
            $total = 0;
        @endphp
        @if(@$result)
            @foreach($result as $dt)
            @php 
                $total += $dt->nominal;
            @endphp
                <tr>
                    <td>{{ $dt->donatur }}</td>
                    <td>{{ $dt->tanggal }}</td>
                    <td align="right">{{ number_format($dt->nominal) }}</td>
                    <td>{{ $dt->title }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th colspan="2"><strong>Total</strong></th>
            <th align="right"><strong>{{ number_format($total) }}</strong></th>
            <th></th>
        </tr>
    </tfoot>
</table>