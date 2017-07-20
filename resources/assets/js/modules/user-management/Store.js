const UserManagementModule = {
    namespaced: true,
    state: {
        users: [],
        activeUser: {
            id: -1,
            name: '',
            email: '',
            password: ''
        },
        eventBus: new Vue()
    },
    mutations: {
        addUser(state, payload) {
            state.users.push(payload);
        },
        setUsers(state, payload) {
            state.users = payload;
        },
        setActiveUser(state, payload) {
            state.activeUser = payload;
        },
        setActiveUserData(state, payload) {
            state.activeUser[payload.field] = payload.value;
        },
        removeUser(state, payload) {
            state.users.splice(payload.index, 1);
        }
    },
    actions: {}
};

store.registerModule('userManagement', UserManagementModule);