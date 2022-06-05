<template>
    <div class="col-md-12">

        <form @submit.prevent="update ? updateObservation() : createObservation()">
            <div class="form-group">
                <label>N/A</label>
                <input type="checkbox" name="NA" value="NA" @click="NAfunction($event)">
                <!-- :readonly="$gate.isINL()"  -->
                <textarea v-model="form.observation" name="" id="" class="form-control"></textarea>
            </div>
            <!-- v-if="!$gate.isINL()" -->
            <div class="form-group" >
                <button v-show="update" type="submit" class="btn btn-primary btn-round">{{ $t('observationsBySource.update_observation') }}</button>
                <button v-show="!update" type="submit" class="btn btn-primary btn-round"> {{ $t('observationsBySource.observation_save') }}</button>
            </div>
        </form>

    </div>
</template>

<script>
    export default {
        props: {
            observation: Object,
            update: Boolean,
            headquarter: Number,
            criterion: Number,
            source: Number,
            state: Number,
            decision: Number,
            ambit: Number
        },
        data: () =>({
            form: new Form({
                id: '',
                state_id: '',
                headquarter_id: '',
                decision_id: '',
                ambit_id: '',
                criterion_id: '',
                source_id: '',
                observation: ''
            })
        }),
        methods: {
            updateObservation(){
                this.$Progress.start();
                this.form.put('/api/observation/'+this.form.id)
                .then(() => {
                    swal(
                    '¡Actualizado!',
                    'Datos actualizados.',
                    'success'
                    )
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                }).catch(() => {
                    this.$Progress.fail();
                });
            },
            NAfunction(event){
                if ($(event.target).is(":checked")) {
                    this.form.observation = "N\/A";
                }
                else{
                    this.form.observation = "";
                }

            },
            createObservation(){
                this.$Progress.start();

                this.form.state_id = this.$props.state;
                this.form.headquarter_id = this.$props.headquarter;
                this.form.decision_id = this.$props.decision;
                this.form.ambit_id = this.$props.ambit;
                this.form.criterion_id = this.$props.criterion;
                this.form.source_id = this.$props.source;

                this.form.post('/api/observation')
                .then(()=>{
                    toast({
                    type: 'success',
                    title: 'Creada correctamente'
                    })
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(()=>{
                    toast({
                    type: 'error',
                    title: 'Error al cargar los datos'
                    })
                    this.$Progress.fail();
                })
            }
        },
        created(){
            const languaje = localStorage.getItem("languaje");
            this.$i18n.locale = languaje;
            if(this.$props.update == true) {
                this.form.fill(this.$props.observation);
            } else {
                this.form.reset();
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
