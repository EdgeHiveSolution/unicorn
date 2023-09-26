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
                            <div v-else>
                                <p>Loading progress details...</p>
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
                                        <div>
                                            <!-- You can display user profile photo here -->
                                            <img
                                                :src="
                                                    comment.sender
                                                        .profile_photo_url
                                                "
                                                alt="Profile Photo"
                                            />
                                        </div>
                                        <div>
                                            <strong>{{
                                                comment.sender.name
                                            }}</strong>
                                            {{ comment.formattedTimestamp }}
                                            <p>{{ comment.message }}</p>
                                        </div>
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

    async created() {},

    mounted() {
        this.fetchComments();
        this.fetchProgressDetails();
        console.log("Progress Details:", this.progressDetail);
        console.log("Which user is this?", this.$store.state.loggedUser);
    },

    methods: {
        async fetchComments() {
            const progressId = this.$props.progressId;

            const uri = this.base_url + `api/v1/progress-chats/${progressId}`;

            try {
                const response = await axios.get(uri);
                const comments = response.data.data;

                // Fetch sender information for each comment
                for (const comment of comments) {
                    const senderId = comment.sender_id;

                    // Check if the sender_id matches the ID of the logged-in user
                    if (senderId === this.loggedUser.id) {
                        // Use the logged-in user's data
                        comment.sender = this.loggedUser;
                    } else {
                        // Fetch sender information from the API
                        const senderInfoUri =
                            this.base_url + `api/v1/users/${senderId}`;

                        try {
                            const senderResponse = await axios.get(
                                senderInfoUri
                            );
                            const senderData = senderResponse.data;

                            // Assign the sender's data to the comment
                            comment.sender = senderData;
                        } catch (error) {
                            console.error(
                                "Error fetching sender information:",
                                error
                            );
                        }
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
                    this.newComment = ""; // Clear the input field
                })
                .catch((error) => {
                    console.error("Error posting comment:", error);
                });
        },

        async fetchProgressDetails() {
            const progressId = this.$props.progressId;

            console.log("Progress Id:", progressId);

            for (const member of this.$store.state.loggedUser.member
                .kpi_metric_members) {
                const progress = member.progress.find(
                    (p) => p.id === progressId
                );

                if (progress) {
                    console.log("Found matching progress:", progress);
                    const uri = this.base_url + `api/v1/progress/${progressId}`;

                    try {
                        const response = await axios.get(uri); // Await the API request
                        console.log("API Response:", response.data);
                        this.progressDetail = response.data;
                        return; // Exit the function once a matching progress is found
                    } catch (error) {
                        console.error(
                            "Error fetching progress details:",
                            error
                        );
                    }
                }
            }

            console.log("No matching progress found.");
        },
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
</style>
