<template>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <h4 class="font-weight-bold">
                            <img src="/img/assets/icons_inl_sedes_icon.svg" alt="database" style="width:1.5rem;">
                            {{ $t('documentary_information.headquarter') }}
                        </h4>
                    </div>
                </div>
                <div class="row mt-3 mb-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <col width="40">
                                        <col>
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th>ID</th>
                                                <th>{{ $t('documentary_information.ago_region') }}</th>
                                                <!-- <th>Municipios por sede</th>
                                                <th>No. de agentes del ministerio público por sede</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(hq, index) in headquarters" :key="hq.id">
                                                <td>
                                                    {{ hq.id }}
                                                </td>
                                                <td>
                                                  <!-- :readonly="$gate.isINL()" -->
                                                    <input

                                                        v-on:blur="updateHeadquarter(hq)"
                                                        v-on:focus="auxHeadquarter(hq)"
                                                        v-model="headquarters[index].name"
                                                        type="text"
                                                        class="form-control"
                                                    >
                                                </td>
                                                <!-- <td><input :readonly="$gate.isINL()" v-on:blur="updateHeadquarter(hq)" v-on:focus="auxHeadquarter(hq)" v-model="headquarters[index].city_halls" type="text" class="form-control"></td>
                                                <td><input :readonly="$gate.isINL()" v-on:blur="updateHeadquarter(hq)" v-on:focus="auxHeadquarter(hq)" v-model="headquarters[index].agents" type="number" class="form-control"></td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["keyState"],
        data: () => ({
            headquarters: [],
            headquarter_aux : null,
            headquarter: {
                name: '',
                city_halls: '',
                agents: 0,
                state: ''
            }
        }),
        methods: {
            auxHeadquarter(headquarter) {
                this.headquarter_aux = Object.assign({}, headquarter);
            },
            isDirty(headquarter) {
                return headquarter.name !== this.headquarter_aux.name
                || headquarter.city_halls !== this.headquarter_aux.city_halls
                || headquarter.agents !== this.headquarter_aux.agents;
            },
            updateHeadquarter(headquarter) {
                if(!this.isDirty(headquarter))
                    return false;
                if (headquarter.name !== '' && headquarter.city_halls !== '') {
                    this.$Progress.start();

                    axios.put('/api/headquarters/' + headquarter.id, headquarter).then(response => {
                        this.$Progress.finish();
                        toast({
                            type: 'success',
                            title: '¡Información de sede actualizada!'
                        });
                        this.headquarter_aux = null;
                    }).catch(error => {
                        this.$Progress.fail();
                        toast({
                            type: 'error',
                            title: 'Try again!'
                        })
                    });


                } else {
                    toast({
                        type: 'error',
                        title: 'Completa todos los campos'
                    })
                }
            },
            getHeadquarters() {
                axios.get('/api/headquarters?state=' + this.keyState).then(response => {
                    this.headquarters = response.data;
                }).catch(error => {});
            },
            addHeadquarter() {
                if (this.headquarter.name !== '' && this.headquarter.city_halls !== '') {
                    this.headquarter.state = this.keyState;
                    this.$Progress.start();

                    axios.post('/api/headquarters', this.headquarter).then(response => {
                        this.headquarters.push(response.data);
                        this.$Progress.finish();
                        this.headquarter = {
                            name: '',
                            city_halls: '',
                            agents: 0,
                            state: ''
                        };
                        toast({
                            type: 'success',
                            title: 'Sede creada'
                        })
                    }).catch(error => {
                        this.$Progress.fail();
                        toast({
                            type: 'error',
                            title: 'Try again!'
                        })
                    });

                } else {
                    toast({
                        type: 'error',
                        title: 'Completa todos los campos'
                    })
                }
            },
            deleteHeadquarter(headquarter, index) {
                window.swal({
                    title: '¿Eliminar sede?',
                    text: "¡No podrás revertir esto!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.value) {
                        this.$Progress.start();

                        axios.delete('/api/headquarters/' + headquarter.id).then(response => {
                            this.$Progress.finish();
                            this.headquarters.splice(index, 1);
                            window.swal.fire(
                                'Eliminada',
                                'La sede ha sido eliminada',
                                'success'
                            )
                        }).catch(error => {
                            this.$Progress.fail();
                            toast({
                                type: 'error',
                                title: 'Vuelve a intentar'
                            })
                        });


                    }
                });
            }
        },
        created(){

            const languaje = localStorage.getItem("languaje");
            this.$i18n.locale = languaje;
        },

        mounted() {
            this.getHeadquarters();
            // this.getAllHeadquarters();
        }
    }
</script>

<style lang="scss" scoped>

</style>
