<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All users</h3>

                        <div class="card-tools">
                            <button type="button"
                                    class="btn btn-success"
                                    @click="newModal()">
                                Add user <i class="fa fa-plus"></i>
                            </button>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>status</th>
                                <th>Roles</th>
                                <th>Rgistred at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>
                                    <span v-if="user.status==0" class="badge badge-info">Pending</span>
                                    <span v-else-if="user.status==1" class="badge badge-success">Verified</span>
                                    <span v-else class="badge badge-danger">Blocked</span>
                                </td>
                                <td>
                                    <ul v-for="role in user.roles">
                                        <li>{{role.name | upText}}</li>
                                    </ul>
                                </td>
                                <td>{{user.created_at | myDate}}</td>
                                <td>
                                    <a href="#" @click="editModal(user)">
                                        <i class="fa fa-edit"></i>
                                    </a>  /
                                    <a href="#" @click="deleteModal(user)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

<!--                        <div v-for="singleRole in allRoles" :key="singleRole.id">-->
<!--                            <span style="color:red;">{{singleRole.name}}</span>-->
<!--                        </div>-->
                        <pagination :data="users" @pagination-change-page="loadUsers"></pagination>

                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
        </div>




        <!-- Modal -->
        <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Add user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode? updateUser() :createUser()">
                    <div class="modal-body">
                            <div class="form-group">
                                <label>name</label>
                                <input v-model="form.name"
                                       type="text"
                                       name="name"
                                       placeholder="Enter username"
                                       class="form-control"  :class="{'is-invalid':form.errors.has('name')}" >
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email"
                                       type="email"
                                       name="email"
                                       placeholder="Enter Email"
                                       class="form-control"  :class="{'is-invalid':form.errors.has('email')}" >
                                <has-error :form="form" field="email"></has-error>
                            </div>

                        <label>Roles</label>
                        <multiselect
                                     :class="{'is-invalid':form.errors.has('roles')}"
                                      name="roles"
                                      v-model="form.roles"
                                      tag-placeholder="Add this as new tag"
                                      placeholder="Search or add a tag"
                                      label="name"
                                      track-by="id"
                                      :options="allRoles" :multiple="true" :taggable="true" @tag="addTag">
                        </multiselect>
                        <has-error :form="form" field="roles[]"></has-error>

                        <div class ="form-group">
                            <label>status</label>
                            <select class="form-control"
                                    name="status"
                                    v-model="form.status" :class="{'is-invalid':form.errors.has('status')}">
                                <option value="0">pending</option>
                                <option value="1">verified</option>
                                <option value="2">blocked</option>
                            </select>
                            <has-error :form="form" field="status"></has-error>

                        </div>
                        <div class="form-group">
                                <label>Password</label>
                                <input v-model="form.password"
                                       type="password"
                                       name="password"
                                       class="form-control"  :class="{'is-invalid':form.errors.has('password')}" placeholder="Enter password">
                                <has-error :form="form" field="password"></has-error>
                        </div>

                        <input type="file"
                               v-on:change="onImageChange"
                               class="form-control" :class="{'is-invalid':form.errors.has('profile')}">

                        <div class="col-md-3" v-if="form.profile && !editMode">
                            <img v-bind:src="form.profile" class="img-responsive" height="150" width="150">
                        </div>
                        <div class="col-md-3" v-else-if="editMode && !editImg">
                            <img v-bind:src="'img/profile/' + form.profile" class="img-responsive" height="150" width="150">
                        </div>

                        <div class="col-md-3" v-else-if="editMode && editImg">
                            <img v-bind:src="form.profile" class="img-responsive" height="150" width="150">

                        </div>
                        <has-error :form="form" field="profile"></has-error>

                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="clearAndReset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editMode" type="submit"  class="btn btn-primary">create</button>
                        <button v-show="editMode" type="submit"  class="btn btn-primary">update</button>
<!--                        <button type="submit" id="subButton" class="btn btn-primary">create</button>-->
                    </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    import  swal from 'sweetalert2'
    export default {
        name: "Users.vue",
        components: { Multiselect },

        data()
        {
            return{

                editMode:false,
                editImg:false,
                form: new Form({
                    'id':'',
                    'name':'',
                    'email':'',
                    'password':'',
                    'roles':[
                        {}
                    ],
                    'status' : '',
                    'profile': ''

                }),
                users: [],
                allRoles:[],
            }
        },
        methods: {

            newModal()
            {
                this.form.reset();
                this.form.clear();
                $('#createUser').modal('show');
                $("#modalLabel").text("Add User");
                this.editMode = false;

            },

            deleteModal(user)
            {

            },
            editModal(user)
            {
                this.form.reset();
                this.form.clear();
                $('#createUser').modal('show');
                $("#modalLabel").text("Edit User");

                this.editMode = true;
                this.form.fill(user);
            },

            clearAndReset()
            {
                this.editMode = false;
                this.editImg = false;
            },

            loadRoles()
            {
                 axios.get('/admin/api/role').then(({data}) =>(this.allRoles = data));
                //axios.get('api/role').forEach()
            },

            loadUsers(page)
            {
                if (typeof page === 'undefined') {
                    page = 1;
                }
                axios.get('/admin/api/user?page='+page).then(({data}) =>(this.users = data));
            },

            addTag (newTag) {
                const tag = {
                    name: newTag,
                    code: newTag.substring(0, 1) + Math.floor((Math.random() * 10000000))
                }
                this.allRoles.push(tag)
                this.roles.push(tag)
            },

            onImageChange(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                this.editImg =true;
                if(file['size']<2111775)
                {
                    reader.onloadend = (file) =>{
                        this.form.profile = reader.result
                    }
                    reader.readAsDataURL(file)
                }else{
                    swal({
                        type: "error",
                        title : "Oops!",
                        text:"you cannot upload large file",
                    })
                }
                console.log(file);
            },

            createUser()
            {
                this.form.post('/admin/api/user')
                    .then(()=>{
                        this.$Progress.start();

                        Fire.$emit('AfterCreate');
                        $('#createUser').modal('hide');

                        toast.fire({
                            type: 'success',
                            title: 'user Created successfully'
                        });

                        this.$Progress.finish()

                    })
                    .catch(()=>{
                        swal({
                            type: "error",
                            title : "Oops!",
                            text:"cannot create user",
                        })
                        this.$Progress.fail()

                    });
            },
            updateUser()
            {
                this.form.put('/admin/api/user/'+this.form.id)
                    .then(()=>{
                        this.$Progress.start();

                        Fire.$emit('AfterCreate');
                        $('#createUser').modal('hide');

                        toast.fire({
                            type: 'success',
                            title: 'user Updated successfully'
                        });
                        this.editImg =false;
                        this.editMode =false;

                        this.$Progress.finish()

                    })
                    .catch(()=>{
                        this.$Progress.fail()
                        swal({
                            type: "error",
                            title : "Oops!",
                            text:"cannot update user",
                        })
                    });
            }
        },
        created() {
            this.loadUsers();
            this.loadRoles();
            Fire.$on('AfterCreate',() => {
                this.loadUsers();
            });
           // console.log(this.users);
        },

    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>

</style>
