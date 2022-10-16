<!-- Modal to edit user -->
<div class="modal fade" id="edit-modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <form id="edit-form" class="add-new-record modal-content pt-0" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Modifier une année académique</h5>
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
                            <input type="text" name="name" id="name" class="form-control dt-full-name" placeholder="Ex : 2021 - 2022" aria-label="6 ème"/>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary data-submit mr-1"> <i data-feather='edit-3'></i> Modifier</button>
                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
            </div>
            
        </form>

    </div>
</div>