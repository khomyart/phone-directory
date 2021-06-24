<template>
    <div :id="`email-field-${indexOfEmailField}`" class="d-flex flex-column justify-content-start col-12 mb-3 p-0">
        <div class="d-flex flex-row justify-content-between col-12 mb-2 p-0">
            <div class="col-11 pe-2">
                <input type="text" class="form-control" v-model="values.input" :id="`emails.${index}.input`"
                      @input="$emit('sendEmailFieldValues', values, indexOfEmailField)">
                <div :id="`emails.${index}.inputFeedback`" class="invalid-feedback">
                </div>
            </div>
            <button type="button" class="btn btn-primary col-1 justify-content-center align-items-center p-1"
                  @click="$emit('removeEmailField', indexOfEmailField)" >
                -
            </button>
        </div>
        <div class="col-4 pe-2 d-flex justify-content-center align-items-center">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                    v-model="values.checkbox" @input="$emit('sendEmailFieldValues', values, indexOfEmailField)">
                <label class="form-check-label" for="flexSwitchCheckDefault">Основна</label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EmailField",

        props: {
            indexOfEmailField: Number,
            index: Number,
        },

        created() {
            if (this.indexOfEmailField === 0) this.values.checkbox = true
            this.$emit('sendEmailFieldValues', this.values, this.indexOfEmailField)
        },

        data: () => ({
            values: {
                input: '',
                checkbox: false,
            }
        }),
    }
</script>

<style scoped>

</style>
