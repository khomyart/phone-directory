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
        <button type="submit" :class="{'btn btn-primary mb-3' : !form.processing, 'btn btn-danger mb-3' : form.processing}"
                :disabled="form.processing">Створити</button>
    </form>

</template>

<script>
    export default {
        name: "ExecutiveAuthority",
        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    identifierCode: '',
                    locationDescription: '',
                    coordX: '',
                    coordY: '',
                }),
                listOfFormFields: [
                    'name',
                    'identifierCode',
                    'locationDescription',
                    'coordX',
                    'coordY'
                ]
            }
        },
        methods: {
        },
        emits: [
            'submitForm'
        ],
    }
</script>

<style scoped>

</style>
