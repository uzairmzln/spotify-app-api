<template>
    <div class="header">
        <div class="d-flex justify-content-center align-items-center flex-wrap position-relative text-center text-md-start">
            <!-- Left Text -->
            <div class="position-absolute left-text">
                <h1 class="fw-bold fst-italic headtext mb-0">TOP 1</h1>
            </div>

            <!-- Right Text -->
            <div class="position-absolute right-text">
                <h1 class="fw-bold fst-italic headtext mb-0">in your Track</h1>
            </div>

            <!-- Center Image -->
            <div
                class="position-relative z-2 center-content"
                v-if="userTopTracks && userTopTracks.items"
                v-for="(track, index) in userTopTracks.items.slice(0,1)"
                :key="track.id || index"
            >
                <img :src="track.album.images[0].url" alt="Track Image" class="track-img rounded">
                <div class="badges rounded-5">
                    <h2 class="fw-bold fst-italic text-center mt-4 badge-text">
                        #{{ index + 1 }} - {{ track.name }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="container nav-menu">
            <div 
                v-if="userTopTracks && userTopTracks.items"
                v-for="(track, index) in userTopTracks.items.slice(0,1)"
                :key="track.id || index"
            >
                <div class="menu d-flex justify-content-center align-items-center flex-wrap position-relative text-center text-md-start text-white">
                    <p class="p-4">{{ track.artists[0].name }}</p>
                    <p class="p-4">{{ track.album.name }}</p>
                    <p class="p-4">{{ track.popularity }} / 100</p>
                    <p class="p-4">{{( track.duration_ms / 60000 ).toFixed(2)}}</p>
                </div>
                <div class="d-flex justify-content-center">
                    <a :href="track.external_urls.spotify" target="_blank" class="spotify-link">Play on Spotify</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        name: 'section1',
        data(){
            return{
                userprofile: null,
                userTopTracks: null,
                images: [],
            }
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

    .header{
        padding-top: 150px;
    }
    
    .headtext{
        font-size: 4rem; 
        text-shadow: 2px 2px #f00;
    }
    
    .track-img{
        width: 350px; 
        height: 350px; 
        object-fit: cover; 
        box-shadow: 0 8px 30px whitesmoke;
    }
    
    .badges{
        box-shadow: 2px 2px #f00;
        /* background: linear-gradient(60deg, #f7971e, #ffd200, #89f7fe, #66a6ff);
        background-size: 400% 400%;
        animation: stripeColors 4s linear infinite; */
    }
    /* @keyframes stripeColors {
        0% { background-position: 0 0; }
        100% { background-position: 400% 400%; }
    } */
    
    .badge-text {
        font-size: 4rem;
        font-weight: bold;
        text-shadow: 0 20px 40px white; 
        background: linear-gradient(45deg, #43c4ab, #fe5c0a, #31c0d1, #aa525a, #3e215f, #43c4ab);
        background-size: 400% 400%;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
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

    .left-text {
        left: 30%;
    }

    .right-text {
        right: 20%;
    }

    .menu{
        position: relative;
        border-radius: 50px;
        backdrop-filter: blur(10px);
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.2);
        width: fit-content;
        margin: 0 auto;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .nav-menu {
        margin-top: 200px;
    }

    .menu p {
        margin: 0;
        font-weight: 500;
        color: white;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    }
    
    .spotify-link {
        color: #1db954;
        text-decoration: none;
        font-weight: 600;
        margin-top: 15px;
        display: inline-block;
        padding: 8px 20px;
        background: rgba(29, 185, 84, 0.1);
        border-radius: 20px;
        border: 1px solid rgba(29, 185, 84, 0.3);
        transition: all 0.3s ease;
    }

    .spotify-link:hover {
        background: rgba(29, 185, 84, 0.2);
        color: #1ed760;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .nav-menu {
            margin-top: 100px;
        }

        .left-text, .right-text {
            position: static !important;
            text-align: center;
            margin-bottom: 10px;
        }

        .headtext {
            font-size: 2.5rem !important;
        }

        .track-img {
            width: 280px !important;
            height: 280px !important;
        }

        .badge-text {
            font-size: 1.5rem !important;
            padding: 0 10px;
            line-height: 1.3;
        }
    }

    @media (max-width: 480px) {
        .nav-menu {
            margin-top: 100px;
        }

        .headtext {
            font-size: 2rem !important;
        }

        .track-img {
            width: 250px !important;
            height: 250px !important;
        }

        .badge-text {
            font-size: 1.2rem !important;
        }
    }

    @media (max-width: 360px) {
        .nav-menu {
            margin-top: 100px;
        }

        .headtext {
            font-size: 1.8rem !important;
        }

        .track-img {
            width: 220px !important;
            height: 220px !important;
        }

        .badge-text {
            font-size: 1.1rem !important;
        }
    }
</style>