export default {
    setToken(token) {
        return localStorage.setItem(process.env.MIX_APP_TOKEN_NAME, token)
    },
    getToken() {
        return localStorage.getItem(process.env.MIX_APP_TOKEN_NAME)
    },
    clearToken() {
        localStorage.removeItem('myCat');
    },

    csrf() {
        return document.head.querySelector('meta[name="csrf-token"]').content;
    },

    console_log(log) {
        console.log(log)
    },

    notify(message, user_options) {
        const default_action = {
            text: 'بستن',
            onClick: (e, toastObject) => {
                toastObject.goAway(0);
            }
        }
        const options = {
            action: (user_options != null && typeof user_options.action != 'undefined') ? user_options.action : null,
            position: (user_options != null && typeof user_options.position != 'undefined') ? user_options.position : 'top-left',
            duration: (user_options != null && typeof user_options.duration != 'undefined') ? user_options.duration : 4500,
            keepOnHover: (user_options != null && typeof user_options.keepOnHover != 'undefined') ? user_options.keepOnHover : true,
            fullWidth: (user_options != null && typeof user_options.fullWidth != 'undefined') ? user_options.fullWidth : false,
            fitToScreen: (user_options != null && typeof user_options.fullWidth != 'undefined' && user_options.fitToScreen) ? user_options.fitToScreen : false,
            iconPack: (user_options != null && typeof user_options.iconPack != 'undefined') ? user_options.iconPack : 'custom-class',
            icon: (user_options != null && typeof user_options.icon != 'undefined') ? user_options.icon : 'fa fa-check',
            type: (user_options != null && typeof user_options.type != 'undefined') ? user_options.type : 'success',
            theme: (user_options != null && typeof user_options.theme != 'undefined') ? user_options.theme : 'toasted-primary',
            onComplete: (user_options != null && typeof user_options.onComplete != 'undefined') ? user_options.onComplete : null,
            closeOnSwipe: (user_options != null && typeof user_options.closeOnSwipe != 'undefined') ? user_options.closeOnSwipe : true,
            singleton: (user_options != null && typeof user_options.singleton != 'undefined') ? user_options.singleton : false,
            className: (user_options != null && typeof user_options.className != 'undefined') ? user_options.className : null,
            containerClass: (user_options != null && typeof user_options.containerClass != 'undefined') ? user_options.containerClass : null,
        }
        Vue.toasted.show(message, options);
    },
}
