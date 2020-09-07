export default {
  setChannels: (state, channels) => state.channels = channels,
  setChannel: (state, channel) => state.channel = channel,
  pushChannel: (state, channel) => {
    state.channels.data.push(channel)
  },
  removeChannel: (state, channelUuid) => {
    state.channels.data.splice(state.channels.data.findIndex(stateChannel => {
      return stateChannel.uuid === channelUuid
    }), 1)
  },
}
