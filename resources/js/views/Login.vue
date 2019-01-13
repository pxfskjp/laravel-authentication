<template>
    <div id="loginForm" class="pt-5">
        <b-form @submit.prevent="signIn" class="mx-auto justify-content-center w-50 ">
            <b-form-group id="loginGroup"
                          horizontal
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
    export default {
        data: () => ({
            form: {
                    login: '',
                    password: ''
                }
        }),
        methods: {
            signIn(){
                this.$validator.validateAll().then((result) => {
                    if (result) {

                    }
                });
            }
        }
    }
</script>
<style>

</style>