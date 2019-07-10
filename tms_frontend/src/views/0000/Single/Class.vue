<template>
    <b-card>
        <div>
          <b-button-toolbar>
            <b-button-group class="mx-1">
             <router-link to="/new_class" >
              <b-button variant="primary">Add Class Log</b-button>
              </router-link>
            </b-button-group> 
            
             <b-button-group class="mx-1">
             <router-link to="/new_class" >
              <b-button variant="primary">  Create New Class</b-button>
              </router-link>
            </b-button-group> 
            
            <b-button-group class="mx-1">
             <router-link to="/class_logs" >
              <b-button variant="primary">View Class Logs</b-button>
               </router-link>
            </b-button-group>
          </b-button-toolbar>
          <br>
            <b-card-group deck>
              <b-card
                border-variant="success"
                header="Primary"
                header-bg-variant="success"
                header-text-variant="white"
                align="center"
              >
                <b-card-text>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</b-card-text>
              </b-card>
            </b-card-group>
            <br>
            <h5>Class Timeslots:</h5>
            <custom-table :items="items.timeslots" :fields="fields.timeslots"></custom-table>
            
            <br>
            <h5>Class Logs:</h5>
            <custom-table :items="items.classlogs" :fields="fields.classlogs"></custom-table>
            
            <br>
            <h5>Class Exams:</h5>
            <custom-table :items="items.exams" :fields="fields.exams"></custom-table>
            
            <br>
            <h5>Class Attendance of Students:</h5>
            <custom-table :items="items.attendance" :fields="fields.attendance"></custom-table>
        </div>
    </b-card>
</template>

<script>
      import CustomTable from '../SelectFromTable/CustomTable.vue';
    export default {
        props: {
            idclass: {
                default: 90
            }
        },
        data() {
            return {
                isBusy: false, 
                fields: {
                    temp:  [
                      { key: 'student_name', label: 'Pdsdserson Full name', sortable: true, sortDirection: 'desc' },
                      { key: 'age', label: 'Person age', sortable: true, class: 'text-center' },
                      { key: 'isActive', label: 'is Active' },
                      { key: 'actions', label: 'Actions' }
                    ],
                    timeslots: [
                        { key: 'idclass', label: 'Class ID' , sortable: true },
                      { key: 'idtimeslot', label: 'Timeslot ID', sortable: true  },
                      { key: 'weekday', label: 'Day', sortable: true },
                      { key: 'start_time', label: 'Start Time', sortable: true},
                      { key: 'end_time', label: 'End Time', sortable: true},
                      { key: 'idhall', label: 'Hall ID', sortable: true},
                      { key: 'name', label: 'Hal Name', sortable: true}
                    ],
                    classlogs: [
                          { key: 'idclass_log', label: 'Class Log ID', sortable: true },
                          { key: 'idhall', label: 'Hall ID', sortable: true },
                          { key: 'idtimeslot', label: 'Timeslot ID', sortable: true },
                          { key: 'date', label: 'Date', sortable: true },
                          { key: 'start_time', label: 'Start Time', sortable: true },
                          { key: 'end_time', label: 'End Time', sortable: true },
                          { key: 'payed_to_teacher', label: 'Payed To Teacher', sortable: true } 
                    ],
                    attendance: [
                          { key: 'idclass_log', label: 'Class Log ID', sortable: true },
                          { key: 'class_idclass', label: 'Class ID', sortable: true },
                          { key: 'idstudent', label: 'Student ID', sortable: true },
                          { key: 'full_name', label: 'Full Name', sortable: true },
                            { key: 'date', label: 'Date', sortable: true },
                          { key: 'state', label: 'Attendance', sortable: true },
                          { key: 'payed_from_student', label: 'Payed By Student', sortable: true } 
                    ],
                    exams: [
                         { key: 'idexam', label: 'Exam ID', sortable: true, },
                          { key: 'exam_name', label: 'Name', sortable: true, },
                          { key: 'date_time', label: 'Time', sortable: true, sortDirection: 'desc' },
                          { key: 'duration', label: 'Duration(min)', sortable: true },
                    ]
                },
                items: {
                    temp: [
                          { idstudent: 111, student_name: 'Dickerson Macdonald' },
                            { idstudent: 22, student_name: 'Dickerson Macdonald' },
                    ],
                    timeslots: [],
                    classlogs: [],
                    attendance: [],
                    exams: []
                }
            }
        },  
        components: {
            CustomTable
        },
        mounted(){
          const axios = require('axios'); this.isBusy = true;
            let url = "http://localhost:8000/api/one_class/" + this.idclass
            axios.get(url)
                .then(response => {
                    console.log(response.data.timeslots);
                    this.items.timeslots = response.data.timeslots;
                    this.items.classlogs = response.data.class_logs;
                    this.items.attendance = response.data.attendance;
                    this.items.exams = response.data.exams;
                    this.isBusy = false;   
                 })
            .catch(function(error) {
              console.log(error);this.items = [];this.isBusy = false;
            });
         }
    }
</script>