<template>
  <h3 class="text-center py-4 my-5">Laravel and Vue Contact form</h3>
  <div class="card shadow-sm rounded border-0">
    <div class="card-body">
      <small class="text-muted"> Please fill in the form</small>

        <h4 v-if="successMessage" class="text-center alert alert-success rounded-0"> {{ successMessage }}</h4>
        <h4 v-if="errorMessage" class="text-center alert alert-success rounded-0"> {{ errorMessage }}</h4>
      <form @submit="saveContact" class="mt-4">
        <div class="form-group row mb-4">
          <div class="col-md-6 mb-1">
            <label for="name"> Full name </label>
            <input
              v-model="form.name"
              id="name"
              type="text"
              placeholder="John doe"
              class="form-control rounded-0 py-2 bg-white"
            />
            <span v-if="errors.name" class="text-danger mt-2">
              {{ errors.name }}
            </span>
          </div>
          <div class="col-md-6 mb-1">
            <label for="gender" class="text-left"> Gender </label>
            <select
              id="gender"
              v-model="form.gender"
              class="form-control rounded-0 py-2 bg-white"
            >
              <option selected disabled>Select gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
            <span v-if="errors.gender" class="text-danger mt-2">
              {{ errors.gender }}
            </span>
          </div>
        </div>
        <div class="form-group row mb-4">
          <div class="col-md-12">
            <label for="email"> Email address</label>
            <input
              id="email"
              v-model="form.email"
              placeholder="username@domain.com"
              class="form-control rounded-0 bg-white py-2"
            />
            <span v-if="errors.email" class="text-danger mt-2">
              {{ errors.email }}
            </span>
          </div>
        </div>
        <div class="form-group row mb-4">
          <div class="col-md-12">
            <label for="content"> Content</label>
            <textarea
              v-model="form.content"
              id="content"
              placeholder="Content goes here..."
              class="form-control rounded-0 bg-white"
              rows="7"
            ></textarea>
            <span v-if="errors.content" class="text-danger mt-2">
              {{ errors.content }}
            </span>
          </div>
        </div>
        <div class="form-group row mb-4">
          <div class="col-md-6">
            <button
              type="reset"
              class="btn btn-danger float-start rounded-0 shadow-sm"
            >
              Reset
            </button>
          </div>
          <div class="col-md-6">
            <button
              type="submit"
              class="btn btn-primary float-end rounded-0 shadow-sm"
            >
              Submit
            </button>
          </div>
        </div>
      </form>
      <div class="">
          <a href="/login"> Admin Login</a> | <a href="/register"> Register</a>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      errors: { name: "", gender: "", email: "", content: "" },
      form: {
        name: null,
        gender: null,
        email: null,
        content: null,
        formValid: true,
      },
      successMessage: null,
      errorMessage: null
    };
  },
  methods: {
    saveContact: function (event) {
      event.preventDefault();
      if (!this.form.name || this.form.name.length < 3) {
        this.errors.name = "Full name is required";
        this.formValid = false;
      } else {
        this.errors.name = null;
        this.formValid = true;
      }

      if (!this.form.gender) {
        this.errors.gender = "Gender is required";
        this.formValid = false;
      } else {
        this.errors.gender = null;
        this.formValid = true;
      }

      if (!this.form.email) {
        this.errors.email = "Email address is required";
        this.formValid = false;
      } else if (!this.validEmail(this.form.email)) {
        this.errors.email = "Please enter a valid email address";
        this.formValid = false;
      } else {
        this.errors.email = null;
        this.formValid = true;
      }

      if (!this.form.content) {
        this.errors.content = "Content address is required";
        this.formValid = false;
      } else {
        this.errors.content = null;
        this.formValid = true;
      }
      if (this.formValid) {
        axios
          .post("/save-contact", this.form)
          .then((response) => {
              if(response.data.success) {
                  this.successMessage = response.data.message;
                  this.form = {};
                  setTimeout(()=> {
                    this.successMessage = null;
                  }, 2000)
              }
          })
          .catch((error) => {
              console.log(error);
                  this.errorMessage = error.data.message;
                  setTimeout(()=> {
                    this.errorMessage = null;
                  }, 2000)
          });
      }
    },
    validEmail: function (email) {
      var re =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
  },
};
</script>
