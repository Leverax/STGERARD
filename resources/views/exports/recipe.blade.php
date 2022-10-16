<table>
    <tr>
        <td colspan="6">AUTRES RECETTES DU : {{ date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date)) }} </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>Motif</th>
            <th>Montant</th>
            <th>Année Académique</th>
            <th>Date de creation</th>
            <th>Par</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recipes as $key => $recipe)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$recipe->motif}}</td>
                <td>{{\App\Helpers\FormatNumberToLetter::formatNumber($recipe->amount).' F CFA'}}</td>
                <td>{{$recipe->academic_years->name}}</td>
                <td>{{$recipe->created_at}}</td>
                <td>{{$recipe->users->lastname.' '.$recipe->users->firstname}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td colspan="2">MONTANT TOTAL</td>
            <td>{{\App\Helpers\FormatNumberToLetter::formatNumber($recipes->sum('amount')).' F CFA'}}</td>
            <td colspan="3"></td>
        </tr>

    </tbody>
</table>