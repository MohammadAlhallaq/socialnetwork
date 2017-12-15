<template>
    <div>
            <p class="text-center" v-if="loading">
                Loading ...
            </p>
            <p class="text-center" v-if="!loading">


                <button class="btn btn-primary"  v-if="auth_user !== profile_user_id && status==0" @click="add_friend()">Add Friend</button>
                <button class="btn btn-success" v-if="status == 'pending'" @click="accept_friend()">Accept Friend</button>
                <span class="text-success" v-if="status == 'waiting'">Waiting For Response</span>
                <span class="text-success" v-if="status == 'friends'">Friends</span>
            </p>
    </div>
</template>

<script>


    import axios from 'axios'

    export default {

        mounted() {
            axios.get('/check_relation_status/' + this.profile_user_id)
                .then(
                    (response) =>
                    {
                        this.status = response.data.status
                        this.loading = false
                    });
        },

        data(){
            return{
                status: '',
                loading: true
            }
        },


        methods:{


            add_friend(){

                this.loading = true

                axios.get('/add_friend/' + this.profile_user_id)
                    .then((response) => {
                            if (response.status == 200)
                            {
                                this.status = 'waiting'
                                new Noty({
                                    timeout: 1500,
                                    type: 'success',
                                    layout: 'bottomLeft',
                                    text: 'Request Has Been Sent'
                                }).show();
                                this.loading = false

                            }
                    });
            },

            accept_friend(){
                this.loading = true

                axios.get('/accept_friend/'  + this.profile_user_id)
                    .then(
                        (response) => {
                            if (response.status == 200)
                            {
                                this.status = 'friends'
                                new Noty({
                                    timeout: 1500,
                                    type: 'success',
                                    layout: 'bottomLeft',
                                    text: 'Request Accepted'
                                }).show();
                                this.loading = false
                            }

                        });
            },


        },


        props: ['auth_user',  'profile_user_id'],


    }
</script>
