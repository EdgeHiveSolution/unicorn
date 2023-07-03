<template>
    <div>
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h1>My profile</h1>
                    </div>
                    <div class="card-body">
                        <div v-if="loading">
                            Loading...
                        </div>
                        <div v-else>
                            <h2>{{ user.name }}</h2>
                            <p>Email: {{ user.email }}</p>
                            <p>Username: {{ user.username }}</p>
                            <!-- Display other user details as needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: {},
            loading: true,
            base_url:'../',
        };
    },
    mounted() {
        this.fetchUser();
    },
    methods: {
        fetchUser() {
            let uri =this.base_url+`api/v1/profile`;
                axios.get(uri).then((response) => {
                    this.user = response.data;
                   
                });
        }
    }
};
</script>

<style>
</style>

