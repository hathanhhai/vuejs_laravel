<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My Task</div>

                    <div class="panel-body">

                        <div class="input-group">
                            <input type="text" class="form-control"
                                   v-model="taskCreate.name"
                                   @keydown.enter="create"
                            />
                            <span class="input-group-btn">
                                <button @click="create" class="btn btn-success">Add</button>
                            </span>
                        </div>


                        <div class="tast-list">
                            <br>
                            <div class="alert alert-danger" v-if="!tasks.length">
                                You have no tasks !
                            </div>
                            <ul class="list-unstyled">
                                <li v-for="item in tasks" :key="item.id">
                                    <div class="checkbox" v-bind:class="{done:item.completed}">

                                        <label >
                                            <input type="checkbox" v-model="item.completed" @click="done(item)" />{{item.name}}
                                        </label>
                                        <div class="pull-right">
                                            <a href="#" @click.prevent="remove(item)" >X</a>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                        </div>
                        <div class="panel-footer" v-if="tasks.length">
                            <span class="label label-default">You have {{tasks.length}} Tasks</span>
                            <span class="label label-warning">{{remainingTask()}} task left</span>
                            <span class="label label-success">{{completedTask()}} tasks completed</span>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetchData()
        },
        data (){
            return {
                tasks:[],
                taskCreate:{
                    name:''
                }

            }
        },
        methods:{
            remainingTask(){
                return this.tasks.filter(task=>{
                    return !task.completed
                }).length
            },
            completedTask(){
                return this.tasks.filter(task=>{
                    return  task.completed
                }).length
            },
            fetchData(){
                axios.get('/api/task')
                    .then((res)=>{
                        this.tasks = res.data
                    })
                    .catch((err)=>{
                        console.log(err)
                    })
            },
            create(){
                axios.post('api/task',this.taskCreate)
                    .then((res)=>{
                        this.tasks.unshift(res.data)
                        this.taskCreate.name = ''
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            },
            done(task){

                axios.put('/api/task/'+task.id,{

                     completed:!task.completed,

                })
                    .then((res)=>{
                        console.log('task upload')
                    })
                    .catch((err)=>{
                        console.log(err)
                    })

            },
            remove(task){
                axios.delete('api/task/'+task.id)
                    .then((res)=>{
                        const taskIndex = this.tasks.indexOf(task)
                        this.tasks.splice(taskIndex,1)
                    })
                    .catch((err)=>{
                        console.log(err)
                    })

            }



        }
    }
</script>

<style>

    body,.task-list {
        padding-top:20px;
    }
    .done label{
        text-decoration: line-through;
    }

</style>
