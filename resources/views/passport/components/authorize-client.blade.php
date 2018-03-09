@section('authorize-client')
<div class="col"> 
    <div class="card card-default">
        <div class="card-header">Authorized Applications</div>

        <div class="card-body">
            <!-- Authorized Tokens -->
            <table class="table table-borderless mb-0" v-if="tokens.length > 0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Scopes</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="token in tokens">
                        <!-- Client Name -->
                        <td style="vertical-align: middle;">
                            @{{ token.client.name }}
                        </td>

                        <!-- Scopes -->
                        <td style="vertical-align: middle;">
                            <span v-if="token.scopes.length > 0">
                                @{{ token.scopes.join(', ') }}
                            </span>
                        </td>

                        <!-- Revoke Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link text-danger" @click="revoke(token)">
                                Revoke
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- No Tokens Notice -->
            <p class="mb-0" v-if="tokens.length === 0">
                You have not any authorized applications.
            </p>
        </div>
    </div> 
</div>
@stop
<script type="text/javascript">
    window.url = '{!! env("APP_URL") !!}';
    Vue.component('ripple-authorize-client', {
        template: `@yield('authorize-client')`,


        /**
         *  The Component's data
         */
        data(){
            return {
                tokens: []
            };
        },
        
        /**
         * Prepare the component
         */
        ready(){
            this.prepareComponent();
        },

        /**
         * Prepare the component
         */
         mounted(){
             this.prepareComponent();
         },

         methods:{
             // Prepare component method declaration
             prepareComponent(){
                 this.getTokens();
             },


             // Get all  the autorized token for the user
             getTokens(){
                 axios.get(window.url+'/oauth/tokens')
                 .then(response=>{
                     this.tokens = response.data;
                 })
             },


             // Revoke the given token
             revoke(token){
                 axios.delete(window.url+'/oauth/tokens/'+token.id)
                 .then(response=>{
                     this.getTokens();
                 })
             }
         }

    });
</script>