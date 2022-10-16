<!-- Modal to add new user -->
<div class="modal fade" id="create-modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <form id="create-form" class="add-new-record modal-content pt-0" method="POST" action="{{ route('schooling.store') }}">

            @csrf

            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Enregistrer une facture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body flex-grow-1">

                <div class="row">
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="academic_year">Année académique</label>
                        {{-- <select class="select2 form-control" disabled>
                            <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                        </select>
                        <select class="form-control" hidden name="academic_year" id="academic_year">
                            <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                        </select> --}}
                        <select class="select2 form-control" name="academic_year" id="academic_year" onchange="remainder_to_pay(); ajax_search_student();">
                            @foreach($academic_years as $key => $academic_year)
                                <option value="{{$academic_year->id}}">{{$academic_year->name}}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-group col-lg-6" id="student-content">
                        <label class="form-label" for="student">Elève</label>
                        <select class="select2 form-control" name="student" onchange="remainder_to_pay(); ajax_search_classroom();" id="student">
                            {{-- <option selected disabled>Selectionner l'élève</option>
                            @foreach($students as $student)
                                <option value="{{$student->id}}">{{ $student->indicative ? $student->indicative.' : ' : '' }} {{$student->lastname.' '.$student->firstname.' ('.$student->matricule.' )'}}</option>
                            @endforeach --}}
                        </select>
                    </div>
    
                    <div class="form-group col-lg-6" id="classroom-content">
                        <label class="form-label" for="classroom">Classe</label>
                        <select class="form-control" name="classroom" onchange="remainder_to_pay()" id="classroom">
                            {{-- <option selected disabled>Selectionner une classe</option>
                            @foreach($classrooms as $classroom)
                                <option value="{{$classroom->id}}">{{$classroom->name}} {{$classroom->indicative ? ' ('.$classroom->indicative.')' : ''}}</option>
                            @endforeach --}}
                        </select>
                    </div>
    
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="backward">Arriéré</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='edit'></i></span>
                            </div>
                            <input type="number" name="backward" id="backward" oninput="remainder_to_pay()" class="form-control dt-full-name" disabled="disabled" placeholder="0"/>
                        </div>
                    </div>
    
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="amount">Somme payée</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='edit'></i></span>
                            </div>
                            <input type="number" name="amount" id="amount" min="0" oninput="remainder_to_pay()" class="form-control dt-full-name" placeholder="Ex : 5000"/>
                        </div>
                    </div>
    
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="rest">Reste à payer</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='edit'></i></span>
                            </div>
                            <input type="number" name="rest" id="rest" class="form-control dt-full-name" disabled="disabled" placeholder="0"/>
                        </div>
                    </div>
    
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="author">Qui a payé ?</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='user'></i></span>
                            </div>
                            <input type="text" name="author" id="author" class="form-control dt-full-name" placeholder="Ex : Mère"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h6>Restes par Année Académique</h6>
                        <ol class="text-danger" id="recap-rest">
                        </ol>
                    </div>
                </div>
                
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary data-submit mr-1" disabled id="btn-save"> <i data-feather='plus-circle'></i> Ajouter</button>
                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
            </div>

        </form>

    </div>
</div>