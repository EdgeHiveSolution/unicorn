import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";

const store = createStore({
    plugins: [
        createPersistedState({
            storage: sessionStorage, // Use sessionStorage
            paths: ["loggedUser"], // This ensures only 'loggedUser' is persisted
        }),
    ],

    state: {
        loggedUser: null,
    },

    // mutations: {
    //     UPDATE_LOGGED_USER(state, user) {
    //         // Initialize the progress property as null for each kpi_metric_member
    //         if (user && user.member && user.member.kpi_metric_members) {
    //             user.member.kpi_metric_members.forEach((kpiMetricMember) => {
    //                 kpiMetricMember.progress = null;
    //             });
    //         }
    //         state.loggedUser = user;
    //         console.log(
    //             "Updated User State: " + JSON.stringify(state.loggedUser)
    //         );
    //         console.log("Updated User State: " + JSON.stringify(user));
    //     },
    // },

    mutations: {
        UPDATE_LOGGED_USER(state, user) {
            state.loggedUser = user;
            console.log(
                "Updated User State: " + JSON.stringify(state.loggedUser)
            );
            console.log("Updated User State: " + JSON.stringify(user));
        },
    },

    actions: {
        updateLoggedUser(context, user) {
            context.commit("UPDATE_LOGGED_USER", user);
        },

        // updateKpiMetricMembers(context, kpiMetricMembers) {
        //     context.commit('UPDATE_KPI_METRIC_MEMBERS', kpiMetricMembers);
        // },
    },
});

export default store;
