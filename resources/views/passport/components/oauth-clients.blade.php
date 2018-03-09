@section('oauth-clients')
<div class="col">
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span>
                    OAuth Clients
                </span>

                <a class="btn-link" style="cursor:pointer;" tabindex="-1" @click="showCreateClientForm">
                    Create New Client
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0" v-if="clients.length > 0">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Secret</th>
                        <th colspan="2">Action</th>
                        <!--<th></th>-->
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(client, key) in clients" :key="key">
                        <!-- ID -->
                        <td style="vertical-align: middle;">
                        @{{ client.id }}
                        </td>

                        <!-- Name -->
                        <td style="vertical-align: middle;">
                        @{{ client.name }}
                        </td>

                        <!-- Secret -->
                        <td style="vertical-align: middle;">
                            <code>@{{ client.secret }}</code>
                        </td>

                        <!-- Edit Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link" tabindex="-1" @click="edit(client)">
                                Edit
                            </a>
                        </td>

                        <!-- Delete Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link text-danger" @click="destroy(client)">
                                Delete
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
             <!-- No Tokens Notice -->
            <p class="mb-0" v-if="clients.length === 0">
                You have not created any personal access tokens.
            </p>
        </div>
    </div>

    <!-- Create Client Modal -->
    <div class="modal fade" id="modal-create-client" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Create Client
                    </h4>

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <!-- Form Errors -->
                    <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                        <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                        <br>
                        <ul>
                            <li v-for="error in createForm.errors">
                                @{{ error }}
                            </li>
                        </ul>
                    </div>

                    <!-- Create Client Form -->
                    <form role="form">
                        <!-- Name -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name</label>

                            <div class="col-md-9">
                                <input id="create-client-name" type="text" class="form-control"
                                                            @keyup.enter="store" v-model="createForm.name">

                                <span class="form-text text-muted">
                                    Something your users will recognize and trust.
                                </span>
                            </div>
                        </div>

                        <!-- Redirect URL -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Redirect URL</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" name="redirect"
                                                @keyup.enter="store" v-model="createForm.redirect">

                                <span class="form-text text-muted">
                                    Your application's authorization callback URL.
                                </span>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" @click="store">
                        Create
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!-- Edit Client Modal -->
    <div class="modal fade" id="modal-edit-client" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Edit Client
                    </h4>

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <!-- Form Errors -->
                    <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                        <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                        <br>
                        <ul>
                            <li v-for="error in editForm.errors">
                                @{{ error }}
                            </li>
                        </ul>
                    </div>

                    <!-- Edit Client Form -->
                    <form role="form">
                        <!-- Name -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name</label>

                            <div class="col-md-9">
                                <input id="edit-client-name" type="text" class="form-control"
                                                            @keyup.enter="update" v-model="editForm.name">

                                <span class="form-text text-muted">
                                    Something your users will recognize and trust.
                                </span>
                            </div>
                        </div>

                        <!-- Redirect URL -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Redirect URL</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" name="redirect"
                                                @keyup.enter="update" v-model="editForm.redirect">

                                <span class="form-text text-muted">
                                    Your application's authorization callback URL.
                                </span>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" @click="update">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div> 
</div>
@stop


<script>
    window.url = '{!! env("APP_URL") !!}';
    Vue.component('ripple-oauth-clients', {
        template: `@yield("oauth-clients")`,
        data(){
            return {
                clients: [],

                createForm: {
                    errors: [],
                    name: '',
                    redirect: ''
                },

                editForm: {
                    errors: [],
                    name: '',
                    redirect: ''
                }
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getClients();
            },



            /**
             * Get all of the OAuth clients for the user.
             */
            getClients() {
                axios.get(window.url+'/oauth/clients')
                        .then(response => {
                            this.clients = response.data;
                        });
            },

           /**
            * Show the form for creating new clients.
            */
            showCreateClientForm() {
            $("#modal-create-client").modal("show");
            },


           /**
            * Create a new OAuth client for the user.
            */
            store() {
                this.persistClient(
                    "post",
                    window.url+"/oauth/clients",
                    this.createForm,
                    "#modal-create-client"
                );
            },

           /**
            * Edit the given client.
            */
            edit(client) {
                this.editForm.id = client.id;
                this.editForm.name = client.name;
                this.editForm.redirect = client.redirect; 
                $("#modal-edit-client").modal("show");
            },

           /**
            * Update the client being edited.
            */
            update() {
                this.persistClient(
                    "put",
                    window.url+"/oauth/clients/" + this.editForm.id,
                    this.editForm,
                    "#modal-edit-client"
                );
            },


           /**
            * Persist the client to storage using the given form.
            */
            persistClient(method, uri, form, modal) {
            form.errors = [];

            axios[method](uri, form)
                .then(response => {
                this.getClients();

                form.name = "";
                form.redirect = "";
                form.errors = [];

                $(modal).modal("hide");
                })
                .catch(error => {
                if (typeof error.response.data === "object") {
                    form.errors = _.flatten(_.toArray(error.response.data.errors));
                } else {
                    form.errors = ["Something went wrong. Please try again."];
                }
                });
            },


           /**
            * Destroy the given client.
            */
            destroy(client) {
                axios.delete(window.url+"/oauth/clients/" + client.id).then(response => {
                    this.getClients();
                });
            }
        }
    });
</script>