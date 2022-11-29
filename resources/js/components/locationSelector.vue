<template>
    <div class="mb-3">
        <label>Chọn thành phố <span class="hoathi">*</span></label>
        <div class="mb-3">
            <select class="form-control" name="province_id" v-model="province_id">
                <option value="">Vui lòng chọn thành phố</option>
                <option 
                    v-for="province in provinces" 
                    :key="province.id" 
                    :value="province.id"
                >
                    {{ province.name }}
                </option>
            </select>
        </div>
        <div class="mb-3">
            <label>Chọn quận/huyện <span class="hoathi">*</span></label>
            <select class="form-control" name="district_id" v-model="district_id">
                <option value="">Vui lòng chọn quận</option>
                <option 
                    v-for="district in districts" 
                    :key="district.id" 
                    :value="district.id">
                    {{ district.name }}
                </option>
             </select>
        </div>
        <div class="mb-3">
            <label>Chọn phường/xã <span class="hoathi">*</span></label>
            <select class="form-control" name="ward_id" v-model="ward_id">
                <option value="">Vui lòng chọn phường</option>
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
    props: ['address'],
    data(){
        return{
            provinces:[ ],
            province_id:null,
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
        },
        "address": {
            deep: true,
            immediate: true,
            handler(newValue){
                const { district, ward,province } = newValue;
                this.province_id = province.map(item=>item.province_id)[0] || "";
                this.district_id = district.map(item=>item.district_id)[0] || "";
                this.ward_id = ward.map(item=>item.ward_id)[0] || "";
            }
        }
    }
}
</script>

<style scoped>
    .hoathi{
        color:red;
    }
</style>