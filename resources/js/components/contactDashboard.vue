<template>
  <h3 class="text-center py-4 my-5">Admin Dashboard</h3>
  <div class="card">
    <div class="card-header py-4">All Contacts</div>
    <div class="card-body">
      <h4
        v-if="successMessage"
        class="text-center alert alert-success rounded-0"
      >
        {{ successMessage }}
      </h4>
      <div class="row">
        <div class="col-md-8">
          <label for="search">
            Search <small class="text-muted"> by name or email</small></label
          >
          <input
            id="search"
            v-model="searchForm.query"
            @keyup="search()"
            type="text"
            placeholder="Search here..."
            class="form-control rounded-0 mb-3 py-2"
          />
        </div>
        <div class="col-md-4">
          <label for="filter">
            Filter <small class="text-muted"> by gender</small></label
          >
          <select
            @change="filter()"
            v-model="filterForm.query"
            id="filter"
            class="form-control rounded-0 py-2"
          >
            <option selected disabled>Select option</option>
            <option v-for="option in filterOptions" :key="option">
              {{ option }}
            </option>
          </select>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr class="table-primary">
              <th>Name</th>
              <th>Gender</th>
              <th>Email</th>
              <th>Content</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="contact in contacts" :key="contact.id">
              <td>{{ contact.name }}</td>
              <td>{{ contact.gender }}</td>
              <td>{{ contact.email }}</td>
              <td>{{ contact.content }}</td>
              <td>
                <button
                  @click="deleteContact(contact.id)"
                  class="btn btn-danger btn-sm rounded-0 shadow"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="text-left btn-group">
          <button
            v-for="link in links"
            :key="link.label"
            @click="paginate(link.url)"
            :class="{ 'text-muted disabled': link.active }"
            class="btn btn-outline-dark btn-sm rounded-0"
          >
            {{ link.label }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      contacts: [],
      links: null,
      successMessage: null,
      searchForm: {
        query: null,
      },
      filterOptions: ["male", "female", "other", "all"],
      filterForm: {
        query: "Select option",
      },
    };
  },
  mounted: function () {
    axios
      .get("/get-contacts")
      .then((response) => {
        this.contacts = response.data.contacts.data;
        this.links = response.data.contacts.links;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  methods: {
    deleteContact: function (id) {
      if (!window.confirm("You wont be able to recover this record")) {
        return;
      }

      axios
        .delete("/delete-contact/" + id)
        .then((response) => {
          this.successMessage = response.data.message;
          this.getContacts();
          setTimeout(() => {
            this.successMessage = null;
          }, 2000);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getContacts: function () {
      axios
        .get("/get-contacts")
        .then((response) => {
          this.contacts = response.data.contacts.data;
          this.links = response.data.contacts.links;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    paginate: function (link) {
      axios
        .get(link)
        .then((response) => {
          this.contacts = response.data.contacts.data;
          this.links = response.data.contacts.links;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    search: function () {
      if (this.searchForm.query.length > 3) {
        axios
          .post("/search-contact", this.searchForm)
          .then((response) => {
            this.contacts = response.data.contacts.data;
            this.links = response.data.contacts.links;
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.getContacts();
      }
    },
    filter: function () {
      if (this.filterForm.query) {
        axios
          .get("/filter-contact/" + this.filterForm.query)
          .then((response) => {
            this.contacts = response.data.contacts.data;
            this.links = response.data.contacts.links;
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.getContacts();
      }
    },
  },
};
</script>

