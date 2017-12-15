<template>

   <div class="container">

       <div class="row">

           <div class="col-lg-6 col-lh-offset-3">

               <input type="text " class="form-control" v-model="query" @keyup.enter="search()">
               <hr>
               <div class="row">



               </div>

           </div>

       </div>

   </div>

</template>

<script>

    import axios from 'axios'

//    var algoliasearch = require('algoliasearch')
//
//    var client = algoliasearch('Y8OBLNC5H4', '1afed6b447d97747f3494bcba602a768')
//
//    var index = client.initIndex('users')


    export default {


        mounted(){

        },


        data(){

            return{
                query: '',
                results: []
            }

        },


        methods:{

            search(){

                axios.get('/search/' + this.query)
                    .then((response) => {

                    console.log(response)

                    })


//                index.search(this.query, (err, content) => {
//
//                    this.results = content.hits


//                })
            }

        }





}


</script>
