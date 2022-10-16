@extends('layouts.master')

@section('title-page') Utilisateur @endsection

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
        'title_page'    => "Liste des utilisateurs",
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
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                    <th>Etat</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
            
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ $user->firstname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->status }}</td>
                                        @if($user->id != Auth::id())
                                            <td>
                                                <div class="demo-inline-spacing">
                                                    <div class="custom-control custom-switch custom-switch-success">
                                                        <input type="checkbox" class="custom-control-input" id="{{'enable_user_'.$key}}" onclick="state({{$user->id}})" @if($user->isActive) checked @endif />
                                                        <label class="custom-control-label" for="{{'enable_user_'.$key}}" title="{{ $user->isActive ? "Désactiver l'utilisateur" : "Activer l'utilisateur"}}">
                                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <a href="#" class="btn btn-icon btn-primary waves-effect waves-float waves-light" title="Modifier l'utilisateur" onclick="editUser('{{$user->id}}')" data-toggle="modal" data-target="#edit-modal"> <i data-feather='edit'></i> </a> --}}
                                                @if($user->classrooms->isEmpty() && $user->students->isEmpty() && $user->schooling->isEmpty())
                                                    <a class="btn btn-icon btn-danger waves-effect waves-float waves-light" title="Supprimer l'utilisateur"  onclick="deleteUsers('{{$user->id}}','{{$user->firstname}} {{$user->lastname}}')" data-toggle="modal" data-target="#deleteModal"> <i data-feather='trash-2'></i> </a>
                                                @else
                                                    <i data-feather='x' class="text-danger"></i>
                                                @endif
                                            </td>
                                        @else
                                            <td class="text-danger"><i data-feather='x'></i></td>
                                            <td class="text-danger"><i data-feather='x'></i></td>
                                        @endif
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
        @include('user.modal.modal')

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
    @include('user.js.default_functions')
@endsection
