<template>
    <div v-if="loading">
        <p>Loading your Spotify profile...</p>
    </div>
        
    <div v-else-if="error">
        <p style="color: red;">{{ error }}</p>
    </div>
        
    <div v-else-if="userprofile" class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="row w-100 justify-content-center gap-3" style="height: 80vh;">
            <div class="col-lg-5 profile-bg rounded-5">
                <div class="d-flex align-items-center py-3">
                    <img :src="userprofile.images[0].url" alt="Profile Image" class="round-pfp rounded-circle me-2">
                    <span class="fs-6 fw-bold">{{ userprofile.display_name }}</span>
                </div>
                <div>
                    <Carousel :items-to-show="1" :wrap-around="true" :autoplay="5000">
                        <Slide v-for="(image, index) in images" :key="index">
                            <div class="carousel__item">
                                <img :src="image.url" :alt="image.alt" class="img-fluid">
                                <!-- <div class="carousel-caption">
                                    <p class="fw-bold mb-0">{{ image.name }}</p>
                                </div> -->
                            </div>
                        </Slide>
                        
                        <template #addons class="d-flex align-items-center">
                            <div class="carousel-controls">
                                <AnOutlinedLike class="like-button"/>
                                <FlChatEmpty class="like-button"/>
                                <HiShare class="like-button"/>
                                <Pagination class="pagination-custom"/>
                            </div>
                        </template>
                    </Carousel>
                    <div class="pt-2 mb-2">
                        <span class="fs-6 me-3 fw-bolder">{{ userprofile.display_name }}</span>
                        <span>Our Top Track are here :</span>
                    </div>
                    <div v-for="(track, index) in userTopTracks.items" :key="track.id || index">
                        <span class="fw-bold text-primary">#{{ index + 1 }} {{ track.name }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 profile-bg-2 d-flex align-items-center justify-content-center rounded-5">
                
            </div>
        </div>
    </div>
    <div v-else>
        <p>No profile data available</p>
    </div>
</template>

<script>
import 'vue3-carousel/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import { AnOutlinedLike } from '@kalimahapps/vue-icons';
import { FlChatEmpty } from '@kalimahapps/vue-icons';
import { HiShare } from '@kalimahapps/vue-icons';

export default {
    name: 'Dashboard',
    components: { 
        Carousel, 
        Slide, 
        Pagination, 
        Navigation, 
        AnOutlinedLike, 
        FlChatEmpty, 
        HiShare 
    },
    data() {
        return {
            userprofile: null,
            userTopTracks: null,
            images: [],
            loading: true,
            error: null
        };
    },
    mounted(){
        this.fetchSpotifyApi();
    },
    methods: {
        // Fetch user profile and top tracks from the backend
        fetchSpotifyApi() {
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
                        this.userTopTracks = data.userTopTracks;

                        console.log('Top Tracks:', this.userTopTracks);
                    }
                })
                .catch(error => {
                    console.error('Error fetching profile:', error);
                    this.error = 'Failed to load profile. Please try again.';
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        // Populate images from userTopTracks
        populatedImages(){
            if(this.userTopTracks && this.userTopTracks.items) {
                this.images = this.userTopTracks.items.map((track, index) => ({
                    url: track.album.images[0]?.url || '',
                    alt: `Album ${index + 1}`,
                    name: track.name,
                }));
            } else {
                this.images = [];
            }
        }
    }, 
    // Watch for changes in userTopTracks to populate images
    watch:{
        userTopTracks(newVal) {
            if (newVal) {
                this.populatedImages();
            }
        }
    }
}
</script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap');

    *{
        font-family: "Manrope", sans-serif;
        font-optical-sizing: auto;
        font-weight: auto;
        font-style: normal;
    }

    .profile-bg,
    .profile-bg-2{
        height: 100%;
    }

    .profile-bg{
        background-color: white;
        /* background-size: cover;
        background-position: center;
        background-repeat: no-repeat; */
    }

    .profile-bg-2{
        background-color: #1db954;
    }

    .round-pfp {
        width: 30px;
        height: 30px;
    }

    .carousel__pagination {
        position: static !important;
        margin-top: 10px;
        transform: none !important;
    }
    .carousel__pagination-button {
        height: 10px;
        width: 10px;
        border-radius: 5px;
        background-color: #1db954;
    }
    .carousel__pagination-button--active {
        background-color: grey;
    }

    .carousel-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        padding: 10px 0;
    }
    .like-button {
        font-size: 24px;
        margin-right: 10px;
        color: #1db954;
        /* cursor: pointer;
        transition: color 0.3s ease; */
    }
    .pagination-custom {
        flex: 1;
        padding-right: 100px;
        display: flex;
        justify-content: center;
        margin-bottom: 5px;
    }
</style>