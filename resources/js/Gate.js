export default class Gate {

    constructor(user) {
        this.user = user;
    }

    isAdmin() {
        return this.user.type === 'admin';
    }

    isAdminOrModerator() {
        if (this.user.type === 'admin' || this.user.type === 'moderator') {
            return true;
        }
    }

    isUser() {
        return this.user.type === 'user';
    }

    isUserOrModerator() {
        if (this.user.type === 'user' || this.user.type === 'moderator') {
            return true;
        }
    }
}