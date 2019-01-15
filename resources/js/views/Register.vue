<template>
    <div id="loginForm" class="pt-5">
        <b-form v-on:submit.prevent="signUp" class="mx-auto justify-content-center w-50 ">
            <b-form-group horizontal
                          label="Login: "
                          label-for="login">
                <b-form-input id="login"
                              name="login"
                              type="text"
                              v-model="form.login"
                              v-validate="'required|min:3|max:60'"/>
                <b-form-row class="text-danger">
                    <i v-show="errors.has('login')" class="fa fa-warning"></i>
                    <span v-show="errors.has('login')" class="help is-danger">
                        {{ errors.first('login') }}
                    </span>
                </b-form-row>
            </b-form-group>
            <b-form-group horizontal
                          label="Email: "
                          label-for="login">
                <b-form-input id="email"
                              name="email"
                              type="text"
                              v-model="form.email"
                              v-validate="'required|email'"/>
                <b-form-row class="text-danger">
                    <i v-show="errors.has('email')" class="fa fa-warning"></i>
                    <span v-show="errors.has('email')" class="help is-danger">
                        {{ errors.first('email') }}
                    </span>
                </b-form-row>
            </b-form-group>
            <b-form-group horizontal
                          label="Password:"
                          label-for="password">
                <b-form-input id="password"
                              name="password"
                              type="password"
                              v-model="form.password"
                              v-validate="'required|min:8|max:36'"
                              ref="password"/>
                <b-form-row class="text-danger">
                    <i v-show="errors.has('password')" class="fa fa-warning"></i>
                    <span v-show="errors.has('password')" class="help is-danger">
                        {{ errors.first('password') }}
                    </span>
                </b-form-row>
            </b-form-group>
            <b-form-group horizontal
                          label="Confirm your password:"
                          label-for="password">
                <b-form-input id="confirmPassword"
                              name="password_confirmation"
                              type="password"
                              v-model="form.password_confirmation"
                              v-validate="'required|confirmed:password'"/>
                <b-form-row class="text-danger">
                    <i v-show="errors.has('password_confirmation')" class="fa fa-warning"></i>
                    <span v-show="errors.has('password_confirmation')" class="help is-danger">
                        {{ errors.first('password_confirmation') }}
                    </span>
                </b-form-row>
            </b-form-group>
            <b-form-group class="text-center">
                <b-button type="submit" variant="success">Sign-up now!</b-button>
            </b-form-group>
        </b-form>

    </div>
</template>
<script>
    import { REGISTER } from "../store/actions.type";

    export default {
        data: () => ({
            form: {
                login: '',
                email: '',
                password: '',
                password_confirmation:''
            }
        }),
        methods: {
            signUp(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        console.log('Registration attempt.');
                        this.$store
                            .dispatch(REGISTER, this.form)
                            .then(() => this.$router.push({ name: "home" }));
                    } else {
                        console.log('validation is incorrect');
                    }
                });
            }
        }
    }
</script>
<style>

</style>