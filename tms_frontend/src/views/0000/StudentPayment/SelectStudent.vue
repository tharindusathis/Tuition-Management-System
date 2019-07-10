<template>
<b-row><b-col sm='12'>
  <b-card><b-container fluid>

    <!-- User Interface controls -->
    <b-row>
      <b-col md="4" class="my-1">
        <b-form-group label-cols-sm="3" label="Filter" class="mb-0">
          <b-input-group>
            <b-form-input v-model="filter" placeholder="Type to Search" />
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
      <b-col md="4" class="my-1">
        <b-form-group label-cols-sm="3" label="Per page" class="mb-0">
          <b-form-select :options="pageOptions" v-model="perPage" />
        </b-form-group>
      </b-col>

      <b-col md="4" class="my-1">
        <b-pagination
          :total-rows="totalRows"
          :per-page="perPage"
          v-model="currentPage"
          class="my-0"
        />
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table
      selectable
      small=true
      hover=true
      select-mode="single"
      show-empty
      stacked="md"
      :items="items"
      :busy.sync="isBusy"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
      @row-selected="rowSelected"
    >
    <div slot="table-busy" class="text-center text-danger my-2">
      <b-spinner class="align-middle" />
      <strong> Loading...</strong>
    </div>
    
    </b-table>

  </b-container>
</b-card>

</b-col></b-row>
</template>

<script>
  const items = []

  export default {
    data() {
      return {
        items: items, isBusy: false,
        fields: [
          { key: 'idstudent', label: 'ID' , sortable: true },
          { key: 'student_name', label: 'Name', sortable: true  },
          { key: 'full_name', label: 'Full Name', sortable: true}
        ],
        currentPage: 1,
        perPage: 5,
        totalRows: items.length,
        pageOptions: [5, 10, 50, 100, 500],
        sortBy: null,
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
        modalInfo: { title: '', content: '' },
        selected: []
      }
    },
    mounted(){
      const axios = require('axios'); this.isBusy = true;
        axios.get("http://localhost:8000/api/all_student_min")
            .then(response => {
                const items = response.data.all;
                console.log(items);this.items = items;this.totalRows = items.length;this.isBusy = false;
             })
        .catch(function(error) {
          console.log(error);this.items = [];this.isBusy = false;
        });
    },
    computed: {
     // totalRows: function () { return this.items.length },

      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      }
    },
    methods: {
      info(item, index, button) {
        this.modalInfo.title = `Row index: ${index}`
        this.modalInfo.content = JSON.stringify(item, null, 2)
        this.$root.$emit('bv::show::modal', 'modalInfo', button)
      },
      resetModal() {
        this.modalInfo.title = ''
        this.modalInfo.content = ''
      },
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },
      rowSelected(items) {
        this.selected = items
        this.$emit('rowSelected', this.selected);
      }
    }
  }
</script>