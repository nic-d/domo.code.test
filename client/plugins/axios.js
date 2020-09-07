import Vue from 'vue'
import axios from 'axios'

export default function ({ app, $axios }) {

  // Adding the ability to cancel requests
  const CancelToken = axios.CancelToken

  Vue.prototype.$axiosCancelToken = CancelToken.source()

  Vue.prototype.$axiosRefreshCancelToken = () => {
    Vue.prototype.$axiosCancelToken = CancelToken.source()
  }

  $axios.onRequest(config => {
    config.baseURL = process.env.API_URL
    config.headers['Accept'] = 'application/json'
    config.headers['Content-Type'] = 'application/json'
    config.cancelToken = Vue.prototype.$axiosCancelToken.token
  })
}
