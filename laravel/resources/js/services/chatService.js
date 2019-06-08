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
            return ch.listen(event, listener);
        }
    };
};

export default {
    getSocketId,
    getMessage,
    putMessage,
    broadcast
};
