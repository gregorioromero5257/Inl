<template>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h4 class="font-weight-bold">
                    <img src="/img/assets/icons_inl_sedes_icon.svg" alt="database" style="width:1.5rem;">
                    {{ $t('documentary_information.total_headquarter') }}
                </h4>
            </div>
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                      <!-- {{headquarter_evaluate}} -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="8%">{{ $t('documentary_information.options') }}</th>
                                        <th>{{ $t('documentary_information.headquarter_offices') }}</th>
                                        <th>{{ $t('documentary_information.municipalities_seat') }}</th>
                                        <th>{{ $t('documentary_information.number_prosecutors') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(hq, index) in headquarters" :key="hq.id">
                                        <td>&nbsp;
                                          <!-- <template v-if="allheadquarters == ''">
                                            <input type="checkbox" @click="addNewHeadquarters(hq)">
                                          </template>
                                          <template v-else>
                                            <template v-if="allheadquarters.name === headquarters[index].name">
                                              <input type="checkbox" checked @click="deleteHeadquarters()">
                                            </template>
                                            <template v-else>
                                              <input type="checkbox" disabled @click="addNewHeadquarters(hq)">
                                            </template>
                                          </template> -->
                                          <input type="checkbox" @click="addNewHeadquarters($event, headquarters[index].id)" v-model="headquarters[index].evaluate" :id="headquarters[index].id">

                                        </td>
                                        <td>
                                          <!-- :readonly="$gate.isINL()" -->
                                          <input  @keyup.enter="updateHeadquarter(hq)" @focus="auxHeadquarter(hq)" v-model="headquarters[index].name" type="text" class="form-control"></td>
                                        <td>
                                          <!-- :readonly="$gate.isINL()" -->
                                            <textarea

                                                @keyup.enter="updateHeadquarter(hq)"
                                                @focus="auxHeadquarter(hq)"
                                                v-model="headquarters[index].city_halls"
                                                class="form-control"
                                            ></textarea>
                                        </td>
                                        <td>
                                           <!-- :readonly="$gate.isINL()" -->
                                          <input @keyup.enter="updateHeadquarter(hq)" @focus="auxHeadquarter(hq)" v-model="headquarters[index].agents" type="number" class="form-control"></td>
                                        <td>
                                          <!-- v-if="!$gate.isINL()" -->
                                            <button  @click="deleteHeadquarter(hq, index)" class="btn btn-small btn-danger">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>N/A</td>
                                        <td>
                                          <!-- :readonly="$gate.isINL()" -->
                                          <input  v-model="headquarter.name" type="text" class="form-control"></td>
                                        <td>
                                          <!-- :readonly="$gate.isINL()" -->
                                            <textarea
                                                class="form-control"

                                                v-model="headquarter.city_halls"
                                            ></textarea>
                                        </td>
                                        <td>
                                          <!-- :readonly="$gate.isINL()"  -->
                                          <input v-model="headquarter.agents" type="number" class="form-control"></td>
                                        <td>
                                          <!-- v-if="!$gate.isINL()" -->
                                            <button  @click="addHeadquarter" class="btn btn-small btn-success">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
            headquarter_evaluate : '',
            headquarters: [],
            allheadquarters  : '',
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

                    axios.put('/api/all_headquarters/' + headquarter.id, headquarter).then(response => {
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
                axios.get('/api/all_headquarters?state=' + this.keyState).then(response => {
                    this.headquarters = response.data;
                    this.headquarter_evaluate = response.data.filter(evaluate => evaluate.evaluate == 1);

                }).catch(error => {});
                this.allheadquarters = '';
                axios.get('/api/headquarters-state/' + this.keyState).then(response => {
                    this.allheadquarters = response.data;
                }).catch(error => {});
            },

            addHeadquarter() {
                if (this.headquarter.name !== '' && this.headquarter.city_halls !== '') {
                    this.headquarter.state = this.keyState;
                    this.$Progress.start();

                    axios.post('/api/all_headquarters', this.headquarter).then(response => {
                        // this.headquarters.push(response.data);
                        this.getHeadquarters();
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
            addNewHeadquarters(e, id){
              if (e.target.checked == true) {
                if ((this.headquarter_evaluate).length > 0) {
                  toast({
                      type: 'warning',
                      title: 'Ya existe una sede a evaluar deselecione para continuar'
                  });
                  $('#' + id).prop("checked", false);
                }else {
                  this.headquarter_evaluate.push({'id' : id});
                  axios.get(`change-headquarter-observation/${id}&${this.$route.params.key}`).then(response => {
                    toast({
                        type: 'success',
                        title: 'Correcto !!!'
                    });
                  });
                }
              }else {
                this.headquarter_evaluate = [];

              }
            },
            // addNewHeadquarters(hq){
            //   if (this.allheadquarters != '') {
            //     toast({
            //         type: 'warning',
            //         title: 'Solo se puede seleccionar una sede'
            //     })
            //   }else {
            //     axios.post('/api/headquarters',{
            //       state : this.keyState,
            //       name : hq.name,
            //       city_halls : hq.city_halls,
            //       agents : hq.agents
            //     }).then(response => {
            //       toast({
            //           type: 'success',
            //           title: 'Registrado'
            //       });
            //       this.$router.push(`/state/${this.$route.params.key}/documentary-information`);
            //
            //     }).catch(e => {
            //       toast({
            //           type: 'error',
            //           title: 'Error'
            //       })
            //     });
            //   }
            // },
            // deleteHeadquarters(){
            //   axios.get('/api/headquarters-delete/' + this.allheadquarters.id).then(response => {
            //     this.$router.push(`/state/${this.$route.params.key}/documentary-information`);
            //     this.getHeadquarters();
            //   }).catch(e =>{
            //     toast({
            //         type: 'error',
            //         title: 'Error'
            //     })
            //   });
            // },
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

                        axios.delete('/api/all_headquarters/' + headquarter.id).then(response => {
                            this.$Progress.finish();
                            this.headquarters.splice(index, 1);
                            window.swal.fire(
                                'Eliminada',
                                'La sedeha sido eliminada',
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
        created() {
          this.getHeadquarters();
        }
    }
</script>

<style lang="scss" scoped>

</style>
