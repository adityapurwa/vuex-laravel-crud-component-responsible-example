<template>
    <table class="table">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>-</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(user, index) in users">
            <td>{{index}}</td>
            <td>
                <a href="#" v-on:click="setActiveUser(user)">
                    {{user.name}}
                </a>
            </td>
            <td>{{user.email}}</td>
            <td>
                <a href="#" v-on:click="remove(user, index)">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
        </tbody>
    </table>
</template>
<script>
    export default {
        props: {
            actionUrl: String
        },
        mounted() {
            this.load();
            this.$store.state.userManagement.eventBus.$on('userManagement/save', this.load);
        },
        computed: Vuex.mapState({
            users: state => state.userManagement.users
        }),
        methods: {
            setActiveUser(user) {
                this.$store.commit('userManagement/setActiveUser', user);
            },
            load() {
                axios.get(this.actionUrl)
                    .then((res) => {
                        this.$store.commit('userManagement/setUsers', res.data);
                    });
            },
            remove(user, index) {
                axios.delete(this.actionUrl + '/' + user.id)
                    .then((res) => {
                        if (res.data.status === 'ok' && res.data.deleted.toString() === user.id.toString()) {
                            this.$store.commit('userManagement/removeUser', {
                                id: user.id,
                                index: index
                            });
                        }
                    });
            }
        }
    }
</script>