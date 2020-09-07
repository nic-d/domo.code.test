export default {
  async get({ commit }) {
    return await this.$axios.get(`/infrastructure/account`)
      .then(response => {
        commit('setUser', response.data.data)
        return response.data.data
      })
      .catch(error => {
        throw error
      })
  },

  async updateLastChannel({ commit }, { type, uuid }) {
    const formData = { uuid: uuid }

    return await this.$axios.patch(`/chat/account/last-channel`, formData)
      .then(response => {
        commit('setUser', response.data.data)
        return response.data.data
      })
      .catch(error => {
        throw error
      })
  },
}
