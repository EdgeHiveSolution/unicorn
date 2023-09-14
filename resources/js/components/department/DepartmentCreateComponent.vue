<template>
    <div>
    
        <flash-message></flash-message>
        <!-- Alerts -->
        <!-- <div class="alert alert-success" role="alert" v-if="alert_success">
            Department created successfully!
        </div>
        <div class="alert alert-danger" role="alert" v-if="alert_error">
            Error in creating department!
        </div> -->

        <!-- Breadcrumb -->
        <!--<div v-if="isLoading">
            <h1 class="plans_text mt-5 mb-3">Please wait..</h1>
            <b-spinner
                style="width: 3rem; height: 3rem"
                variant="info"
                label=""
            ></b-spinner>
        </div>-->

     <!-- <div v-if="isLoading" class="overlay d-flex flex-row justify-content-center px-auto">
          <div class="container  col-sm-4 rounded bg-white mx-5 p-3">
           <div class="d-flex flex-row justify-content-center px-0">
            <h1 class="add_dep_text text-info">Please wait..</h1>
           
            <div class="spinner-border text-info mt-1 mx-2">
            </div>
      </div>
      </div>
      </div>-->

      <div v-if="isLoading" class="loading">
          
      </div>
          
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/departments">Departments</a>
                </li>
                <li
                    style="font-weight: bold; color: black"
                    class="breadcrumb-item active"
                    aria-current="page"
                >
                    New Department
                </li>
            </ol>
        </nav>

        <!-- Page content -->
        <h2>New Department</h2>
        <p>Add a new department to UNICON.</p>

        <div class="d-flex justify-content-between">
            <div>
                <h3 style="font-size: 16px">Department Info</h3>
                <p>Enter the details of the department here.</p>
            </div>
            <div class="btn-icon">
                <button
                    class="btn btn-light border-dark p-3 btn-action cancel-btn"
                >
                    Cancel
                </button>
                <button
                    class="btn btn-primary p-3 btn-action add-btn"
                    form="form-submit"
                    type="submit"
                >
                    Add
                </button>
            </div>
        </div>

      

        <!-- Department form -->
        <form
            id="form-submit"
            class="row g-3"
            @submit.prevent="formSubmit"
            method="post"
        >
            <div class="row mb-2 p-3">
                <label
                    for="name"
                    class="col-md-3 col-form-label text-md-start"
                    >{{ "Name" }}</label
                >
                <div class="col-md-5 offset-md-0 text-center">
                    <input
                        style="height: 10px"
                        id="name"
                        name="name"
                        class="form-control form-control-lg"
                        type="text"
                        v-model="name"
                        autocomplete="name"
                        autofocus
                    />
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
                    <input
                        style="height: 10px"
                        id="email"
                        name="email"
                        class="form-control form-control-lg"
                        type="email"
                        v-model="email"
                        autocomplete="email"
                        autofocus
                    />
                </div>
            </div>
            <hr />

            <div class="row mb-2 p-3">
                <label for="about" class="col-md-3 col-form-label text-md-start"
                    >{{ "About" }} <br /><span class="text-muted"
                        >Write a brief of the department.</span
                    ></label
                >
                <div class="col-md-5 offset-md-0 text-center">
                    <div class="d-flex m-3 justify-content-space-between">
                        <select
                            style="width: 300px; height: 45px"
                            class="form-select form-control form-select-lg mb-3"
                            aria-label=".form-select-lg example"
                        >
                            <option value="normal_text">Normal Text</option>
                            <option value="long_text">Long Text</option>
                            <option value="short_text">Short Text</option>
                        </select>

                        <i
                            ><span
                                class="text-muted mx-3 h3 text-gray"
                                id="bold"
                                ><b>B</b></span
                            ></i
                        >
                        <i
                            ><span
                                class="text-muted mdi mdi-format-italic mx-3 h3 text-gray"
                                id="italic"
                                ><i></i></span
                        ></i>

                        <i class="mx-3 h3 mdi mdi-link text-gray" id="link"></i>
                        <i
                            class="mx-3 h3 mdi mdi-format-list-bulleted text-gray"
                            id="dotted"
                        ></i>

                        <i
                            class="mx-3 h3 mdi mdi-format-list-numbered text-gray"
                            id="dotted"
                        ></i>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea
                            class="form-control"
                            name="about"
                            placeholder="Write company about here"
                            style="height: 100px"
                            v-model="about"
                        ></textarea>
                        <label></label>
                    </div>
                </div>
            </div>
            <hr />

            <div class="row mb-2 p-3">
                <label for="email" class="col-md-3 col-form-label text-md-start"
                    >{{ "Members" }} <br /><span class="text-muted"
                        >Invite or select the relevant members to this
                        department</span
                    ></label
                >
                <div class="col-md-5 offset-md-0 text-center">
                    <div class="row">
                        <div class="input-group">
                            <input
                                style="
                                    border-radius: 10px;
                                    width: 200px;
                                    height: 40px;
                                "
                                placeholder="Select team member or enter email address"
                                list="memberEmails"
                                id="email"
                                class="form-control"
                                name="email"
                                v-model="selectedMember"
                                @input="handleMemberInput"
                                @keydown.enter.prevent="addMemberToList"
                            />
                            <div class="input-group-append mx-3">
                                <button
                                    style="color: white"
                                    class="btn btn-warning"
                                    @click.prevent="addMemberToList"
                                >
                                    Add
                                </button>
                            </div>
                        </div>
                        <datalist id="memberEmails">
                            <option
                                v-for="member in memberEmails"
                                :value="member"
                                class="email_container"
                            >
                                {{ member }}
                            </option>
                        </datalist>
                       
                        <div>

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-10">
                            <ul class="list-group">
                                <li
                                    class="list-group-item my-2 p-0"
                                    v-for="(email, index) in selectedMembers"
                                    :key="index"
                                >
                                    {{ email }}
                                    <button
                                        class="btn btn-sm txt-gray float-end"
                                        @click="removeMemberFromList(index)"
                                    >
                                        <i
                                            class="mx-3 h3 mdi mdi-delete text-gray"
                                            id="dotted"
                                        ></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <hr />

           
        
            <div class="text-right mt-3 mb-5 text-end">
                <div class="btn-icon">
                    <button
                        style="border: lightgrey"
                        class="btn btn-light border-dark p-3 btn-action"
                    >
                        Cancel
                    </button>
                    <button
                        class="btn btn-primary p-3 btn-action add-btn"
                        form="form-submit"
                        type="submit"
                    >
                        Add
                    </button>
                </div>
            </div>
            <div class="dropdown-divider mb-5"></div>
        </form>

        <!-- <b-overlay :show="isShow" spinner-variant="info" rounded="sm" no-wrap>
                    <template #overlay>
                    <div class="overlay_container text-center">
                    <b-spinner  font-scale="3" variant="info"></b-spinner>
                    <p class="text-dark">Verifying Payment.Please wait...</p>
       
        </div>
      </template>
    </b-overlay>  -->  
    </div>
</template>

<script>
/*import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";*/
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
            name: "",
            email: "",
            about: "",
            alert_error: false,
            alert_success: false,
            isLoading: false,
            isShow: true,
            base_url: "../",
            member_id: "",
            members: [],
            selectedMember: "",
            selectedMembers: [],
            memberEmails: [],
        };
    },
    mounted() {
        this.fetchMembers();
    },
    methods: {
        fetchMembers() {
            let uri = this.base_url + `api/v1/member-list`;
            axios.get(uri).then((response) => {
                this.members = response.data;
            });
        },
        handleMemberInput() {
            if (this.selectedMember) {
                this.memberEmails = this.members
                    .filter((member) =>
                        member.email.includes(this.selectedMember)
                    )
                    .map((member) => member.email);
            } else {
                this.memberEmails = [];
            }
        },
        addMemberToList() {
            if (this.selectedMember) {
                const existingMember = this.members.find(
                    (member) => member.email === this.selectedMember
                );
                if (existingMember) {
                    this.selectedMembers.push(this.selectedMember);
                } else {
                    this.selectedMembers.push(this.selectedMember);
                }
                this.selectedMember = "";
                this.memberEmails = [];
            }
        },
        removeMemberFromList(index) {
            this.selectedMembers.splice(index, 1);
        },
        formSubmit() {
            console.log("formSubmit method called");

            this.isLoading = true;

            if (
                !this.name ||
                !this.email ||
                !this.about ||
                this.selectedMembers.length === 0
            ) {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Please fill in all the required fields and select at least one member.",
                    customClass: {
                        container: "custom-swal",
                    },
                });
                this.isLoading = false; // Reset isLoading in case of error
                return;
            }

            console.log("Form data valid. Submitting...");

            const formData = new FormData();
            formData.append("name", this.name);
            formData.append("email", this.email);
            formData.append("about", this.about);
            formData.append("members", this.selectedMembers.join(","));

            let uri = this.base_url + `api/v1/department-create`;

            axios
                .post(uri, formData)
                .then((response) => {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Department created successfully!",
                    });
                })
                .catch((error) => {
                     this.isLoading = false;
                    this.alert_error = true;
                    console.log(error);
                })
                .finally(() => {
                    this.isLoading = false;
                    if (!this.alert_error) {
                        console.log("Redirecting to /departments");
                        window.location.href = "/departments"; // Redirect only on success
                    }
                });
        },
    },
};
</script>

<style scoped>
h2 {
    font-weight: bold;
}

.btn-action {
    padding: 2px 5px; /* Adjust the padding as needed */
    line-height: 0.2; /* Set line-height to 1 to remove any extra spacing */
    width: 70px;
}

.cancel-btn:hover {
    /* Set any hover styles to 'initial' or 'none' to remove the effect */
    background-color: initial;
    color: initial;
    border-color: initial;
    border: 1px solid grey;
    border: 1px solid rgba(0, 0, 0, 0.5); /* Adjust the opacity (last value) as needed */

    /* Add any other styles you want to reset on hover */
}

.text-gray {
    font-size: 20px;
}

.custom-swal {
    font-size: 14px; /* Adjust the font size as desired */
    padding: 10px; /* Adjust the padding as desired */
    max-width: 200px; /* Adjust the maximum width as desired */
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
