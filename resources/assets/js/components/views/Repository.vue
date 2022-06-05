<template>
    <div class="repository container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <router-link to="/home" class="text-secondary">
                                    {{ $t('breadcrumb.state') }}
                                </router-link>
                            </li>
                            <li class="breadcrumb-item">
                              <router-link to="/home" class="text-secondary">
                                {{ $t('breadcrumb.round') }} {{state_selected.round}}
                              </router-link>
                            </li>
                            <li class="breadcrumb-item">
                                <router-link :to="`/state/${$route.params.key}`" class="text-secondary">
                                    {{ state_selected.name }}
                                </router-link>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="font-weight-bold text-dark">
                                    {{ $t('repository.title') }}
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a @click="downloadZip" class="pointer font-weight-bold repo-link">
                            <img class="" src="/img/assets/zip_icon.svg" alt="zip" style="width:1.3rem; margin-bottom: 0.3rem;">
                            <span class="d-none d-md-inline-block">{{ $t('repository.zip') }}</span>
                        </a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="row">
            <div class="col-md-12 mb-4">
                <h3 class="text-center text-uppercase font-weight-bold">{{ $t('repository.title') }}</h3>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary btn-round mb-3 float-right" @click="newModal">
                   {{ $t('repository.add_document') }}
                </button>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center font-weight-bold bg-primary">
                       {{ $t('repository.documents_from') }} {{ state_selected.name }}
                    </div>
                    <div class="card-body" v-show="!isdownloading">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ $t('repository.name') }}</th>
                                        <th class="text-center">{{ $t('repository.type') }}</th>
                                        <th class="text-center">{{ $t('repository.date') }}</th>
                                        <th class="text-center">{{ $t('repository.dowload') }}</th>
                                        <th class="text-center">{{ $t('repository.delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="document in state_selected.repositories" :key="document.id">
                                        <td>{{ document.name }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-pill badge-secondary">{{ document.type }}</span>
                                        </td>
                                        <td class="text-center">{{ document.created_at | myDate }}</td>
                                        <td class="text-center">
                                            <img class="pointer" @click="downloadFile(document)" src="/img/assets/download_icon_INL.svg" alt="download" style="width: 1.3em;">
                                        </td>
                                        <td class="text-center">
                                            <img class="pointer" @click="deleteDocument(document.id)" src="/img/assets/icons_INL_icon_delete.svg" alt="delete" style="width: 1.5em;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body" v-show="isdownloading">
                      <div class="col-md-12 text-center">
                        <p>
                          <i class="fas fa-spinner fa-pulse fa-4x"></i>
                        </p>
                        <p class="h4">{{ $t('downloading') }}</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">{{ $t('repository.add_document') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-show="isloading">
                      <div class="col-md-12 text-center">
                        <p>
                          <i class="fas fa-spinner fa-pulse fa-4x"></i>
                        </p>
                        <p class="h4">{{ $t('loading') }}</p>
                      </div>
                    </div>
                    <form @submit.prevent="addDocument()" enctype="multipart/form-data">
                    <div class="modal-body" v-show="!isloading">
                        <div class="form-group">
                            <label for="name">{{ $t('repository.name') }}</label>
                            <input v-model="form.name" type="text" name="name" placeholder="" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>

                        <div class="form-group">
                            <label for="type">{{ $t('repository.type') }}</label>
                            <input v-model="form.type" type="text" name="type" placeholder="" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                            <has-error :form="form" field="type"></has-error>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">{{ $t('repository.document') }}</label>
                            <input @change="onImageChange" type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                    </div>
                    <div class="modal-footer" v-show="!isloading">
                        <button type="submit" class="btn btn-primary btn-round">{{ $t('repository.add') }}</button>
                        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">{{ $t('repository.cancel') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            loading: false,
            isloading : false,
            isdownloading : false,
            state_selected: {},
            form: new Form({
                id:'',
                state_id: '',
                name : '',
                type: '',
                document: '',
            })
        }),
        methods: {
            addDocument(e){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                this.isloading = true;
                let formData = new FormData();
                formData.append('name', this.form.name);
                formData.append('type', this.form.type);
                formData.append('document', this.form.document);
                formData.append('state_id', this.state_selected.id);

                this.$Progress.start();

                axios.post(`/api/repository`, formData, config)
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    toast({
                        type: 'success',
                        title: 'Documento creado con éxito'
                    })
                    this.$Progress.finish();
                    this.form.reset();
                    this.isloading = false;
                })
                .catch((e)=>{
                    this.isloading = false;
                    toast({
                        type: 'error',
                        title: 'Error al agregar documento'
                    })
                    this.$Progress.fail();
                })
            },
            downloadZip(){
                this.$Progress.start();

                axios({
                    url: `/api/download-repository-zip/${this.state_selected.id}`,
                    method: 'GET',
                    responseType: 'blob', // important
                }).then((response) => {
                    this.$Progress.finish();
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', `${this.state_selected.key}_repository.zip`);
                    document.body.appendChild(link);
                    link.click();
                });
            },
            downloadFile(doc){
                this.isdownloading = true;
                this.$Progress.start();

                axios({
                    url: `/api/download-repository-file/${doc.id}`,
                    method: 'GET',
                    responseType: 'blob', // important
                }).then((response) => {
                    this.$Progress.finish();
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', doc.document);
                    document.body.appendChild(link);
                    link.click();
                    this.isdownloading = false;
                });
            },
            deleteDocument(id){
                this.$Progress.start();
                swal({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esta acción!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('/api/repository/'+id)
                        .then(()=>{
                             this.$Progress.finish();
                            swal(
                            '¡Eliminado!',
                            'El documento ha sido eliminado.',
                            'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(()=> {
                            swal("Error", "Algo salió mal", "warning");
                            this.$Progress.fail();
                        });
                    }
                })
            },
            onImageChange(e) {
                this.form.document = e.target.files[0];
                console.log(this.form.document);
            },
            newModal(){
                this.form.reset();
                $('#addNew').modal('show');
            },
            loadData() {
                this.loading = true;
                axios.get(`/api/state_by_key/${this.$route.params.key}`)
                .then(({data}) => (
                    this.loading = false,
                    this.state_selected = data
                )).catch(()=>{
                    toast({
                        type: 'error',
                        title: 'Error al cargar datos'
                    })
                    this.loading = false;
                });
            },
        },
        created(){
            const languaje = localStorage.getItem("languaje");
            this.$i18n.locale = languaje;
            this.loadData();
            Fire.$on('AfterCreate',() => {
                this.loadData();
            });
        }
    }
</script>

<style lang="scss" scoped>
    .repo-link {
        position: absolute;
        right: 0em;
        top: -2.3em;
    }
</style>
