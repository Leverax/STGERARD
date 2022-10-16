@extends('layouts.master')

@section('title-page') Classe @endsection

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
        'title_page'    => "Liste des classes",
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
                                    <th>Nom</th>
                                    
                                    <th>Scolarité</th>
                                    <th>Date de creation</th>
                                    <th>Par</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
            
                                @foreach ($classrooms as $key => $classroom)
                                    <tr class="text-center">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $classroom->name }}</td>
                                        <td>{{ number_format( $classroom->schoolings , 0 , '' , ' ').' F CFA' }}</td>
                                        <td>{{ $classroom->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $classroom->users->lastname.' '.$classroom->users->firstname }}</td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-primary waves-effect waves-float waves-light" title="Modifier la classe" onclick="editClassroom('{{$classroom->id}}')" data-toggle="modal" data-target="#edit-modal"> <i data-feather='edit'></i> </a>
                                           
                                            @if($classroom->schooling->isEmpty())
                                                <a class="btn btn-icon btn-danger waves-effect waves-float waves-light" title="Supprimer la classe"  onclick="deleteClassroom('{{$classroom->id}}','{{$classroom->name}}')" data-toggle="modal" data-target="#deleteModal"> <i data-feather='trash-2'></i> </a>
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
        @include('class.modal.modal')

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
    
@endsection

@section('scripts-page')
    <script src="{!! asset('/app-assets/js/scripts/tables/table-datatables-basic.min.js') !!}"></script>
    @include('class.js.default_functions')
@endsection
