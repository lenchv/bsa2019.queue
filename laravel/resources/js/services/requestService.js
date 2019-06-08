const fetchData = (method, endpoint, data, customHeaders = {}) => {
    const headers = Object.keys(customHeaders)
        .reduce((headers, headerName) => {
            headers.append(headerName, customHeaders[headerName]);

            return headers;
        }, new Headers())
        .append('Content-Type', 'application/json');
    const requestData = {
        method,
        headers
    };

    if (data) {
        requestData.body = JSON.stringify(data);
    }

    return fetch(endpoint, requestData).then(response => {
        if (!response.ok) {
            return Promise.reject(response);
        }

        return response.json();
    });
};

const authFetch = (method, endpoint, data, userId) => {
    if (!userId) {
        return Promise.reject('User is not authorized!');
    }

    return fetchData(method, endpoint, data, {
        'x-user-id': userId
    });
};

export default {
    fetch: fetchData,
    auth: authFetch,
};
