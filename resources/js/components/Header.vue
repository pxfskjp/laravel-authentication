<template>
    <div>
        <b-navbar toggleable="md" type="dark" variant="dark">

            <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

            <b-navbar-brand href="#">
                <img :src="'../images/avatars/avatar.jpg'" width="30" height="30"
                     alt="" style="padding-right: 3px" class="d-inline-block align-top">
                Corporate web-chat
            </b-navbar-brand>

            <b-collapse is-nav id="nav_collapse">

                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                    <!-- Search messages from chat
                    <b-nav-form>
                        <b-form-input size="sm" class="mr-sm-2" type="text" placeholder="Search"/>
                        <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
                    </b-nav-form>
                    -->
                    <template v-if="!isAuthenticated">
                        <b-nav-item>
                            <router-link to="/login">
                                <b-button size="sm" class="my-2 my-sm-0 btn-success" type="button">
                                    Sign-in
                                </b-button>
                            </router-link>
                        </b-nav-item>
                        <b-nav-item>
                            <router-link to="/register">
                                <b-button size="sm" class="my-2 my-sm-0 btn-warning" type="button">
                                    Sign-up
                                </b-button>
                            </router-link>
                        </b-nav-item>
                    </template>


                    <!-- I18N Integration
                    <b-nav-item-dropdown text="Lang" right>
                        <b-dropdown-item href="#">EN</b-dropdown-item>
                        <b-dropdown-item href="#">RU</b-dropdown-item>
                    </b-nav-item-dropdown>
                    -->

                    <!-- Settings configuration-->
                    <template v-else>
                        <b-nav-item-dropdown right no-caret>
                            <template slot="button-content">
                                <div class="profile-photo-small">
                                    <img :src="'../images/avatars/avatar.jpg'"  width="30" height="30"
                                         class="rounded-circle img-fluid" alt="test">
                                </div>
                            </template>
                            <b-dropdown-item href="#">Profile</b-dropdown-item>
                            <b-dropdown-item @click="logout" href="#">Logout</b-dropdown-item>
                        </b-nav-item-dropdown>
                    </template>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex';

    export default {
        computed: {
            ...mapGetters("auth", {
                isAuthenticated: "isAuthenticated"
            })
        },
        methods: {
            logout(){

                let vm = this;

                this.$store
                    .dispatch("auth/logout")
                    .then((response) => {

                        if(vm.$route.name !== 'home')
                            vm.$router.push({name: "home"})
                    });
            },
        }
    }
</script>
<style>

</style>
