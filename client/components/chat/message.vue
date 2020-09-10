<template>
  <div>
    <div class="flex items-start mb-4 text-sm">
      <avatar
        :url="user.avatar"
        class="mr-3"
        :username="user.name"
        size="md"
      />

      <div class="flex-1 overflow-hidden">
        <div>
          <span class="font-bold">{{ user.name }}</span>
          <span class="text-gray-400 text-xs">{{ formatTimestamp(created_at) }}</span>
        </div>

        <p class="text-black leading-normal">{{ message }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import dayjs from 'dayjs'
import avatar from "../user/avatar"

export default {
  name: "message",

  components: {
    avatar,
  },

  props: {
    user: {
      type: Object,
      required: true,
    },

    message: {
      type: String,
      required: true,
    },

    created_at: {
      type: String,
      required: true,
    },
  },

  methods: {
    formatTimestamp: function (date) {
      return dayjs(date).format('D MMM, YYYY, h:m')
    },
  },
}
</script>

<style scoped>

</style>
