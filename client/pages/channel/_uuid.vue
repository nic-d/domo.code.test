<template>
  <div class="flex-1 flex flex-col bg-white overflow-hidden">
    <div class="border-b flex px-6 py-2 items-center flex-none">
      <div class="flex flex-col">
        <h3 class="text-gray-700 mb-1 font-bold">
          #{{ channel.name }}
        </h3>

        <div class="text-gray-600 text-sm truncate">
          {{ channel.description }}
        </div>
      </div>

      <div class="ml-auto hidden md:block">
        <div class="relative">
        </div>
      </div>
    </div>

    <div class="px-6 py-4 flex-1 overflow-y-scroll" v-if="messages && messages.data.length" ref="messages">
      <message
        v-for="(item, index) in messages.data"
        v-bind="item"
        v-bind:key="item.uuid"
      />
    </div>

    <div class="pb-6 px-4 flex-none">
      <form @submit.prevent="submit">
        <div class="flex rounded-lg border-2 border-grey overflow-hidden">
          <span class="text-3xl text-grey border-r-2 border-grey p-2">
            <svg class="fill-current h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z"/>
            </svg>
          </span>

          <input
            name="message"
            type="text"
            class="w-full px-4"
            :placeholder="placeholder"
            v-model="$v.message.$model"
          />
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import { required, minLength, maxLength } from 'vuelidate/lib/validators'
import message from "../../components/chat/message"

export default {
  name: "uuid",

  components: {
    message,
  },

  data() {
    return {
      loading: false,
      uuid: this.$route.params.uuid,
      message: '',
      placeholder: '',
    }
  },

  validations: {
    message: {
      required,
      minLength: minLength(1),
      maxLength: maxLength(500),
    },
  },

  watch: {
    messages: {
      deep: true,
      immediate: false,

      handler () {
        this.$nextTick(function() {
          let container = this.$refs.messages;
          container.scrollTop = container.scrollHeight + 200;
        });
      },
    },
  },

  computed: {
    ...mapGetters({
      channel: 'channel/getChannel',
      messages: 'message/getMessages',
    }),
  },

  async beforeMount() {
    this.$store.dispatch('channel/read', this.uuid)
      .then(() => {
        this.placeholder = `Message #${this.channel.name}`
      })

    const formData = { channel: this.uuid }

    this.$store.dispatch('message/list', this.uuid)
    this.$store.dispatch('user/updateLastChannel', { formData })
  },

  async mounted() {
    this.$echo.channel(`private-channel.${this.$route.params.uuid}`)
      .on('message.created', response => {
        // Avoid creating the message element in DOM if sent by the current user
        if (this.$auth.user.uuid !== response.user.uuid) {
          this.$store.dispatch('message/wsCreate', response)
        }
      })
  },

  methods: {
    ...mapActions({
      createMessage: 'message/create',
      wsMessage: 'message/wsCreate',
      updateLastChannel: 'user/updateLastChannel',
    }),

    async submit() {
      const formData = { message: this.message }
      const channelUuid = this.uuid

      await this.$store.dispatch('message/create', { channelUuid, formData })
        .then(response => {
          this.message = ''
        })
        .catch(error => {

        })
    },
  },
}
</script>

<style scoped>

</style>
