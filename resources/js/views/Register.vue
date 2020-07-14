<template>
    <div id="loginForm" class="pt-5">
        <ValidationObserver ref="form" v-slot="{ invalid }">
            <b-form v-on:submit.prevent="signUp"
                    class="mx-auto justify-content-center w-50 ">
                <b-form-group id="registerErrors" class="errorsBlock"
                              v-show="registrationErrors.length > 0">
                    <ul>
                        <li v-for="error in registrationErrors">
                            {{ error.message }}
                        </li>
                    </ul>
                </b-form-group>

                <b-form-group horizontal
                              label="Login: "
                              label-for="login">
                    <ValidationProvider placeholder="Login"
                                        name="Login"
                                        rules="required|alpha_num|min:3|max:60"
                                        v-slot="{ errors }">

                        <b-form-input id="login"
                                      type="text"
                                      v-model="form.login"/>
                        <template v-show="errors.length > 0">
                            <b-form-row class="text-danger">
                                <i class="fa fa-warning"></i>
                                <span class="help is-danger">
                                    {{ errors[0] }}
                                </span>
                            </b-form-row>
                        </template>
                    </ValidationProvider>
                </b-form-group>

                <b-form-group horizontal
                              label="Email: "
                              label-for="email">
                    <ValidationProvider placeholder="Email"
                                        name="Email"
                                        rules="required|email"
                                        v-slot="{ errors }">
                        <b-form-input id="email"
                                      type="text"
                                      v-model="form.email"/>
                        <template v-show="errors.length > 0">
                            <b-form-row class="text-danger">
                                <i class="fa fa-warning"></i>
                                <span class="help is-danger">
                                    {{ errors[0] }}
                                </span>
                            </b-form-row>
                        </template>
                    </ValidationProvider>
                </b-form-group>

                <b-form-group horizontal
                              label="Password:"
                              label-for="password">
                    <ValidationProvider
                        name="Password"
                        rules="required|alpha_num|min:8|max:36|confirmed:password_confirmation"
                        v-slot="{ errors }">
                        <b-form-input id="password"
                                      type="password"
                                      v-model="form.password"
                                      ref="password"/>
                        <template v-show="errors.length > 0">
                            <b-form-row class="text-danger">
                                <i class="fa fa-warning"></i>
                                <span class="help is-danger">
                                    {{ errors[0]}}
                                </span>
                            </b-form-row>
                        </template>

                    </ValidationProvider>
                </b-form-group>
                <b-form-group horizontal
                              label="Confirm your password:"
                              label-for="password">
                    <ValidationProvider
                        name="PasswordConfirmation"
                        v-slot="{ errors }"
                        vid="password_confirmation">
                        <b-form-input id="confirmPassword"
                                      name="password_confirmation"
                                      type="password"
                                      v-model="form.password_confirmation"/>
                        <template v-show="errors.length > 0">
                            <b-form-row class="text-danger">
                                <i class="fa fa-warning"></i>
                                <span class="help is-danger">
                                    {{ errors[0] }}
                                </span>
                            </b-form-row>
                        </template>

                    </ValidationProvider>
                </b-form-group>
                <b-form-group class="text-center">
                    <b-button :disabled="invalid"
                              type="submit"
                              variant="success">Sign-up now!</b-button>
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
            ValidationProvider,
        },
        data() {
            return {
                form: {
                    login: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                }
            }
        },
        computed: {
            ...mapGetters("auth", {
                registrationErrors: "getRegistrationErrors"
            }),
        },
        methods: {
            signUp() {

                this.$store
                    .dispatch("auth/register", this.form)
                    .then(() => this.$router.push({name: "home"}));
            }
        }
    }
</script>
<style>

</style>
