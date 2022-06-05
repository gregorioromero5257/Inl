<template>
    <div class="repository container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                         
                        </ol>
                    </div>
                </div>
                
            </div><!-- /.container-fluid -->
        </section>
       <div class="row">
            <div class="col-md-12 mb-4">
                <h3 class=" text-uppercase font-weight-bold">{{ $t('documental_repository.title') }}</h3>
            </div>
         
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold bg-primary">
                         <span style="font-size: 20px;">{{ $t('documental_repository.table_disaster') }}</span> 
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ $t('documental_repository.name') }}</th>
                                        <th class="text-center">{{ $t('documental_repository.type') }}</th>
                                        <th class="text-center">{{ $t('documental_repository.date') }}</th>
                                        <th class="text-center">{{ $t('documental_repository.dowload') }}</th>
                                        <th class="text-center">{{ $t('documental_repository.delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(repo, index) in repo" >
                                        <tr :key="index" v-if="repo.document == 'Plan_de_recuperacion_desastres.pdf'">
                                            <td>{{repo.document}}</td>
                                            <td class="text-center">
                                                <span class="badge badge-pill badge-secondary">pdf</span>
                                            </td>
                                            <td class="text-center">{{ repo.created_at | myDate }}</td>
                                            <td class="text-center">
                                                <img class="pointer"  @click="downloadFile(repo)" src="/img/assets/download_icon_INL.svg" alt="download" style="width: 1.3em;">
                                            </td>
                                            <td class="text-center">
                                                <img class="pointer" @click="deleteDocument(repo.id)" src="/img/assets/icons_INL_icon_delete.svg" alt="delete" style="width: 1.5em;">
                                            </td>
                                        </tr> 
                                    </template>
                                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                         <div class="col-md-12">
                            <button class="btn btn-primary btn-round mb-3 float-right" @click="newModal">
                                {{ $t('documental_repository.add') }}
                            </button>
                        </div> 
                </div>
            </div>
             <div class="col-md-12">
                 <br>
             </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold bg-primary">
                         <span style="font-size: 20px;">{{ $t('documental_repository.forms') }}</span> 
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ $t('documental_repository.name') }}</th>
                                        <th class="text-center">{{ $t('documental_repository.type') }}</th>
                                        <th class="text-center">{{ $t('documental_repository.date') }}</th>
                                        <th class="text-center">{{ $t('documental_repository.dowload') }}</th>
                                        <th class="text-center">{{ $t('documental_repository.delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(repo, index) in repo" >
                                        <tr :key="index" v-if="repo.document != 'Plan_de_recuperacion_desastres.pdf'">
                                            <td>{{repo.document}}</td>
                                            <td class="text-center">
                                                <span class="badge badge-pill badge-secondary">pdf</span>
                                            </td>
                                            <td class="text-center">{{ repo.created_at | myDate }}</td>
                                            <td class="text-center">
                                                <img class="pointer"  @click="downloadFile(repo)" src="/img/assets/download_icon_INL.svg" alt="download" style="width: 1.3em;">
                                            </td>
                                            <td class="text-center">
                                                <img class="pointer" @click="deleteDocument(repo.id)" src="/img/assets/icons_INL_icon_delete.svg" alt="delete" style="width: 1.5em;">
                                            </td>
                                        </tr> 
                                    </template>
                                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                         <div class="col-md-12">
                            <button class="btn btn-primary btn-round mb-3 float-right" @click="newModal2">
                                {{ $t('documental_repository.add') }}
                            </button>
                        </div> 
                </div>
            </div>
       </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">{{ $t('documental_repository.add') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="addDocument()" enctype="multipart/form-data">
                    <div class="modal-body">
                    

                        <div class="form-group">
                            <label for="exampleFormControlFile1">{{ $t('documental_repository.document') }}</label>
                            <input @change="onImageChange" type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-round">{{ $t('documental_repository.add_button') }}</button>
                        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">{{ $t('documental_repository.cancel') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew2" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">{{ $t('documental_repository.add') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="uploadDocument()" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">{{ $t('documental_repository.name') }}</label>             
                            <input v-model="form.name" type="text" name="name" placeholder="" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>

                        <div class="form-group">
                            <label for="type">{{ $t('documental_repository.type') }}</label>   
                            <input v-model="form.type" type="text" name="type" placeholder="" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                            <has-error :form="form" field="type"></has-error>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">{{ $t('documental_repository.document') }}</label>
                            <input @change="onImageChange" type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-round">{{ $t('documental_repository.add_button') }}</button>
                        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">{{ $t('documental_repository.cancel') }}</button>
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
            state_selected: {},
            repo:[],
            form: new Form({
                id:'',
                state_id: '',
                name : '',
                type: '',
                document: '',
            })
        }),
        methods: {
            uploadDocument(e){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('name', this.form.name);
                formData.append('type', this.form.type);
                formData.append('document', this.form.document);
                
                this.$Progress.start();

                axios.post(`/api/upload-repository-document-all`, formData, config)
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    toast({
                        type: 'success',
                        title: 'Documento creado con éxito'
                    })
                    this.$Progress.finish();
                    this.form.reset();
                })
                .catch((e)=>{
                    console.log(e);
                    
                    toast({
                        type: 'error',
                        title: 'Error al agregar documento'
                    })
                    this.$Progress.fail();
                })
            },
            addDocument(e){
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('document', this.form.document);
                
                this.$Progress.start();

                axios.post(`/api/upload-repository-document`, formData, config)
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    toast({
                        type: 'success',
                        title: 'Documento creado con éxito'
                    })
                    this.$Progress.finish();
                    this.form.reset();
                })
                .catch((e)=>{
                    console.log(e);
                    
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
                this.$Progress.start();

                axios({
                    url: `/api/download-repository-document/${doc.id}`,
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
                        this.form.get('/api/delete-repository/'+id)
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
            },
            newModal(){
                this.form.reset();
                $('#addNew').modal('show');
            },
            newModal2(){
                this.form.reset();
                $('#addNew2').modal('show');
            },
            loadData() {
                this.loading = true;
                axios.get(`/api/all-repository`)
                .then(({data}) => (
                    this.loading = false,
                    this.repo = data,
                    console.log(data)

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