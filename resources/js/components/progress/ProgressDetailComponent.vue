<template>
    <div>
        <div class="body-items">
            <div id="">
                <!-- KPIs content -->

                <div class="row">
                    <div class="col-12 px-0">
                        <div>
                            <div v-if="progressDetail.data">
                                <div class="card mb-5">
                                    <div class="card-body mb-5">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Value</th>
                                                        <th>Notes</th>
                                                        <th>Documents</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Your table data rows here with <td> elements -->
                                                    <tr>
                                                        <td>
                                                            {{
                                                                progressDetail
                                                                    .data.title
                                                            }}
                                                        </td>
                                                        <td class="">
                                                            {{
                                                                progressDetail
                                                                    .data
                                                                    .current_value
                                                            }}
                                                        </td>
                                                        <td class="">
                                                            {{
                                                                progressDetail
                                                                    .data.notes
                                                            }}
                                                        </td>

                                                        <td>
                                                            <ul
                                                                class="no-bullets"
                                                            >
                                                                <li
                                                                    v-for="filePath in progressDetail.progress_files"
                                                                    :key="
                                                                        filePath
                                                                    "
                                                                >
                                                                    <a
                                                                        :href="
                                                                            base_url +
                                                                            '/' +
                                                                            filePath
                                                                        "
                                                                        :download="
                                                                            getFileName(
                                                                                filePath
                                                                            )
                                                                        "
                                                                        target="_blank"
                                                                        >{{
                                                                            getFileName(
                                                                                filePath
                                                                            )
                                                                        }}</a
                                                                    >
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <pagination
                                                :total="totalPages"
                                                :current="currentPage"
                                                @page-change="handlePageChange"
                                            ></pagination>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!-- <div v-else>
                                <p>Loading progress details...</p>
                            </div>-->

                            <div v-if="isLoading" class="loading">
                
                         </div>

                            <!-- New card for comments section -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Comments</h5>
                                    <div
                                        v-for="comment in formattedTimestamps"
                                        :key="comment.id"
                                    >
                                        <!-- Display user information like profile photos here -->
                                        <!--alt="Profile Photo"-->
                                        <div v-if="comment.sender" class="d-flex flex-row">
                                            <!-- You can display user profile photo here -->
                                            <div class="profile_photo">
                                                <img v-if="comment.sender.photo"
                                                :src="comment.sender.photo"
                                                
                                            />
                                            </div>
                                            <div class="container-fluid d-flex mx-2 flex-column">
                                                <strong v-if="comment.sender" class="header_name_text">{{
                                                comment.sender.name
                                            }}</strong>
                                           
                                            <p class="body_name_text">{{ comment.message }}</p>

                                            <div class="d-flex flex-row justify-content-end"><label class="text-muted mx-1"> {{ comment.formattedTimestamp }}</label></div>
                                            
                                            </div>
                                        </div>
                                        <!--<div>
                                            <strong v-if="comment.sender">{{
                                                comment.sender.name
                                            }}</strong>
                                           <label class="text-muted m-2"> {{ comment.formattedTimestamp }}</label>
                                            <p>{{ comment.message }}</p>
                                        </div>-->
                                    </div>

                                    <!-- Comment form -->
                                    <form @submit.prevent="postComment">
                                        <div class="form-group">
                                            <textarea
                                                v-model="newComment"
                                                class="form-control"
                                                placeholder="Write a comment..."
                                            ></textarea>
                                        </div>
                                        <div class="mt-2">
                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                            >
                                                Post Comment
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import store from "../../store";
import { format } from "date-fns";
import { formatDistanceToNow } from "date-fns";

export default {
    props: {
        progressId: {
            type: Number,
            required: true,
        },
    },

    data() {
        return {
            comments: [],
            success: "",
            searchQuery: "",
            currentPage: 1,
            newComment: "",
            base_url: "../",
            progressDetail: {},
            isLoading:false
        };
    },

    computed: {
        loggedUser() {
            return this.$store.state.loggedUser;
        },

        formattedTimestamps() {
            return this.comments.map((comment) => ({
                ...comment,
                formattedTimestamp: formatDistanceToNow(
                    new Date(comment.created_at),
                    {
                        addSuffix: true,
                    }
                ),
            }));
        },
    },

    async created() {
        await this.fetchComments();
        await this.fetchProgressDetails();

        console.log("Comments are:", this.comments);
    },

    mounted() {
        console.log("Progress Details:", this.progressDetail);
        console.log("Which user is this?", this.$store.state.loggedUser);
    },

    methods: {
        getFileName(filePath) {
            // Assuming the file path is in the format "ProgressUploads/filename.ext"
            return filePath.split("/").pop();
        },

        async fetchComments() {
            const progressId = this.$props.progressId;

            const uri = this.base_url + `api/v1/progress-chats/${progressId}`;

            try {
                const response = await axios.get(uri);
                const comments = response.data.data;

                console.log("Which comment is this being updated:", comments);

                // Fetch sender information for each comment
                for (const comment of comments) {
                    const senderId = comment.sender_id;

                    // Fetch sender information from the API
                    const senderInfoUri =
                        this.base_url + `api/v1/users/${senderId}`;

                    try {
                        const senderResponse = await axios.get(senderInfoUri);
                        const senderData = senderResponse.data;

                        // Assign the sender's data to the comment
                        comment.sender = senderData;

                        console.log("Senders info", comment.sender);
                    } catch (error) {
                        console.error(
                            "Error fetching sender information:",
                            error
                        );
                    }

                    // Push the updated comment to the comments array
                    this.comments.push(comment);
                    console.log("Please see comments:", this.comments);
                }
            } catch (error) {
                console.error("Error fetching comments:", error);
            }
        },

        // New method to post a comment
        postComment() {
            this.isLoading=true;
            const progressId = this.$props.progressId;
            const uri = this.base_url + `api/v1/progress-chats`;

            axios
                .post(uri, {
                    progress_id: progressId,
                    sender_id: this.loggedUser.id,
                    message: this.newComment,
                })
                .then((response) => {
                    // Successfully posted comment, update the comments array with the new comment
                    this.comments.push(response.data);
                    this.newComment = "";
                    this.isLoading=false; // Clear the input field
                })
                .catch((error) => {
                    this.isLoading=false;
                    console.error("Error posting comment:", error);
                });
        },

        async fetchProgressDetails() {
            const progressId = this.$props.progressId;
            console.log("Progress Id:", progressId);

            // Replace this with your API endpoint URL
            const uri = this.base_url + `api/v1/progress/${progressId}`;

            try {
                const response = await axios.get(uri); // Await the API request
                console.log("API Response:", response.data);
                this.progressDetail = response.data;
            } catch (error) {
                console.error("Error fetching progress details:", error);
                console.log("No matching progress found.");
            }
        },

        // async fetchProgressDetails() {
        //     const progressId = this.$props.progressId;

        //     console.log("Progress Id:", progressId);

        //     for (const member of this.$store.state.loggedUser.member
        //         .kpi_metric_members) {
        //         // Check if member.progress has an id property
        //         if (member.progress && member.progress.id === progressId) {
        //             console.log("Found matching progress:", member.progress);
        //             const uri = this.base_url + `api/v1/progress/${progressId}`;

        //             try {
        //                 const response = await axios.get(uri); // Await the API request
        //                 console.log("API Response:", response.data);
        //                 this.progressDetail = response.data;
        //                 return; // Exit the function once a matching progress is found
        //             } catch (error) {
        //                 console.error(
        //                     "Error fetching progress details:",
        //                     error
        //                 );
        //             }
        //         }
        //     }

        //     console.log("No matching progress found.");
        // },
    },
};
</script>

<style scoped>
a {
    font-size: 20px;
}

.active-link {
    color: rgb(14, 28, 223);
    border-bottom: 2px solid blue;
}

.add-link {
    font-size: 14px;
}

.p-progress h5 {
    font-size: 1.2rem;
}

.p-progress p {
    font-size: 1.6rem;
    color: brown;
    font-weight: 800;
}

.status h6 {
    font-size: 1rem;
    color: brown;
}
img {
    width: 80px;
    height: 80px;
}

.set-metric input[type="text"] {
    width: 70px;
    height: 30px;
    border-radius: 5px;
    border: 1px solid gray;
}
.member-count {
    background-color: rgba(195, 195, 209, 0.733);
    padding: 7px;
    border-radius: 40%;
    font-size: 0.7rem;
}

.status span {
    background-color: rgba(51, 255, 0, 0.164);
    padding: 8px;
    border-radius: 15px;
}
.depart-tag {
    background-color: rgba(235, 240, 234, 0.685);
    padding: 8px;
    border-radius: 15px;
}
.list-item {
    list-style-type: none;
    border: 1px solid rgba(128, 128, 128, 0.534);
    border-radius: 10px;
    width: 70%;
}

.btn-icon {
    display: flex;
    align-items: center;
    font-weight: bold;
}

.encircle {
    padding: 3px;
    border-radius: 50%;
    background-color: rgba(128, 128, 128, 0.089);
    color: rgba(24, 23, 23, 0.911);
}

.nav-link {
    font-size: 14px;
    font-weight: 600;
}

.view-btn {
    cursor: pointer;
    font-size: 11px; /* Adjust font size */
    padding: 5px 10px; /* Adjust padding (top/bottom, left/right) */
    display: flex;
    background-color: #0072bb;
    align-items: center;
    justify-content: center; /* Center the content horizontally */
    border-radius: 8px;
    height: 35px;
}

.no-bullets {
    list-style-type: circle;
    padding: 0;
    margin-bottom: 5px;
}
.view-btn a {
    display: flex;
    align-items: center;
}

.view-btn i {
    margin-right: 8px;
}

.view-btn a {
    display: flex;
    align-items: center;
}

.view-btn i {
    margin-right: 8px;
}

.profile_photo{
     width: 35px;
    margin-left: -10px;
    height: 35px;
    border-radius: 50%;
    background-color: #f3f4f7;
    border-color: 1px solid #979da9;
}

.header_name_text {
    color: #111828;
}

.body_name_text{
    font-size: 14px;
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
