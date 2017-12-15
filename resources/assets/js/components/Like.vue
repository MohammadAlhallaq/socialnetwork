<template>

<div>
    <hr>

    <p class="text-center" v-for="like in post.likes">
        <img :src="like.user.avatar" width="40px" height="40px" style="border-radius:50%; " alt="">
    </p>

    <hr>

    <button class="btn btn-primary" v-if="!is_likes_post" @click="like()">Like</button>

    <button class="btn btn-danger" v-else @click="unlike()">Unlike</button>

</div>
</template>

<script>

export default {


    props: ['id'],


    computed:{

        likers()
        {
             var likers = []

          this.post.likes.forEach((like) =>{
              likers.push(like.user_id)
          })

            return likers

        },


        is_likes_post()
        {

          var isLikes = this.likers.indexOf(this.$store.state.auth_user.id)


            if (isLikes === -1)
            {
                return false
            }
            else
            {
                return true
            }
        },


        post(){
            return this.$store.state.posts.find((post) =>{
                return post.id === this.id
            })
        }
    },


    methods:{

        like()
        {
                axios.get('/like/' + this.id)
                    .then((response) => {
                    this.$store.commit('update_post_like', {id: this.id, like: response.data})


            })
        },


        unlike()
        {
            axios.get('/unlike/' + this.id)
                .then((response) => {


                    this.$store.commit('unlike_post', {post_id: this.id, like_id: response.data})
            })
        }
    }

}

</script>


<style>
    p{
        display: inline-block;
    }
</style>