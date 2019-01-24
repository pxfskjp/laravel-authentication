<template>
    <div id="loginForm" class="pt-5">
        <b-form v-on:submit.prevent="signIn(form.identity,form.password)"
                class="mx-auto justify-content-center w-50 ">
            <b-form-group id="loginErrors" class="errorsBlock"
                          v-show="containsErrors()">
                <ul v-for="error in getErrors()">
                    <li>
                        {{ error.message }}
                    </li>
                </ul>
            </b-form-group>
            <b-form-group id="loginGroup"
                          horizontal
                          label="Login: "
                          label-for="login">
                <b-form-input id="login"
                              name="login"
                              type="text"
                              v-model="form.identity"
                              v-validate="'required'"/>
                <b-form-row class="text-danger">
                    <i v-show="errors.has('login')" class="fa fa-warning"></i>
                    <span v-show="errors.has('login')" class="help is-danger">
                        {{ errors.first('login') }}
                    </span>
                </b-form-row>
            </b-form-group>
            <b-form-group id="passwordGroup"
                          horizontal
                          label="Password:"
                          label-for="password">
                <b-form-input id="password"
                              name="password"
                              type="password"
                              v-model="form.password"
                              v-validate="'required|min:8|max:36'"/>
                <b-form-row class="text-danger">
                    <i v-show="errors.has('password')" class="fa fa-warning"></i>
                    <span v-show="errors.has('password')" class="help is-danger">
                        {{ errors.first('password') }}
                    </span>
                </b-form-row>
            </b-form-group>
            <b-form-group class="text-center">
                <b-button type="submit" variant="primary">Sign-in</b-button>
            </b-form-group>
        </b-form>
    </div>
</template>
<script>
    import { LOGIN } from "../store/actions.type";

    export default {
        data: () => ({
            form: {
                    identity: '',
                    password: ''
                }
        }),
        methods: {
            getErrors(){
                return this.$store.getters.getErrors.login;
            },
            containsErrors(){
                console.log(this.$store.getters.getErrors.login.length > 0);
              return this.$store.getters.getErrors.login.length > 0;
            },
            signIn(identity, password){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.$store
                            .dispatch(LOGIN, {identity, password})
                            .then(() => this.$router.push({name: "home"}));
                    }
                });
            }
        }
    }
</script>
<style>

</style>