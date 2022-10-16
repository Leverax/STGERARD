<table>
    <tr>
        <td colspan="6">STATISTIQUES DU : {{ date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date)) }} </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>INSCRITS</th>
            <th>SOLDE</th>
            <th>NON SOLDE</th>
            <th>ARRIERE</th>
            <th>MONTANT ARRIERE</th>
            <th>MONTANT ENCAISE</th>
      
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$register}}</td>
            <td>{{$sold}}</td>
            <td>{{$unsold}}</td>
            <td>{{$backward ? $backward->count() : 0}}</td>
            <td>{{$backward ? \App\Helpers\FormatNumberToLetter::formatNumber($backward->sum('backward')).' F CFA' : 0}}</td>
            <td>{{\App\Helpers\FormatNumberToLetter::formatNumber($amount).' F CFA'}}</td>

            
        </tr>
    </tbody>
</table>