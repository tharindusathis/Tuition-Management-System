<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
          <b-card no-body class="mx-4">
            <b-card-body class="p-4">
              <b-form>
                <h1>Register</h1>
                <p class="text-muted">Create your account</p>
                
                <b-form @submit="onSubmit" @reset="onReset" v-if="show">
          <b-form-group
            id="input-group-1"
            label="Email address:"
            label-for="input-1"
            description="We'll never share your email with anyone else."
          >
            <b-form-input
              id="input-1"
              v-model="form.email"
              type="email"
              required
              placeholder="Enter email"
            ></b-form-input>
          </b-form-group>

          <b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
            <b-form-input
              id="input-2"
              v-model="form.name"
              required
              placeholder="Enter name"
            ></b-form-input>
          </b-form-group>

          <b-form-group id="input-group-3" label="Type:" label-for="input-3">
            <b-form-select
              id="input-3"
              v-model="form.type"
              :options="types"
              required
            ></b-form-select>
          </b-form-group>


            
          <b-form-group id="input-group-4" label="Password:" label-for="input-4">
            <b-form-input
              id="input-4"
              v-model="form.password"
              type="password"
              required
            ></b-form-input>
          </b-form-group>



          

          <b-button type="submit" variant="primary">Submit</b-button>
          <b-button type="reset" variant="danger">Reset</b-button>
        </b-form>

                <!-- <b-button variant="success" block>Create Account</b-button> -->
              </b-form>
            </b-card-body>
            <b-card-footer class="p-4">
              <!-- <b-row>
                <b-col cols="6">
                  <b-button block class="btn btn-facebook"><span>facebook</span></b-button>
                </b-col>
                <b-col cols="6">
                  <b-button block class="btn btn-twitter" type="button"><span>twitter</span></b-button>
                </b-col>
              </b-row> -->
            </b-card-footer>
          </b-card>
        </b-col>
      </b-row>
    </div>
  </div>
</template>


<script>
  export default {
    data() {
      return {
        form: {
          email: '',
          name: '',
          type: null, 
          password: '',
        },
        types: [{ text: 'Select Type', value: null },{ text: 'Admin', value: 1 },{ text: 'Teacher', value: 2 } ],
        show: true,
        isBusy: false

      }
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()
        this.$router.push('/');
        const axios = require('axios'); 
        //this.isBusy = true;
        axios.post(
          "http://localhost:8000/api/auth/signup", this.form
        ).then(response => {
            console.log(response);  
            this.$router.push('/classes')
            //this.isBusy = false;
        }).catch(function(error) {
            console.log(error);
            //this.isBusy = false;
        });
      },
      onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.name = ''
        this.form.type = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }
    }
  }
</script>