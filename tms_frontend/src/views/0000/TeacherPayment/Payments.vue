<template>
<b-card>
    <h3>Add Teacher Payment</h3>
    <br>
    <h5>Select Teacher:</h5>
    <select-teacher ref="teacherTable" @rowSelected="selectTeacher($event)"></select-teacher>
    <b-collapse :visible="log_visible" id="collapse-logs">
        
        <h5>Selected Teacher:</h5>
        <b-list-group>
          <b-list-group-item variant="warning">
          {{ selectedTeacherInfo }} 
          </b-list-group-item>
        </b-list-group>
        
        
        <br>    
        <h5>Select Class Log to Pay:</h5>
        <select-class-logs ref="classLogTable" @rowSelected="selectClassLogs($event)"></select-class-logs>
        
        
        <h5>Payment:</h5>
        <b-list-group>
          <b-list-group-item   variant="warning" class="d-flex justify-content-between align-items-center">
             <div>
              <strong>Class Log ID: {{ selectedClassLogs.idclass_log }} - {{ selectedClassLogs.class_name }}  </strong>
              <b-badge variant="primary" pill>{{ selectedClassLogs.date }} </b-badge>
             </div>
              <div>
              
              <b-badge variant="success" pill>Rs. {{ selectedClassLogs.amount }} </b-badge>
                </div>
          </b-list-group-item>
        
        </b-list-group>
        <br>
        
        <div class="text-right"><b-button  variant="primary" v-on:click="makePayment()">Make Payment</b-button></div>
    </b-collapse>
</b-card>
</template>

<script>
    import SelectTeacher from './SelectTeacher.vue';
    import SelectClassLogs from './SelectClassLogs.vue';

    export default {
        props: {
            admin_idadmin: {
                default: 22
            }
        },
        data() {
            return {
                idTeacher: null,
                selectedTeacher: null,
                selectedClassLogs: [],
                log_visible: false,
                total_amount: 0.00
            }
        },
        components: {
            SelectTeacher,
            SelectClassLogs
        },
        mounted() {

        },
        computed: {
            selectedTeacherInfo: function() {
                if (this.selectedTeacher == null) {
                    return null;
                } else {
                    let info = "ID: " + this.selectedTeacher.idteacher + " - " + this.selectedTeacher.teacher_name;
                    return info;
                }
            }
        },
        methods: {
            selectTeacher(row) {
                this.selectedTeacher = row[0]
                this.idTeacher = row[0].idteacher

                this.$refs.classLogTable.getRows(this.idTeacher)

                if (this.idTeacher)
                    this.log_visible = true
                else
                    this.log_visible = false

            },

            selectClassLogs(rows) {
                this.selectedClassLogs = rows[0];
                // let total_amount = 0.00;
                // for (let i of rows) {
                //     console.log(i);
                //     total_amount += (i.amount);
                // }
                this.total_amount = rows[0].amount;
            },
            makePayment(){
                let payment = {};
                payment.admin_idadmin = this.admin_idadmin;
                payment.amount = this.total_amount; 
                payment.class_log_idclass_log = this.selectedClassLogs.idclass_log;

                const axios = require('axios');
                this.isBusy = true;
                let url = "http://localhost:8000/api/teacher_payment/";
                axios.post(url, payment)
                    .then(response => {
                        console.log(response);
                        //let idTeacherPayment = response.data.id;
                        //this.addPayment(idTeacherPayment);
                        this.isBusy = false;
                    })
                    .catch(function(error) {
                        console.log(error); 
                        this.isBusy = false;
                    });
            },
            // addPayment(id) {
            //     console.log("Paying")
            //     //let idLogs = [];
            //     let req = {}
            //     req.id = id

            //     const axios = require('axios');
            //     this.isBusy = true;
            //     let url = "http://localhost:8000/api/teacher_pay/";
            //     axios.post(url, req)
            //         .then(response => {
            //             console.log(response);
            //             this.isBusy = false;
            //         })
            //         .catch(function(error) {
            //             console.log(error); 
            //             this.isBusy = false;
            //         });
            // }
        }
    }

</script>
