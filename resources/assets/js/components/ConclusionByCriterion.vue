<template>
    <div class="col-md-12">
        <form @submit.prevent="update ? updateConclusion() : createConclusion()">
            <div class="form-group">
                <label class="text-uppercase" for="">
                     {{ $t('observationsBySource.conlusion_by_criteria') }}
                </label>
                <label>N/A</label>
                <input type="checkbox" name="NA" value="NA" @click="NAfunction($event)">
                <textarea v-model="form.conclusion" class="form-control" name="" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <button v-show="update" type="submit" class="btn btn-primary btn-round"> {{ $t('observationsBySource.change_conclusion') }}</button>
                <button v-show="!update" type="submit" class="btn btn-primary btn-round">{{ $t('observationsBySource.conclusion_save') }}</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            conclusion: Object,
            update: Boolean,
            state: Number,
            ambit: Number,
            decision: Number,
            criterion: Number,
        },
        data: () => ({
            form: new Form({
                id: '',
                state_id: '',
                decision_id: '',
                ambit_id: '',
                criterion_id: '',
                conclusion: ''
            })
        }),
        methods: {
            updateConclusion(){
                this.$Progress.start();
                this.form.put('/api/criterion-conclusion/'+this.form.id)
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
                    this.form.conclusion = "N\/A";            
                }
                else{
                    this.form.conclusion = "";               
                }
                
            },
            createConclusion(){
                this.$Progress.start();

                this.form.state_id = this.$props.state;
                this.form.decision_id = this.$props.decision;
                this.form.ambit_id = this.$props.ambit;
                this.form.criterion_id = this.$props.criterion;

                this.form.post('/api/criterion-conclusion')
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
                this.form.fill(this.$props.conclusion);
            } else {
                this.form.reset();
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>