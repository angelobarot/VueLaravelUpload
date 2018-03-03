<template>
    <div class="container">
        <b-form-file v-model="file" placeholder="Choose a file..." @input="fileChange()"></b-form-file>
        <img class="col-md-12" :src="path" alt="" />
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            file: '',
            path: ''
        }
    },
    methods: {
        fileChange () {
            let formData = new FormData();
            formData.append('file', this.file);

            axios({
                method: 'POST',
                url: '/api/upload',
                headers: {
                    'Content-Type': 'application/json'
                },
                data: formData
            }).then(res => {
                this.path = res.data.path;
            }).catch(err => {
                console.log(err);
            });
        }
    }
};
</script>