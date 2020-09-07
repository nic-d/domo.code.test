<template>
  <div>
    <nuxt-link
      :to="{name: 'channel-uuid', params: {uuid: uuid}}"
      class="group flex items-center px-2 py-2 text-sm leading-5 font-medium rounded-lg text-gray-100 hover:bg-blue-500 focus:outline-none focus:bg-blue-500 transition ease-in-out duration-150"
      :class="{'bg-blue-500 text-white': isRouteActive(uuid) }"
    >
      <span class="mr-4 text-white">#</span>
      {{ name }}
    </nuxt-link>
  </div>
</template>

<script>
export default {
  name: "channel-list",

  props: {
    uuid: {
      type: String,
      required: true,
    },

    name: {
      type: String,
      required: true,
    },
  },

  methods: {
    isRouteActive(uuid) {
      if (this.$route.path.includes(uuid)) {
        return true
      } else {
        return false
      }
    },
  },
}
</script>

<style scoped>

</style>
