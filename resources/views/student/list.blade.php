@extends('layouts.master')

@section('title-page') Elèves @endsection

@section('styles-page')
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/vendors.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') !!}">

    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/plugins/forms/form-validation.css') !!}">
@endsection

@section('breadcrumb')
    @include('components.breadcrumbs' , [
        'title_page'    => "Liste des élèves",
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
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Prénom(s)</th>
                                        <th>Date de creation</th>
                                        <th>Arrièré</th>
                                        <th>Par</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
            
                                @foreach ($students as $key => $student)
                                    <tr class="text-center">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $student->matricule }}</td>
                                        <td>{{ $student->lastname }}</td>
                                        <td>{{ $student->firstname }}</td>
                                        <td>{{ $student->created_at->format('d-m-Y') }}</td>
                                        <td>{{ number_format( $student->backward , 0 , '' , ' ').' F CFA' }}</td>
                                        <td>{{ $student->users->lastname.' '.$student->users->firstname }}</td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-primary waves-effect waves-float waves-light" title="Modifier la classe" onclick="editStudent('{{$student->id}}')" data-toggle="modal" data-target="#edit-modal"> <i data-feather='edit'></i> </a>
                                            @if($student->schooling->isEmpty())
                                                <a class="btn btn-icon btn-danger waves-effect waves-float waves-light" title="Supprimer la classe"  onclick="deleteStudent('{{$student->id}}','{{$student->lastname.' '.$student->firstname}}')" data-toggle="modal" data-target="#deleteModal"> <i data-feather='trash-2'></i> </a>
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
        @include('student.modal.modal')

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

    <script src="{!! asset('/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') !!}"></script>
    
@endsection

@section('scripts-page')
    <script src="{!! asset('/app-assets/js/scripts/tables/table-datatables-basic.min.js') !!}"></script>
    @include('student.js.default_functions')
@endsection
