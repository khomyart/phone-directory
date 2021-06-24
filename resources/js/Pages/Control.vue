<template>
    <div class="container-fluid d-flex justify-content-center align-items-center flex-column p-0" style="height: 100vh">
        <div class="col-12 d-flex justify-content-center align-items-center" style="height: 10%">
            {{ $page.props.auth.role }}
        </div>
        <div class="row col-12 col-xxl-8 d-flex flex-row" style="height: 80%">
            <div class="col-8 d-flex justify-content-center p-4 content-holder">
                <ul>
                    <li v-for="executiveAuthority in $page.props.executiveAuthorities" :key="executiveAuthority.id">
                        {{ executiveAuthority.name }}
                    </li>
                </ul>
            </div>
            <div class="col-4 d-flex justify-content-center align-items-start p-4 forms-holder">
                <component :is="currentComponent" @submit-form="submit"
                          v-model:isFormSuccessfullySubmitted = "isFormSuccessfullySubmitted"></component>
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
                currentComponent: 'ExecutiveAuthorityForm',
                isFormSuccessfullySubmitted: false,
            }
        },

        watch: {
            isFormSuccessfullySubmitted(val, oldVal) {
                console.log(`showingChange of ${oldVal} to ${val}`)
            }
        },

        methods: {
            submit(form, listOfFields) {
                form.post(this.route('control'), {
                    onSuccess: () => {
                        listOfFields.forEach((el)=>{ form.reset(el) })
                        this.isFormSuccessfullySubmitted = true;
                    },
                    onError: (errors) => {
                        this.showErrors(errors)
                    }
                })
            },
            showErrors(errors) {
                Object.keys(errors).forEach((el)=>{
                    document.getElementById(el).classList.add('is-invalid');
                    document.getElementById(`${el}Feedback`).innerText = errors[el];
                })
            }
        }
    }
</script>

<style scoped>
    .content-holder {
        min-height: 100%;
        max-height: 100%;
        overflow-y: scroll;
    }

    .forms-holder {
        min-height: 100%;
        max-height: 100%;
        overflow-y: scroll;
    }
</style>
