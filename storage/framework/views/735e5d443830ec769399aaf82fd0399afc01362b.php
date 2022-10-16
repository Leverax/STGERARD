<!-- Modal to add new broadcast -->
<div class="modal modal-slide-in fade" id="edit-modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog sidebar-sm">

        <form id="edit-form" class="add-new-record modal-content pt-0">
            
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="editModalLabel">Modifier la facture</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div>
                    <div class="form-group">
                        <div class="row">
                            
                            <div class="form-group col-lg-12">
                                <label class="form-label" for="amount">Somme payée</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='edit'></i></span>
                                    </div>
                                    <input type="number" name="amount" id="amount" min="0" oninput="remainder_edit_to_pay()" class="form-control dt-full-name" placeholder="Ex : 5000"/>
                                </div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="form-label" for="rest">Reste à payer</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather='edit'></i></span>
                                    </div>
                                    <input type="number" name="rest" id="rest" class="form-control dt-full-name" disabled="disabled" placeholder="0"/>
                                </div>
                            </div>
                    
                        </div>                        
                    </div>
                </div>                

                <button type="button" id="btn-submit" disabled class="btn btn-primary data-submit mr-1">Modifier</button>
                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
            </div>

        </form>

    </div>
</div><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/schooling/modal/edit.blade.php ENDPATH**/ ?>