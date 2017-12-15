import Vuex from "vuex"

import Vue from "vue"

Vue.use(Vuex);


export const store = new Vuex.Store({
    state: {

        notifications: [],
        posts: [],
        auth_user: {}

    },

    getters:{

        all_nots(state)
        {
            return state.notifications
        },


        all_nots_count(state)
        {
            return state.notifications.length
        },

        all_posts(state)
        {
            return state.posts
        }

    },

    mutations: {
        add_not(state, not){
            state.notifications.push(not)
        },

        add_post(state, post){
            state.posts.push(post)
        },

        auth_user_date(state, user){
            state.auth_user = user
        },


        update_post_like(state, payload)
        {

            var $post = state.posts.find((post) => {
                return post.id === payload.id
            })

            $post.likes.push(payload.like)




        },

        unlike_post(state, payload)
        {
            var $post = state.posts.find((post) => {

                return post.id === payload.post_id
            })

            var $index = $post.likes.findIndex((like) => {

                return like.id === payload.like_id
            })

            $post.likes.splice($index)

        }
    }
});