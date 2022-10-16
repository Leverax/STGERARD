<!-- Modal to add new user -->
<div class="modal fade" id="create-modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <form id="create-form" class="add-new-record modal-content pt-0" method="POST" action="{{ route('utilisateur.store') }}">

            @csrf

            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body flex-grow-1">

                <div class="row">
                    <div class="col-12 text-center mb-2">
                        <div class="avatar mr-1 bg-white">
                            <img src="{!! asset('images/avatar.png') !!}" alt="" width="120" height="120">
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="lastname">Nom</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                            </div>
                            <input type="text" name="lastname" id="lastname" class="form-control dt-full-name" placeholder="Entrer le nom ici" aria-label="John Doe"/>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="firstname">Prénom</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                            </div>
                            <input type="text" name="firstname" id="firstname" class="form-control dt-full-name" placeholder="Enter le prénom ici" aria-label="John Doe"/>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i data-feather='mail'></i></span>
                            </div>
                            <input type="email" name="email" id="email" class="form-control dt-full-name" placeholder="caseco@example.com" aria-label="caseco@example.com"/>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="form-label" for="basic-icon-default-email">Statut</label>
                        <div class="input-group input-group-merge">
                            <select name="status" id="status" class="custom-select">
                                <option value="" selected disabled>Selectionnez le status</option>
                                <option value="admin">Administrateur</option>
                                <option value="user">Utilisateur Simple</option>
                            </select>
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