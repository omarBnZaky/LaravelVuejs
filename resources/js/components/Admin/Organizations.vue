<template>
<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Organizations</h3>

                        <div class="card-tools">
                            <button type="button"
                                    class="btn btn-success"
                                    @click="newModal()">
                                Add Organizations <i class="fa fa-plus"></i>
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
                                <th>Registered at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="org in Organizations.data" :key="org.id">
                                <td>{{org.id}}</td>
                                <td>{{org.name}}</td>
                                <td>{{org.email}}</td>
                                <td>
                                    <span v-if="org.status==0" class="badge badge-info">Pending</span>
                                    <span v-else-if="org.status==1" class="badge badge-success">Verified</span>
                                    <span v-else class="badge badge-danger">Blocked</span>
                                </td>
                                <td>{{org.created_at | myDate}}</td>
                                <td>
                                    <a href="#" @click="editModal(org)">
                                        <i class="fa fa-edit"></i>
                                    </a>  /
                                    <a href="#" @click="deleteOrg(org.id)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <!--                        <div v-for="singleRole in allRoles" :key="singleRole.id">-->
                        <!--                            <span style="color:red;">{{singleRole.name}}</span>-->
                        <!--                        </div>-->
                        <pagination :data="Organizations" @pagination-change-page="loadOrgs"></pagination>

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
                                <img v-bind:src="'/img/org/' + form.profile" class="img-responsive" height="150" width="150">
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

</div>
</template>

<script>
    export default {
        name: "Organizations",

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
                    'status' : '',
                    'profile': '',

                }),
                Organizations:[],
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

            deleteOrg(id)
            {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('/admin/api/org/'+id).then(()=>{
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(()=>{
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Cannot delete User !',
                            })
                        })
                    }

                })

            },
            editModal(org)
            {
                this.form.reset();
                this.form.clear();
                $('#createUser').modal('show');
                $("#modalLabel").text("Edit User");
                this.editMode = true;
                this.form.fill(org);
            },

            clearAndReset()
            {
                this.editMode = false;
                this.editImg = false;
            },

            loadOrgs(page)
            {
                if (typeof page === 'undefined') {
                    page = 1;
                }
                axios.get('/admin/api/org?page='+page).then(({data}) =>(this.Organizations = data));
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
                    Swal.fire({
                        type: "error",
                        title : "Oops!",
                        text:"you cannot upload large file",
                    })
                }
                console.log(file);
            },

            createUser()
            {
                this.form.post('/admin/api/org')
                    .then(()=>{
                        this.$Progress.start();

                        Fire.$emit('AfterCreate');
                        $('#createUser').modal('hide');

                        toast.fire({
                            type: 'success',
                            title: 'user Created successfully'
                        });

                        this.$Progress.finish()
                        this.editImg= false;

                    })
                    .catch(()=>{
                        Swal.fire({
                            type: "error",
                            title : "Oops!",
                            text:"cannot create user",
                        })
                        this.$Progress.fail()

                    });
            },
            updateUser()
            {
                this.form.put('/admin/api/org/'+this.form.id)
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
            this.loadOrgs();
            Fire.$on('AfterCreate',() => {
                this.loadOrgs();
            });
            // console.log(this.organizations);
        },

    }
</script>

<style scoped>

</style>
