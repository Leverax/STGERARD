@extends('layouts.master')

@section('title-page') Années académiques @endsection

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
        'title_page'    => "Années académiques",
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
                                    <th>Active</th>
                                    <th>Année académique</th>
                                    <th>Date de creation</th>
                                    <th>Par</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
            
                                @foreach ($academic_years as $key => $academic_year)
                                    <tr class="text-center">
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            <div class="demo-inline-spacing">
                                                <div class="custom-control custom-switch custom-switch-success mx-auto">
                                                    <input type="checkbox" class="custom-control-input" id="{{'enable_year_'.$key}}" onclick="state({{$academic_year->id}})" @if($academic_year->isActive) checked @endif />
                                                    <label class="custom-control-label" for="{{'enable_year_'.$key}}" title="{{ $academic_year->isActive ? "Désactiver l'année" : "Activer l'année"}}">
                                                        <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $academic_year->name }}</td>
                                        <td>{{ $academic_year->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $academic_year->users->lastname.' '.$academic_year->users->firstname }}</td>
                                        <td>
                                            
                                            <a href="#" class="btn btn-icon btn-primary waves-effect waves-float waves-light" title="Modifier la classe" onclick="editAcademic_year('{{$academic_year->id}}')" data-toggle="modal" data-target="#edit-modal"> <i data-feather='edit'></i> </a>
                                            @if($academic_year->schooling->isEmpty())
                                                <a class="btn btn-icon btn-danger waves-effect waves-float waves-light" title="Supprimer la classe"  onclick="deleteAcademic_year('{{$academic_year->id}}','{{$academic_year->name}}')" data-toggle="modal" data-target="#deleteModal"> <i data-feather='trash-2'></i> </a>
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
        @include('academic_year.modal.modal')

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
    @include('academic_year.js.default_functions')
@endsection
