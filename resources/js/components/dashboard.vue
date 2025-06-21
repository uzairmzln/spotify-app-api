<template>
    <div>
        <div v-if="loading">
            <p>Loading your Spotify profile...</p>
        </div>
        
        <div v-else-if="error">
            <p style="color: red;">{{ error }}</p>
        </div>
        
        <div v-else-if="userprofile">
            <h1>Welcome, {{ userprofile.display_name }}!</h1>
            <p>Email: {{ userprofile.email }}</p>
            <p>Followers: {{ userprofile.followers.total }}</p>
            <p>Country: {{ userprofile.country }}</p>
            <div v-if="userprofile.images && userprofile.images.length > 0">
                <img :src="userprofile.images[0].url" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
            </div>
        </div>
        
        <div v-else>
            <p>No profile data available</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Dashboard',
    data() {
        return {
            userprofile: null,
            loading: true,
            error: null
        };
    },
    mounted(){
        this.fetchUserProfile();
    },
    methods: {
        fetchUserProfile() {
            fetch('/spotify-user')
                .then(res => {
                    if (!res.ok) {
                        throw new Error(`HTTP error! status: ${res.status}`);
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.error) {
                        this.error = data.error;
                    } else {
                        this.userprofile = data.userprofile;
                    }
                })
                .catch(error => {
                    console.error('Error fetching profile:', error);
                    this.error = 'Failed to load profile. Please try again.';
                })
                .finally(() => {
                    this.loading = false;
                });
        }
    }
}
</script>

<style scoped>
h1 {
    color: #1DB954;
}
</style>