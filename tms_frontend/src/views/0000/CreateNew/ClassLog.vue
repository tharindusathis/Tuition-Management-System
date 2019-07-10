<template>
  <b-card>
    <h3>Create New Class Log</h3>
    <b-form @submit="onSubmit" @reset="onReset">

      <b-form-group id="input-group-1" label="Select Teacher:" label-for="input-1">

        <b-form-input id="input-1"
          v-model="ui.teacher"
          type="text"
          trim
          required
          maxLength="45"
          disabled
          placeholder="Select a teacher from below table"
        ></b-form-input>

        <table-teacher 
        @rowSelected=
        "form.teacher_idteacher = $event[0]['idteacher']; 
         ui.teacher = $event[0]['teacher_name'] 
        ">  
        </table-teacher>
      </b-form-group>

      <b-form-group id="input-group-2" label="Select Subject:" label-for="input-2">

        <b-form-input id="input-2"
          v-model="ui.subject"
          type="text"
          trim
          required
          maxLength="45"
          disabled
          placeholder="Select a subject from below table"
        ></b-form-input>

        <table-subject 
        @rowSelected=
        "form.subject_idsubject = $event[0]['idsubject']; 
         ui.subject = $event[0]['subject_name'] 
        ">  
        </table-subject>
      </b-form-group>
  
       <b-form-group id="input-group-0" label="Class Name:" label-for="input-0">
        <b-form-input id="input-0"
          v-model="form.name"
          type="text"
          trim
          maxLength="255"
          required
          placeholder="Enter class name here"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-3" label="Hourly fee rate:" label-for="input-3">
        <b-form-input id="input-3"
          v-model="form.hourly_rate"
          type="number"
          trim
          maxLength="10"
          placeholder="Houly fee rate of class"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-5" label="Institute Commission(%):" label-for="input-5">
        <b-form-input id="input-5"
          v-model="form.institute_rate"
          type="number"
          trim
          required
          maxLength="5"
          placeholder="Percentage Commission for institute"
        ></b-form-input>
      </b-form-group>


      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  </b-card>
</template>

<script>
  import TableTeacher from '../SelectFromTable/TableTeachers.vue';

  import TableSubject from '../SelectFromTable/TableSubjects.vue';
  export default {
    data() {
      return {
        ui: {
          teacher: "",
          subject: "",
        },
        form: {
          teacher_idteacher: null,
          subject_idsubject: null,
          hourly_rate: null,
          name: null, 
          institute_rate: null
        },
        isBusy: false,
        api_result: null
      }
    },
    components: {
        TableTeacher,
        TableSubject
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()
        //alert(JSON.stringify(this.form))
        const axios = require('axios'); 
        this.isBusy = true;
        axios.post(
          "http://localhost:8000/api/class", this.form
        ).then(response => {
            console.log(response);  
            this.isBusy = false;
        }).catch(function(error) {
            console.log(error);
            this.isBusy = false;
        });
      },
      onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.name = ''
        this.form.medium = ''
        this.form.grade = ''
        this.form.syllabus_year = ''
      }
    }
  }
</script>