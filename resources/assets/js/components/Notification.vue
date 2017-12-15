<template>

  <div>
  </div>

</template>

<script>

  export default {
      mounted(){
          this.listen()
      },

      props:['id'],

      methods: {
          listen(){
              Echo.private('App.User.' + this.id)
                  .notification((notification) => {

                  new Noty({
                      timeout: 1500,
                      type: 'success',
                      layout: 'top',
                      text: notification.name + notification.message,
                  }).show();

                      this.$store.commit('add_not', notification);

                  document.getElementById('notify_audio').play()

              });
          }
      }

  }

</script>
