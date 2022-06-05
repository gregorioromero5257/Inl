<template>
  <div class="container">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <span class="font-weight-bold text-dark">
                  Usuarios
                </span>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="row mt-5" v-if="$gate.isDirector() || $gate.isFortisDirector()">
      <div class="col-md-12">
        <h3 class="text-center text-uppercase font-weight-bold">{{ $t('users.title') }}</h3>
      </div>
      <div class="col-md-12">
        <button class="btn btn-primary btn-round mb-3 float-right" @click="newModal">
          {{ $t('users.add_new') }}
        </button>
      </div>
      <div class="col-md-12">
        <!-- <button class="btn btn-primary mb-3" @click="exportData">
        Export data <i class="fas fa-file-excel"></i>
      </button> -->
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <h3 class="card-title">Director(es)</h3>
          <div class="table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th style="width:4%;">ID</th>
                  <th style="width:11%;">{{ $t('users.name') }}</th>
                  <th style="width:17%;">{{ $t('users.email') }}</th>
                  <th >{{ $t('users.type') }}</th>
                  <th >{{ $t('users.registered_at') }}</th>
                  <!-- <th >{{ $t('users.status') }}</th> -->
                  <th >{{ $t('users.last_login_at') }}</th>
                  <th >{{ $t('users.see') }}</th>
                  <th >{{ $t('users.edit') }}</th>
                  <th >{{ $t('users.act_des') }}</th>
                  <th >{{ $t('users.act_des') }}</th>
                </tr>
                <tr v-for="user in users" :key="user.id"
                v-if="user.type == 'director' || user.type == 'fortis_director'">
                <td>{{user.id}}</td>
                <td>{{user.name}}</td>
                <td class="texto">{{user.email}}</td>
                <td>{{user.type | upText}}</td>
                <td>{{user.created_at | myDate}}</td>
                <!-- <td>{{ user.is_active }}</td> -->
                <td>
                  <span v-if="user.last_login_at">
                    {{ user.last_login_at | myDate }}
                  </span>
                  <span v-else>
                    No hay datos
                  </span>
                </td>
                <td>
                  <a href="#" @click="showModal(user)">
                    <img src="/img/assets/icons_INL_icon_eye_active.svg" alt="pencil"
                    style="width: 2.5em;">
                  </a>
                </td>
                <td>
                  <a href="#" @click="editModal(user)">
                    <img src="/img/assets/icons_INL_icon_pencil.svg" alt="pencil"
                    style="width: 2.5em;">
                  </a>
                </td>
                <td>

                  <label class="switch">
                    <input type="checkbox" v-model="user.is_active" @change="sendActiveDesactive(user)">
                    <span class="slider round"></span>
                  </label>
                </td>
                <td>
                  <a href="#" @click="deleteUser(user.id)">
                    <img src="/img/assets/icons_INL_icon_delete.svg" alt="pencil"
                    style="width: 1.5em;">
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- <pagination :data="users" @pagination-change-page="getResults"></pagination> -->
        </div>
      </div>
      <!-- /.card-body -->
    </div><!-- /.card -->
  </div>
  <div class="col-md-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <h3 class="card-title">Coordinador(es)</h3>
        <div class="table-responsive p-0">
          <table class="table table-hover">
            <tbody>
              <tr>
                <th style="width:4%;">ID</th>
                <th style="width:11%;">{{ $t('users.name') }}</th>
                <th style="width:17%;">{{ $t('users.email') }}</th>
                <th>{{ $t('users.type') }}</th>
                <th>{{ $t('users.registered_at') }}</th>
                <!-- <th>{{ $t('users.status') }}</th> -->
                <th>{{ $t('users.last_login_at') }}</th>
                <th >{{ $t('users.see') }}</th>
                <th >{{ $t('users.edit') }}</th>
                <th >{{ $t('users.act_des') }}</th>
                <th >{{ $t('users.act_des') }}</th>
              </tr>
              <tr v-for="user in users" :key="user.id" v-if="user.type == 'coordinator'">
                <td>{{user.id}}</td>
                <td>{{user.name}}</td>
                <td class="texto">{{user.email}}</td>
                <td>{{user.type | upText}}</td>
                <td>{{user.created_at | myDate}}</td>
                <!-- <td>{{ user.is_active }}</td> -->
                <td>
                  <span v-if="user.last_login_at">
                    {{ user.last_login_at | myDate }}
                  </span>
                  <span v-else>
                    No hay datos
                  </span>
                </td>
                <td>
                  <a href="#" @click="showModal(user)">
                    <img src="/img/assets/icons_INL_icon_eye_active.svg" alt="pencil"
                    style="width: 2.5em;">
                  </a>
                </td>
                <td>
                  <a href="#" @click="editModal(user)">
                    <img src="/img/assets/icons_INL_icon_pencil.svg" alt="pencil"
                    style="width: 2.5em;">
                    <!-- <i class="fa fa-edit blue"></i> -->
                  </a>
                </td>
                <td>

                  <label class="switch">
                    <input type="checkbox" v-model="user.is_active" @change="sendActiveDesactive(user)">
                    <span class="slider round"></span>
                  </label>
                </td>
                <td>
                  <a href="#" @click="deleteUser(user.id)">
                    <img src="/img/assets/icons_INL_icon_delete.svg" alt="pencil"
                    style="width: 1.5em;">
                    <!-- <i class="fa fa-trash red"></i> -->
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- <pagination :data="users" @pagination-change-page="getResults"></pagination> -->
        </div>
      </div>
      <!-- /.card-body -->
    </div><!-- /.card -->
  </div>
  <div class="col-md-12">
    <!-- <button class="btn btn-primary mb-3" @click="exportData">
    Export data <i class="fas fa-file-excel"></i>
  </button> -->
  <div class="card">
    <!-- /.card-header -->
    <div class="card-body">
      <h3 class="card-title">Analista / Capturista</h3>
      <div class="table-responsive p-0">
        <table class="table table-hover">
          <tbody>
            <tr>
              <th style="width:4%;">ID</th>
              <th style="width:11%;">{{ $t('users.name') }}</th>
              <th style="width:17%;">{{ $t('users.email') }}</th>
              <th>{{ $t('users.type') }}</th>
              <th>{{ $t('users.registered_at') }}</th>
              <!-- <th>{{ $t('users.status') }}</th> -->
              <th>{{ $t('users.last_login_at') }}</th>
              <th >{{ $t('users.see') }}</th>
              <th >{{ $t('users.edit') }}</th>
              <th >{{ $t('users.act_des') }}</th>
              <th >{{ $t('users.act_des') }}</th>
            </tr>
            <tr v-for="user in users" :key="user.id" v-if="user.type == 'analyst'">
              <td>{{user.id}}</td>
              <td>{{user.name}}</td>
              <td class="texto">{{user.email}}</td>
              <td>{{user.type | upText}}</td>
              <td>{{user.created_at | myDate}}</td>
              <!-- <td>{{ user.is_active }}</td> -->
              <td>
                <span v-if="user.last_login_at">
                  {{ user.last_login_at | myDate }}
                </span>
                <span v-else>
                  No hay datos
                </span>
              </td>
              <td>
                <a href="#" @click="showModal(user)">
                  <img src="/img/assets/icons_INL_icon_eye_active.svg" alt="pencil"
                  style="width: 2.5em;">
                </a>
              </td>
              <td>
                <a href="#" @click="editModal(user)">
                  <img src="/img/assets/icons_INL_icon_pencil.svg" alt="pencil"
                  style="width: 2.5em;">
                </a>
              </td>
              <td>

                <label class="switch">
                  <input type="checkbox" v-model="user.is_active" @change="sendActiveDesactive(user)">
                  <span class="slider round"></span>
                </label>
              </td>
              <td>
                <a href="#" @click="deleteUser(user.id)">
                  <img src="/img/assets/icons_INL_icon_delete.svg" alt="pencil"
                  style="width: 1.5em;">
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- <pagination :data="users" @pagination-change-page="getResults"></pagination> -->
      </div>
    </div>
    <!-- /.card-body -->
  </div><!-- /.card -->
</div>
<div class="col-md-12">
  <div class="card">
    <!-- /.card-header -->
    <div class="card-body">
      <h3 class="card-title">INL</h3>
      <div class="table-responsive p-0">
        <table class="table table-hover">
          <tbody>
            <tr>
              <th style="width:4%;">ID</th>
              <th style="width:11%;">{{ $t('users.name') }}</th>
              <th style="width:17%;">{{ $t('users.email') }}</th>
              <th>{{ $t('users.type') }}</th>
              <th>{{ $t('users.registered_at') }}</th>
              <!-- <th>{{ $t('users.status') }}</th> -->
              <th>{{ $t('users.last_login_at') }}</th>
              <th >{{ $t('users.see') }}</th>
              <th >{{ $t('users.edit') }}</th>
              <th >{{ $t('users.act_des') }}</th>
              <th >{{ $t('users.act_des') }}</th>
            </tr>
            <tr v-for="user in users" :key="user.id" v-if="user.type == 'inl'">
              <td>{{user.id}}</td>
              <td>{{user.name}}</td>
              <td class="texto">{{user.email}}</td>
              <td>{{user.type | upText}}</td>
              <td>{{user.created_at | myDate}}</td>
              <!-- <td>{{ user.is_active }}</td> -->
              <td>
                <span v-if="user.last_login_at">
                  {{ user.last_login_at | myDate }}
                </span>
                <span v-else>
                  No hay datos
                </span>
              </td>
              <td>
                <a href="#" @click="showModal(user)">
                  <img src="/img/assets/icons_INL_icon_eye_active.svg" alt="pencil"
                  style="width: 2.5em;">
                </a>
              </td>
              <td>
                <a href="#" @click="editModal(user)">
                  <img src="/img/assets/icons_INL_icon_pencil.svg" alt="pencil"
                  style="width: 2.5em;">
                  <!-- <i class="fa fa-edit blue"></i> -->
                </a>
              </td>
              <td>

                <label class="switch">
                  <input type="checkbox" v-model="user.is_active" @change="sendActiveDesactive(user)">
                  <span class="slider round"></span>
                </label>
              </td>
              <td>
                <a href="#" @click="deleteUser(user.id)">
                  <img src="/img/assets/icons_INL_icon_delete.svg" alt="pencil"
                  style="width: 1.5em;">
                  <!-- <i class="fa fa-trash red"></i> -->
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- <pagination :data="users" @pagination-change-page="getResults"></pagination> -->
      </div>
    </div>
    <!-- /.card-body -->
  </div><!-- /.card -->
</div>
</div>
<div v-else>
  <not-found></not-found>
</div>
<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" v-show="!editmode" id="addNewLabel">{{ $t('users.add_new') }}</h5>
      <h5 class="modal-title" v-show="editmode" id="addNewLabel">{{ $t('users.update') }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form @submit.prevent="editmode ? updateUser() : createUser()">
      <div class="modal-body">
        <div class="form-group">
          <label>{{ $t('users.email') }}</label>
          <input v-model="form.email" type="text" name="name"
          placeholder="Nombre"
          class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
          <has-error :form="form" field="name"></has-error>
        </div>
        <div class="form-group">
  <label for="inputState">{{ $t('users.domain') }}</label>
  <select id="inputState" class="form-control" v-model="form.domain"  >
    <!-- @change="changeUser" -->
    <option v-for="domain in domains" :key="domain">{{ domain }}</option>
  </select>
   <!-- @click="changeDomain(domain)" -->
</div>

        <!-- <div class="form-group">
        <input v-model="form.email" type="email" name="email"
        placeholder="Email Address"
        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
        <has-error :form="form" field="email"></has-error>
      </div> -->
      <div class="form-group">
        <label>{{ $t('users.tipo') }}</label>

        <select name="type" v-model="form.type" id="type" class="form-control"
        :class="{ 'is-invalid': form.errors.has('type') }">
        <option value="">Seleccionar rol</option>
        <option value="director">Director</option>
        <option value="fortis_director">Director Fortis</option>
        <option value="coordinator">Coordinador</option>
        <option value="analyst">Analista</option>
        <option value="inl">INL</option>
        <option value="readonly">Sólo lectura</option>
      </select>
      <has-error :form="form" field="type"></has-error>
    </div>
    <div class="form-group">
      <label>{{ $t('users.description') }}</label>

      <textarea v-model="form.bio" name="bio" id="bio"
      placeholder="Descripción (Opcional)"
      class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
      <has-error :form="form" field="bio"></has-error>
    </div>
    <div class="form-group">
      <label>{{ $t('users.contrasena') }}</label>
      <input v-model="form.password" type="password" name="password" id="password"
      class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
      <has-error :form="form" field="password"></has-error>
    </div>
  </div>
  <div class="modal-footer">
    <button v-show="editmode" type="submit" class="btn btn-primary btn-round">Actualizar
    </button>
    <button v-show="!editmode" type="submit" class="btn btn-primary btn-round">Agregar</button>
    <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Cancelar
    </button>
  </div>
</form>
</div>
</div>
</div>

<!-- Modal show user info -->
<div class="modal fade" id="showUser" tabindex="-1" role="dialog" aria-labelledby="showUserLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="showLabel">Información del usuario</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p class="text-center font-weight-bold h5">{{ user.name }} <span class="badge badge-dark">{{ user.type }}</span>
      </p>
      <p class="text-center">({{ user.email }})</p>
      <p>{{ user.bio }}</p>
      <div class="row">
        <div class="col-md-4" v-for="state in states" :key="state.id">
          <div class="card pointer" @click="addState(state, user)">
            <div class="card-body">
              <div class="row">
                <div class="col-md-2 text-right">
                  <i class="far"
                  :class="{ 'fa-square text-secondary' : state.active == 0, 'fa-check-square' : state.active == 1 }"></i>
                </div>
                <div class="col-md-10 text-left"
                :class="{ 'text-secondary' : state.active == 0, 'text-primary' : state.active == 1 }">
                {{ state.name }}
              </div>
            </div>
          </div>
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

  data: () => ({
    editmode: false,
    domains: ['@c-230.com', '@fortisconsultores.com.mx', '@state.gov','@usaid.gov'],
    states: {},
    states_selected: [],
    users: {},
    user: {},
    form: new Form({
      id: '',
      name: '',
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
  methods: {
    addState(s, user) {
      this.states[s.id - 1].active = 1 - s.active;
      let user_states = this.states.filter(state => state.active == 1);
      let states_id = user_states.map(function (state) {
        return state.id
      })
      axios.get(`api/add_states/${this.user.id}`, {
        params: {
          states: states_id
        }
      }).then(
        this.loadStates(),
        this.showModal(user),
        (this.states[s.id - 1].active == 1) ? toast({
          type: 'info',
          title: `Acceso a ${s.name} generado correctamente.`
        }) : toast({type: 'info', title: `Acceso a ${s.name} removido correctamente.`})
      )
    },
    changeUser() {
      this.form.email = this.form.username + this.form.domain;
      console.log(this.form.email);
    },
    changeDomain(domain) {
      this.form.domain = domain;
      this.form.email = this.form.username + this.form.domain;
      console.log(this.form.email);
    },
    importData() {
      axios.get("api/import-user").then(response => {
        Fire.$emit('AfterCreate');
        console.log(response)
      });
    },
    exportData() {
      axios.get("api/export-user", {
        responseType: 'blob'
      }).then(response => {
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'users.xlsx');
        document.body.appendChild(link);
        link.click();
      });
    },
    loadStates() {
      axios.get("api/state").then(
        ({data}) => (
          this.loading = false,
          this.states = data,
          this.addActiveField()
        )
      ).catch(() => {
        toast({
          type: 'error',
          title: 'Error al cargar datos'
        })
      });
    },
    addActiveField() {
      this.states.forEach(function (state) {
        state.active = 0;
      });
    },
    loadUsers() {
      this.loadStates();
      if (this.$gate.isDirector()) {
        axios.get("api/user").then(
          ({data}) => (this.users = data)
        ).catch;
      }
    },
    // getResults(page = 1) {
    //   axios.get('api/user?page=' + page)
    //   .then(response => {
    //     this.users = response.data;
    //   });
    // },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $('#addNew').modal('show');
    },
    createUser() {
      this.$Progress.start();

      this.form.post('api/user')
      .then(() => {
        Fire.$emit('AfterCreate');
        $('#addNew').modal('hide')
        toast({
          type: 'success',
          title: 'Usuario creado correctamente'
        })
        this.$Progress.finish();
      })
      .catch(() => {
        toast({
          type: 'error',
          title: 'Error al crear usuario'
        })
        this.$Progress.fail();
      })
    },
    showModal(user) {
      axios.get(`api/user/${user.id}`).then(
        ({data}) => (
          this.user = data,
          this.addActiveStates(data)
        )
      ).catch;
      $('#showUser').modal('show');
    },
    addActiveStates(active_states) {
      this.addActiveField();
      let vm = this;
      active_states.states.forEach(function (state, index) {
        vm.states[state.id - 1].active = 1;
      })

      //let as = active_states.forEach(function(state) { this.states[state.id-1] = 1 });
    },
    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $('#addNew').modal('show');
      this.form.fill(user);
    },
    updateUser() {
      this.$Progress.start();
      this.form.put('api/user/' + this.form.id)
      .then(() => {
        $('#addNew').modal('hide');
        swal(
          '¡Actualizado!',
          'Se ha actualizado la información del usuario.',
          'success'
        )
        this.$Progress.finish();
        Fire.$emit('AfterCreate');
      }).catch(() => {
        this.$Progress.fail();
      });
    },
    deleteUser(id) {
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
          this.form.delete('api/user/' + id).then(() => {
            swal(
              '¡Eliminado!',
              'El usuario ha sido eliminado.',
              'success'
            )
            Fire.$emit('AfterCreate');
          }).catch(() => {
            swal("Error", "Algo salió mal", "warning");
          });
        }
      })
    },
    sendActiveDesactive(user){
      axios.post('api/active-desactive', user).then(response => {
        swal(
          '¡Actualizado!',
          'Se ha actualizado la información del usuario.',
          'success'
        )
      }).catch(e => {
        console.log(e);
      });
    }
  },
  created() {
    Fire.$on('searching', () => {
      let query = this.$parent.search;
      axios.get('api/findUser?q=' + query)
      .then((data) => {
        this.users = data.data
      })
      .catch(() => {

      })
    })
    this.loadUsers();
    Fire.$on('AfterCreate', () => {
      this.loadUsers();
    });
  }
}
</script>
<style media="screen">
.texto {
  -ms-word-break: break-all;
  word-break: break-all;
  word-break: break-word;
  /* Sólo WebKit -NO DOCUMENTADO */
  -ms-hyphens: auto;
  /* Guiones para separar en sílabas */
  -moz-hyphens: auto;
  /*  depende de lang en <html>      */
  -webkit-hyphens: auto;
  hyphens: auto;
}

/* Rounded sliders */
.slider.round {
  border-radius: 12px;
}

.slider.round:before {
  border-radius: 60%;
}

.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 22px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 4px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
</style>
