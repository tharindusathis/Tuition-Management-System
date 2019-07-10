<template>
<b-card>
    <h3>Add New Class Log</h3>
    <br>
    <h5>Select Class:</h5>
    <select-class ref="classTable" @rowSelected="selectClass($event)"></select-class>
    <b-collapse :visible="log_visible" id="collapse-logs">
        
<!--
        <h5>Selected Class:</h5>
        <b-list-group>
          <b-list-group-item variant="warning">
          {{ selectedClassInfo }} 
          </b-list-group-item>
        </b-list-group>
-->
        
        
        <br>    
        <h5>Select A Timeslot:</h5>
        <select-timeslots ref="timeslotTable" @rowSelected="selectTimeslots($event)"></select-timeslots>
        
        
<!--
        <h5>Selected Time-slot:</h5>
        <b-list-group>
          <b-list-group-item v-for="item in selectedClassLogs" variant="warning" class="d-flex justify-content-between align-items-center">
             <div>
              <strong>Class Log ID: {{ item.class_log_idclass_log }} - {{ item.class_name }}  </strong>
              <b-badge variant="primary" pill>{{ item.date }} </b-badge>
             </div>
              <div>
              
              <b-badge variant="success" pill>Rs. {{ item.amount }} </b-badge>
                </div>
          </b-list-group-item>
        </b-list-group>
        <br>
-->
        
        <div class="text-right"><b-button  variant="primary" v-on:click="addTimeslot()">Add Class Log</b-button></div>
    </b-collapse>
</b-card>
</template>

<script>
    import SelectClass from './SelectClass.vue';
    import SelectTimeslots from './SelectTimeslots.vue';

    export default {
        props: {
            admin_idadmin: {
                idclass: 90
            }
        },
        data() {
            return {
                idclass: null,
                selectedStudent: null,
                selectedTimeslot: null,
                log_visible: false 
            }
        },
        components: {
            SelectClass,
            SelectClassLogs
        },
        mounted() {

        },
        computed: {
//            selectedStudentInfo: function() {
//                if (this.selectedStudent == null) {
//                    return null;
//                } else {
//                    let info = "ID: " + this.selectedStudent.idstudent + " - " + this.selectedStudent.full_name;
//                    return info;
//                }
//            }
        },
        methods: {
            selectClass(row) {
                this.selectedClass = row[0]
                this.idclass = row[0].idclass
                this.$refs.timeslotTable.getRows(this.idclass)
                if (this.idclass)
                    this.log_visible = true
                else
                    this.log_visible = false

            },
            selectTimeslot(row) {
                this.selectedTimeslot = row;
            },
            makePayment(){
                let payment = {};
                payment.student_idstudent = this.idStudent;
                payment.amount = this.total_amount;
                payment.admin_idadmin = this.admin_idadmin;
                const axios = require('axios');
                this.isBusy = true;
                let url = "http://localhost:8000/api/student_payment/";
                axios.post(url, payment)
                    .then(response => {
                        console.log(response);
                        let student_payment_idstudent_payment = response.data.id;
                        this.addPayment(student_payment_idstudent_payment);
                        this.isBusy = false;
                    })
                    .catch(function(error) {
                        console.log(error); 
                        this.isBusy = false;
                    });
            },
            addPayment(id) {
                console.log("Paying")
                //let idLogs = [];
                let idLogs = this.selectedClassLogs.map(a => a.class_log_idclass_log);
                let req = {}
                req.idStudent = this.idStudent
                req.student_payment_idstudent_payment = id;
                req.idLogs = idLogs;
                console.log(req)

                const axios = require('axios');
                this.isBusy = true;
                let url = "http://localhost:8000/api/student_pay/";
                axios.post(url, req)
                    .then(response => {
                        console.log(response);
                        this.isBusy = false;
                    })
                    .catch(function(error) {
                        console.log(error); 
                        this.isBusy = false;
                    });
            }
        }
    }

</script>
