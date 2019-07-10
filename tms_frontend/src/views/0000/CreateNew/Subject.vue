<template>
  <b-card>
    <h3>Create New Subject</h3>
    <b-form @submit="onSubmit" @reset="onReset">

      <b-form-group id="input-group-1" label="Subject Name:" label-for="input-1">
        <b-form-input id="input-1"
          v-model="form.name"
          type="text"
          trim
          maxLength="255"
          required
          placeholder="Enter subject name here"
        ></b-form-input>
      </b-form-group>
  
      <b-form-group id="input-group-2" label="Grade:" label-for="input-2">
        <b-form-input id="input-2"
          v-model="form.grade"
          type="text"
          trim
          required
          maxLength="45"
          placeholder="Enter grade here"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-3" label="Syllabus year:" label-for="input-3">
        <b-form-input id="input-3"
          v-model="form.syllabus_year"
          type="number"
          trim
          maxLength="4"
          placeholder="Enter year of syllabus here"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-5" label="Language:" label-for="input-5">
        <b-form-input id="input-5"
          v-model="form.medium"
          type="text"
          trim
          required
          maxLength="20"
          placeholder="Enter language here"
        ></b-form-input>
      </b-form-group>


      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  </b-card>
</template>

<script>
  export default {
    data() {
      return {
        form: {
          name: null,
          grade: null,
          syllabus_year: null,
          medium: null
        },
        isBusy: false,
        api_result: null
      }
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()
        //alert(JSON.stringify(this.form))
        const axios = require('axios'); 
        this.isBusy = true;
        axios.post(
          "http://localhost:8000/api/subject", this.form
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