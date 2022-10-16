@extends('layouts.master')

@section('title-page') Factures @endsection

@section('styles-page')
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/vendors.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') !!}">

    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/plugins/forms/form-validation.css') !!}">

    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/forms/select/select2.min.css') !!}">

    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/plugins/forms/pickers/form-pickadate.min.css') !!}">
    
    <style>
        .select2-selection__arrow{
            display: none;
        }

        #student-content .select2 , #classroom-content .select2{
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            padding-top: 8px;
        }
    </style>
@endsection

@section('breadcrumb')
    @include('components.breadcrumbs' , [
        'title_page'    => "Liste des factures",
    ])
@endsection

@section('content-page')
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="">
                        <div class="card-body p-1">
                            <table class="table" id="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>N°</th>
                                        <th>Année académique</th>
                                        <th>Classe</th>
                                        <th>Elève</th>
                                        <th>Montant payé</th>
                                        <th>Reste</th>
                                        <th>Arriéré</th>
                                        <th>Total</th>
                                        <th>Statut</th>
                                        <th>Date de creation</th>
                                        <th>Par</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
            
                                @foreach ($schoolings as $key => $schooling)
                                    <tr class="text-center">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $schooling->academic_years->name }}</td>
                                        <td>{{ $schooling->classrooms->name }} {{ $schooling->classrooms->indicative ? '('.$schooling->classrooms->indicative.')' : ''  }}</td>
                                        <td>{{ $schooling->students->lastname.' '.$schooling->students->firstname.' ('.$schooling->students->matricule.')' }}</td>
                                        <td>{{ number_format( $schooling->schooling_details->sum('amount') , 0 , '' , ' ').' F CFA'  }}</td>
                                        <td>{{ number_format( $schooling->rest , 0 , '' , ' ').' F CFA'  }}</td>
                                        <td>{{ number_format( $schooling->backward , 0 , '' , ' ').' F CFA'  }}</td>
                                        <td>{{ number_format( $schooling->total , 0 , '' , ' ').' F CFA' }}</td>
                                        <td> 
                                            @if($schooling->rest > 0) 
                                                <span class="badge badge-danger">Reste</span>  
                                            @else 
                                                <span class="badge badge-success">Soldé</span> 
                                            @endif
                                        </td>
                                        <td>{{ $schooling->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $schooling->users->lastname.' '.$schooling->users->firstname }}</td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-warning waves-effect waves-float waves-light" title="Voir Détails" onclick="ShowDetailsSchooling('{{$schooling->id}}')" data-toggle="modal" data-target="#detail-modal"> <i data-feather='eye'></i> </a>
                                            @if(Auth::user()->status == 'admin')
                                                <a href="#" class="btn btn-icon btn-danger waves-effect waves-float waves-light" title="Supprimer la scholarité" onclick="destroySchooling('{{$schooling->id}}')" data-toggle="modal" data-target="#deleteModal"> <i data-feather='trash-2'></i> </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal to add new user -->
        @include('schooling.modal.modal')

    </section>
@endsection

@section('scripts-page-vendor')

    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') !!}"></script>
    
    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/buttons.print.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') !!}"></script>

    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/jszip.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/pdfmake.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/vfs_fonts.js') !!}"></script> 
    <script src="{!! asset('/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') !!}"></script>

    <script src="{!! asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>

    <script src="{!! asset('/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') !!}"></script>

    <script src="{!! asset('/app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
    
@endsection

@section('scripts-page')
    <script src="{!! asset('/app-assets/js/scripts/tables/table-datatables-basic.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/js/scripts/forms/form-select2.min.js') !!}"></script>
    
    <script src="{!! asset('/app-assets/js/scripts/forms/pickers/form-pickers.min.js') !!}"></script>

    @include('schooling.js.default_functions')
@endsection
