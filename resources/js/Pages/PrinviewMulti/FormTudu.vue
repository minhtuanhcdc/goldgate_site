<template>
 <div class="m-0 p-0" v-for="(td,i) in getbilltests" :key="i">
    <div class="w-full" ref="printMe" id="printMe" style="@media print:{margin:0; padding:0;}">
      <div class="grid grid-cols-9 justify-between mx-0 py-0">
        <div class="col-span-7">
          <div class="flex "  v-if="td.ousent.logo_view == 1">
              <div class=" py-0">
                <span  v-if="td.ousent.logo">
                  <img
                    class="h-16"
                    :src="pathLogo + td.ousent.logo"
                    :alt="td.ousent.logo"
                    />
                </span>
                <span v-else></span>
              </div>
              <div class=" font-sans-Timenew pl-1 text-xs font-bold" v-if="td.ousent.address_view == 1">
                <p class="uppercase text-sm">{{td.ousent.name}}</p>
                  <span class="flex">
                <span class="leading-4 w-12"> Địa chỉ:</span> <span>{{td.ousent.address}}</span>
                  </span>
                <p class="leading-4" v-if="td.ousent.phone_contact">Điện thoại: {{td.ousent.phone_contact}}</p>
                <p class="leading-4" v-if="td.ousent.website">Website: {{td.ousent.phone_contact}}</p>
              </div>
          </div>
          <div class="flex "  v-if="td.ousent.logo_view !== 1 && td.ousent.address_view !== 1">
              <div class=" py-0">
                <span  v-if="eurolab.logo">
                  <img
                      class="h-14"
                      :src="pathLogoEurolab + eurolab.logo"
                      alt=""
                    />
                </span>
                <span v-else></span>
              </div>
              <div class=" font-sans-Timenew pl-1 text-xs font-bold" v-if="td.ousent.address_view !== 1">
                <p class="uppercase text-sm">{{eurolab.name}}</p>
                <span class="flex">
                <span class="leading-4 w-16"> Địa chỉ:</span> <span class="pl-1">{{eurolab.addressSG}}</span>
                  </span>
                <p class="leading-4" v-if="eurolab.phoneSG">Điện thoại: {{eurolab.phoneSG}}</p>
                <p class="leading-4" v-if="eurolab.website">Website: {{eurolab.website}}</p>
              </div>
          </div>
        </div>
        <div class="col-span-2 text-center text-sm font-bold font-sans-Timenew leading-4">
          <p class="flex justify-center">
            <vue-barcode class="h-6 w-36" :value="td.thinprep_code" :options="{ displayValue: false }"></vue-barcode>
          </p>
          <span class="text-center -mt-2 fontsizeElement">Mã số: {{td.thinprep_code}}</span>
        </div>
      </div>
      <div class=" text-center mt-1 mb-1">
        <div class="pt-0 py-0 place-items-center flex flex-col">
          <span class="text-center font-bold text-xl font-sans-Timenew text-blue-800 fontsizeTitle">PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG</span>
        </div>
      </div>
      <div class="relative">
        <div class="absolute mt-4 flex justify-center w-full opacity-10">
          <img class="w-1/3 -mt-4" :src="pathLogoEurolab + eurolab.background_thin" alt="imagesGG">
        </div>
        <div class="grid grid-cols-4 leading-5 text-sm fontsizeName">
          <div class="col-span-2 font-sans-Timenew italic fontsizeName">Họ và tên (Name):<span class=" font-bold fontsizeName">{{td.custommer.name}}</span></div>
          <div class="  font-sans-Timenew italic">Tuổi (Age):<span class="pl-2 font-bold">{{td.custommer.birthday}}</span></div>
          <div class="  font-sans-Timenew italic">Para: <span class="pl-2">{{td.para}}</span></div>
        </div>
        <div class="grid grid-cols-4 fontsizeName leading-5">
          <div class="col-span-3 font-sans-Timenew  italic">Đia chỉ(Address):<span class="pl-2 ">{{td.custommer.address}}</span></div>
          <div class=" font-sans-Timenew  italic ">Số ĐT:<span class="pl-2">{{td.custommer.phone}}</span></div>
        </div>
        <div class="font-sans-Timenew leading-5 italic fontsizeName">Khoa/Phòng:<span class="pl-2 font-bold">{{td.department}} </span></div>
        <div class="grid grid-cols-2 italic fontsizeName leading-5">
          <div class="font-sans-Timenew">Chẩn đoán lâm sàng:<span class="font-bold pl-2">{{td.diagnose}}</span></div>
        </div>
        <div class="grid grid-cols-2 italic fontsizeName leading-5">
          <div class=" font-sans-Timenew font-bold ">Ngày lấy mẫu: <span class="font-bold">{{formatDate(td.date_receive)}}</span></div>
          <div class="font-sans-Timenew font-bold">Bác sỹ lấy mẫu: <span class="font-bold pl-2 infoText"> {{td.doctor_indi}}</span></div>
      </div>
      </div>
      <div>
        <div class="text-center font-bold font-sans-Timenew mt-2 text-red-600 text-lg tracking-tighter fontsizeInfo">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG (BETHESDA 2014)</div>
        <div class="text-left font-bold text-sm  font-sans-Timenew mt-1 text-blue-800 leading-5">LOAI BỆNH PHẨM
          <span class="pl-5 text-blue-600 mr-0 pr-0 text-sm">Tế bào học nhúng dịch ThinPrep</span><span class="text-blue-600 align-top ml-0 p-0">&reg;</span>
        </div>
        <div class="grid grid-cols-7 mt-2">
                  <div class=" col-span-2  text-left font-bold text-sm font-sans-Timenew mt-0 text-blue-800 leading-5">TÍNH CHẤT BỆNH PHẨM </div>
                  <div class="col-span-5 flex flex-row items-center -mt-1" >
                      <div class="" v-for="eg11 in testElements" :key="eg11.id">
                        <div class="font-bold ml-3" v-if="eg11.element_group ==11">
                          <span v-if="eg11.id == 27">
                            <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map(({result})=> result)[0] !=='27'"/>
                          </span>
                          <span v-else>
                              <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg11.id" v-model="selectedArray"/>
                          </span>
                          <span class=" text-middle  font-sans-Timenew tracking-tight ml-1 fontsizeElement">{{eg11.name}}</span>
                        </div>
                      </div>
                    </div>
        </div>
        <div class="grid grid-cols-2 mt-2 text-center" v-if="td.imageleft">
          <div  class="text-center flex justify-center mr-2">
            <img
              class="w-86 max-h-72"
              :src="pathThinLeft+td.imageleft.thinLeft"
              :alt="td.thinprep_code"/>
          </div>
          <div class="text-center flex justify-center ml-2" >
              <img
              class="w-86 max-h-72 "
              :src="pathThinRight+td.imageleft.thinRight"
              :alt="LogoThin"/>
          </div>
        </div>
        <div class="">
          <span class="font-bold text-blue-800 font-sans-Timenew text-sm underline mt-2 fontsizeName">KẾT LUẬN:</span>
            <div  v-for="eg9 in testElements" :key="eg9.id">
              <span class="font-bold  w-full mr-3 text-sm p-0 m-0" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                <div class="" style="line-heigh:30%" v-if="td.results.find((result) => result.element_id === '26')">
                    <span class="uppercase text-red-800 font-sans-Timenew text-sm pl-2 m-0 fontsizeName" v-if="td.results.find((result) => result.element_id === '26').result !== null">
                      {{td.results.find((result) => result.element_id === "26").result}}
                    </span>
                    <span v-else>
                      <span class="uppercase text-red-800 font-sans-Timenew text-xs pl-2 m-0 fontsizeName">- Không tổn thương trong biểu mô hay ung thư</span>
                      <p class="pl-2 font-sans-Timenew text-sm leading-3 fontsizeName">-Tế bào cổ tử cung biến đổi do viêm</p>
                    </span>
                </div>
                <span v-else >
                  <span class="uppercase text-red-800 font-sans-Timenew text-xs pl-2">- KHÔNG TỔN THƯƠNG TRONG BIỂU MÔ HAY UNG THƯ</span>
                  <p class="  font-sans-Timenew  pl-2 leading-3 text-sm">- Tế bào cổ tử cung biến đổi do viêm</p>
                </span>
              </span>
            </div>
        </div>
        <div class="font-bold text-blue-800 font-sans-Timenew text-sm underline underline-offset-2 mt-2">ĐỀ NGHỊ:</div>
        <div class="flex justify-between text-center text-sm">
          <div></div>
          <div class="flex flex-col">
            <span class="font-bold font-sans-Timenew ">Ngày đọc kết quả: {{currentDate}}</span>
            <p class=" font-sans-Timenew">BS/KTV đọc kết quả:</p>
            <div v-if="td.asign_hide == 1" class="py-10"></div>
            <div v-else>
            <span class="py-2" v-if="td.ousent.asign_view ==1">
              <span v-if="doctorread">
                <img class="h-14" :src="pathAsign +td.doctorread.asign"/>
              </span>
              <p v-else class="py-10"></p>
            </span>
            <p class="py-10" v-else></p>
            <span class="font-bold font-sans-Timenew text-md " v-if="td.doctorread">{{td.doctorread.title}}<span class="ml-1 uppercase"> {{td.doctorread.name}}</span></span>
            <span v-else></span>
          </div>
          </div>
        </div>
      </div>
    </div>
  <div class="page-break"></div>
</div>
</template>
<script>
import { CheckIcon } from '@heroicons/vue/solid'
import VueBarcode from '@chenfengyuan/vue-barcode';
import moment from 'moment'
export default {
    props:{
        getbilltests:Object,
        pathLogoEurolab:'',
        eurolab:'',
        selectedArray:'',
        testElements:'',
        ImageThin:"",
        pathThinLeft:'',
        pathThinRight:'',
        imageThinLeft:'',
        ketluan:'',
        currentDate:'',
        pathLogo:'',
        pathAsign:''
    },
    components:{
      CheckIcon,
      VueBarcode
    },
    data(){
      return{
        LogoGG:'/images/Logo/logoEuro(40_40).jpg',
      test:[1, 2,3,4,5,6,7],

      }
    },
     methods:{
    formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY')}
    },
  }
}
</script>
