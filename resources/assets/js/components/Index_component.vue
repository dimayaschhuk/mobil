<template>
    <div class="container">
<div class="row">
    <div class="col-1 offset-11"> <button @click="out" class="btn btn-primary ">out</button></div>

</div>
        <br><br>


        <div class="modal fade" id="group" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <div class="row">

                            <div class="col-lg-6" style="text-align: center" ><h4>Група</h4></div>
                            <div class="col-lg-6" style="text-align: center" ><h4>Курс</h4></div>

                        </div>
                        <div class="row" v-for="row in array" @click="ok_visiting('group',row.id)">
                            <div class="col-lg-6" style="text-align: center" ><h5>{{row.name}}</h5></div>
                            <div class="col-lg-6" style="text-align: center" ><h5>{{row.course}}</h5></div>



                        </div>





                    </div>
                    <div class="modal-footer" >


                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="subject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <div class="row" >
                            <div class="col-6" style="text-align: center" v-for="row in array">
                                <h3 @click="ok_visiting('subject',row.id)">{{row.name}}</h3>
                            </div>


                        </div>






                    </div>
                    <div class="modal-footer" >


                    </div>
                </div>
            </div>
        </div>







        <div class="row">
            <h4>подивитися відвідуваня</h4>
        </div>
        <div class="row" v-if="flag">
            <div class="col-6">
                <button data-toggle="modal" data-target="#subject" @click="search_student('subject')">по предмету</button>
            </div>
            <div class="col-6">
                <button data-toggle="modal" data-target="#group" @click="search_student('group')">по групі</button>
            </div>

        </div>
        <div class="row" v-else="">
            <div class="col-3">
              <p>за період</p>
            </div>
            <div class="col-4">
               <input type="date" v-model="data_min">
            </div>
            <div class="col-4">
                <input type="date" v-model="data_max">
            </div>
            <div class="col-1">
             <button @click="flag=!flag">ok</button>
            </div>

        </div>
<br>

        <div class="row" v-show="teacher=='true'">
            <button @click="run_my_cabinet('edit_my_magazine')" class="btn btn-primary btn-lg btn-block">Відмітити студентів на моїх парах </button>
        </div>
        <div class="row" v-show="admin=='true'">
            <button @click="run_my_cabinet('edit_schedule')" class="btn btn-primary btn-lg btn-block">Змінити розклад</button>
        </div>


    </div>
</template>

<script>
    export default {
        props:['admin','teacher'],
        data(){
            return {
                data_min:'',
                data_max:'',
                array:[],
                response:'',
                flag:false,
            }},
                mounted() {
            console.log('Component mounted.')
        },
        methods:{
            search_student:function (status) {
                this.flag=false;
                axios.post(`/search`, {
                    status: status,
                }).then(response => {

                    this.array=response.data;

            });

            },
            out:function () {
                window.location.href = '/out';
            },
            ok_visiting:function (status,id) {
                axios.post(`/result`, {
                    data_min:this.data_min,
                    data_max:this.data_max,
                    status: status,
                    id: id,
                }).then(response => {
if(status=='group'){
                    alert('у студенти даної групи, разом  '+response.data[0]+'годин прогула пару');
                }else {
                    alert('Даний придмет відвідали  '+response.data+' раз');

                }


            });
            },
            run_my_cabinet:function (status) {
                window.location.href = '/'+status;

            }
        }
    }
</script>
