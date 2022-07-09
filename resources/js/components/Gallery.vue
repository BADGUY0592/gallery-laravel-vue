<template>
    <div>
        <loading :active.sync="isLoading"
                :can-cancel="false"
                color="black"
                :is-full-page="fullPage"/>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Details</th>
                    <th scope="col">Map Link</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(gallery, index) in galleries" :key="gallery.id">
                    <td>
                        <img :src="gallery.image_url" alt="" width="100" height="100">
                    </td>
                    <td>
                        <p><b>Image Name:</b> {{ gallery.image_name.substring(0,45)+".." }}</p>
                        <p><b>Image Dimensions:</b> {{ gallery.image_width+'*'+gallery.image_height }}</p>
                        <p><b>Image Size:</b> {{ gallery.image_size }}</p>
                        <p><b>Image Extension:</b> {{ gallery.image_extension }}</p>
                        <p><b>User Name:</b> {{ gallery.user_name }}</p>
                        <p><b>Co-ordinates:</b> {{ gallery.image_lat+' '+gallery.image_long }}</p>
                    </td>
                    <td>
                        <a :href="'https://www.google.com/maps?q='+gallery.image_lat+'+'+gallery.image_long" 
                        class="btn btn-success" target="_blank">Open in Map</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    export default {
        data() {
            return {
                galleries: [],                
                isLoading: true,
                fullPage: true
            }
        },        
        components: {
            Loading
        },
        created() {
            this.loadGallery();
        },
        methods: {            
            async loadGallery(){
                await axios.get('get-images')
                    .then(res=>{
                        this.isLoading = false
                        this.galleries = res.data.data;
                    })
            },
        }
    }
</script>