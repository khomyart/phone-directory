<template>
    <form @submit.prevent="$emit('submitForm', form, listOfFormFields)" class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label">Назва</label>
            <input class="form-control" v-model="form.name" id="name" placeholder="Повна назва виконавчого органу">
        </div>

        <div class="mb-3">
            <label for="identifierCode" class="form-label">Ідентифікаційний код</label>
            <input class="form-control" v-model="form.identifierCode" id="identifierCode" placeholder="ЄДРПОУ">
        </div>

        <div class="mb-3">
            <label for="locationDescription" class="form-label">Опис локації розміщення</label>
            <textarea class="form-control" v-model="form.locationDescription" id="locationDescription" rows="3"></textarea>
        </div>

        <div class="d-flex flex-row col-12 mb-3 p-0">
            <div class="col-6 pe-2">
                <label for="coordX" class="form-label">Координати (х)</label>
                <input class="form-control" v-model="form.coordX" id="coordX" placeholder="х">
            </div>
            <div class="col-6 ps-2">
                <label for="coordY" class="form-label">Координати (y)</label>
                <input class="form-control" v-model="form.coordY" id="coordY" placeholder="у">
            </div>
        </div>

        <div class="d-flex flex-row justify-content-between col-12 mb-3 p-0" style="text-align: center;">
            <span class="d-flex align-items-center">{{ telephoneLabel }}</span>
            <button type="button" class="btn btn-primary col-1 d-flex justify-content-center align-items-center p-1"
                    @click="createAdditionalPhoneNumberField">
                +
            </button>
        </div>
        <div id="phone_numbers_holder" class="mb-4">
            <phone-number-field v-for="index in amountOfPhoneNumberFields" :index="index" :key="index"
                @send-phone-number-field-values="receivePhoneNumberFieldValues"
                @remove-phone-number-field="removePhoneNumberField"></phone-number-field>
        </div>

        <div class="d-flex flex-row justify-content-between col-12 mb-3 p-0" style="text-align: center;">
            <span class="d-flex align-items-center">{{ emailLabel }}</span>
            <button type="button" class="btn btn-primary col-1 d-flex justify-content-center align-items-center p-1"
                    @click="createEmailField">
                +
            </button>
        </div>
        <div id="emails_holder" class="mb-4">
            <email-field v-for="index in amountOfEmailFields" :index="index" :key="index"
                 @remove-email-field="removeEmailField" @send-email-field-values="receiveEmailFieldValues"></email-field>
        </div>

        <button type="submit" :class="{'btn btn-primary mb-3' : !form.processing, 'btn btn-danger mb-3' : form.processing}"
                :disabled="form.processing">Створити</button>
    </form>

</template>

<script>
    import PhoneNumberField from "@/Components/forms/phoneNumberField";
    import EmailField from "@/Components/forms/EmailField";

    export default {
        name: "ExecutiveAuthority",

        components: {
            PhoneNumberField,
            EmailField,
        },

        data() {
            return {
                listOfFormFields: [
                    'name',
                    'identifierCode',
                    'locationDescription',
                    'coordX',
                    'coordY',
                    'phoneNumbers',
                    'emails'
                ],
                form: this.$inertia.form({
                    name: '',
                    identifierCode: '',
                    locationDescription: '',
                    coordX: '',
                    coordY: '',
                    phoneNumbers: [],
                    emails: [],
                }),
                amountOfPhoneNumberFields: [],
                amountOfEmailFields: []
            }
        },
        watch: {
        },
        methods: {
                /* Create components */
            createAdditionalPhoneNumberField() {
                let lastArrayIndex = this.amountOfPhoneNumberFields.length === 0
                    ? 0 : this.amountOfPhoneNumberFields[this.amountOfPhoneNumberFields.length - 1] + 1
                this.amountOfPhoneNumberFields.push(lastArrayIndex);
                this.form.phoneNumbers.push({});
            },
            createEmailField() {
                let lastArrayIndex = this.amountOfEmailFields.length === 0
                    ? 0 : this.amountOfEmailFields[this.amountOfEmailFields.length - 1] + 1
                this.amountOfEmailFields.push(lastArrayIndex);
                this.form.emails.push({});
                console.log(this.form.emails);
            },

                /* Receive data from components */
            receivePhoneNumberFieldValues(values, index) {
                let indexOfPhoneNumberField = this.amountOfPhoneNumberFields.indexOf(index);
                this.form.phoneNumbers[indexOfPhoneNumberField] = values;
            },
            receiveEmailFieldValues(values, index) {
                let indexOfEmailField = this.amountOfEmailFields.indexOf(index);
                this.form.emails[indexOfEmailField] = values;
                console.log(this.form)
            },

                /* Remove components */
            removePhoneNumberField(index) {
                let indexOfPhoneNumberField = this.amountOfPhoneNumberFields.indexOf(index);
                document.getElementById(`phone-number-field-${index}`).remove();
                this.amountOfPhoneNumberFields.splice(indexOfPhoneNumberField, 1);
                // indexOfPhoneNumberField = this.amountOfPhoneNumberFields.indexOf(index);
                this.form.phoneNumbers.splice(indexOfPhoneNumberField, 1);
            },
            removeEmailField(fieldNumber) {
                let indexOfEmailField = this.amountOfEmailFields.indexOf(fieldNumber);
                document.getElementById(`email-field-${fieldNumber}`).remove();
                this.amountOfEmailFields.splice(indexOfEmailField, 1)
                this.form.emails.splice(indexOfEmailField, 1);
                console.log(this.form.emails);
            }
        },
        computed: {
            telephoneLabel() {
                return this.amountOfPhoneNumberFields.length > 1 ? 'Телефони' : 'Телефон';
            },
            emailLabel() {
                return this.amountOfEmailFields.length > 1 ? 'Електронні пошти' : 'Електронна пошта';
            }
        },
        emits: [
            'submitForm'
        ],
    }
</script>

<style scoped>

</style>
