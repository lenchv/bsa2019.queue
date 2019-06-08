import requestService from './requestService';

const getSocketId = () => Echo.socketId();
const getMessage = (text, author) => ({ text, author });
const putMessage = (message, userId) => {
    return requestService.auth('POST', '/api/messages', {
        message
    }, userId, {
        'X-Socket-ID': getSocketId()
    });
};

const broadcast = (channel) => {
    const ch = Echo.channel(channel);
    
    return {
        on(event, listener) {
            ch.listen(event, listener);
            return this;
        },
        onWhisper(event, listener) {
            Echo.private(channel).listenForWhisper(event, listener);

            return this;
        },
        whisper(event, data) {
            Echo.private(channel).whisper(event, data);
            
            return this;
        }
    };
};

export default {
    getSocketId,
    getMessage,
    putMessage,
    broadcast
};
