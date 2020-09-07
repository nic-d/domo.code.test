<template>
  <div>
  </div>
</template>

<script>
export default {
  name: "logout",
  layout: "auth",
  auth: false,

  async mounted() {
    this.$auth.logout()
    this.$router.push('/auth/login')
  },
}
</script>

<style scoped>

</style>
