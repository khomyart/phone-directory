<template>
    <div class="container-fluid d-flex justify-content-center align-items-center flex-column p-0" style="height: 100vh">
        <div class="col-12 d-flex justify-content-center align-items-center" style="height: 10%">
            {{ $page.props.auth.role }}
        </div>
        <div class="row col-12 d-flex flex-row" style="height: 80%">
            <div class="col-8 d-flex justify-content-center p-4" >
                <ul>
                    <li v-for="executiveAuthority in $page.props.executiveAuthorities" :key="executiveAuthority.id">
                        {{ executiveAuthority.name }}
                    </li>
                </ul>
            </div>
            <div class="col-4 d-flex justify-content-center align-items-center p-4" >
                <component :is="currentComponent" @submit-form="submit"></component>
<!--                <executive-authority-form @submit-form="submit"></executive-authority-form>-->
            </div>
        </div>
        <div class="col-12 d-flex justify-content-center align-items-center" style="height: 10%">
            2021
        </div>
    </div>
</template>

<script>
    import Authenticated from "@/Layouts/Authenticated";
    import ExecutiveAuthorityForm from "@/Components/forms/ExecutiveAuthority";
    export default {
        name: "Control",

        components: {
            Authenticated,
            ExecutiveAuthorityForm,
        },

        props: {
            auth: Object,
            executiveAuthorities: Object,
        },

        data() {
            return {
                currentComponent: 'ExecutiveAuthorityForm'
            }
        },

        methods: {
            submit(form, listOfFields) {
                form.post(this.route('control'), {
                    onSuccess: () => {
                        //resets form's fields depends on it names
                        listOfFields.forEach((el)=>{
                            form.reset(el);
                        })
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>
