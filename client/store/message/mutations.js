export default {
  setMessages: (state, messages) => {
    state.messages = messages
    state.messages.data = messages.data.reverse()
  },
  setMessage: (state, message) => state.message = message,
  pushMessage: (state, message) => {
    if (! state.messages.data.find(val => val.uuid == message.uuid)) {
     state.messages.data.push(message)
    }
  },
  removeMessage: (state, messageUuid) => {
    state.messages.data.splice(state.messages.data.findIndex(stateMessage => {
      return stateMessage.uuid === messageUuid
    }), 1)
  },
}
