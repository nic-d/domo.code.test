const path = require('path')
require('dotenv').config()

export default {
  /*
  ** Nuxt rendering mode
  ** See https://nuxtjs.org/api/configuration-mode
  */
  mode: 'spa',

  /*
   * Set generate configuraiton
   * Doc: https://nuxtjs.org/guide/routing#spa-fallback
   */
  generate: {
    fallback: true,
  },

  /*
  ** Headers of the page
  ** See https://nuxtjs.org/api/configuration-head
  */
  head: {
    title: process.env.npm_package_name || '',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  /*
  ** Global CSS
  */
  css: [
    '~assets/css/tailwind.css',
  ],

  /*
  ** Plugins to load before mounting the App
  ** https://nuxtjs.org/guide/plugins
  */
  plugins: [
    '~plugins/axios',
    '~plugins/vuelidate',
    '~plugins/vue-spinner',
  ],

  /*
  ** Auto import components
  ** See https://nuxtjs.org/api/configuration-components
  */
  components: true,

  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
    '@nuxtjs/dotenv',
    '@nuxtjs/tailwindcss',
    '@nuxtjs/laravel-echo',
  ],

  /*
  ** Nuxt.js modules
  */
  modules: [
    '@nuxtjs/pwa',
    '@nuxtjs/axios',
    '@nuxtjs/auth',
    '@nuxtjs/dotenv',
    'nuxt-purgecss',
  ],

  /*
  ** Build configuration
  ** See https://nuxtjs.org/api/configuration-build/
  */
  build: {
    postcss: {
      plugins: {
        'postcss-import': {},
        tailwindcss: path.resolve(__dirname, './tailwind.config.js'),
        'postcss-nested': {},
      },
    },
    preset: {
      stage: 1 // see https://tailwindcss.com/docs/using-with-preprocessors#future-css-featuress
    }
  },

  loading: {
    color: '#3EB991',
  },

  /*
  ** Purge Css
  */
  purgeCSS: {
    mode: 'postcss',
    enabled: (process.env.APP_MODE === 'production')
  },

  /*
  ** Axios module configuration
  ** See https://axios.nuxtjs.org/options
  */
  axios: {
    proxy: true,
    progress: true,
    debug: (process.env.APP_DEBUG === 'local'),
    withCredentials: true,
    baseURL: `${process.env.API_URL}`,
  },

  auth: {
    resetOnError: false,
    fullPathRedirect: true,
    rewriteRedirects: true,
    redirect: {
      login: '/auth/login',
      logout: '/',
      home: '/',
    },
    localStorage: false,
    cookie: {
      prefix: process.env.AUTH_PREFIX,
      options: {
        domain: process.env.AUTH_COOKIE_DOMAIN,
        path: '/',
        secure: false,
      },
    },
    strategies: {
      local: {
        endpoints: {
          login: { url: '/infrastructure/login', method: 'post', propertyName: 'access_token' },
          logout: false,
          user: { url: '/infrastructure/account', method: 'get', propertyName: 'data' },
        },
        tokenRequired: true,
        tokenName: 'Authorization',
        tokenType: 'Bearer',
      },
    },
  },

  router: {
    middleware: ['auth'],
  },

  echo: {
    broadcaster: process.env.WS_BROADCASTER,
    key: process.env.WS_KEY,
    cluster: process.env.WS_CLUSTER,
    wsHost: process.env.WS_HOST,
    wsPort: process.env.WS_PORT,
    enabledTransports: ['ws'],
    disableStats: true,
    encrypted: true,
    forceTLS: false,
    authModule: true,
    authEndpoint: `${process.env.API_URL}/broadcasting/auth`,
  },

  env: {
    API_URL: process.env.API_URL,
    APP_DEBUG: process.env.APP_DEBUG,
    AUTH_COOKIE_DOMAIN: process.env.COOKIE_DOMAIN,
    WS_BROADCASTER: process.env.WS_BROADCASTER,
    WS_HOST: process.env.WS_HOST,
    WS_PORT: process.env.WS_PORT,
    WS_ENCRYPTED: process.env.WS_ENCRYPTED,
    WS_CLUSTER: process.env.WS_CLUSTER,
    WS_KEY: process.env.WS_KEY,
  },

  server: {
    port: process.env.PORT,
    host: process.env.HOST,
    timing: false
  },

  watchers: {
    webpack: {
      aggregateTimeout: 300,
      poll: 1000
    },
  },
}
