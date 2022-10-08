<template>
<!-- <div>{{getbilltests}}</div> -->
  <div class="px-0 mx-0 w-full" v-for="td in getbilltests" :key="td.id">
    <div>
        <div class="grid grid-cols-8  mx-0 py-0" >
          <div class="col-span-6">
            <div class="flex "  v-if="td.ousent.logo_view == 1">
              <div class=" py-0">
                <span  v-if="td.ousent.logo">
                    <img
                        class="h-16"
                        :src="pathLogo + td.ousent.logo"
                        alt=""
                      />
                </span>
                <span v-else></span>

              </div>
              <div class=" font-sans-Timenew pl-1 text-xs font-bold" v-if="td.ousent.address_view == 1">
                <p class="uppercase text-sm">{{td.ousent.name}}</p>
                <p class="leading-4"> Địa chỉ: {{td.ousent.address}}</p>
                <p class="leading-4" v-if="td.ousent.phone_contact">Điện thoại: {{td.ousent.phone_contact}}</p>
                <p class="leading-4" v-if="td.ousent.website">Website: {{td.ousent.phone_contact}}</p>
              </div>
            </div>
            <div class="flex " v-if="td.ousent.logo_view !== 1 && td.ousent.address_view !== 1">
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
              <div class=" font-sans-Timenew pl-1 text-xs font-bold" v-if="td.ousent.logo_view !== 1 && td.ousent.address_view !== 1">
                <p class="uppercase text-sm">{{eurolab.name}}</p>
                <p class="leading-4"> Địa chỉ: {{eurolab.addressSG}}</p>
                <p class="leading-4" v-if="eurolab.phoneSG">Điện thoại: {{eurolab.phoneSG}}</p>
                <p class="leading-4" v-if="eurolab.website">Website: {{eurolab.website}}</p>
              </div>
            </div>
          </div>
         <div class="col-span-2 text-center text-italy text-sm font-bold  font-sans-Timenew leading-4">
               <p class="  flex justify-center">
                <vue-barcode class="h-8 w-36 " :value="td.thinprep_code" :options="{ displayValue: false }"></vue-barcode>
              </p>
              <span class="-mt-2 text-center fontsizeName">Mã số: {{td.thinprep_code}}</span>
          </div>
        </div>

      <div class=" w-full mt-1 py-0">
          <div class="pl-10 py-0 place-items-center text-blue-700 font-sans-Timenew">
            <div class="pl-10 text-center font-bold text-lg underline underline-offset-2 leading-4 fontsizeTitle">PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG</div>
              <div class="leading-3 text-center fontsizeInfo">
                  <span class="text-center font-bold text-lg font-sans-Timenew ml-0 pl-0 fontsizeInfo">PAP'S SMEAR - ThinPrep</span>
                  <span class="align-top ml-0 p-0 text-md font-bold mt-2">&reg;</span>
              </div>
            </div>
      </div>
      <!--==============--->
      <div class="font-bold text-blue-800 font-sans-Timenew text-sm underline">THÔNG TIN BỆNH NHÂN</div>
      <div class="relative fontsizeName">
         <div class="absolute -mt-4 flex justify-center w-full opacity-10">
            <img class="w-1/3 -mt-4" :src="pathLogoEurolab + eurolab.background_thin" alt="imagesGG">
          </div>
      <div class="grid grid-cols-4 leading-6">
          <div class="col-span-2  font-sans-Timenew">Họ tên: <span class="font-bold"> {{td.custommer.name}}</span></div>
          <div class=" text-md font-sans-Timenew">Năm sinh: <span class="font-bold"> {{td.custommer.birthday}}</span></div>
          <div class=" font-sans-Timenew ">Para: <span class="font-bold"> {{td.para}}</span></div>
      </div>
      <div class="flex font-sans-Timenew leading-6 text-sm">
        <div class="w-1/2">
          Đia chỉ: <span class="font-bold "> {{td.custommer.address}}</span>
        </div>
        <div class="w-1/4">
          Điện thoại: <span class="font-bold "> {{td.custommer.phone}}</span>
        </div>
        <div class="w-1/4">
          Số HS: <span class="font-bold "> {{td.patient_code}}</span>
        </div>
      </div>
      <div class=" font-sans-Timenew leading-6">Chẩn đoán lâm sàng: <span class="font-bold"> {{td.diagnose}}</span></div>
      <div class="grid grid-cols-3 font-sans-Timenew leading-4">
          <div class=" col-span-2">Bác sỹ lấy mẫu: <span class="font-bold" > {{td.doctor_indi}}</span></div>
          <div class="">Ngày lấy mẫu:<span class="font-bold" > {{formatDate(td.date_sent)}}</span></div>
      </div>
      </div>
       <!--/==============--->
        <!--==============--->
        <div class="text-center font-bold text-md underline underline-offset-2 font-sans-Timenew mt-1 text-red-600 fontsizeInfo">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG (BETHESDA 2014)</div>
        <div class="text-left font-bold text-sm  font-sans-Timenew mt-2 text-blue-800">LOAI BỆNH PHẨM <span class="pl-5 text-red-600 mr-0 pr-0">Tế bào học nhúng dịch ThinPrep</span>
         <span class="text-red-600 align-top ml-0 p-0">&reg;</span>
         </div>
         <div class="grid grid-cols-7">
           <div class=" col-span-2  text-left font-bold text-sm  font-sans-Timenew mt-0 text-blue-800">TÍNH CHẤT BỆNH PHẨM </div>

           <div class="col-span-5 flex flex-row text-sm pl-2" >
                    <div class="" v-for="eg11 in testElements" :key="eg11.id">
                     <span class="font-bold pr-4" v-if="eg11.element_group ==11">
                          <span>
                            <input type="checkbox"   class=" form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg11.id === x) !== -1" />
                          </span>
                          <span class=" text-middle ml-1  font-sans-Timenew">{{eg11.name}}</span>
                      </span>
                    </div>
            </div>
         </div>
         <!--/==============--->
         <!--==============--->
         <div class="font-bold text-blue-800 font-sans-Timenew text-sm mt-1">KẾT QUẢ</div>
         <div class="flex flex-wrap">
           <div class="text-xs" v-for="eg12 in testElements" :key="eg12.id">
              <div class="font-bold fontsizeElement mr-4" v-if="eg12.element_group ==12">
                      <span v-if="eg12.id == 29">

                              <span>
                                  <input type="checkbox"   class=" form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg12.id === x) !== -1" />
                              </span>

                        </span>
                           <span v-else>
                                  <input type="checkbox"   class=" form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg12.id === x) !== -1" />
                              </span>
                          <span class=" text-middle uppercase text-blue-800  font-sans-Timenew leading-3  ml-1">{{eg12.name}}</span>
                    </div>
            </div>
         </div>

         <div class="grid grid-cols-3">
            <div>
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào do vi sinh</span>
              <div class="text-xs " v-for="eg13 in testElements" :key="eg13.id">
                      <span class="flex flex-row items-center leading-3 font-bold pl-2" v-if="eg13.element_group ==13">
                          <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg13.id === x) !== -1" />
                          <span class="text-middle ml-1 italic py-1  font-sans-Timenew leading-3">{{eg13.name}}</span>
                      </span>
              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Gai</span>
               <div class="text-xs" v-for="eg14 in testElements" :key="eg14.id">
                      <span class="flex flex-row items-center font-bold pl-2 leading-4" v-if="eg14.element_group ==14">
                           <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg14.id === x) !== -1" />
                            <span class="text-middle ml-1 font-sans-Timenew">{{eg14.name}}</span>
                      </span>
              </div>
            </div>


         </div>
         <div class="grid grid-cols-3 mt-0">
            <div class="text-xs">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Biến đổi tế bào khác</span>
              <div class="flex flex-col">
               <div class="" v-for="eg15 in testElements" :key="eg15.id">
                      <span class="flex flex-row items-center font-bold pl-2 align-items-middle" v-if="eg15.element_group ==15">
                           <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg15.id === x) !== -1" />
                            <span class="align-middle text-xs font-sans-Timenew ml-1 py-1 leading-3">{{eg15.name}}</span>
                      </span>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào tuyến</span>
              <div class="flex flex-col leading-5">
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
                      class="w-72 max-h-48 "
                      :src="pathThinLeft+td.imageleft.thinLeft"
                      :alt="td.thinprep_code"/>
                </div>
                <div class="text-center flex justify-center"  >
                  <img
                      class="w-72 max-h-48 "
                      :src="pathThinRight+td.imageleft.thinRight"
                      :alt="LogoThin"/>
                    </div>
          </div>
         <div class="grid grid-cols-3">
                <div class="col-span-2">
                    <div class="grid grid-cols-1">
                        <span class="font-bold text-red-800 font-sans-Timenew text-sm underline underline-offset-2 fontsizeName">KẾT LUẬN (Conclution):</span>
                          <div class="fontsizeElement"  v-for="eg9 in testElements" :key="eg9.id">
                                    <span class="font-bold text-xs w-full mr-2" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                                        <span class="" style="line-heigh:30%">
                                            <span class="uppercase text-red-800 font-sans-Timenew  pl-2 m-0 fontsizeElement" v-if="td.results.find((result) => result.element_id === '26') && td.results.find((result) => result.element_id === '26').result !== null">
                                                  {{td.results.find((result) => result.element_id === "26").result}}
                                            </span>
                                           <span v-else>
                                                <span class="uppercase text-red-800 font-sans-Timenew text-sm pl-2 m-0 fontsizeElement">- Không tổn thương trong biểu mô hay ung thư</span>
                                              <p class="pl-2 font-sans-Timenew text-lg leading-4 fontsizeElement">-Tế bào cổ tử cung biến đổi do viêm</p>
                                            </span>

                                        </span>
                                    </span>
                          </div>
                          <div class="font-sans-Timenew text-sm  font-bold"><span class="underline text-blue-700 uppercase">Đề nghị:</span> {{td.note}}</div>
                          <div class="font-sans-Timenew text-sm  font-bold mt-2"><span class="underline text-blue-700">Ngày nhận mẫu:</span> {{formatDate(td.date_receive)}}</div>
                    </div>
                </div>
                    <div class="grid grid-cols-1 text-center fontsizeName">
                        <span class="font-bold font-sans-Timenew text-md">Ngày đọc kết quả: {{currentDate}}</span>
                        <span class="font-bold font-sans-Timenew text-md">BS/KTV đọc kết quả:</span>
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
                        <span class="font-bold font-sans-Timenew text-md">KHOA GIẢI PHẨU BỆNH</span>
                        <span class="font-bold font-sans-Timenew text-md">BỆNH VIỆN TỪ DŨ</span>
                    </div>
        </div>
    </div>
    <div class="page-break"></div>
  </div>
</template>

<script>
import { BeakerIcon } from '@heroicons/vue/solid'
import { CheckIcon } from '@heroicons/vue/solid'
import VueBarcode from '@chenfengyuan/vue-barcode';
import moment from 'moment'
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
         pathLogoEurolab:''

    },
    components:{
      BeakerIcon,
      CheckIcon,
      VueBarcode
    },
    data(){
      return{
        pathLogoSG:'/images/Logo/logoSG.png',
        pathLogoThin:'/images/Logo/Thinprep.jpg',
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

