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
        </div>

        <div class="mb-8">
          <div class="px-4 mb-2 text-white flex justify-between items-center">
            <div class="text-gray-300">Channels</div>

            <div @click="shouldShow = true" class="cursor-pointer">
              <svg @click="shouldShow = true" class="fill-current h-4 w-4 opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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

        <Modal v-if="shouldShow">
          <template v-slot:body>
            <form @submit.prevent="submitNewChannel">
              <div class="py-3 text-center sm:mt-5">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-5" id="modal-headline">
                  Create Channel
                </h3>

                <div class="mt-2">
                  <div>
                    <div class="mt-1 relative rounded-md shadow-sm">
                      <input v-model="$v.newChannelName.$model" id="text" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="#hello world" name="newChannelName">
                    </div>
                  </div>
                </div>
              </div>

              <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                <span class="flex w-full rounded-md shadow-sm sm:col-start-2">
                  <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Create
                  </button>
                </span>

                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:col-start-1">
                  <button @click="shouldShow = false" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Cancel
                  </button>
                </span>
              </div>
            </form>
          </template>
        </Modal>
      </div>
    </div>
  </div>
</template>

<script>
import channelList from "../components/channel/channel-list"
import avatar from "../components/user/avatar"
import modal from "../components/common/modal"

import { mapGetters, mapActions } from 'vuex'
import { maxLength, minLength, required } from "vuelidate/lib/validators";

export default {
  name: "default",
  auth: true,

  components: {
    avatar,
    channelList,
    modal,
  },

  validations: {
    newChannelName: {
      required,
      minLength: minLength(3),
      maxLength: maxLength(20),
    },
  },

  data() {
    return {
      defaultChannel: 'general',
      newChannelName: '',
      shouldShow: false,
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

  methods: {
    ...mapActions({
      createChannel: 'channel/create',
    }),

    async submitNewChannel() {
      const formData = { name: this.newChannelName }

      await this.$store.dispatch('channel/create', { formData })
        .then(response => {
          this.shouldShow = false
          this.newChannelName = ''

          // change to the new channel
          this.$router.push(`/channel/${response.data.uuid}`)
        })
        .catch(error => {

        })
    },
  },
}
</script>

<style>
</style>
