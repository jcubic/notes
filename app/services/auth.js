function service(rpc) {
    var token_key = 'notes_token';
    var name_key = 'notes_username';
    this.token = localStorage.getItem(token_key);
    this.username = localStorage.getItem(name_key);
    var clear = () => {
        localStorage.removeItem(token_key);
        localStorage.removeItem(name_key);
        delete this.token;
        delete this.username;
    };
    this.authenticated = () => {
        return rpc.then((service) => {
            return service.valid_token(this.username, this.token).then(function(valid) {
                if (!valid) {
                    clear();
                }
                return valid;
            });
        });
    };
    this.login = (username, password) => {
        return rpc.then((service) => {
            return service.login(username, password).then((token) => {
                if (token) {
                    localStorage.setItem(token_key, token);
                    localStorage.setItem(name_key, username);
                    this.token = token;
                    this.username = username;
                }
                return token;
            });
        });
    };
    this.logout = (username, password) => {
        return rpc.then((service) => {
            return service.logout(this.token, this.username).then(() => {
                clear();
            });
        });
    };
}
service.$inject = ['rpc'];
export default service;
