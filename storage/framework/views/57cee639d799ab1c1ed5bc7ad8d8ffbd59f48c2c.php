<!-- Modal to edit user -->
<div class="modal fade" id="edit-modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <form id="edit-form" class="add-new-record modal-content pt-0" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Modifier une classe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body flex-grow-1">

                <div class="row">
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="lastname">Nom</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="edit"></i></span>
                            </div>
                            <input type="text" name="lastname" id="lastname" class="form-control dt-full-name" placeholder="Entrer le nom ici"/>
                        </div>
                    </div>
    
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="firstname">Prénom(s)</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='edit'></i></span>
                            </div>
                            <input type="text" name="firstname" id="firstname" class="form-control dt-full-name" placeholder="Enter le prénom ici"/>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label class="form-label" for="indicative">Indicatif</label>
                        <div class="input-group input-group-merge">
                            
                            
                            <select name="indicative" id="indicative" class="form-control dt-full-name">
                                <option value="NOUVEAU">NOUVEAU</option>
                                <option value="ANCIEN">ANCIEN</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-6">
                        <label class="form-label" for="backward">Arriéré </label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='edit'></i></span>
                            </div>
                            <input type="number" name="backward" id="backward" class="form-control dt-full-name" placeholder="Ex : 5000"/>
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
</div><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/student/modal/edit.blade.php ENDPATH**/ ?>