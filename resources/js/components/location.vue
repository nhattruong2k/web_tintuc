<template>
    <div class="col">
        <label>Chọn thành phố *:</label>
        <div class="col">
            <select class="form-control" name="province_id" v-model="province_id">
                <option value="null">Vui lòng chọn thành phố</option>
                <option 
                    v-for="province in provinces" 
                    :key="province.id" 
                    :value="province.id"
                >
                    {{ province.name }}
                </option>
            </select>
        </div>
        <br>
        <div class="col">
            <label>Chọn quận/huyện *:</label>
            <select class="form-control" name="district_id" v-model="district_id">
                <option value="null">Vui lòng chọn quận</option>
                <option 
                    v-for="district in districts" 
                    :key="district.id" 
                    :value="district.id">
                    {{ district.name }}
                </option>
             </select>
        </div>
        <br>
        <div class="col">
            <label>Chọn phường/xã *:</label>
            <select class="form-control" name="ward_id" v-model="ward_id">
                <option value="null">Vui lòng chọn phường</option>
                <option 
                    v-for="ward in wards" 
                    :key="ward.id" 
                    :value="ward.id">
                    {{ ward.name }}
                </option>
             </select>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{
            provinces:[ ],
            province_id: null,
            districts:[ ],
            district_id: null,  
            wards:[ ],
            ward_id: null,
        }
    },
     mounted(){
        this.getProvinces();
    },
    methods: {
        getProvinces(){
            axios.get("/location/provinces").then(response => {
               this.provinces = response.data;
            })
        },
        getDistricts(){
            axios.get("/location/province/"+this.province_id+"/districts").then(response => {
               this.districts = response.data;
            })
        },
        getWards(){
            axios.get("/location/district/"+this.district_id+"/wards").then(response => {
               this.wards = response.data;
            })
        },
    },
    // Cứ biến thay đổi thì thay đổi theo
    watch: {
        // Thành phố thay đổi thì lấy quận huyện
        province_id(){
            this.getDistricts();
        },
        district_id(){
            this.getWards();
        }
    }
}
</script>