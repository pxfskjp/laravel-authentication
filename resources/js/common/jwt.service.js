const ID_API_TOKEN = 'id_api_token';

export const getToken = () => {
    return window.localStorage.getItem(ID_API_TOKEN)
};

export const setToken = (token) => {
    window.localStorage.setItem(ID_API_TOKEN, token);
};

export const unsetToken = () => {
    window.localStorage.removeItem(ID_API_TOKEN);
};

export default {getToken, setToken, unsetToken}