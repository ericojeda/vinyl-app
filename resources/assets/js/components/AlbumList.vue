<template>
    <div class="album-list">
        <h3>{{ artist }}</h3>
        <ul>
            <album-list-item></album-list-item>
        </ul>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
