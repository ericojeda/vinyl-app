<template>
    <ul>
        <li v-for="(folder) in info" :key="folder.id">{{folder.name}}</li>
    </ul>
</template>

<script>
    export default {
        data() {
            return {
                info: null
            }
        },
        mounted() {
            axios
                .get('/folders')
                .then(response => (this.info = response.data.data))
        }
    }
</script>
