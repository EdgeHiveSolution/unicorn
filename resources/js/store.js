import { createStore } from 'vuex';
import createPersistedState from "vuex-persistedstate";


const store = createStore({
    plugins: [
        createPersistedState({
            storage: window.sessionStorage,
        }),
    ],

    state: {
        loggedUser: null,
    },
    mutations: {
        UPDATE_LOGGED_USER(state, user) {
            state.loggedUser = user;
            console.log("Updated User State: " + JSON.stringify(state.loggedUser));
            console.log("Updated User State: " + JSON.stringify(user));
        },

    },
    actions: {
        updateLoggedUser(context, user) {
            context.commit('UPDATE_LOGGED_USER', user);
        },
    },
});

export default store;
