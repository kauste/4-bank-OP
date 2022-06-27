export const login = key => {
    localStorage.setItem('token', key);
}
export const logout = () => {
    localStorage.removeItem('token');
}
    
export const authConfig = () => {
    return {
        headers: { Authorization: `${localStorage.getItem('token') ?? ''}` }
    }
}
