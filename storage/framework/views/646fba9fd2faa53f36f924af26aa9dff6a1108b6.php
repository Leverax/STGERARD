<!-- Modal to add new user -->
<div class="modal fade" id="create-modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <form id="create-form" class="add-new-record modal-content pt-0" method="POST" action="<?php echo e(route('student.store')); ?>">

            <?php echo csrf_field(); ?>

            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter des élèves</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body flex-grow-1">

                <div data-repeater-list="student">
                    <div data-repeater-item>

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="input-group input-group-merge justify-content-end">
                                    <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                        <i data-feather="x" class="mr-25"></i>
                                    </button>
                                </div>
                            </div>

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
                </div>

                <div class="pb-2">
                    <button class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light" type="button" data-repeater-create title="Ajouter un nouveau élève">
                        <i data-feather="plus"></i>
                    </button>
                </div>
                
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary data-submit mr-1"> <i data-feather='plus-circle'></i> Ajouter</button>
                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
            </div>

        </form>

    </div>
</div><?php /**PATH C:\server_xampp\htdocs\csiledesroses\resources\views/student/modal/create.blade.php ENDPATH**/ ?>