<template>
    <div class="container">
        <div class="modal fade" id="get_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Розклад</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row" v-for="row in student">
                            <div class="col-8">{{row.name}}</div>
                            <div class="col-4"><input type="checkbox" @click="add(row.id)"></div>
                        </div>
                        <button @click="good" class="close" data-dismiss="modal">Зберегти</button>
                         </div>





                </div>
                <div class="modal-footer" >


                </div>
            </div>
        </div>

        <div class="modal fade" id="roz" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Розклад</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div v-for="row in resultat" style="background-color: #d4f0c7; margin-bottom: 10px;padding: 10px" >

                           <h5>{{row.day}}</h5>

                           <p v-for="ron in row.lesson" >{{ron.name}} в рупі  {{ron.group}}  ({{ron.course}}  курс) на {{ron.number}} парі</p>



                            </div>
                        </div>





                    </div>
                    <div class="modal-footer" >


                    </div>
                </div>
            </div>

<div class="row">
    <div class="col-6"><button data-toggle="modal" data-target="#roz" @click="roz" class="btn btn-primary btn-lg btn-block">Ваш особистий розклад на тиждень</button></div>
    <div class="col-6"><button  @click="run" class="btn btn-primary btn-lg btn-block">Журнал Відвідувань</button></div>

</div>

        <h1>Сьогодні {{day}}</h1>
        <h5>Розлад на сьогодні</h5>
<div v-for="row in result" style="background-color: #d4f0c7; margin-bottom: 10px;padding: 10px" >

    <div class="row" v-for="ron in row.lesson">
        <div class="col-10">

            <p  >{{ron.name}} в рупі  {{ron.group}}  ({{ron.course}}  курс) на {{ron.number}} парі</p>

        </div>
        <div class="col-2">
            <button data-toggle="modal" data-target="#get_student" @click="run_lesson(ron.group_id,ron.schedule)">Відміти присутніх</button>
        </div>

    </div>
   </div>


    </div>
</template>

<script>
    export default {
        props:['result','day'],
        data(){
            return {
                resultat:[],
                student:[],
                student_id:[],

            }},
                mounted() {
            console.log('Component mounted.')
        },
        methods:{
            run:function () {
                window.location.href = '/';
            },
            run_lesson:function(group_id,schedule_id){

                axios.post(`/get_student`, {
                    group_id:group_id,
                    schedule_id:schedule_id
                }).then(response => {

                    this.student=response.data;

            });
    },
            roz:function () {
                axios.post(`/roz_all`, {

                }).then(response => {

                    this.resultat=response.data;

            });

            },
            add:function (id) {
                this.student_id.push(id);

            },
            good:function (schedule_id) {
                axios.post(`/save`, {

                    student_id:this.student_id,

                }).then(response => {

                    alert(response.data);

            });
            }
        }
    }
</script>
