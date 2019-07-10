  <template>
    <b-card>
      <h3>Register New Hall</h3>
      <b-form @submit="onSubmit" @reset="onReset">

        <b-row>
          <b-col class='sm-6'>
            <b-form-group id="input-group-2" label="Hall name:" label-for="input-2">
              <b-form-input id="input-2"
              v-model="form.name"
              type="text"
              trim
              required
              maxLength="45"
              placeholder="Enter name here"
              ></b-form-input>
            </b-form-group>
          </b-col>
          <b-col class='sm-6'>
            <b-form-group id="input-group-3" label="Note:" label-for="input-3">
              <b-form-input id="input-3"
              v-model="form.note"
              type="text"
              trim
              maxLength="45"
              placeholder="Enter note here"
              ></b-form-input>
            </b-form-group>
          </b-col>
        </b-row>
        


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
              note: null, 
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
            "http://localhost:8000/api/hall", this.form
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
          this.form.note = '' 
        }
      }
    }
    </script>