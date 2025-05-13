<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ title }}</h3>
      <div class="card-tools">
        <div class="input-group input-group-sm" v-if="showSearch" style="width: 150px;">
          <input type="text" name="table_search" class="form-control float-right" 
                 placeholder="Search" v-model="searchText" @input="handleSearch">
          <div class="input-group-append">
            <button type="submit" class="btn btn-default">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th v-for="(column, index) in columns" :key="index">{{ column.label }}</th>
            <th v-if="showActions">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, rowIndex) in filteredItems" :key="rowIndex">
            <td v-for="(column, colIndex) in columns" :key="colIndex">
              {{ item[column.field] }}
            </td>
            <td v-if="showActions" class="project-actions text-right">
              <button v-if="showViewButton" @click="$emit('view', item)" class="btn btn-primary btn-sm">
                <i class="fas fa-folder"></i> View
              </button>
              <button v-if="showEditButton" @click="$emit('edit', item)" class="btn btn-info btn-sm">
                <i class="fas fa-pencil-alt"></i> Edit
              </button>
              <button v-if="showDeleteButton" @click="$emit('delete', item)" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i> Delete
              </button>
            </td>
          </tr>
          <tr v-if="filteredItems.length === 0">
            <td :colspan="showActions ? columns.length + 1 : columns.length" class="text-center">
              No data available
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer clearfix" v-if="hasPagination">
      <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
  title: {
    type: String,
    default: 'Data Table'
  },
  columns: {
    type: Array,
    required: true
    // Expected format: [{ field: 'fieldName', label: 'Column Label' }]
  },
  items: {
    type: Array,
    required: true
  },
  showSearch: {
    type: Boolean,
    default: true
  },
  showActions: {
    type: Boolean,
    default: true
  },
  showViewButton: {
    type: Boolean,
    default: true
  },
  showEditButton: {
    type: Boolean,
    default: true
  },
  showDeleteButton: {
    type: Boolean,
    default: true
  },
  hasPagination: {
    type: Boolean,
    default: false
  }
});

defineEmits(['view', 'edit', 'delete', 'search']);

const searchText = ref('');

const filteredItems = computed(() => {
  if (!searchText.value) return props.items;
  
  return props.items.filter(item => {
    return props.columns.some(column => {
      const value = item[column.field];
      return value && value.toString().toLowerCase().includes(searchText.value.toLowerCase());
    });
  });
});

function handleSearch() {
  emit('search', searchText.value);
}
</script>
