<template>
    <div>
        <loading :active.sync="isLoading"
                :can-cancel="false"
                color="black"
                :is-full-page="fullPage"/>
        <div class="card mt-5">
            <div class="card-header">
                Add Image
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name*</label>
                    <input type="text" class="form-control" id="name" placeholder="Your Name" v-model="name">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input class="form-control form-control-sm" id="image" type="file" ref="galimage">
                </div>
                <input type="hidden" class="form-control" id="latitude" placeholder="Your Latitude" ref="latitude">
                <input type="hidden" class="form-control" id="longitude" placeholder="Your Longitude" ref="longitude">
                <div class="alert alert-danger mt-2" v-if="errors.length>0">
                    <ul>
                        <li v-for="(error, index) in errors" :key="'error'+index">{{ error }}</li>
                    </ul>
                </div>
                <button type="button" class="btn btn-primary" @click="saveImage()">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    export default {
        data() {
            return {
                name: '',
                errors: [],          
                isLoading: false,
                fullPage: true
            }
        },
        components: {
            Loading
        },
        methods: {
            async saveImage() {
                this.errors = [];
                this.isLoading = true;
                const formData = new FormData();
                let file = this.$refs.galimage.files[0];
                formData.append('image', file);
                const headers = { 'Content-Type': 'multipart/form-data' };
                formData.append('name', this.name);
                formData.append('latitude', this.$refs.latitude.value);
                formData.append('longitude', this.$refs.longitude.value);
                await axios.post('store', formData, {headers})
                .then(async res=>{
                    // console.log(res.data)
                    this.isLoading = false
                    if(res.data.errors){
                        this.errors = res.data.errors;
                        return
                    } else {
                        this.name = '';
                        window.location.href=res.data.redirect;
                    }
                })
            }
        }
    }
</script>
