<table>
    <tr>
        @isset($schoolings_recap)
            <td colspan="11">RECAPITULATIF TOTAL DU : {{ date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date)) }} </td>
        @endisset

        @isset($schoolings_sold)
            <td colspan="11">RECAPITULATIF DES SOLDES DU : {{ date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date)) }} </td>
        @endisset

        @isset($schoolings_unsold)
            <td colspan="11">RECAPITULATIF DES NON SOLDES DU : {{ date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date)) }} </td>
        @endisset
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>N°</th>
            {{-- <th>Année académique</th> --}}
            <th>Classe</th>
            <th>Elève</th>
            <th>Montant payé</th>
            <th>Arriéré payé</th>
            <th>Arriéré restant</th>
            <th>Reste</th>
            <th>Total dû</th>
            <th>Statut</th>
            <th>Date de creation</th>
            <th>Par</th>
        </tr>
    </thead>
    <tbody>

        @php 
            $amount         = 0;
            $backward       = 0;
            $backward_rest  = 0;
            $rest           = 0;
            $total          = 0;
        @endphp

        @isset($schoolings_recap)
            
            @foreach($schoolings_recap as $key => $schooling)
                <tr>
                    <td>{{ ++$key }}</td>
                    {{-- <td>{{ $schooling->academic_years->name }}</td> --}}
                    <td>{{ $schooling->classrooms->name }}</td>
                    <td>{{ $schooling->students->lastname.' '.$schooling->students->firstname.' ('.$schooling->students->matricule.')' }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('amount') ).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('backward')).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->backward - $schooling->schooling_details->sum('backward')).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->rest).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->total + $schooling->backward).' F CFA' }}</td>
                    <td> 
                        @if($schooling->rest > 0) 
                            <span class="badge badge-danger">Reste</span>  
                        @else 
                            <span class="badge badge-success">Soldé</span> 
                        @endif
                    </td>
                    <td>{{ $schooling->created_at->format('d-m-Y') }}</td>
                    <td>{{ $schooling->users->lastname.' '.$schooling->users->firstname }}</td>
                </tr>

                @php 
                    $amount         = $amount + $schooling->schooling_details->sum('amount') ;
                    $backward       = $backward + $schooling->schooling_details->sum('backward');
                    $backward_rest  = $backward_rest + ($schooling->backward - $schooling->schooling_details->sum('backward'));
                    $rest           = $rest + $schooling->rest;
                    $total          = $total + $schooling->total + $schooling->backward;
                @endphp

            @endforeach

                {{-- <tr>
                    <td colspan="11"></td>
                </tr>
                <tr>
                    <td colspan="3">TOTAL</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($amount).' F CFA' }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($backward).' F CFA'}}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($backward_rest).' F CFA'}}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($rest).' F CFA' }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($total).' F CFA' }}</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="11"></td>
                </tr>
                <tr>
                    <td colspan="3">MONTANT TOTAL PAYE</td>
                    <td colspan="2">{{ \App\Helpers\FormatNumberToLetter::formatNumber($amount + $backward).' F CFA' }}</td>
                    <td colspan="5"></td>
                </tr> --}}

        @endisset

        @isset($schoolings_sold)
            @foreach($schoolings_sold as $key => $schooling)
                <tr>
                    <td>{{ ++$key }}</td>
                    {{-- <td>{{ $schooling->academic_years->name }}</td> --}}
                    <td>{{ $schooling->classrooms->name }}</td>
                    <td>{{ $schooling->students->lastname.' '.$schooling->students->firstname.' ('.$schooling->students->matricule.')' }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('amount') ).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('backward')).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->backward - $schooling->schooling_details->sum('backward')).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->rest).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->total + $schooling->backward).' F CFA' }}</td>
                    <td> 
                        @if($schooling->rest > 0) 
                            <span class="badge badge-danger">Reste</span>  
                        @else 
                            <span class="badge badge-success">Soldé</span> 
                        @endif
                    </td>
                    <td>{{ $schooling->created_at->format('d-m-Y') }}</td>
                    <td>{{ $schooling->users->lastname.' '.$schooling->users->firstname }}</td>
                </tr>

                @php 
                    $amount         = $amount + $schooling->schooling_details->sum('amount') ;
                    $backward       = $backward + $schooling->schooling_details->sum('backward');
                    $backward_rest  = $backward_rest + ($schooling->backward - $schooling->schooling_details->sum('backward'));
                    $rest           = $rest + $schooling->rest;
                    $total          = $total + $schooling->total + $schooling->backward;
                @endphp

            @endforeach

            {{-- <tr>
                <td colspan="11"></td>
            </tr>
            <tr>
                <td colspan="3">TOTAL</td>
                <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($amount).' F CFA' }}</td>
                <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($backward).' F CFA'}}</td>
                <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($backward_rest).' F CFA'}}</td>
                <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($rest).' F CFA' }}</td>
                <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($total).' F CFA' }}</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="11"></td>
            </tr>
            <tr>
                <td colspan="3">MONTANT TOTAL PAYE</td>
                <td colspan="2">{{ \App\Helpers\FormatNumberToLetter::formatNumber($amount + $backward).' F CFA' }}</td>
                <td colspan="5"></td>
            </tr> --}}

        @endisset

        @isset($schoolings_unsold)
            @foreach($schoolings_unsold as $key => $schooling)
                <tr>
                    <td>{{ ++$key }}</td>
                    {{-- <td>{{ $schooling->academic_years->name }}</td> --}}
                    <td>{{ $schooling->classrooms->name }}</td>
                    <td>{{ $schooling->students->lastname.' '.$schooling->students->firstname.' ('.$schooling->students->matricule.')' }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('amount') ).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->schooling_details->sum('backward')).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->backward - $schooling->schooling_details->sum('backward')).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->rest).' F CFA'  }}</td>
                    <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($schooling->total + $schooling->backward).' F CFA' }}</td>
                    <td> 
                        @if($schooling->rest > 0) 
                            <span class="badge badge-danger">Reste</span>  
                        @else 
                            <span class="badge badge-success">Soldé</span> 
                        @endif
                    </td>
                    <td>{{ $schooling->created_at->format('d-m-Y') }}</td>
                    <td>{{ $schooling->users->lastname.' '.$schooling->users->firstname }}</td>
                </tr>

                @php 
                    $amount         = $amount + $schooling->schooling_details->sum('amount') ;
                    $backward       = $backward + $schooling->schooling_details->sum('backward');
                    $backward_rest  = $backward_rest + ($schooling->backward - $schooling->schooling_details->sum('backward'));
                    $rest           = $rest + $schooling->rest;
                    $total          = $total + $schooling->total + $schooling->backward;
                @endphp
                
            @endforeach

            {{-- <tr>
                <td colspan="11"></td>
            </tr>
            <tr>
                <td colspan="3">TOTAL</td>
                <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($amount).' F CFA' }}</td>
                <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($backward).' F CFA'}}</td>
                <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($backward_rest).' F CFA'}}</td>
                <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($rest).' F CFA' }}</td>
                <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($total).' F CFA' }}</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="11"></td>
            </tr>
            <tr>
                <td colspan="3">MONTANT TOTAL PAYE</td>
                <td colspan="2">{{ \App\Helpers\FormatNumberToLetter::formatNumber($amount + $backward).' F CFA' }}</td>
                <td colspan="5"></td>
            </tr> --}}

        @endisset
            

        <tr>
            <td colspan="11"></td>
        </tr>
        <tr>
            <td colspan="3">TOTAL</td>
            <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($amount).' F CFA' }}</td>
            <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($backward).' F CFA'}}</td>
            <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($backward_rest).' F CFA'}}</td>
            <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($rest).' F CFA' }}</td>
            <td>{{ \App\Helpers\FormatNumberToLetter::formatNumber($total).' F CFA' }}</td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>
        <tr>
            <td colspan="3">MONTANT TOTAL PAYE</td>
            <td colspan="2">{{ \App\Helpers\FormatNumberToLetter::formatNumber($amount + $backward).' F CFA' }}</td>
            <td colspan="5"></td>
        </tr>



    </tbody>
</table>