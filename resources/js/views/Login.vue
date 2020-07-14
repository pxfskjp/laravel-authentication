<template>
    <div id="loginForm" class="pt-5">
        <ValidationObserver ref="form" v-slot="{ invalid }">
            <b-form v-on:submit.prevent="signIn(form.identity,form.password)"
                    class="mx-auto justify-content-center w-50 ">

                <b-form-group id="loginErrors" class="errorsBlock"
                              v-show="loginErrors.length > 0">
                    <ul v-for="error in loginErrors">
                        <li>
                            {{ error.message }}
                        </li>
                    </ul>
                </b-form-group>

                <b-form-group id="loginGroup"
                              horizontal
                              label="Login: "
                              label-for="login">
                    <ValidationProvider placeholder="Login"
                                        name="Login"
                                        rules="required|alpha_num|min:3|max:254"
                                        v-slot="{ errors }">
                        <b-form-input id="login"
                                      type="text"
                                      v-model="form.identity"/>
                        <b-form-row class="text-danger">
                            <template v-show="errors.length > 0">
                                <i class="fa fa-warning"></i>
                                <span class="help is-danger">
                                    {{ errors[0] }}
                                </span>
                            </template>
                        </b-form-row>
                    </ValidationProvider>
                </b-form-group>

                <b-form-group id="passwordGroup"
                              horizontal
                              label="Password:"
                              label-for="password">
                    <ValidationProvider name="Password"
                                        rules="required|alpha_num|min:8|max:36"
                                        v-slot="{ errors }">
                        <b-form-input id="password"
                                      type="password"
                                      v-model="form.password"/>
                        <b-form-row class="text-danger">
                            <template v-show="errors.length > 0">
                                <i class="fa fa-warning"></i>
                                <span class="help is-danger">
                                    {{ errors[0]}}
                                </span>
                            </template>
                        </b-form-row>
                    </ValidationProvider>

                </b-form-group>

                <b-form-group class="text-center">
                    <b-button :disabled="invalid"
                              type="submit"
                              variant="primary">Sign-in
                    </b-button>
                </b-form-group>
            </b-form>
        </ValidationObserver>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex';
    import {ValidationObserver, ValidationProvider} from "vee-validate";

    export default {
        components: {
            ValidationObserver,
            ValidationProvider
        },
        data() {
            return {
                form: {
                    identity: '',
                    password: ''
                }
            }
        },
        computed: {
            ...mapGetters("auth", {
                loginErrors: "getLoginErrors"
            })
        },
        methods: {
            signIn() {

                this.$store
                    .dispatch("auth/login", {
                        login: this.form.identity,
                        password: this.form.password
                    })
                    .then(() => this.$router.push({name: "home"}));
            }
        }
    }
</script>
<style>

</style>
