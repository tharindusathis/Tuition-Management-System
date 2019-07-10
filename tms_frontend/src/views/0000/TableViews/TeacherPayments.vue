<template>
  <b-card> 
        <div>
          <b-button-toolbar>
            <b-button-group class="mx-1">
             <router-link to="/new_teacherpayment" >
              <b-button variant="primary">New Payment</b-button>
              </router-link>
            </b-button-group>
            <span></span>

          </b-button-toolbar>
        </div>
        <br>
      <main-table></main-table>
  </b-card>
</template>

<script>
  import MainTable from '../Tables/TableTeacherPayments.vue';

  export default {
    data() {
      return {
          
      }
    },
    components: {
        MainTable
    },
    methods: {
    }
  }
</script>
