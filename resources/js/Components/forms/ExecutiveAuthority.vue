<template>
    <form @submit.prevent="$emit('submitForm', form, listOfFormFields)" class="col-12">
        <div class="mb-3">
            <label for="name" class="form-label">Назва</label>
            <input class="form-control" v-model="form.name" id="name" placeholder="Повна назва виконавчого органу">
            <div id="nameFeedback" class="invalid-feedback">
            </div>
        </div>

        <div class="mb-3">
            <label for="locationDescription" class="form-label">Опис локації розміщення</label>
            <textarea class="form-control" v-model="form.locationDescription" id="locationDescription" rows="3"></textarea>
            <div id="locationDescriptionFeedback" class="invalid-feedback">
            </div>
        </div>

        <div class="accordion" id="accordionAdditionalParams">
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="accordionAdditionalParamsHeading">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#additionalParamsCollapse" aria-expanded="false"
                            aria-controls="additionalParamsCollapse">
                        Додаткові параметри:
                    </button>
                </h2>
                <div id="additionalParamsCollapse" class="accordion-collapse collapse" aria-labelledby="accordionAdditionalParamsHeading"
                     data-bs-parent="#accordionAdditionalParams">
                    <div class="accordion-body">

                        <div class="mb-3">
                            <label for="identifierCode" class="form-label">Ідентифікаційний код</label>
                            <input class="form-control" v-model="form.identifierCode" id="identifierCode" placeholder="ЄДРПОУ">
                            <div id="identifierCodeFeedback" class="invalid-feedback">
                            </div>
                        </div>

                        <div class="d-flex flex-row col-12 mb-3 p-0">
                            <div class="col-12">
                                <label for="coordinates" class="form-label">Координати</label>
                                <input class="form-control" v-model="form.coordinates" id="coordinates" placeholder="123.142312, 143.123123">
                                <div id="coordinatesFeedback" class="invalid-feedback">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-between col-12 mb-3 p-0" style="text-align: center;">
            <span class="d-flex align-items-center">{{ telephoneLabel }}</span>
            <button type="button" class="btn btn-primary col-1 d-flex justify-content-center align-items-center p-1"
                    @click="createAdditionalPhoneNumberField">
                +
            </button>
        </div>
            <div id="phone_numbers_holder" class="mb-4 list-holder">
                <transition-group name="list" tag="div">
                    <phone-number-field v-for="(indexOfPhoneNumberField, key) in indexesOfPhoneNumberFields"
                                        :indexOfPhoneNumberField="indexOfPhoneNumberField" :key="indexOfPhoneNumberField"
                                        :index="key" @send-phone-number-field-values="receivePhoneNumberFieldValues"
                                        @remove-phone-number-field="removePhoneNumberField" class="list-item">
                    </phone-number-field>
                </transition-group>

            </div>

        <div class="d-flex flex-row justify-content-between col-12 mb-3 p-0" style="text-align: center;">
            <span class="d-flex align-items-center">{{ emailLabel }}</span>
            <button type="button" class="btn btn-primary col-1 d-flex justify-content-center align-items-center p-1"
                    @click="createEmailField">
                +
            </button>
        </div>
        <div id="emails_holder" class="mb-4 list-holder">
            <transition-group name="list" tag="div">
                <email-field v-for="(indexOfEmailField, key) in indexesOfEmailFields"
                             :indexOfEmailField="indexOfEmailField" :index="key" :key="indexOfEmailField"
                             @remove-email-field="removeEmailField"
                             @send-email-field-values="receiveEmailFieldValues" class="list-item">
                </email-field>
            </transition-group>
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

        props: {
            isFormSuccessfullySubmitted: Boolean,
        },

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
                    'coordinates',
                    'phoneNumbers',
                    'emails',
                ],
                form: this.$inertia.form({
                    name: '',
                    identifierCode: '',
                    locationDescription: '',
                    coordinates: '',
                    phoneNumbers: [],
                    emails: [],
                }),
                indexesOfPhoneNumberFields: [],
                indexesOfEmailFields: []
            }
        },
        watch: {
            isFormSuccessfullySubmitted(val, oldVal) {
                if (oldVal === false && val === true) {
                    // since form has been successfully submitted and form object has been reset,
                    // we are clearing array witch represents email and phone fields
                    // to remove all those fields
                    this.indexesOfPhoneNumberFields = [];
                    this.indexesOfEmailFields = [];

                    //returning boolean flag into default position
                    this.$emit('update:isFormSuccessfullySubmitted', false);
                }
            }
        },
        methods: {

                /* Create components */
            createAdditionalPhoneNumberField() {
                let lastArrayIndex = this.indexesOfPhoneNumberFields.length === 0
                    ? 0 : this.indexesOfPhoneNumberFields[this.indexesOfPhoneNumberFields.length - 1] + 1
                this.indexesOfPhoneNumberFields.push(lastArrayIndex);
                this.form.phoneNumbers.push({});
            },
            createEmailField() {
                let lastArrayIndex = this.indexesOfEmailFields.length === 0
                    ? 0 : this.indexesOfEmailFields[this.indexesOfEmailFields.length - 1] + 1
                this.indexesOfEmailFields.push(lastArrayIndex);
                this.form.emails.push({});
            },

                /* Receive data from components */
            receivePhoneNumberFieldValues(values, index) {
                let indexOfPhoneNumberField = this.indexesOfPhoneNumberFields.indexOf(index);
                this.form.phoneNumbers[indexOfPhoneNumberField] = values;
            },
            receiveEmailFieldValues(values, index) {
                let indexOfEmailField = this.indexesOfEmailFields.indexOf(index);
                this.form.emails[indexOfEmailField] = values;
            },

                /* Remove components */
            removePhoneNumberField(index) {
                let indexOfPhoneNumberField = this.indexesOfPhoneNumberFields.indexOf(index);
                // document.getElementById(`phone-number-field-${index}`).remove();
                this.indexesOfPhoneNumberFields.splice(indexOfPhoneNumberField, 1);
                this.form.phoneNumbers.splice(indexOfPhoneNumberField, 1);
            },
            removeEmailField(fieldNumber) {
                let indexOfEmailField = this.indexesOfEmailFields.indexOf(fieldNumber);
                // document.getElementById(`email-field-${fieldNumber}`).remove();
                this.indexesOfEmailFields.splice(indexOfEmailField, 1)
                this.form.emails.splice(indexOfEmailField, 1);
            }
        },
        computed: {
            telephoneLabel() {
                return this.indexesOfPhoneNumberFields.length > 1 ? 'Телефони' : 'Телефон';
            },
            emailLabel() {
                return this.indexesOfEmailFields.length > 1 ? 'Електронні скринькі' : 'Електронна скринька';
            }
        },
        emits: [
            'submitForm',
            'update:isFormSuccessfullySubmitted',
        ],
    }
</script>

<style scoped>
    .list-holder {
        position: relative;
    }

    .list-item {
        transition: all 0.5s ease;
    }

    .list-enter-from {
        opacity: 0;
        transform: scale(0.9);
    }

    .list-leave-to {
        /*opacity: 0;*/
        /*transform: scale(0.95);*/
        transition: all 0s ease;
    }

    .list-leave-active {
        /*position: absolute;*/
    }
</style>
