<template>
    <form action="" method="post"
          class="form"
          enctype="application/x-www-form-urlencoded">
        <div class="form-group">
            <input type="text" name="name" id="name" class="form-control"
                   placeholder="Name" v-model="name">
        </div>
        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control"
                   placeholder="Email" v-model="email">
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" class="form-control"
                   placeholder="Password" v-model="password">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="button" v-on:click="save()">
                <span class="glyphicon glyphicon-plus" v-if="id === -1"></span>
                <span class="glyphicon glyphicon-floppy-disk" v-else></span>
            </button>
            <button class="btn btn-default" type="button" v-on:click="cancel()"
                    v-if="id !== -1">
                Cancel
            </button>
        </div>
    </form>
</template>
<script>
    export default {
        props: {
            actionUrl: String
        },
        mounted() {
        },
        computed: {
            activeUser() {
                return this.$store.state.userManagement.activeUser;
            },
            id() {
                return this.$store.state.userManagement.activeUser.id;
            },
            name: {
                get() {
                    return this.$store.state.userManagement.activeUser.name;
                },
                set(value) {
                    this.$store.commit('userManagement/setActiveUserData', {
                        field: 'name',
                        value: value
                    });
                }
            },
            email: {
                get() {
                    return this.$store.state.userManagement.activeUser.email;
                },
                set(value) {
                    this.$store.commit('userManagement/setActiveUserData', {
                        field: 'email',
                        value: value
                    });
                }
            },
            password: {
                get() {
                    return this.$store.state.userManagement.activeUser.password;
                },
                set(value) {
                    this.$store.commit('userManagement/setActiveUserData', {
                        field: 'password',
                        value: value
                    });
                }
            }
        },
        methods: {
            save() {
                if (this.activeUser.id === -1) {
                    axios.post(this.actionUrl, this.activeUser)
                        .then((res) => {
                            alert('user saved');
                            this.$store.state.userManagement.eventBus.$emit('userManagement/save');
                        });
                } else {
                    this.update();
                }
            },
            update() {
                axios.put(this.actionUrl + '/' + this.id, this.activeUser)
                    .then((res) => {
                        alert('user updated');
                        this.$store.state.userManagement.eventBus.$emit('userManagement/save');
                    });
            },
            cancel() {
                this.$store.commit('userManagement/setActiveUser', {
                    id: -1,
                    name: '',
                    email: '',
                    password: ''
                });
            }
        }
    }
</script>