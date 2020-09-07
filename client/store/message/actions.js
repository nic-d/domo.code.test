export default {
  async list({ commit }, { channelUuid }) {
    return await this.$axios.get(`/chat/channel/${channelUuid}/messages`)
      .then(response => {
        commit('setMessages', response.data)
        return response.data
      })
      .catch(error => {
        throw error
      })
  },

  async create({ commit }, { channelUuid, messageUuid, formData }) {
    return await this.$axios.post(`/chat/channel/${channelUuid}/messages/${messageUuid}`, formData)
      .then(response => {
        commit('pushMessage', response.data.data)
        return response.data.data
      })
      .catch(error => {
        throw error
      })
  },

  async update({ commit }, { channelUuid, messageUuid, formData }) {
    return await this.$axios.patch(`/chat/channel/${channelUuid}/messages/${messageUuid}`, formData)
      .then(response => {
        commit('setMessage', response.data.data)
        return response.data.data
      })
      .catch(error => {
        throw error
      })
  },

  async delete({ commit }, { channelUuid, messageUuid }) {
    return await this.$axios.delete(`/chat/channel/${channelUuid}/messages/${messageUuid}`)
      .then(response => {
        commit('removeMessage', messageUuid)
      })
      .catch(error => {
        throw error
      })
  },

  wsCreate({ commit }, message) {
    commit('pushMessage', message)
  },
}
