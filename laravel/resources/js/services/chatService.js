import requestService from './requestService';

const getMessage = (text, author) => ({ text, author });
const putMessage = (message, userId) => {
    return requestService.auth('POST', '/api/messages', {
        message
    }, userId);
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
    getMessage,
    putMessage,
    broadcast
};
