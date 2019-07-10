<template>
<b-card>
    <h3>Add Student Payment</h3>
    <br>
    <h5>Select Student:</h5>
    <select-student ref="studentTable" @rowSelected="selectStudent($event)"></select-student>
    <b-collapse :visible="log_visible" id="collapse-logs">
        
        <h5>Selected Student:</h5>
        <b-list-group>
          <b-list-group-item variant="warning">
          {{ selectedStudentInfo }} 
          </b-list-group-item>
        </b-list-group>
        
        
        <br>    
        <h5>Select Class Logs to Pay:</h5>
        <select-class-logs ref="classLogTable" @rowSelected="selectClassLogs($event)"></select-class-logs>
        
        
        <h5>Selected Class Logs to Pay:</h5>
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
          <b-list-group-item variant="danger" class="d-flex justify-content-between align-items-center">
               <strong>Total Amount Paying</strong>
               <b-badge variant="success" pill>Rs. {{ total_amount }} </b-badge>
          </b-list-group-item>
        </b-list-group>
        <br>
        
        <div class="text-right"><b-button  variant="primary" v-on:click="makePayment()">Make Payment</b-button></div>
    </b-collapse>
</b-card>
</template>

<script>
    import SelectStudent from './SelectStudent.vue';
    import SelectClassLogs from './SelectClassLogs.vue';

    export default {
        props: {
            admin_idadmin: {
                default: 22
            }
        },
        data() {
            return {
                idStudent: null,
                selectedStudent: null,
                selectedClassLogs: [],
                log_visible: false,
                total_amount: 0.00
            }
        },
        components: {
            SelectStudent,
            SelectClassLogs
        },
        mounted() {

        },
        computed: {
            selectedStudentInfo: function() {
                if (this.selectedStudent == null) {
                    return null;
                } else {
                    let info = "ID: " + this.selectedStudent.idstudent + " - " + this.selectedStudent.full_name;
                    return info;
                }
            }
        },
        methods: {
            selectStudent(row) {
                this.selectedStudent = row[0]
                this.idStudent = row[0].idstudent
                this.$refs.classLogTable.getRows(this.idStudent)
                if (this.idStudent)
                    this.log_visible = true
                else
                    this.log_visible = false

            },
            selectClassLogs(rows) {
                this.selectedClassLogs = rows;
                let total_amount = 0.00;
                for (let i of rows) {
                    console.log(i);
                    total_amount += (i.amount);
                }
                this.total_amount = total_amount;
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
