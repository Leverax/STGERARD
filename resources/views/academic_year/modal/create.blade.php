<!-- Modal to add new user -->
<div class="modal fade" id="create-modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <form id="create-form" class="add-new-record modal-content pt-0" method="POST" action="{{ route('academic_year.store') }}">

            @csrf

            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une année académique</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body flex-grow-1">

                <div class="row">
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="name">Nom</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='calendar'></i></span>
                            </div>
                            <input type="text" name="name" id="name" class="form-control dt-full-name" placeholder="Ex : 2021 - 2022"/>
                        </div>
                    </div>
                </div>
            
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary data-submit mr-1"> <i data-feather='plus-circle'></i> Ajouter</button>
                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
            </div>

        </form>

    </div>
</div>