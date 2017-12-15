<template>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" v-for="post in posts">

                    <div class="panel-heading">

                        <img :src="post.user.avatar" width="40px" height="40px" style="border-radius:50%; " alt="">

                        {{post.user.name}}
                    </div>


                    <div class="panel-body">
                        <p class="text-center">
                            {{post.content}}
                        </p>


                        <like :id="post.id"></like>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>


    import axios from 'axios'

    export default {

        mounted(){
            this.getPosts();
        },


        methods:{
            getPosts(){
                axios.get('/get_posts')
                    .then((response)=> {


                        response.data.forEach((posts) => {
                            this.$store.commit('add_post', posts)
                        })
                    })
            }
        },


        omputed:{
            posts()
            {
                return this.$store.getters.all_posts
            }
        }c


    }

</script>
