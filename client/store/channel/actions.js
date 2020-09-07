export default {
  async list({ commit }) {
    return await this.$axios.get(`/chat/channels`)
      .then(response => {
        commit('setChannels', response.data)
        return response.data
      })
      .catch(error => {
        throw error
      })
  },

  async read({ commit, dispatch }, uuid) {
    return await this.$axios.get(`/chat/channels/${uuid}`)
      .then(response => {
        commit('setChannel', response.data.data)
        return response.data.data
      })
      .catch(error => {
        throw error
      })
  },

  async create({ commit }, { formData }) {
    return await this.$axios.post(`/chat/channels`, formData)
      .then(response => {
        commit('pushChannel', response.data.data)
        return response.data.data
      })
      .catch(error => {
        throw error
      })
  },

  async update({ commit }, { uuid, formData }) {
    return await this.$axios.patch(`/chat/channels/${uuid}`, formData)
      .then(response => {
        commit('setChannel', response.data.data)
        return response.data.data
      })
      .catch(error => {
        throw error
      })
  },

  async delete({ commit }, uuid) {
    return await this.$axios.delete(`/chat/channels/${uuid}`)
      .then(response => {
        commit('removeChannel', uuid)
      })
      .catch(error => {
        throw error
      })
  },
}
