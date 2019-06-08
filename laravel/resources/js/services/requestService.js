const fetchData = (method, endpoint, data, customHeaders = {}) => {
    const headersData = Object.assign({
        'Content-Type': 'application/json'
    }, customHeaders);

    const headers = Object.keys(headersData)
        .reduce((headers, headerName) => {
            headers.append(headerName, headersData[headerName]);

            return headers;
        }, new Headers())

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
