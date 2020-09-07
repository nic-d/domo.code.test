<template>
  <img
    class="bg-gray-300 rounded-full flex-shrink-0"
    :class="sizes[size].container"
    :src="url"
    :alt="username"
  >
</template>

<script>
export default {
  name: "avatar",

  props: {
    size: {
      type: String,
      required: false,
      default: 'md',
    },

    username: {
      type: String,
      required: true,
    },

    url: {
      type: String,
      required: true,
    },

    colour: {
      type: String,
      required: false,
      default: 'indigo-500'
    },

    shape: {
      type: String,
      required: false,
      default: 'rounded-full', // rounded|rounded-full
    },
  },

  data() {
    return {
      sizes: {
        xxs: {
          container: 'h-4 w-4',
          icon: 'h-2 w-2',
        },
        xs: {
          container: 'h-6 w-6',
          icon: 'h-2 w-2',
        },
        sm: {
          container: 'h-8 w-8',
          icon: 'h-3 w-3',
        },
        md: {
          container: 'h-10 w-10',
          icon: 'h-3 w-3',
        },
        lg: {
          container: 'h-12 w-12',
          icon: 'h-4 w-4',
        },
        xl: {
          container: 'h-14 w-14',
          icon: 'h-4 w-4',
        },
        xxl: {
          container: 'h-16 w-16',
          icon: 'h-5 w-5',
        },
      },
    }
  },

  computed: {
    iconSize: function () {
      const size = this.sizes[this.size].icon
      return size
    },

    bgColour: function () {
      const bg = 'bg-' + this.colour
      return bg
    },
  },
}
</script>

<style scoped>

</style>
