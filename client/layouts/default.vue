<template>
  <div>
    <div class="font-sans antialiased h-screen flex">
      <div class="bg-aubergine-500 text-purple-lighter flex-none w-64 pb-6 hidden md:block">
        <div class="text-white mb-2 mt-3 px-4 flex justify-between">
          <div class="flex-auto">
            <h1 class="font-semibold text-xl leading-tight mb-1 truncate">DOMO Project</h1>

            <div class="flex items-center mb-6">
              <span class="bg-green-500 rounded-full block w-2 h-2 mr-2"></span>
              <span class="text-gray-300 text-sm">{{ $auth.user.name }}</span>
            </div>
          </div>

          <div>
            <svg class="h-6 w-6 fill-current text-white opacity-25" viewBox="0 0 20 20">
              <path d="M14 8a4 4 0 1 0-8 0v7h8V8zM8.027 2.332A6.003 6.003 0 0 0 4 8v6l-3 2v1h18v-1l-3-2V8a6.003 6.003 0 0 0-4.027-5.668 2 2 0 1 0-3.945 0zM12 18a2 2 0 1 1-4 0h4z" fill-rule="evenodd" />
            </svg>
          </div>
        </div>

        <div class="mb-8">
          <div class="px-4 mb-2 text-white flex justify-between items-center">
            <div class="text-gray-300">Channels</div>
            <div>
              <svg class="fill-current h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z" />
              </svg>
            </div>
          </div>

          <nav class="flex-1 space-y-1 px-2">
            <ChannelList
              v-for="(item, $index) in channels.data"
              v-bind="item"
              v-bind:key="$index"
            />
          </nav>
        </div>
      </div>

      <div class="flex-1 flex flex-col bg-white overflow-hidden">
        <Nuxt />
      </div>
    </div>
  </div>
</template>

<script>
import channelList from "../components/channel/channel-list"
import avatar from "../components/user/avatar"

import { mapGetters } from 'vuex'

export default {
  name: "default",
  auth: true,

  components: {
    avatar,
    channelList,
  },

  data() {
    return {
      defaultChannel: 'general',
    }
  },

  computed: {
    ...mapGetters({
      channels: 'channel/getChannels',
    }),
  },

  async beforeMount() {
    await this.$store.dispatch('channel/list')
  },
}
</script>

<style>
</style>
