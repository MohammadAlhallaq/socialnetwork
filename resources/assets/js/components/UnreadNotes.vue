<template>
    <li>
        <a href="/notifications">
            Unread Notifications
            <span class="badge">{{ all_nots_count }}</span>
        </a>
    </li>
</template>


<script>

    import axios from 'axios'

    export default{
        mounted(){
            this.getUnread();
        },

        methods:{
            getUnread(){
                axios.get('/get_unread')
                    .then((nots)=> {
                        nots.data.forEach((not) => {
                            this.$store.commit('add_not', not)
                        });
                    })
            }
        },


        computed:{
            all_nots_count(){
                return this.$store.getters.all_nots_count
            }
        }

    }
</script>