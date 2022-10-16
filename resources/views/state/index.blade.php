
@extends('layouts.master')

@section('title-page') Etats @endsection

@section('styles-page')
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/vendors.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/vendors/css/forms/select/select2.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/app-assets/css/plugins/forms/pickers/form-pickadate.min.css') !!}">
    <style>
        .select2-selection__arrow{
            display: none;
        }
    </style>
@endsection

@section('content-page')
    
    <div class="row pb-1">
        <div class="col-12 text-center">
            <h3> Récapitulatif </h3>
            <select name="academic_year" id="academic_year" class="select2 form-control" oninput="getState()">
                @foreach($academic_years as $key => $academic_year)
                    <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- Line Chart Card -->
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" id="n_register">{{ $n_register }}</h2>
                        <p class="card-text">Inscrits</p>
                    </div>
                    <div class="avatar bg-light-primary p-50">
                        <div class="avatar-content">
                            <i data-feather="user-check" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" id="n_sold"> {{ $n_sold }}</h2>
                        <p class="card-text">Soldé</p>
                    </div>
                    <div class="avatar bg-light-success p-50">
                        <div class="avatar-content">
                            <i data-feather="check" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" id="n_unsold">{{ $n_unsold }}</h2>
                        <p class="card-text">Non soldé</p>
                    </div>
                    <div class="avatar bg-light-danger p-50">
                        <div class="avatar-content">
                            <i data-feather="slash" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" id="backward_count">{{ $backward->count() }}</h2>
                        <p class="card-text">Arriéré</p>
                    </div>
                    <div class="avatar bg-light-primary p-50">
                        <div class="avatar-content">
                            <i data-feather='corner-up-left' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" style="color:rgb(198, 0, 0) !important;" id="backward_sum">{{ $backward->sum('backward').' F CFA' }}</h2>
                        <p class="card-text" style="color:rgb(198, 0, 0) !important;">Arriéré</p>
                    </div>
                    <div class="avatar bg-light-primary p-50" style="color:rgb(198, 0, 0) !important;">
                        <div class="avatar-content">
                            <i data-feather='corner-up-left' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" id="amount_today">{{ \App\Helpers\FormatNumberToLetter::formatNumber($amount[0]) }} F CFA</h2>
                        <p class="card-text">Montant encaissé ajourd'hui</p>
                    </div>
                    <div class="avatar bg-light-info p-50">
                        <div class="avatar-content">
                            <i data-feather='check-circle' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header align-items-start">
                    <div>
                        <h2 class="font-weight-bolder" style="color: rgb(8, 216, 8) !important;" id="amount_total">{{ \App\Helpers\FormatNumberToLetter::formatNumber($amount[1]) }} F CFA</h2>
                        <p class="card-text" style="color: rgb(8, 216, 8) !important;">Montant total encaissé</p>
                    </div>
                    <div class="avatar bg-light-success p-50" style="color: rgb(8, 216, 8) !important;">
                        <div class="avatar-content">
                            <i data-feather='users' class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      
        
    </div>

    <div class="row">
        <div class="col-lg-4 form-group">
            <label for="start_date">Du</label>
            <input type="text" id="start_date" oninput="exportExcel()" name="start_date" class="form-control flatpickr-basic bg-white" placeholder="YYYY-MM-DD" />
        </div>
        <div class="col-lg-4 form-group">
            <label for="end_date">Au</label>
            <input type="text" id="end_date" oninput="exportExcel()" name="end_date" class="form-control flatpickr-basic bg-white" placeholder="YYYY-MM-DD" />
        </div>
        <div class="col-lg-4 form-group">
            <a id="btn_generate" class="btn btn-primary" style="position: absolute; bottom:0px; width:90%;"><i data-feather='download'></i> Exportation</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 form-group">
            <label for="start_date">Année Academique</label>
            <select name="academic_year_sort" id="academic_year_sort" class="form-control select2" oninput="exportExcelByYearAndClass()">
                @foreach ($academic_years as $academic_year)
                    <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 form-group">
            <label for="end_date">Classe</label>
            <select name="classroom_sort[]" id="classroom_sort" class="form-control select2" multiple oninput="exportExcelByYearAndClass()">
                @foreach ($classrooms as $classroom)
                    <option value="{{$classroom->id}}">{{$classroom->name}} {{ $classroom->indicative ? ' ('.$classroom->indicative.')' : ''}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 form-group">
            <a id="btn_generate_by_sort" class="btn btn-primary" style="position: absolute; bottom:0px; width:90%;"><i data-feather='download'></i> Exportation</a>
        </div>
    </div>
    <!--/ Line Chart Card -->
@endsection

@section('scripts-page-vendor')
    <script src="{!! asset('/app-assets/vendors/js/charts/chart.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/vendors/js/charts/apexcharts.min.js') !!}"></script>

    <script src="{!! asset('/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') !!}"></script>

    <script src="{!! asset('/app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
@endsection
@section('scripts-page')
    <script src="{!! asset('/app-assets/js/scripts/forms/form-select2.min.js') !!}"></script>
    <script src="{!! asset('/app-assets/js/scripts/forms/pickers/form-pickers.min.js') !!}"></script>

    @include('state.js.default_functions')
@endsection
