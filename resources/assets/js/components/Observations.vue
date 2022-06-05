<template>
    <div class="row">
        <observation
            v-for="obs in observations" 
            :key="obs.id"
            v-show="obs.criterion_id == criterion && obs.source_id == source && obs.headquarter_id == headquarter"
            :observation="obs"
            :update="update"
        />
    </div>
</template>

<script>
    export default {
        props: {
            observations: Array,
            headquarter: Number,
            criterion: Number,
            source: Number,
            update: Boolean
        },
    }
</script>

<style lang="scss" scoped>

</style>