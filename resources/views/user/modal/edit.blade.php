<!-- Modal to edit user -->
<div class="modal modal-slide-in fade" id="edit-modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog sidebar-sm">

        <form id="edit-form" class="add-new-record modal-content pt-0" method="POST" action="{{ route('utilisateur.store') }}">

            @csrf

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Modifier un utilisateur</h5>
            </div>
            <div class="modal-body flex-grow-1">

                <div class="form-group">
                    <label class="form-label" for="lastname">Nom</label>
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                        </div>
                        <input type="text" name="lastname" id="lastname" class="form-control dt-full-name" placeholder="Entrer le nom ici" aria-label="John Doe"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="firstname">Prénom</label>
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                        </div>
                        <input type="text" name="firstname" id="firstname" class="form-control dt-full-name" placeholder="Enter le prénom ici" aria-label="John Doe"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="basic-icon-default-email">Email</label>
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather='mail'></i></span>
                        </div>
                        <input type="email" name="email" id="email" class="form-control dt-full-name" placeholder="caseco@example.com" aria-label="caseco@example.com"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="basic-icon-default-email">Statut</label>
                    <div class="input-group input-group-merge">
                        <select name="status" id="status" class="custom-select">
                            <option value="" selected disabled>Selectionnez le status</option>
                            <option value="admin">Administrateur</option>
                            <option value="user">Utilisateur Simple</option>
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary data-submit mr-1">Ajouter</button>
                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Annuler</button>
            </div>
            
        </form>

    </div>
</div>