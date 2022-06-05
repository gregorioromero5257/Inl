<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
.widget-user .card-footer{
    padding: 0;
}

</style>


<template>
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <router-link to="/users" class="text-secondary">
                                {{ $t('profile.users') }}
                            </router-link>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="font-weight-bold text-dark">
                                {{ $t('profile.profile') }}
                            </span>
                        </li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="row">
            <div class="col-md-12 mt-3">

                <div class="card">
                    <div class="card-body box-profile">
                        <h3 class="profile-username text-center font-weight-bold">{{this.form.name}}</h3>
                        <p class="text-muted text-center">{{this.form.type}}</p>
                    </div>
                <!-- /.card-body -->
                </div>
            </div>

            <!-- tab -->

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">{{ $t('profile.activity') }}</a></li>
                        <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">{{ $t('profile.settings') }}</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Activity Tab -->
                            <div class="tab-pane" id="activity">
                                <h3 class="text-center">{{ $t('profile.user_activity') }}</h3>
                            </div>
                            <!-- Setting Tab -->
                            <div class="tab-pane active show" id="settings">
                                <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-12 control-label">{{ $t('profile.name') }}</label>

                                    <div class="col-sm-12">
                                    <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Nombre" :class="{ 'is-invalid': form.errors.has('name') }">
                                     <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-12 control-label">Email</label>
                                    <div class="input-group col-md-12">
                                        <input v-model="form.username" type="text" class="form-control" placeholder="Correo electrónico" @change="changeUser">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ form.domain }}</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item pointer" v-for="domain in domains" :key="domain" @click="changeDomain(domain)">{{ domain }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-12 control-label">{{ $t('profile.description') }}</label>

                                    <div class="col-sm-12">
                                    <textarea  v-model="form.bio" class="form-control" id="description" placeholder="Descripción" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                     <has-error :form="form" field="bio"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="col-sm-12 control-label">{{ $t('profile.picture') }}</label>
                                    <div class="col-sm-12">
                                        <input type="file" @change="updateProfile" name="photo" class="form-input">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-sm-12 control-label">{{ $t('profile.password') }}</label>

                                    <div class="col-sm-12">
                                    <input type="password"
                                        v-model="form.password"
                                        class="form-control"
                                        id="password"
                                        placeholder="Password"
                                        :class="{ 'is-invalid': form.errors.has('password') }"
                                    >
                                     <has-error :form="form" field="password"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">
                                    <button @click.prevent="updateInfo" type="submit" class="btn btn-primary btn-round">{{ $t('profile.update') }}</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
          </div>
          <!-- end tabs -->
        </div>
    </div>
</template>



<script>
    export default {
        data: () => ({
            editmode: false,
            domains: ['@c-230.com', '@fortisconsultores.com.mx', '@state.gov'],
            users : {},
            form: new Form({
            id:'',
            name : '',
            username: '',
            domain: '@c-230.com',
            email: '',
            password: '',
            type: '',
            bio: '',
            photo: 'profile.png',
            is_active: '0',
            })
        }),
        methods:{
            changeUser(){
                this.form.email = this.form.username + this.form.domain;
                console.log(this.form.email);
            },
            changeDomain(domain){
                this.form.domain= domain;
                this.form.email = this.form.username + this.form.domain;
                console.log(this.form.email);
            },
            getProfilePhoto(){
                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo ;
                return photo;
            },
            updateInfo(){
                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/profile')
                .then(()=>{
                  swal({
                      type: 'success',
                      text: 'Correcto',
                  });
                     Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(() => {
                  swal({
                      type: 'warning',
                      text: 'Error',
                  });
                    this.$Progress.fail();
                });
            },
            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                    return false;
                }

                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            }
        },
        created() {
            const languaje = localStorage.getItem("languaje");
            this.$i18n.locale = languaje;
            axios.get("api/profile")
            .then(({ data }) => (this.form.fill(data)));
        }
    }
</script>
