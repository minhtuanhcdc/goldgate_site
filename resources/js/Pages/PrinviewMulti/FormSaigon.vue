<template>
<!-- <div>{{getbilltests}}</div> -->
  <div class="" v-for="td in getbilltests" :key="td.id">
    <div class="my-0 py-0">
        <div class="flex justify-between mx-0 py-0">
            <div class=" py-0">
                <img
                  class="h-16 w-42"
                  :src="pathLogo + td.ousent.logo"
                  :alt="pathLogoSG"
                />
            </div>
             <div class="text-italy text-sm font-bold content-center font-sans-Timenew leading-5  pl-1 py-0 -mt-1">
              <span class="text-left pl-1">Mã y tế: {{td.sample_code}}</span>
              <p class="-mt-1  flex justify-center">
              <vue-barcode class="h-6 w-32 " :value="td.thinprep_code" :options="{ displayValue: false }"></vue-barcode>
              </p>
               <p class="text-left">STT: {{td.thinprep_code}}</p>
            </div>
        </div>
      <div class="grid grid-cols-5 w-full mt-0 py-0 my-0 ">
          <div class="col-span-4 text-center">
              <div class="pl-10 py-0 place-items-center">
                    <div class="pl-10 text-center font-bold text-lg underline underline-offset-2 font-sans-Timenew text-blue-700 ">PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG</div>
                 </div>

          </div>

      </div>
    </div>
      <!--==============--->
      <div class="font-bold text-blue-800 font-sans-Timenew text-sm underline">THÔNG TIN BỆNH NHÂN</div>
      <div class="relative">
        <div class="absolute -mt-4 flex justify-center w-full opacity-10">
                            <img class="w-1/3 -mt-4" :src="pathLogoEurolab + eurolab.background_thin" alt="imagesGG">
                          </div>
      <div class="grid grid-cols-4 leading-4 fontsizeName">
          <div class="col-span-2  font-sans-Timenew">Họ tên: <span class="font-bold"> {{td.custommer.name}}</span></div>
          <div class=" text-md font-sans-Timenew">Năm sinh: <span class="font-bold"> {{td.custommer.birthday}}</span></div>
          <div class=" font-sans-Timenew ">Para: <span class="font-bold"> {{td.para}}</span></div>
      </div>
      <div class=" font-sans-Timenew leading-5 fontsizeName">Đia chỉ <span class="font-bold"> {{td.custommer.address}}</span></div>
      <div class=" font-sans-Timenew leading-5 fontsizeName">Chẩn đoán lâm sàng: <span class="font-bold"> {{td.diagnose}}</span></div>
      <div class="grid grid-cols-3 font-sans-Timenew leading-5 fontsizeName">
          <div class=" col-span-2">Bác sỹ lấy mẫu: <span class="font-bold"> {{td.doctor_indi}}</span></div>
          <div class="">Ngày lấy mẫu:<span class="font-bold" > {{formatDate(td.date_receive)}}</span></div>
      </div>
      </div>
       <!--/==============--->
        <!--==============--->
        <div class="text-center font-bold text-lg underline underline-offset-2 font-sans-Timenew mt-1 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG (BETHESDA 2014)</div>
        <div class="text-left font-bold text-xs  font-sans-Timenew mt-0 text-blue-800">LOAI BỆNH PHẨM <span class="pl-5 text-red-600 mr-0 pr-0 text-sm">Tế bào học nhúng dịch ThinPrep</span>
         <span class="text-red-600 align-top ml-0 p-0">&reg;</span>
         </div>

         <div class="grid grid-cols-5">
           <div class=" col-span-2  text-left font-bold text-xs  font-sans-Timenew mt-0 text-blue-800">TÍNH CHẤT BỆNH PHẨM </div>

           <div class="col-span-3 flex flex-row" >
                    <div class="text-xs" v-for="eg11 in testElements" :key="eg11.id">
                      <span class="font-bold mr-4" v-if="eg11.element_group ==11">
                          <span>
                            <input type="checkbox"   class=" form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg11.id === x) !== -1" />
                          </span>
                          <span class="font-sans-Timenew ml-1">{{eg11.name}}</span>
                      </span>
                    </div>
            </div>
         </div>
         <!--/==============--->
         <!--==============--->
         <div class="font-bold text-blue-800 font-sans-Timenew text-sm mt-2">KẾT QUẢ</div>

         <div class="flex flex-wrap ">
              <div class="leading-5 m-0 p-0" v-for="eg12 in testElements" :key="eg12.id">
                    <div class="mr-3" v-if="eg12.element_group ==12">
                           <span>
                                  <input type="checkbox"   class=" form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg12.id === x) !== -1" />
                              </span>
                          <span class=" text-middle uppercase text-blue-800  font-sans-Timenew leading-5  underline fontsizeName font-bold ml-1">{{eg12.name}}</span>
                    </div>
              </div>



         </div>

         <div class="grid grid-cols-3 my-0 mt-2">
            <div>
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào do vi sinh</span>
              <div class="text-xs leading-3" v-for="eg13 in testElements" :key="eg13.id">
                  <span class="flex flex-row items-center leading-4 font-bold pl-2 " v-if="eg13.element_group ==13">
                    <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg13.id === x) !== -1" />
                    <span class="text-middle ml-1 italic  font-sans-Timenew">{{eg13.name}}</span>
                  </span>
              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Gai</span>
               <div class="text-xs leading-4" v-for="eg14 in testElements" :key="eg14.id">
                  <span class="flex flex-row items-center font-bold pl-2" v-if="eg14.element_group ==14">
                    <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg14.id === x) !== -1" />
                    <span class="text-middle ml-1 font-sans-Timenew">{{eg14.name}}</span>
                  </span>
              </div>
            </div>
         </div>
         <div class="grid grid-cols-3 -mt-1">
            <div class="text-xs">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Biến đổi tế bào khác</span>
              <div class="flex flex-col">
               <div class="" v-for="eg15 in testElements" :key="eg15.id">
                    <span class="flex flex-row items-center font-bold pl-2 align-items-middle" v-if="eg15.element_group ==15">
                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 mt-1" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg15.id === x) !== -1" />
                      <span class="align-middle text-xs font-sans-Timenew ml-1 py-1 leading-3">{{eg15.name}}</span>
                    </span>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào tuyến</span>
              <div class="flex flex-col leading-3">
                <div class=" leading-3" v-for="eg16 in testElements" :key="eg16.id">
                      <span class="flex flex-row items-center font-bold pl-2" v-if="eg16.element_group ==16">
                          <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg16.id === x) !== -1" />
                            <span class="text-middle text-xs font-sans-Timenew ml-1 leading-2">{{eg16.name}}</span>
                      </span>
                </div>
              </div>
            </div>
         </div>
          <div class="grid grid-cols-2 mt-1 text-center" v-if="td.imageleft">
              <div  class="text-center flex justify-center">
                  <img
                    class="w-72 max-h-46 "
                    :src="pathThinLeft+td.imageleft.thinLeft"
                    :alt="td.thinprep_code"/>
              </div>
              <div class="text-center flex justify-center"  >
                  <img
                    class="w-72 max-h-46 "
                    :src="pathThinRight+td.imageleft.thinRight"
                    :alt="LogoThin"/>
              </div>
            </div>
         <div class="flex justify-between">
            <div class="flex flex-col">
              <div class="grid grid-cols-1">
                  <span class="font-bold text-red-800 font-sans-Timenew text-sm underline underline-offset-2">KẾT LUẬN (Conclution):</span>
                  <div  v-for="eg9 in testElements" :key="eg9.id">
                      <div class="font-bold text-xs w-full mr-2" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                        <div class="" style="line-heigh:30%" v-if="td.results.find((result) => result.element_id === '26')">
                                             <span class="uppercase text-red-800 font-sans-Timenew text-sm pl-2 m-0" v-if="td.results.find((result) => result.element_id === '26').result !== null">
                                                  {{td.results.find((result) => result.element_id === "26").result}}
                                            </span>
                                            <span v-else>
                                               <span class="uppercase text-red-800 font-sans-Timenew text-xs pl-2 m-0">- Không tổn thương trong biểu mô hay ung thư</span>
                                               <p class="pl-2 font-sans-Timenew text-sm leading-6 ">-Tế bào cổ tử cung biến đổi do viêm</p>
                                            </span>
                        </div>
                           <div v-else>
                              <span class="uppercase text-red-800 font-sans-Timenew text-xs pl-2 m-0">- Không tổn thương trong biểu mô hay ung thư</span>
                              <p class="pl-2 font-sans-Timenew text-sm leading-5 ">-Tế bào cổ tử cung biến đổi do viêm</p>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="flex flex-col text-center text-sm">
              <span class="font-bold font-sans-Timenew text-xs">Ngày đọc kết quả: {{currentDate}}</span>
              <span class="font-bold font-sans-Timenew " >BS/KTV đọc kết quả:</span>
              <div v-if="td.asign_view" class="py-10"></div>
              <div v-else>
                <span class="py-2" v-if="td.ousent.asign_view">
                  <img class="h-14" :src="pathAsign +td.doctorread.asign"/>
                </span>
                <span class="py-10" v-else></span>
                <span class="font-bold font-sans-Timenew text-md " v-if="td.doctorread">{{td.doctorread.title}}<span class="ml-1 uppercase"> {{td.doctorread.name}}</span></span>
              </div>
              <span class="font-bold font-sans-Timenew leading-4">KHOA GIẢI PHẨU BỆNH</span>
              <span class="font-bold font-sans-Timenew leading-4">BỆNH VIỆN TỪ DŨ</span>
            </div>
          </div>
    <div class="grid grid-cols-3 -mt-10">
        <div class="col-span-2">
          <div class="w-full flex flex-col font-bold">
              <span class="font-sans-Timenew text-xs">{{td.ousent.address}}</span>
              <span class="font-sans-Timenew text-xs">Tel: {{td.ousent.phone_contact}}* W: {{td.ousent.website}}</span>
            </div>
        </div>
      <div></div>
    </div>
    <div class="page-break"></div>
  </div>

</template>

<script>
import { BeakerIcon } from '@heroicons/vue/solid'
import { CheckIcon } from '@heroicons/vue/solid'
import moment from 'moment'
import VueBarcode from '@chenfengyuan/vue-barcode';
export default {
    props:{
        getbilltests:Object,
        printDoctor:'',
        selectedArray:'',
        testElements:'',
        pathImageLeft:"",
        pathThinLeft:'',
        pathThinRight:'',
        imageThinLeft:'',
        imageThinRight:'',
        ketluan:'',
        currentDate:'',
         pathLogo:'',
         eurolab:'',
         pathLogoEurolab:'',
         pathAsign:'',

    },
    components:{
      BeakerIcon,
      CheckIcon,
      VueBarcode
    },
    data(){
      return{
        pathLogoSG:'/images/Logo/logoSG.png',
        //pathLogoThin:'/images/Logo/Thinprep.jpg',
        pathLogoThin:'/images/Logo/logoEuro(40_40).jpg',
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