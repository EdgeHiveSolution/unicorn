<template>
    <div>
        <flash-message></flash-message>
        <!-- Alerts -->
        <div class="alert alert-success" role="alert" v-if="alert_success">
            Department created successfully!
        </div>
        <div class="alert alert-danger" role="alert" v-if="alert_error">
            Error in creating department!
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/departments">Departments</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    New Department
                </li>
            </ol>
        </nav>

        <!-- Page content -->
        <h2>New Department</h2>
        <p>Add a new department to UNICON.</p>

        <div class="d-flex justify-content-between">
            <div>
                <h3>Department Info</h3>
                <p>Enter the details of the department here.</p>
            </div>
            <div>
                <button class="btn btn-light border-dark p-3 btn-action">
                    Cancel
                </button>
                <button
                    class="btn btn-primary p-3 btn-action"
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
                    <div class="d-flex m-3 justify-content-center">
                        <select
                            class="form-select form-select-lg mb-3"
                            aria-label=".form-select-lg example"
                        >
                            <option value="normal_text">Normal Text</option>
                            <option value="long_text">Long Text</option>
                            <option value="short_text">Short Text</option>
                        </select>

                        <i
                            ><span class="text-muted mx-3 h3" id="bold"
                                ><b>B</b></span
                            ></i
                        >
                        <i
                            ><span
                                class="text-muted mdi mdi-format-italic mx-3 h3"
                                id="italic"
                                ><i></i></span
                        ></i>
                        <i
                            class="mx-3 h3 mdi mdi-format-list-bulleted text-gray"
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
                            >
                                {{ member }}
                            </option>
                        </datalist>
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
            <div class="text-right mt-3 mb-5">
                <button class="btn btn-light border-dark btn-action">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary btn-action">
                    Add
                </button>
            </div>
            <div class="dropdown-divider mb-5"></div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            email: "",
            about: "",
            alert_error: false,
            alert_success: false,
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
            const formData = new FormData();
            formData.append("name", this.name);
            formData.append("email", this.email);
            formData.append("about", this.about);
            formData.append("members", this.selectedMembers.join(","));

            let uri = this.base_url + `api/v1/department-create`;

            axios
                .post(uri, formData)
                .then((response) => {
                    alert("Department created successifully!");
                    window.location.href = "/departments";
                })
                .catch((error) => {
                    this.alert_error = true;
                    console.log(error);
                });
        },
    },
};
</script>
