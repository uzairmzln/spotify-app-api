import { ref, onMounted } from 'vue';

export function useSpotify() {
    const userprofile = ref(null);
    const userTopTracks = ref(null);
    const images = ref([]);
    const error = ref(null);
    const loading = ref(true);

    const fetchSpotifyApi = async () => {
        try {
        const res = await fetch('/spotify-user');
        if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
        }

        const data = await res.json();
        if (data.error) {
            error.value = data.error;
        } else {
            userprofile.value = data.userprofile;
            userTopTracks.value = data.userTopTracks;
            populateImages();
        }
        } catch (err) {
        console.error('Error fetching Spotify data:', err);
        error.value = 'Failed to load profile. Please try again.';
        } finally {
        loading.value = false;
        }
    };

    const populateImages = () => {
        if (userTopTracks.value?.items) {
        images.value = userTopTracks.value.items.map((track, index) => ({
            url: track.album.images[0]?.url || '',
            alt: `Album ${index + 1}`,
            name: track.name,
        }));
        } else {
        images.value = [];
        }
    };

    onMounted(fetchSpotifyApi);

    return {
        userprofile,
        userTopTracks,
        images,
        error,
        loading,
    };
}
