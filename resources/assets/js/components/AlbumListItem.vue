<template>
    <li class="album-item">{{ album }}</li>
</template>

<script>
    export default {
        data() {
            return {
                album: 'Test Album'
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
