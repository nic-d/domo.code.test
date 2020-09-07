<template>
  <div></div>
</template>

<script>
import { mapGetters } from 'vuex'
import message from "../components/chat/message"
import avatar from "../components/user/avatar";

export default {
  name: "index",

  components: {
    avatar,
    message,
  },

  computed: {
    ...mapGetters({
      user: 'user/getUser',
    }),
  },

  async beforeMount() {
    let user = this.$auth.user
    this.$router.push(`/channel/${user.last_channel}`)
  },
}
</script>

<style>
</style>
