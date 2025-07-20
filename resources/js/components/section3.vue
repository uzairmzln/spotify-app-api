<template>
    <div class="row">
        <div class="col-lg-6"
            v-if="userTopTracks && userTopTracks.items"
            v-for="(track,i) in userTopTracks.items.slice(0,1)"
            :key="track.id || i"
            :style="{
                backgroundImage: track.album && track.album.images && track.album.images[0] 
                    ? `url(${track.album.images[0].url})` : 'none',
                backgroundSize: 'cover',
                backgroundPosition: 'center',
                backgroundRepeat: 'no-repeat',
                minHeight: '100vh'
            }"
        >
        </div>
        <div class="columnSec col-lg-6"
            v-if="userTopTracks && userTopTracks.items"
            v-for="(track,i) in userTopTracks.items.slice(0,1)"
            :key="track.id || i"
        >
            <div class="container">
                <div>
                    <h1 class="headTitle text-white p-5">{{ track.album.name }}<hr class="hr1"></h1>
                </div>
                <div class="p-5"> 
                    <h3 class="text-secondary pb-5">Track List</h3>
                    <div class="container trackList"
                        v-if="albumTrackList && albumTrackList.tracks && albumTrackList.tracks.items"
                        v-for="(track, i) in albumTrackList.tracks.items"
                        :key="track.id || i"
                    >
                        <a :href="track.external_urls.spotify" target="_blank" class="trackLink pt-3">
                            <i class="pi pi-play pe-5 text-secondary"></i>
                            <span class="text-white pe-5">{{ (i + 1).toString().padStart(2, '0') }}</span> 
                            <span class="text-secondary pe-5">-</span> 
                            <span class="text-white">{{ track.name }}</span>
                        </a>
                        <hr>
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
        albumTrackList,
        images,
        error,
        loading
    } = useSpotify();
</script>
<style>
    .headTitle {
        text-shadow: 2px 2px 5px red;    
    }

    .hr1 {
        border: 2px solid grey;
        margin-top: 50px;
    }

    .columnSec {
        background-color: #121212;
    }
    
    .trackLink {
        text-decoration: none;
    }

    .trackList {
        cursor: pointer;
        transition: all 0.3s ease;
        text-shadow: 2px 2px 5px blue;
    }

    .trackList:hover {
        background: rgba(255, 255, 255, 0.05);
        transform: translateX(10px); 
        padding-top: 15px;
    }

    @media screen and (max-width: 768px) {
        body {
            min-width: 1024px;
            overflow-x: auto;
        }
    }
</style>