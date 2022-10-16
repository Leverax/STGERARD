<table>
    <tr>
        <td colspan="6">DEPENSES DU : {{ date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date)) }} </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>Motif</th>
            <th>Cycle</th>
            <th>Montant</th>
            <th>Année Académique</th>
            <th>Bénéficiaire</th>
            <th>Date de creation</th>
            <th>Par</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expenses as $key => $expense)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$expense->motif}}</td>
                <td>{{$expense->cycle}}</td>
                <td>{{\App\Helpers\FormatNumberToLetter::formatNumber($expense->amount).' F CFA'}}</td>
                <td>{{$expense->academic_years->name}}</td>
                <td>{{$expense->receiver}}</td>
                <td>{{$expense->created_at}}</td>
                <td>{{$expense->users->lastname.' '.$expense->users->firstname}}</td>
            </tr>
        @endforeach

            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="3">MONTANT TOTAL</td>
                <td>{{\App\Helpers\FormatNumberToLetter::formatNumber($expenses->sum('amount')).' F CFA'}}</td>
                <td colspan="4"></td>
            </tr>
    </tbody>
</table>