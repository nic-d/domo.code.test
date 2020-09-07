<template>
  <div>
    <div class="h-screen flex overflow-hidden bg-white">
      <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64">
          <!-- Sidebar component, swap this element with another sidebar if you like -->
          <div class="flex flex-col h-0 flex-1 bg-aubergine-500">
            <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
              <div class="flex items-center flex-shrink-0 px-4">
                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-on-brand.svg" alt="Workflow">
              </div>

              <nav class="px-3 mt-6">
                <h3 class="px-3 pb-2 text-xs leading-4 font-semibold text-gray-300 uppercase tracking-wider" id="channels-headline">
                  Channels
                </h3>

                <div class="space-y-1">
                  <ChannelList
                    v-for="(item, $index) in channels.data"
                    v-bind="item"
                    v-bind:key="$index"
                  />
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>

      <div class="flex flex-col w-0 flex-1 overflow-hidden">
        <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
          <Nuxt />
        </main>
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

    let user = this.$auth.user

    if (user.last_channel !== null) {
      this.defaultChannel = user.last_channel
    }
  },
}
</script>

<style>
</style>
