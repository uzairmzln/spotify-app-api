<template>
    <div>
        <div class="container">
            <div class="d-flex justify-content-center">
                <h1 class="text-center fw-bold headtext p-4 ">Top 5 In your Track</h1>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4"
                    v-if="userTopTracks && userTopTracks.items"
                    v-for="(track, i) in userTopTracks.items.slice(0,5)"
                    :key="track.id || i"
                >
                    <div class="card track-card">
                        <div class="card-image-container">
                            <img :src="track.album.images[0].url" class="card-img-top track-image" alt="">
                        </div>
                        <div class="card-body track-details text-white">
                            <h5 class="card-title">{{i + 1}}. {{track.name}} - {{ track.artists[0].name }}</h5>
                            <p class="album-name">{{ track.album.name }}</p>
                            <p class="popularity">{{ track.popularity }} / 100</p>
                            <p class="duration">{{( track.duration_ms / 60000 ).toFixed(2)}} min</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { useSpotify } from '@/composables/useSpotify.js';

    const {
        userprofile,
        userTopTracks,
        images,
        error,
        loading
    } = useSpotify();
</script>
<style scoped>
    .track-card {
        box-shadow: 0 8px 32px white;
        border-radius: 20px; 
        overflow: hidden;
        position: relative;
        height: 400px;
        cursor: pointer;
        transition: all 0.4s ease;
    }

    .track-card:hover {
        height: 550px;
        transform: translateY(-10px);
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
    }

    .card-image-container {
        width: 100%;
        height: 400px;
        overflow: hidden;
        position: relative;
    }

    .track-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s ease;
    }

    .track-details {
        padding: 20px;
        height: 150px;
        transform: translateY(100%);
        transition: all 0.4s ease;
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        border-radius: 0 0 20px 20px;
        background: linear-gradient(45deg, #43c4ab, #fe5c0a, #31c0d1, #aa525a, #3e215f, #43c4ab);
        background-size: 400% 400%;
        animation: gradientShift 4s ease-in-out infinite;
    }
    @keyframes gradientShift {
            0% { 
                background-position: 0% 50%; 
            }
            50% { 
                background-position: 100% 50%; 
            }
            100% { 
                background-position: 0% 50%; 
            }
    }
    
    .track-card:hover .track-details {
        transform: translateY(0);
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .album-name {
        font-size: 0.9rem;
        margin-bottom: 6px;
        font-style: italic;
    }

    .popularity {
        font-size: 0.85rem;
        margin-bottom: 4px;
    }

    .duration {
        font-size: 0.85rem;
        margin-bottom: 0;
    }
    
</style>