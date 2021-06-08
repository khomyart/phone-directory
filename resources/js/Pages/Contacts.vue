<template>
    <div>
        <ul>
            <li v-for="user in $page.props.users"> {{ user.name }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Contacts",

        props: {
            users: Object,
        },

        data() {
            return {

            }
        },
    }
</script>

<style scoped>

</style>
