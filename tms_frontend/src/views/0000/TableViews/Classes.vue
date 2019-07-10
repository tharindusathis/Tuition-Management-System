<template>
  <b-card>
        <div>
          <b-button-toolbar>
            <b-button-group class="mx-1">
             <router-link to="/new_class" >
              <b-button variant="primary">Create New Class</b-button>
              </router-link>
            </b-button-group>
            <span></span>
            <b-button-group class="mx-1">
             <router-link to="/class_logs" >
              <b-button variant="primary">View Class Logs</b-button>
               </router-link>
            </b-button-group>
          </b-button-toolbar>
        </div>
        <br>
      <table-class></table-class>
  </b-card>
</template>

<script>
  import TableClass from '../Tables/TableClasses.vue';

  export default {
    data() {
      return {
          
      }
    },
    components: {
        TableClass
    },
    methods: {
    }
  }
</script>