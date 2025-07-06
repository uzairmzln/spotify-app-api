<template>
    <div class="container headerS3 position-relative">
        <div class="circular-text" ref="circularText"></div>
        <div class="d-flex justify-content-center align-items-center">
            <img :src="'/images/headset.png'" class="img-fluid img-head" alt="">
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            this.createCircularText();
        },
        methods: {
            createCircularText() {
                const text = "FROM PLAY TO REPLAY • YOUR ALBUM ANTHEMS • ";
                const container = this.$refs.circularText;
                const chars = text.split('');
                const angleStep = 360 / chars.length;
                
                container.innerHTML = '';
                chars.forEach((char, index) => {
                    const span = document.createElement('span');
                    span.textContent = char;
                    span.style.transform = `rotate(${index * angleStep}deg)`;
                    span.className = 'circular-char';
                    container.appendChild(span);
                });
            }
        }
    }
</script>
<style>
    .headerS3 {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .img-head {
        filter: drop-shadow(10px 5px 2px #e31e60);
        width: 300px;
        z-index: 2;
        position: relative;
    }

    .circular-text {
        position: absolute;
        width: 450px;
        height: 450px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
    }

    .circular-char {
        position: absolute;
        color: white;
        font-size: 28px;
        font-weight: bold;
        text-shadow: 2px 2px 5px red;
        transform-origin: 0 225px;
        left: 50%;
        top: 0;
    }

    @media screen and (max-width: 768px) {
        body {
            min-width: 1024px;
            overflow-x: auto;
        }
    }
</style>