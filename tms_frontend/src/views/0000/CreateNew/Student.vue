<template>
  <b-card>
    <h3>Register New Student</h3>
    <b-form @submit="onSubmit" @reset="onReset">

      <b-form-group id="input-group-1" label="Name with initials:" label-for="input-1">
        <b-form-input id="input-1"
          v-model="form.full_name"
          type="text"
          trim
          maxLength="255"
          required
          placeholder="Enter name here"
        ></b-form-input>
      </b-form-group>
      <b-row>
    <b-col class='sm-6'>
      <b-form-group id="input-group-2" label="First name:" label-for="input-2">
        <b-form-input id="input-2"
          v-model="form.fname"
          type="text"
          trim
          maxLength="45"
          placeholder="Enter name here"
        ></b-form-input>
      </b-form-group>
    </b-col>
    <b-col class='sm-6'>
      <b-form-group id="input-group-3" label="Last name:" label-for="input-3">
        <b-form-input id="input-3"
          v-model="form.lname"
          type="text"
          trim
          maxLength="45"
          placeholder="Enter name here"
        ></b-form-input>
      </b-form-group>
    </b-col>
  </b-row>
  <b-row>
    <b-col class='sm-6'>
      <b-form-group id="input-group-4" label="Date of Birth:" label-for="input-4">
        <b-form-input id="input-4"
          v-model="form.dob"
          type="date"
          required
        ></b-form-input>
      </b-form-group>
</b-col>
    <b-col class='sm-6'>
      <b-form-group id="input-group-5" label="Contact Number:" label-for="input-5">
        <b-form-input id="input-5"
          v-model="form.contact_no"
          type="number"
          trim
          maxLength="20"
          placeholder="Enter mobile number here"
        ></b-form-input>
      </b-form-group>
</b-col></b-row>
<b-row>
    <b-col class='sm-6'>
      <b-form-group id="input-group-6" label="Parent's Name:" label-for="input-6">
        <b-form-input id="input-6"
          v-model="form.parent_name"
          type="text"
          trim
          maxLength="255"
          required
          placeholder="Enter name here"
        ></b-form-input>
      </b-form-group>
</b-col>
    <b-col class='sm-6'>
      <b-form-group id="input-group-7" label="Parent's Contact Number:" label-for="input-7">
        <b-form-input id="input-7"
          v-model="form.parent_contact_no"
          type="number"
          trim
          required
          maxLength="20"
          placeholder="Enter mobile number here"
        ></b-form-input>
      </b-form-group>
</b-col></b-row>
      <b-form-group id="input-group-8" label="Address:" label-for="input-8">
        <b-form-textarea id="input-8"
          v-model="form.address"
          type="text"
          trim
          required
          maxLength="255"
          placeholder="Address here"
          rows="3"
          max-rows="10"
        ></b-form-textarea>
      </b-form-group>

      <b-form-group id="input-group-9" label="Notes:" label-for="input-9">
        <b-form-textarea id="input-9"
          v-model="form.notes"
          type="text"
          trim
          maxLength="255"
          placeholder="Note here"
          rows="3"
          max-rows="10"
        ></b-form-textarea>
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
          dob: null,
          contact_no: null,
          parent_name: null,
          parent_contact_no: null,
          address: null,
          notes: null,
          fname: null,
          lname: null,
          full_name: null
        },
        isBusy: false
      }
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()
        //alert(JSON.stringify(this.form))
        const axios = require('axios'); 
        this.isBusy = true;
        axios.post(
          "http://localhost:8000/api/student", this.form
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
        this.form.dob = ''
        this.form.contact_no = ''
        this.form.parent_name = ''
        this.form.parent_contact_no = ''
        this.form.address = ''
        this.form.notes = ''
        this.form.fname = ''
        this.form.lname = ''
        this.form.fullname = ''
      }
    }
  }
</script>