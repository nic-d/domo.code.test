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

  data() {
    return {
      defaultChannel: 'General',
    }
  },

  async beforeMount() {
    let user = this.$auth.user

    if (user.last_channel !== null) {
      this.defaultChannel = user.last_channel
    }

    this.$router.push(`/channel/${this.defaultChannel}`)
  },
}
</script>

<style>
</style>
