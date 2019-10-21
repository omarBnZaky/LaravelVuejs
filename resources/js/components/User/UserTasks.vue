<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Tasks</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>title</th>
                                    <th>description</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="task in tasks.data" :key="task.id">
                                    <td>{{task.id}}</td>
                                    <td>{{task.title}}</td>
                                    <td>{{task.description}}</td>
                                    <td>
                                        <span v-if="task.status==2" class="badge badge-info">Doing</span>
                                        <span v-else-if="task.status==1" class="badge badge-success">Finished</span>
                                        <span v-else class="badge badge-warning">pending</span>
                                    </td>
                                    <td>
                                        <a v-if="task.status==2||task.status==0" href="#" @click="finishTask(task.id)">
                                            <i class="fa fa-check" ></i>

                                        </a>
                                        <a v-if="task.status==1" href="#" @click="doingTask(task.id)">
                                            <i class="fa fa-close"></i>
                                        </a>

                                        <a v-if="task.status==0" href="#"@click="doingTask(task.id)">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <pagination :data="tasks" @pagination-change-page="loadTasks"></pagination>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "UserTasks",

        data() {
            return{
                tasks : []
            }
        },
        methods: {
            loadTasks(page)
            {
                if (typeof page === 'undefined') {
                    page = 1;
                }
                // axios.get('/admin/api/task?page='+page).then(({data}) =>(this.tasks = data));
                axios.get('/api/task/all?page='+page).then(({data}) =>(this.tasks = data));
            },

            finishTask(id)
            {
                axios.post('/api/task/finish/'+id)
                    .then(()=>{
                        this.$Progress.start();

                        Fire.$emit('AfterCreate');
                        $('#createUser').modal('hide');

                        toast.fire({
                            type: 'success',
                            title: 'Task Status promoted to "Finished" status successfully'
                        });

                        this.$Progress.finish()
                        this.editImg= false;
                    })
                    .catch(()=>{
                        Swal.fire({
                            type: "error",
                            title : "Oops!",
                            text:"Cannot update Task Status",
                        })
                        this.$Progress.fail()

                    });
            },

            doingTask(id)
            {
                axios.post('/api/task/doing/'+id)
                    .then(()=>{
                        this.$Progress.start();

                        Fire.$emit('AfterCreate');
                        $('#createUser').modal('hide');

                        toast.fire({
                            type: 'success',
                            title: 'Task Status promoted to "Doing" status'
                        });

                        this.$Progress.finish()
                        this.editImg= false;
                    })
                    .catch(()=>{
                        Swal.fire({
                            type: "error",
                            title : "Oops!",
                            text:"Cannot update Task Status",
                        })
                        this.$Progress.fail()

                    });
            },

        },
        created() {
            this.loadTasks();
            Fire.$on('AfterCreate',() => {
                this.loadTasks();
            });
            // console.log(this.organizations);
        },

    }



</script>

<style scoped>

</style>
