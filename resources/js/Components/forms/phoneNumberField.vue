<template>
    <div :id="`phone-number-field-${indexOfPhoneNumberField}`" class="d-flex flex-row justify-content-between col-12 mb-3 p-0">
        <div class="col-7 pe-2">
            <input type="text" v-model="values.input" class="form-control" :id="`phoneNumbers.${index}.input`"
                   @input="$emit('sendPhoneNumberFieldValues', values, indexOfPhoneNumberField)">
            <div :id="`phoneNumbers.${index}.inputFeedback`" class="invalid-feedback">
            </div>
        </div>
        <div class="col-4 pe-2">
            <select v-model="values.selection" class="form-select"
                    @input="$emit('sendPhoneNumberFieldValues', values, indexOfPhoneNumberField)">
                <option value="stationary">Стац.</option>
                <option value="mobile">Моб.</option>
                <option value="Fax">Факс</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary col-1 justify-content-center align-items-center p-1"
                @click="$emit('removePhoneNumberField', indexOfPhoneNumberField)">
            -
        </button>
    </div>
</template>

<script>
    export default {
        name: "phoneNumberField",

        props: {
            indexOfPhoneNumberField: Number,
            index: Number,
        },

        created() {
            this.$emit('sendPhoneNumberFieldValues', this.values, this.indexOfPhoneNumberField)
        },

        data() {
            return {
                values: {
                    input: '',
                    selection: 'stationary',
                }
            }
        },

        methods: {
        },

        emits: [
            'sendPhoneNumberFieldValues',
            'removePhoneNumberField'
        ]
    }
</script>

<style scoped>

</style>
