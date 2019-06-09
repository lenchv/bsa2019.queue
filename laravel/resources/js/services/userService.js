
import requesService from './requestService';

const authnticate = (userName) => {
    if (!userName) {
        return Promise.reject();
    }

    const success = (userData) => {
        saveUser(userData.name);

        return userData;
    };
    const registerUser = (name) => {
        return requesService.fetch(
            'POST',
            '/api/users',
            { name }
        ).then(success);
    };
    const notFound = (response) => response.status !== 404;
    
    return requesService.fetch('GET', `/api/users/${userName}`)
        .then(
            userData => success(userData),
            (response) => {
                if (notFound(response)) {
                    return Promise.reject(response);
                } else {
                    return registerUser(userName)
                }
            }
        );
};

const saveUser = (userName) => {
    localStorage.setItem('userName', userName);
};
const getUser = () => {
    return localStorage.getItem('userName');
};

export default {
    authnticate,
    saveUser,
    getUser
};
