<template>
    <div class="module-nav">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a class="txt-gray" href="/partners">Partners</a></li>
          <li class="breadcrumb-item active txt-dark" aria-current="page">New partner</li>
        </ol>
      </nav>
      <h2>New Partner</h2>
      <p>On-board a new partner to UNICON.</p>
      <div class="d-flex justify-content-between">
        <div>
          <h3>Partner Info</h3>
          <p>Enter the photo and basic details of the partner here</p>
        </div>



      </div>
      <div>
          <button class="btn btn-light border-dark p-3 btn-action">Cancel</button>
          <button class="btn btn-primary p-3 btn-action" form="form-submit" type="submit">Add</button>
        </div>
        <hr/>

        <form
            id="form-submit"
            class="row g-3"
            @submit.prevent="formSubmit"
            method="post"
        >

    <div class="row mb-2 p-3">
      <label for="first_name" class="col-md-3 col-form-label text-md-start">{{ 'Name' }}</label>

      <div class="col-md-5 offset-md-0 text-center">
        <input
          id="name"
          type="text"
          class="form-control"
          :class="{'is-invalid': errors.name}"
          name="name"
          v-model="formData.name"
          autocomplete="name"
          autofocus
        />

        <span v-if="errors.name" class="invalid-feedback" role="alert">
          <strong>{{ errors.name }}</strong>
        </span>
      </div>
    </div>

    <hr/>

    <div class="row mb-2 p-3">
      <label for="email" class="col-md-3 col-form-label text-md-start">{{ 'Email Address' }}</label>

      <div class="col-md-5 offset-md-0 text-center">
        <input
          id="email"
          type="text"
          class="form-control"
          :class="{'is-invalid': errors.email}"
          name="email"
          v-model="formData.email"
          autocomplete="email"
          autofocus
        />

        <span v-if="errors.email" class="invalid-feedback" role="alert">
          <strong>{{ errors.email }}</strong>
        </span>
      </div>
    </div>
    <hr/>

    <div class="row mb-2 p-3">
      <label for="website" class="col-md-3 col-form-label text-md-start">{{ 'Website'}}</label>

      <div class="col-md-5 offset-md-0 text-center">
        <input
          id="website"
          type="text"
          class="form-control"
          :class="{'is-invalid': errors.website}"
          name="website"
          v-model="formData.website"
          autocomplete="website"
          autofocus
        />

        <span v-if="errors.website" class="invalid-feedback" role="alert">
          <strong>{{ errors.website }}</strong>
        </span>
      </div>
    </div>
    <hr/>

    <div class="row mb-2 p-3">
      <label for="phone" class="col-md-3 col-form-label text-md-start">{{ 'Phone Number' }}</label>

      <div class="col-md-5 offset-md-0 text-center">
        <input
          id="phone"
          type="text"
          class="form-control"
          :class="{'is-invalid': errors.phone}"
          name="phone"
          v-model="formData.phone"
          autocomplete="phone"
          autofocus
        />

        <span v-if="errors.phone" class="invalid-feedback" role="alert">
          <strong>{{ errors.phone }}</strong>
        </span>
      </div>
    </div>
    <hr/>

    <div class="row mb-2 p-3">
      <label for="address" class="col-md-3 col-form-label text-md-start">{{ 'Address' }}</label>

      <div class="col-md-5 offset-md-0 text-center">
        <input
          id="address"
          type="text"
          class="form-control"
          :class="{'is-invalid': errors.address}"
          name="address"
          v-model="formData.address"
          autocomplete="address"
          autofocus
        />

        <span v-if="errors.address" class="invalid-feedback" role="alert">
          <strong>{{ errors.address }}</strong>
        </span>
      </div>
    </div>
    <hr/>

    <div class="row mb-2 p-3">
      <label for="logo" class="col-md-3 col-form-label text-md-start">{{ 'Partner Logo' }} <br><span class="txt-gray"> {{ 'This will be used to identify the partner' }}</span> </label>

      <div class="col-md-5 offset-md-0 text-center">

        <div class="row styled">
          <div class="col-3">
            <img src="/assets/images/faces/face1.jpg" alt="logo">
          </div>
          <div class="col-9">
            <input id="logo" type="file"  class="form-control-file" :class="{'is-invalid': errors.logo}" name="logo"  ref="logoInput" placeholder="text"/>
          </div>
        </div>

        <span v-if="errors.logo" class="invalid-feedback" role="alert">
            <strong>{{ errors.logo }}</strong>
        </span>
    </div>

    </div>
    <hr/>

    <div class="row mb-2 p-3">
      <label for="country" class="col-md-3 col-form-label text-md-start">{{ 'Country' }}</label>

      <div class="col-md-5 offset-md-0 text-center">
        <select id="country" class="form-control"  name="member" v-model="formData.country_id">
            <option value="">Select country <i class="mdi mdi-account"></i></option>
            <option v-for="country in countries" :value="country.id">{{ country.name }}</option>
        </select>
      </div>
    </div>
    <hr/>

    <div class="row mb-2 p-3">
      <label for="business_type" class="col-md-3 col-form-label text-md-start">{{ 'Business type' }} <br><span class="txt-gray"> {{ 'Brief description of the main concern of the business e.g Software, Marketing' }}</span> </label>

      <div class="col-md-5 offset-md-0 text-center">
        <select
          id="business_type"
          class="form-control"
          :class="{'is-invalid': errors.business_type}"
          name="business_type"
          v-model="formData.business_type"
        >
        <option value="">Business type</option>
          <option value="Software">Software</option>
          <option value="Hardware">Hardware</option>
          <option value="Consulting">Consulting</option>
          <!-- Add more business types as needed -->
        </select>

        <span v-if="errors.business_type" class="invalid-feedback" role="alert">
          <strong>{{ errors.business_type }}</strong>
        </span>
      </div>
    </div>
    <hr/>

    <div class="row mb-2 p-3 about">
      <label for="about" class="col-md-3 col-form-label text-md-start">{{ 'About' }} <br><span class="txt-gray"> {{ 'Write a short introduction of the business.' }}</span> </label>

      <div class="col-md-5 offset-md-0 text-center">
        <textarea
          id="about"
          class="form-control"
          :class="{'is-invalid': errors.about}"
          name="about"
          v-model="formData.about"
          autocomplete="about"
          autofocus
        ></textarea>
       <span class="text-count"> {{ '275 characters left' }}</span>

        <span v-if="errors.about" class="invalid-feedback" role="alert">
          <strong>{{ errors.about }}</strong>
        </span>
      </div>
    </div>
    <hr/>
    <div class="row mb-2 p-3">
      <label for="business_type" class="col-md-3 col-form-label text-md-start">{{ 'Documents' }} <br><span class="txt-gray">
        {{ 'Upload any relevant documents related to this business e.g KRA Pin, Company Profile e.t.c' }}</span> </label>

      <div class="col-md-5 offset-md-0 text-center">
        <div class="col-9 styled">
            <input id="documents" type="file"  class="form-control-file" :class="{'is-invalid': errors.documents}" name="documents"  ref="logoInput" placeholder="docs"/>
          </div>

        <span v-if="errors.documents" class="invalid-feedback" role="alert">
          <strong>{{ errors.documents }}</strong>
        </span>
      </div>
    </div>

    <hr>

    <div class="row mb-2 p-3">
      <label for="members" class="col-md-3 col-form-label text-md-start">{{ 'Members' }} <br><span class="txt-gray">
        {{ 'Invite or select the relevant members to this organisation.' }}</span> </label>

      <div class="col-md-9 offset-md-0 text-center">

        <div class="row">
    <div class="col-md-4">
        <select id="member_id" class="form-control" name="member" v-model="formData.member_id">
            <option value="">Enter name or email address <i class="mdi mdi-account"></i></option>
            <option v-for="member in members" :value="member.id">{{ member.email }}</option>
        </select>
    </div>
    <div class="col-md-3">
        <select id="department_id" class="form-control" name="department" v-model="formData.department_id">
            <option value="">Select department <i class="mdi mdi-account"></i></option>
            <option v-for="department in departments" :value="department.id">{{ department.name }}</option>
        </select>
    </div>
    <div class="col-md-3">
        <select id="role_id" class="form-control" name="role" v-model="formData.role_id">
            <option value="">Select Role<span class="mdi mdi-chevron-down"></span></option>
            <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
        </select>
    </div>
    <div class="col-2">
        <button type="button" class="btn btn-warning ml-0 text-light" @click.prevent="addToList">
            Add
        </button>
    </div>
</div>

    <!-- Display selected items -->
    <ul>
    <li v-for="(item, index) in selectedItems" class="list-item">

        <span>
            <i class="mdi mdi-email-outline"></i>
            {{ item.memberEmail }} <span class="btn-suc"> {{ item.departmentName }} </span> <span class="btn-suc">{{ item.roleName }}</span>
        </span>
        <i class="mdi mdi-delete delete-icon" @click="removeFromList(index)"></i>
    </li>
    </ul>
        <span v-if="errors.documents" class="invalid-feedback" role="alert">
          <strong>{{ errors.documents }}</strong>
        </span>
      </div>
    </div>

    <hr>


    <div class="align-right mb-5">
        <div class="text-right mt-3 mb-5">
          <button class="btn btn-light border-dark btn-action">Cancel</button>
          <button type="submit" class="btn btn-primary btn-action">Add</button>
        </div>

</div>



     </form>

      <hr/>
    </div>
  </template>

  <script>
  export default {
    data() {
    return {
        base_url:'../',
        countries:[],
        members:[],
        departments:[],
        roles:[],
      formData: {
        name: '',
        email: '',
        website: '',
        phone: '',
        address: '',
        logo: '',
        country: '',
        business_type: '',
        about: '',
        document_id: '',
        member_id: '',
        department_id: '',
        role_id: '',
        country_id: '',
        role_id: '',
      },
      members: [],
        departments: [],
        roles: [],
        selectedItems: [],
      errors: {},
    };
  },
  mounted() {
      this.fetchDepartments();
      this.fetchMembers();
      this.fetchRoles();
      this.fetchCountries();
    },
    methods: {

        fetchDepartments(){
                let uri =this.base_url+`api/v1/department-list`;
                axios.get(uri).then((response) => {
                    this.departments = response.data;
                });
            },

            addToList() {
            // Get the selected member, department, and role
            const selectedMember = this.members.find(member => member.id === this.formData.member_id);
            const selectedDepartment = this.departments.find(department => department.id === this.formData.department_id);
            const selectedRole = this.roles.find(role => role.id === this.formData.role_id);

            // Add the selected item to the list
            this.selectedItems.push({
                memberEmail: selectedMember.email,
                departmentName: selectedDepartment.name,
                roleName: selectedRole.name
            });

            // Reset the form fields
            this.formData.member_id = '';
            this.formData.department_id = '';
            this.formData.role_id = '';
        },

        removeFromList(index) {
            this.selectedItems.splice(index, 1);
        },

            fetchMembers(){
                let uri =this.base_url+`api/v1/user-list`;
                axios.get(uri).then((response) => {
                    this.members = response.data;
                });
            },

            fetchRoles(){
                let uri =this.base_url+`api/v1/role-list`;
                axios.get(uri).then((response) => {
                    this.roles = response.data;
                });
            },

            fetchCountries(){
                let uri =this.base_url+`api/v1/country-list`;
                axios.get(uri).then((response) => {
                    this.countries = response.data;

                });
            },
      cancel() {
        // Implement the cancel logic here
      },
      submitForm() {
      event.preventDefault();
      document.getElementById('submit-form').submit();
    },
      formSubmit() {
        const members = [];

        // Iterate over the selectedItems and add each member's details to the array
        for (const item of this.selectedItems) {
            members.push({
            memberEmail: item.memberEmail,
            departmentName: item.departmentName,
            roleName: item.roleName
            });
        }

        console.log(members);


        // Make an API request to submit the form data to the backend

        const partnerData = {
        name: this.formData.name,
        email: this.formData.email,
        website: this.formData.website,
        phone: this.formData.phone,
        address: this.formData.address,
        logo: this.formData.logo,
        country: this.formData.country,
        business_type: this.formData.business_type,
        about: this.formData.about,
        document_id: this.formData.document_id,
        members: this.selectedItems.map(item => ({
        memberEmail: item.memberEmail,
        departmentName: item.departmentName,
        roleName: item.roleName
        }))
    };


        let uri = this.base_url + 'api/v1/partner-create';
        axios.post(uri, partnerData)
            .then(response => {
            // Handle the successful response
            console.log(response.data);
            })
            .catch(error => {
            // Handle the error response
            console.error(error);
            });
        },
    },
  };
  </script>

  <style scoped>
  .logo img{
    text-align: left;
    margin: 0;
  }

  .styled input{
    border: 1px solid rgba(228, 221, 221, 0.507);
    padding: 40px;
    margin: 0;
    border-radius: 8px;
  }

  .about .text-count{
    color: gray;
    padding-top: 18px;
    text-align: left;
  }


  .list-item {
    list-style-type: none;
    border: 1px solid #ccc;
    padding: 5px;
    margin-top: 8px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .delete-icon {
    color: rgb(116, 106, 106);
    font-size: 1.2rem;
    cursor: pointer;
  }

  .btn-suc{
    background-color: #ccccccc5;
  }


</style>

