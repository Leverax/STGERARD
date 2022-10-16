<!DOCTYPE html>
<html lang="fr">    
<head>
    {{-- <link rel="stylesheet" href="http://localhost/cspyramide/public/app-assets/css/bootstrap.min.css"> --}}
    <title>Reçu</title>
    <style>
        html{
            margin:0px;
        }
        body{
            padding: 10px;
            background: #afdcec !important;
        }
        .row{
            margin: 0px !important;
        }

        .first-table, .first-table th, .first-table td {
            border: 1px solid;
        }
        .first-table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <div>
        <table class="" style="margin: 0px !important; padding:0px !important;">
            <tr>
                <td>
                    <img src="{{public_path('/images/logo.jpg')}}" width="75" />
                </td>
                <td>
                    <p style="text-align:center">
                        <span style="font-size:12px;">REPUBLIQUE DU BENIN</span> <br>
                        <span>------**------</span> <br>
                        <span style="font-size: 14px; font-weight:bold; line-height: 1;">COMPLEXE SCOLAIRE ST GERARD DE VILLIERS</span> <br>
                    </p>
                </td>
                <td>
                    <table class="first-table" style="font-size: 11px;">
                        <tr>
                            <td colspan="2">Reçu N°</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="font-weight-bold">{{$schoolingDetails->number}}</td>
                        </tr>
                        <tr>
                            <td>du</td>
                            <td>{{$schoolingDetails->created_at->format('d/m/Y')}}</td>
                        </tr>
                        <tr style="text-align:center">
                            <td colspan="2">{{$schoolingDetails->schooling->academic_years->name}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="margin-top: -16px !important; text-align:center;">
            <div style="font-size: 11px; font-weight:bold;">Tél : 96 96 12 13 / 61 97 00 97 / 94 27 78 37</div>
            <div style="font-size: 11px;">02 BP 2176, Gbegamey</div>
        </div>

        <div style="margin-top: 5px; ">
            <div><span style="text-decoration: underline; font-size: 14px;">Elève</span> : <strong>{{ $schoolingDetails->schooling->students->lastname.' '.$schoolingDetails->schooling->students->firstname }}</strong> </div>
            <div><span style="text-decoration: underline; font-size: 14px;">Classe</span> : <strong> {{ $schoolingDetails->schooling->classrooms->name }} </strong> </div>
        </div>

        <table style="width:100%; margin-top:10px; border-collapse: collapse;">
            <thead>
                <tr style="font-size: 11px; text-align:center;">
                    <th style="width:3%; background-color:#afdcec; border: 1px solid #505050;">N°</th>
                    <th style="width:37%; background-color:#afdcec; border: 1px solid #505050;">Nature de recette</th>
                    <th style="width:20%; background-color:#afdcec; border: 1px solid #505050;">Montant dû</th>
                    <th style="width:20%; background-color:#afdcec; border: 1px solid #505050;">Montant versé</th>
                    <th style="width:20%; background-color:#afdcec; border: 1px solid #505050;">Reste à payer</th>
                </tr>
            </thead>
            <tbody>
                <tr style="font-size: 12px; text-align:center;">
                    <td style="background-color:#ebebf8; border: 1px solid #505050;">1</td>
                    <td style="background-color:#ebebf8; border: 1px solid #505050;">{{ \App\Helpers\FormatNumberToLetter::convertorNumberToLetterOrder($schoolingDetails->tranche).' versement' }}</td>
                    <td style="background-color:#ebebf8; border: 1px solid #505050;">{{ \App\Helpers\FormatNumberToLetter::formatNumber($schoolingDetails->total) }}</td>
                    <td style="background-color:#ebebf8; border: 1px solid #505050;">{{ \App\Helpers\FormatNumberToLetter::formatNumber($schoolingDetails->amount) }}</td>
                    <td style="background-color:#ebebf8; border: 1px solid #505050;">{{ \App\Helpers\FormatNumberToLetter::formatNumber($schoolingDetails->total - $schoolingDetails->amount) }}</td>
                </tr>
                <tr style="font-size: 12px; text-align:center;">
                    <td style="background-color:#afdcec; border: 1px solid #505050;">2</td>
                    <td style="background-color:#afdcec; border: 1px solid #505050;">Arriéré</td>
                    <td style="background-color:#afdcec; border: 1px solid #505050;">{{ \App\Helpers\FormatNumberToLetter::formatNumber($schoolingDetails->total_backward) }}</td>
                    <td style="background-color:#afdcec; border: 1px solid #505050;">{{ \App\Helpers\FormatNumberToLetter::formatNumber($schoolingDetails->backward) }}</td>
                    <td style="background-color:#afdcec; border: 1px solid #505050;">{{ \App\Helpers\FormatNumberToLetter::formatNumber($schoolingDetails->total_backward - $schoolingDetails->backward) }}</td>
                </tr>
                <tr style="font-size: 12px;">
                    <td colspan="3" style="background-color:#ebebf8; border: 1px solid #505050; border-right:0px !important;">
                        Montant total versé
                    </td>
                    <td colspan="2" style="background-color:#ebebf8; border: 1px solid #505050; font-weight:bold; text-align:right; border-left:0px !important;">
                        {{ \App\Helpers\FormatNumberToLetter::formatNumber($schoolingDetails->amount + $schoolingDetails->backward) }} F CFA
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="font-size: 14px; margin-top:10px; font-style:italic;">
            Arrêté le présent reçu à la somme de <span style="font-weight: bold;"> {{ \App\Helpers\FormatNumberToLetter::convertorNumberToString($schoolingDetails->amount + $schoolingDetails->backward) }} francs</span>
            <div style="margin-left:100px; font-size:12px;"> le {{ \App\Helpers\DayConverter::DayToString( date('w' , strtotime($schoolingDetails->created_at) ) ).' '. $schoolingDetails->created_at->format('d') .' '. \App\Helpers\MonthConverter::MonthToString($schoolingDetails->created_at->format('m')) .' '.$schoolingDetails->created_at->format('Y')}}</div>
        </div>

        <table style="margin-top:10px; width:95%;">
            <tr style="font-size: 12px;">
                <td style="text-align:center">
                    <div style="padding-bottom:50px;">Le Payeur</div>
                    <span style="font-weight:bold; text-decoration: underline;">{{ $schoolingDetails->author }}</span>
                </td>
                <td style="text-align:center">
                    <div style="padding-bottom:50px;">Le Caissier</div>
                    <span style="font-weight:bold; text-decoration: underline; color: #afdcec; ">.</span>
                </td>
                <td>
                    <fieldset style="background: #ebebf8 !important; width: 100%">
                        <legend style="background: #ebebf8 !important;">Point recapitulatif</legend>
                        <table style="width:100%">
                            <tr>
                                <td>Montant total dû : </td>
                                <td style="text-align:right;">{{ \App\Helpers\FormatNumberToLetter::formatNumber( $schoolingDetails->schooling->total + $schoolingDetails->schooling->students->backward + $schoolingDetails->schooling->schooling_details->sum('backward') ) }}</td>
                            </tr>
                            <tr>
                                <td>Montant total payé : </td>
                                <td style="text-align:right;">{{ \App\Helpers\FormatNumberToLetter::formatNumber( $schoolingDetails->amount + $schoolingDetails->schooling->total - $schoolingDetails->total + $schoolingDetails->schooling->backward - ($schoolingDetails->total_backward - $schoolingDetails->backward)) }}</td>
                            </tr>
                            <tr>
                                <td>Solde restant dû : </td>
                                <td style="text-align:right; font-weight:bold;">{{ \App\Helpers\FormatNumberToLetter::formatNumber( $schoolingDetails->total + $schoolingDetails->total_backward - $schoolingDetails->amount - $schoolingDetails->backward ) }}</td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
        </table>

        <table style="margin-top:10px;">
            <tr>
                <td style="width:45%;">
                    <div style="font-size: 12px;">
                        

                        <span>Les échéances de paiement</span><br>
                        <div> - A l'inscription : 1<sup>ière</sup> Tranche </div>
                        <div> - Fin Novembre : 2<sup>ieme</sup> Tranche </div>
                        <div> - Fin Janvier : 3<sup>ieme</sup> Tranche </div>
                        
                        
                    </div>
                </td>
                <td style="width:55%;">
                    <div style="font-size: 10px; font-weight:bold; font-style:italic;">
                        NB : Toute année commencée ou en cours est due en totalité. 
                        Aucun remboursement ou permutation n'est possible.
                    </div>
                </td>
            </tr>
        </table>
        
        <div style="position: absolute; bottom:10px; font-size: 12px; left:10px;">
            <span> Edité le {{$schoolingDetails->created_at->format('d/m/Y')}} à {{$schoolingDetails->created_at->format('H:i')}} </span>
        </div>
        <div style="position: absolute; bottom:10px; font-size: 11px; right:10px;">
            <span> Schoollab 1.8 &copy 2022 INNOV'WEB, <br>email: innovweb3@gmail.com </span>
        </div>
    </div>
</body>
</html>