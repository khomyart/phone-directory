<template>
    <div :id="`phone-number-field-${index}`" class="d-flex flex-row justify-content-between col-12 mb-3 p-0">
        <div class="col-7 pe-2">
            <input type="text" v-model="values.input" class="form-control"
                   @input="$emit('sendPhoneNumberFieldValues', values, index)">
        </div>
        <div class="col-4 pe-2">
            <select v-model="values.selection" class="form-select"
                    @input="$emit('sendPhoneNumberFieldValues', values, index)">
                <option value="stationary">Стац.</option>
                <option value="mobile">Моб.</option>
                <option value="Fax">Факс</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary col-1 justify-content-center align-items-center p-1"
                @click="$emit('removePhoneNumberField', index)">
            -
        </button>
    </div>
</template>

<script>
    export default {
        name: "phoneNumberField",

        props: {
            index: Number,
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
