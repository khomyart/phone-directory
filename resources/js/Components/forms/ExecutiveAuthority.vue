<template>

    <form @submit.prevent="$emit('submitForm', form)" class="col-12">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Назва</label>
            <input class="form-control" v-model="form.name" id="exampleFormControlInput1" placeholder="Повна назва виконавчого органу">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Ідентифікаційний код </label>
            <input class="form-control" v-model="form.identifierCode" id="exampleFormControlInput2" placeholder="ЄДРПОУ">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Опис локації розміщення</label>
            <textarea class="form-control" v-model="form.locationDescription" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="d-flex flex-row col-12 mb-3 p-0">
            <div class="col-6 pe-2">
                <label for="exampleFormControlInput3" class="form-label">Координати (х)</label>
                <input class="form-control" v-model="form.coordX" id="exampleFormControlInput3" placeholder="х">
            </div>
            <div class="col-6 ps-2">
                <label for="exampleFormControlInput4" class="form-label">Координати (y)</label>
                <input class="form-control" v-model="form.coordY" id="exampleFormControlInput4" placeholder="у">
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
                })
            }
        },
        methods: {
        },
        emits: [
            'submitForm'
        ]
    }
</script>

<style scoped>

</style>
