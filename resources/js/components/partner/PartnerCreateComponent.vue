<template>
    <div class="module-nav">
       <!-- <div v-if="!isLoading" class="overlay d-flex flex-row justify-content-center px-auto">
          <div class="container  col-sm-4 rounded bg-white mx-5 p-3">
           <div class="d-flex flex-row justify-content-center px-0">
            <h1 class="add_dep_text text-info">Please wait..</h1>
           
            <div class="spinner-border text-info mt-1 mx-2">
            </div>
      </div>
      </div>
      </div>-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="txt-gray" href="/partners">Partners</a>
                </li>
                <li class="breadcrumb-item active txt-dark" aria-current="page">
                    New partner
                </li>
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
        <div class="text-end">
            <button type="button" class="btn btn-light border-dark px-3 py-2 btn-action">
                Cancel
            </button>
            <button 
                class="btn btn-primary px-3 py-2 btn-action"
                form="form-submit"
                type="submit"
            >
                Add
            </button>
        </div>

        <hr />

        <form
            id="form-submit"
            class="row g-3"
            @submit.prevent="formSubmit"
            method="POST"
        >
            <div class="row mb-2 p-3">
                <label
                    for="name"
                    class="col-md-3 col-form-label text-md-start"
                    >{{ "Name" }}</label
                >

                <div class="col-md-5 offset-md-0 text-center">
                    <input
                        id="name"
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': errors.name }"
                        name="name"
                        v-model="formData.name"
                        autocomplete="name"
                        autofocus
                    />

                    <span
                        v-if="errors.name"
                        class="invalid-feedback"
                        role="alert"
                    >
                        <strong>{{ errors.name }}</strong>
                    </span>
                </div>
            </div>

            <hr />

            <div class="row mb-2 p-3">
                <label
                    for="email"
                    class="col-md-3 col-form-label text-md-start"
                    >{{ "Email Address" }}</label
                >

                <div class="col-md-5 offset-md-0 text-center">
                    <div class="input-container">
                        <!-- <span class="mdi mdi-email input-icon"></span> -->
                        <input
                            id="email"
                            type="text"
                            class="form-control"
                            :class="{ 'is-invalid': errors.email }"
                            name="email"
                            v-model="formData.email"
                            autocomplete="email"
                            autofocus
                        />
                    </div>

                    <span
                        v-if="errors.email"
                        class="invalid-feedback"
                        role="alert"
                    >
                        <strong>{{ errors.email }}</strong>
                    </span>
                </div>
            </div>
            <hr />

            <div class="row mb-2 p-3">
                <label
                    for="website"
                    class="col-md-3 col-form-label text-md-start"
                    >{{ "Website" }}</label
                >

                <div class="col-md-5 offset-md-0 text-center">
                    <input
                        id="website"
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': errors.website }"
                        name="website"
                        v-model="formData.website"
                        autocomplete="website"
                        autofocus
                    />

                    <span
                        v-if="errors.website"
                        class="invalid-feedback"
                        role="alert"
                    >
                        <strong>{{ errors.website }}</strong>
                    </span>
                </div>
            </div>
            <hr />

            <div class="row mb-2 p-3">
                <label
                    for="phone"
                    class="col-md-3 col-form-label text-md-start"
                    >{{ "Phone Number" }}</label
                >

                <div class="col-md-5 offset-md-0 text-center">
                    <input
                        id="phone"
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': errors.phone }"
                        name="phone"
                        v-model="formData.phone"
                        autocomplete="phone"
                        autofocus
                    />

                    <span
                        v-if="errors.phone"
                        class="invalid-feedback"
                        role="alert"
                    >
                        <strong>{{ errors.phone }}</strong>
                    </span>
                </div>
            </div>
            <hr />

            <div class="row mb-2 p-3">
                <label
                    for="address"
                    class="col-md-3 col-form-label text-md-start"
                    >{{ "Address" }}</label
                >

                <div class="col-md-5 offset-md-0 text-center">
                    <input
                        id="address"
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid': errors.address }"
                        name="address"
                        v-model="formData.address"
                        autocomplete="address"
                        autofocus
                    />

                    <span
                        v-if="errors.address"
                        class="invalid-feedback"
                        role="alert"
                    >
                        <strong>{{ errors.address }}</strong>
                    </span>
                </div>
            </div>
            <hr />

            <div class="row mb-2 p-3">
                <label for="logo" class="col-md-3 col-form-label text-md-start">
                    {{ "Partner Logo" }} <br />
                    <span class="txt-gray">{{
                        "This will be used to identify the partner"
                    }}</span>
                </label>

                <div class="col-md-5 offset-md-0 text-center">
                    <div class="row styled">
                        <div class="col-3">
                            <img :src="logoPreview" alt="." />
                        </div>
                        <div class="col-9">
                            <input
                                id="logo"
                                type="file"
                                class="form-control-file"
                                :class="{ 'is-invalid': errors.logo }"
                                name="logo"
                                ref="logoInput"
                                placeholder="text"
                                @change="handleLogoChange"
                            />
                        </div>
                    </div>

                    <span
                        v-if="errors.logo"
                        class="invalid-feedback"
                        role="alert"
                    >
                        <strong>{{ errors.logo }}</strong>
                    </span>
                </div>
            </div>
            <hr />

            <div class="row mb-2 p-3">
                <label
                    for="country"
                    class="col-md-3 col-form-label text-md-start"
                    >{{ "Country" }}</label
                >

                <div class="col-md-5 offset-md-0 text-center">
                    <select
                        id="country"
                        class="form-control"
                        name="country"
                        v-model="formData.country_id"
                    >
                        <option value="">
                            Select country <i class="mdi mdi-account"></i>
                        </option>
                        <option
                            v-for="country in countries"
                            :value="country.id"
                        >
                            {{ country.name }}
                        </option>
                    </select>
                </div>
            </div>
            <hr />

            <div class="row mb-2 p-3">
                <label
                    for="business_type"
                    class="col-md-3 col-form-label text-md-start"
                    >{{ "Business type" }} <br /><span class="txt-gray">
                        {{
                            "Brief description of the main concern of the business e.g Software, Marketing"
                        }}</span
                    >
                </label>

                <div class="col-md-5 offset-md-0 text-center">
                    <select
                        id="business_type"
                        class="form-control"
                        :class="{ 'is-invalid': errors.business_type }"
                        name="business_type"
                        v-model="formData.business_type"
                    >
                        <option value="">Business type</option>
                        <option value="IT">IT</option>
                        <option value="Healthcare">Healthcare</option>
                        <option value="Logistics">Logistics</option>
                        <option value="Software">Software</option>
                        <option value="Technology">Technology</option>
                        <option value="Marketing">Marketing</option>
                    </select>

                    <span
                        v-if="errors.business_type"
                        class="invalid-feedback"
                        role="alert"
                    >
                        <strong>{{ errors.business_type }}</strong>
                    </span>
                </div>
            </div>
            <hr />

            <div class="row mb-2 p-3 about">
                <label for="about" class="col-md-3 col-form-label text-md-start"
                    >{{ "About" }} <br /><span class="txt-gray">
                        {{
                            "Write a short introduction of the business."
                        }}</span
                    >
                </label>

                <div class="col-md-5 offset-md-0 text-center">
                    <textarea
                        id="about"
                        class="form-control"
                        :class="{ 'is-invalid': errors.about }"
                        name="about"
                        v-model="formData.about"
                        autocomplete="about"
                        autofocus
                    ></textarea>
                    <span
                        v-if="true"
                        class="text-count"
                        :class="{ 'text-danger': isOverMax }"
                        >{{ remainingCharacters + " characters left" }}</span
                    >

                    <span
                        v-if="errors.about"
                        class="invalid-feedback"
                        role="alert"
                    >
                        <strong>{{ errors.about }}</strong>
                    </span>
                </div>
            </div>
            <hr />
            <div class="row mb-2 p-3">
                <label
                    for="documents"
                    class="col-md-3 col-form-label text-md-start"
                    >{{ "Documents" }} <br /><span class="txt-gray">
                        {{
                            "Upload any relevant documents related to this business e.g KRA Pin, Company Profile e.t.c"
                        }}</span
                    >
                </label>

                <div class="col-md-5 offset-md-0 text-center">
                    <div class="col-9 styled">
                        <input
                            id="documents"
                            type="file"
                            class="form-control-file"
                            :class="{ 'is-invalid': errors.documents }"
                            name="documents"
                            ref="logoInput"
                            placeholder="upload any relevant documents"
                        />
                    </div>

                    <span
                        v-if="errors.documents"
                        class="invalid-feedback"
                        role="alert"
                    >
                        <strong>{{ errors.documents }}</strong>
                    </span>
                </div>
            </div>

            <hr />

            <div class="row mb-2">
                <label
                    for="members"
                    class="col-md-3 col-form-label text-md-start"
                >
                    {{ "Members" }} <br /><span class="txt-gray">
                        {{
                            "Invite or select the relevant members to this organisation."
                        }}
                    </span>
                </label>

                <div class="col-md-9 offset-md-0 text-center">
                    <div class="row">
                        <!-- <div class="col-md-4">
                            <input
                                class="form-control py-2 pr-5"
                                autocomplete="member_email"
                                autofocus
                                type="email"
                                placeholder="Enter email address"
                                name="member_email"
                                v-model="member.email"
                            />
                        </div> -->
                        <div class="col-md-4">
                            <select
                                class="form-control py-2 pr-5"
                                name="member_email"
                                v-model="member.email"
                            >
                                <option value="">Select Member</option>

                                <option v-for="member in this.members" :value="member.email">
                                   {{member.email}}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select
                                id="department_id"
                                class="form-control"
                                name="department"
                                v-model="member.department_id"
                            >
                                <option value="">
                                    Select department
                                   
                                </option>
                                <option
                                    v-for="department in departments"
                                    :value="department.id"
                                >
                                    {{ department.name }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select
                                id="role_id"
                                class="form-control"
                                name="role"
                                v-model="member.role"
                            >
                                <option value="">Select role</option>
                                <option value="leader">leader</option>
                                <option value="mentor">Mentor</option>
                                <option value="advisor">Advisor</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button
                                type="button"
                                class="btn btn-warning ml-0 text-light mt-md-0 mt-2"
                                @click.prevent="addToList"
                            >
                                Add
                            </button>
                        </div>
                    </div>
                    <!--
                    <ul>
                        <li
                            v-for="(item, index) in selectedItems"
                            :key="index"
                            class="list-item"
                        >
                            <span>
                                <i class="mdi mdi-email-outline"></i>
                                {{ item.memberEmail }}
                                <span class="btn-suc">
                                    {{
                                        item.departmentId
                                            ? getDepartmentName(
                                                  item.departmentId
                                              )
                                            : ""
                                    }}
                                </span>
                                <span class="btn-suc">{{ item.roleName }}</span>
                            </span>
                            <i
                                class="mdi mdi-delete delete-icon"
                                @click="removeFromList(index)"
                            ></i>
                        </li>
                    </ul>-->

                     <template v-for="(item, index) in selectedItems"
                                :key="index"
                                >
                                <div class="d-flex flex-row">
                                <div class="container col-sm-10 bg-white email_container  my-2 rounded p-2 d-flex flex-row justify-content-between">
                                <div class="d-flex flex-row ">
                                    
                                     <span>
                                <i class="mdi mdi-email-outline"></i>
                                {{ item.memberEmail }}
                                <span class="btn-suc">
                                    {{
                                        item.departmentId
                                            ? getDepartmentName(
                                                  item.departmentId
                                              )
                                            : ""
                                    }}
                                </span>
                                <span class="btn-suc">{{ item.roleName }}</span>
                            </span>
                                    </div>     
                                </div>
                                
                                <div class="delete_email container col-sm-1 my-2 p-0 bg-white rounded d-flex flex-column align-items-center"
                                 @click="removeFromList(index)">
                                    <font-awesome-icon
                                icon="fa-solid, fa-trash-can"
                                style="color: #979da9"
                                size="lg"
                                class="mx-auto my-auto"
                            />
                              <!--    <i
                                class="mdi mdi-delete delete-icon"
                                @click="removeFromList(index)"
                            ></i>-->
                                </div>
                                </div>
                                </template>

                    <span
                        v-if="errors.documents"
                        class="invalid-feedback"
                        role="alert"
                    >
                        <strong>{{ errors.documents }}</strong>
                    </span>
                </div>
            </div>

            <hr />

           <!-- <div v-if="isLoading" class="d-flex flex-row justify-content-end px-0">
            <h1 class="add_dep_text text-info">Please wait..</h1>
           
            <div class="spinner-border text-info mt-1 mx-2">
            </div>
            </div>-->

            <div v-if="isLoading" class="loading">
                
            </div>
            <div v-else class="align-right mb-5">
                <div class="text-right mt-3 mb-5">
                    <button type="button" class="btn btn-light border-dark btn-action">
                        Cancel
                    </button>
                    <button type="submit" class="btn primary_button btn-action">
                        Add
                    </button>
                </div>
            </div>
        </form>

        <hr />
    </div>
</template>

<script>
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faTrashCan } from "@fortawesome/free-solid-svg-icons";

library.add(
    faTrashCan
);
export default {
    components: {
        FontAwesomeIcon,
    },
    data() {
        return {
            logoPreview: "",
            maxCharacters: 250,
            errors: {
                logo: null,
                about: null,
            },
            base_url: "../",
            isLoading: false,
            countries: [],
            departments: [],
            roles: [],
            members: [],
            formData: {
                name: "",
                email: "",
                website: "",
                phone: "",
                address: "",
                logo: "",
                country: "",
                business_type: "",
                about: "",
                document_id: "",
                country_id: "",
                members: [],
            },
            member: {
                email: "",
                department_id: "",
                role: "",
            },
            selectedItems: [],
        };
    },
    mounted() {
        this.fetchDepartments();
        this.fetchMembers();
        this.fetchCountries();
    },
    computed: {
        remainingCharacters() {
            return this.maxCharacters - this.formData.about.length;
        },
        isOverMax() {
            return this.remainingCharacters < 0;
        },
    },
    watch: {
        "formData.about": {
            handler() {
                this.validateAbout();
            },
            immediate: true,
        },
    },
    methods: {
        getDepartmentName(departmentId) {
            const department = this.departments.find(
                (department) => department.id === departmentId
            );
            return department ? department.name : "";
        },
        fetchDepartments() {
            let uri = this.base_url + `api/v1/department-list`;
            axios.get(uri).then((response) => {
                this.departments = response.data;
            });
        },

        fetchMembers() {
            let uri = this.base_url + `api/v1/member-list`;
            axios.get(uri).then((response) => {
                this.members = response.data;

                console.log("Members to be added are:", JSON.stringify(this.members));
            });
        },

        addToList() {
            if (
                this.member.email &&
                this.member.department_id &&
                this.member.role
            ) {
                const selectedMemberEmail = this.member.email;
                const selectedDepartmentId = this.member.department_id; // Store the department_id as an integer
                const selectedRole = this.member.role;

                console.log("Seleced Department ID:", selectedDepartmentId);

                this.selectedItems.push({
                    memberEmail: selectedMemberEmail,
                    departmentId: selectedDepartmentId, // Store the department ID directly
                    roleName: selectedRole,
                });

                console.log("Items are:", this.selectedItems);

                this.formData.members.push({
                    email: selectedMemberEmail,
                    department_id: selectedDepartmentId, // Store the department ID directly
                    role: selectedRole,
                });

                console.log("New Items are:",  this.formData.members);

                this.member.email = "";
                this.member.department_id = "";
                this.member.role = "";
            }
        },

        removeFromList(index) {
            this.selectedItems.splice(index, 1);
        },

        // fetchMembers() {
        //     let uri = this.base_url + `api/v1/user-list`;
        //     axios.get(uri).then((response) => {
        //         this.members = response.data;
        //     });
        // },
        fetchCountries() {
            let uri = this.base_url + `api/v1/country-list`;
            axios.get(uri).then((response) => {
                this.countries = response.data;
            });
        },

        handleLogoChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.formData.logo = file;
                this.logoPreview = URL.createObjectURL(file);
            }
        },

        validateAbout() {
            if (this.isOverMax) {
                this.errors.about = "Maximum character limit exceeded.";
            } else {
                this.errors.about = null;
            }
        },
        submitForm() {
            event.preventDefault();
            document.getElementById("submit-form").submit();
        },

        formSubmit() {
            this.isLoading=true;
            const formData = new FormData();

            formData.append("name", this.formData.name);
            formData.append("email", this.formData.email);
            formData.append("website", this.formData.website);
            formData.append("phone", this.formData.phone);
            formData.append("address", this.formData.address);
            formData.append("logo", this.formData.logo);
            formData.append("country_id", this.formData.country_id);
            formData.append("business_type", this.formData.business_type);
            formData.append("about", this.formData.about);
            formData.append("documents", this.formData.documents);

            // Convert the members data to a JSON string and append it to the form data
            // const members = this.selectedItems.map((item) => {
            //     return {
            //         email: item.memberEmail,
            //         department_id: item.departmentId,
            //         role: item.roleName,
            //     };
            // });

            console.log("Our Members in form Data:", JSON.stringify(this.formData.members));
            formData.append("members", JSON.stringify(this.formData.members));

            const uri = this.base_url + "api/v1/partner-create";

            axios
                .post(uri, formData)
                .then((response) => {
                     this.isLoading = false;
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Partner created successfully!",
                    }).then(() => {
                        window.location.href = "/partners";
                    });
                })
                .catch((error) => {
                     this.isLoading = false;
                    console.error(error);
                });
        },
    },
};
</script>

<style scoped>
.logo img {
    text-align: left;
    margin: 0;
}

.styled input {
    border: 1px solid rgba(228, 221, 221, 0.507);
    padding: 40px;
    margin: 0;
    border-radius: 8px;
}

.about .text-count {
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

.btn-suc {
    /*background-color: #ccccccc5;*/
    background-color: #f3f4f7;
    padding: 5px 10px;
    font-size: 12px;
    margin-right: 5px;
    border-radius: 8px;
}

.input-container {
    position: relative;
}

.input-icon {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    pointer-events: none;
    font-family: "Material Design Icons";
    font-size: 16px;
    color: #aaa;
    z-index: 1;
}

.form-control {
    padding-left: 30px;
}

.email_container{
    /*border :1px solid #979da9;*/
    border: 1px solid #e0e3e8;
}

.delete_email{
    border: 1px solid #e0e3e8;
    align-items: center;
    
}

.primary_button{
    background-color: #084bf7;
    font-size: 14px;
    font-weight: 300;
    color: white;
}

.overlay {  
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  position: absolute;
  width: 80%;
  height: 100%;
  align-self: center;
  z-index: 1;
 /* opacity: 0;*/
  background: rgba(39, 42, 43, 0.4);
  transition: opacity 200ms ease-in-out;
  border-radius: 4px;
  margin-left: -50px;
  /*margin-left: auto;*/
  /*margin: 0;*/
  padding: 0;
}

.add_dep_text{
   /* color: teal;*/
    font-size: 20px;
     
}


.loading {
  position: fixed;
  z-index: 999;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 50px;
  height: 50px;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255,255,255,0.5);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 50px;
  height: 50px;
  margin-top: -0.5em;

  /*border: 15px solid rgba(33, 150, 243, 1.0);*/
  border: 15px solid #f7b309;
  border-radius: 100%;
  border-bottom-color: transparent;
  -webkit-animation: spinner 1s linear 0s infinite;
  animation: spinner 1s linear 0s infinite;


}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
