<template>
 <div class="m-0 p-0" v-for="(td,i) in getbilltests" :key="i">
    <div class="">
      <div class="flex justify-between mx-0 py-0">
                <div class="py-0 flex">
                  <div class="">
                    <span v-if="td.ousent.logo_view">
                      <span v-if="td.ousent.logo">
                            <img
                          class="object-contain w-56 pt-0 mt-0"
                          :src="pathLogo+td.ousent.logo"
                          :alt="td.ousent.logo"
                        />
                      </span>
                      <span v-else></span>

                    </span>
                      <span v-else >
                      </span>
                  </div>
                </div>
                <div class="text-left text-italy fontsizeElement font-bold font-sans-Timenew">
                  <div class="col-span-1 text-left font-sans-Timenew leading-5 fontsizeElement">
                    <span class="p-0 w-40  font-bold ml-1">Mã y tế:</span>
                    <p class="-mt-1  flex justify-left">
                      <vue-barcode class="h-8 w-36" :value="td.thinprep_code" :options="{ displayValue: false }"></vue-barcode>
                    </p>
                      <p class="p-0 w-40 text-center -mt-1 font-bold fontsizeName">STT: {{td.thinprep_code}}</p>
                  </div>
                </div>

      </div>
      <div class="w-full place-items-center -mt-1">
        <div class="text-center font-bold  font-sans-Timenew col-span-6">
          <span class="underline text-blue-700 fontsizeTitle">PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG</span>
        </div>
      </div>
    </div>
    <!--==============--->
    <div class="font-bold text-blue-800 font-sans-Timenew underline fontsizeName">THÔNG TIN BỆNH NHÂN</div>
    <div class="relative leading-3">
      <div class="absolute -mt-8 flex justify-center w-full opacity-10" v-if="pathLogoEurolab+eurolab.background_thin">
        <img class="w-1/3 mt-1" :src="pathLogoEurolab + eurolab.background_thin" alt="">
      </div>
      <div v-else></div>
      <div class="grid grid-cols-4 leading-4 fontsizeInfo">
        <div class="col-span-2  font-sans-Timenew">Họ tên: <span class="font-bold"> {{td.custommer.name}}</span></div>
        <div class=" text-md font-sans-Timenew">Năm sinh: <span class="font-bold"> {{td.custommer.birthday}}</span></div>
        <div class=" font-sans-Timenew ">Para: <span class="font-bold"> {{td.para}}</span></div>
      </div>
      <div class=" font-sans-Timenew leading-4 fontsizeInfo">Đia chỉ: <span class="font-bold"> {{td.custommer.address}}</span></div>
      <div class=" font-sans-Timenew leading-4 fontsizeInfo ">Chẩn đoán lâm sàng: <span class="font-bold"> {{td.diagnose}}</span></div>
      <div class="grid grid-cols-3 font-sans-Timenew leading-4 fontsizeInfo ">
        <div class=" col-span-2">Bác sỹ lấy mẫu: <span class="font-bold" > {{td.doctor_indi}}</span></div>
        <div class="fontsizeInfo">Ngày lấy mẫu:
          <span class="font-bold">
          {{formatDate(td.date_receive)}}
          </span>
        </div>
      </div>
    </div>
    <!--/==============--->
    <!--==============--->
    <div class="text-center font-bold fontsizeTitle underline underline-offset-2 font-sans-Timenew mt-1 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG (BETHESDA 2014)</div>
    <div class="text-left font-bold fontsizeName  font-sans-Timenew mt-2 text-blue-800">LOAI BỆNH PHẨM <span class="pl-5 text-red-600 mr-0 pr-0">Tế bào học nhúng dịch ThinPrep</span>
        <span class="text-red-600 align-top ml-0 p-0">&reg;</span>
    </div>
    <div class="grid grid-cols-7">
      <div class=" col-span-2  text-left font-bold fontsizeName  font-sans-Timenew mt-0 text-blue-800">TÍNH CHẤT BỆNH PHẨM </div>
      <div class="col-span-5 flex flex-row text-sm" >
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
    <div class="font-bold text-blue-800 font-sans-Timenew fontsizeName mt-0">KẾT QUẢ</div>
    <div class="flex flex-wrap pl-2">
      <div class="" v-for="(eg12,i) in testElements" :key="i">
        <div class="font-bold fontsizeInfo leading-3 mr-4" v-if="eg12.element_group ==12">
          <span v-if="eg12.id == 29">
            <span>
              <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 leading-4" />
            </span>
          </span>
          <span v-else>
            <input type="checkbox"   class=" form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg12.id === x) !== -1" />
          </span>
          <span class=" text-middle ml-1 uppercase text-blue-800  font-sans-Timenew leading-3 fontsizeElement">{{eg12.name}}</span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-3 mt-0">
      <div>
        <span class="underline underline-offset-1 font-sans-Timenew font-bold fontsizeInfo uppercase text-blue-700">Tế bào do vi sinh</span>
        <div class="fontsizeElement " v-for="eg13 in testElements" :key="eg13.id">
                <span class="flex flex-row items-center font-bold pl-2 fontsizeElement" v-if="eg13.element_group ==13">
                    <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg13.id === x) !== -1" />
                    <span class="text-middle font-sans-Timenew ml-1 leading-2">{{eg13.name}}</span>
                </span>
        </div>
      </div>
      <div class="col-span-2">
        <span class="underline underline-offset-1 font-sans-Timenew font-bold fontsizeInfo uppercase text-blue-700">Tế bào Gai</span>
          <div class="flex flex-row items-center font-bold pl-2 leading-4 fontsizeElement" v-for="eg14 in testElements" :key="eg14.id">
                <span class="flex flex-row items-center font-bold pl-2" v-if="eg14.element_group ==14">
                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg14.id === x) !== -1" />
                      <span class="text-middle font-sans-Timenew ml-1 leading-2">{{eg14.name}}</span>
                </span>
        </div>
      </div>
    </div>
    <div class="grid grid-cols-3 mt-1">
      <div class="text-xs">
        <span class="underline underline-offset-1 font-sans-Timenew font-bold fontsizeInfo uppercase text-blue-700">Biến đổi tế bào khác</span>
        <div class="flex flex-col leading-4 fontsizeElement">
          <div class="" v-for="eg15 in testElements" :key="eg15.id">
                <span class="flex flex-row font-bold pl-2 items-center" v-if="eg15.element_group ==15">
                    <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg15.id === x) !== -1" />
                      <span class="text-middle font-sans-Timenew ml-1 leading-2">{{eg15.name}}</span>
                </span>
          </div>
        </div>
      </div>
      <div class="col-span-2">
        <span class="underline underline-offset-1 font-sans-Timenew font-bold fontsizeInfo uppercase text-blue-700">Tế bào tuyến</span>
        <div class="flex flex-col leading-4 fontsizeElement">
          <div class="" v-for="eg16 in testElements" :key="eg16.id">
                <span class="flex flex-row items-center font-bold pl-2" v-if="eg16.element_group ==16">
                    <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg16.id === x) !== -1" />
                      <span class="text-middle font-sans-Timenew ml-1 leading-2">{{eg16.name}}</span>
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
    <div class="flex justify-between">
      <div class="flex flex-col">
        <div class="grid grid-cols-1">
          <span class="font-bold text-red-800 font-sans-Timenew fontsizeInfo underline underline-offset-2">KẾT LUẬN (Conclution):</span>
          <div  v-for="eg9 in testElements" :key="eg9.id">
            <div class="font-bold text-xs w-full mr-2" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
              <div class="" style="line-heigh:30%" v-if="td.results.find((result) => result.element_id === '26')">
                <span class="uppercase text-red-800 font-sans-Timenew text-sm pl-2 m-0" v-if="td.results.find((result) => result.element_id === '26').result !== null">
                  {{td.results.find((result) => result.element_id === "26").result}}
                </span>
                <span v-else>
                  <span class="uppercase text-red-800 font-sans-Timenew text-xs pl-2 m-0">- Không tổn thương trong biểu mô hay ung thư</span>
                  <p class="pl-2 font-sans-Timenew text-sm leading-6 ">-Tế bào trong giới hạn bình thường</p>
                </span>
              </div>
              <div v-else>
                <span class="uppercase text-red-800 font-sans-Timenew text-xs pl-2 m-0">- Không tổn thương trong biểu mô hay ung thư</span>
                <p class="pl-2 font-sans-Timenew text-sm leading-5 ">-Tế bào trong giới hạn bình thường</p>
              </div>
            </div>
          </div>
        </div>
        <div class="font-bold text-blue-800 font-sans-Timenew fontsizeInfo"><span class="underline underline-offset-2">ĐỀ NGHỊ</span>: {{td.note}}</div>
      </div>
      <div class="flex flex-col text-center fontsizeInfo">
        <span class="font-bold font-sans-Timenew ">Ngày đọc kết quả: {{currentDate}}</span>
        <span class=" font-bold font-sans-Timenew fontsizeName">BÁC SĨ ĐỌC KẾT QUẢ</span>
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
        printCustommers:Object,
        printAddress:'',
        printOutsent:'',
        printDoctor:'',
        doctorread:'',
        selectedArray:'',
        testElements:'',
        pathImageLeft:"",
        pathThinLeft:'',
        pathThinRight:'',
        imageThinLeft:'',
        imageThinRight:'',
        ketluan:'',
        currentDate:'',
        logo:'',
        imagePathBackground:'',
        imageGGSqure:'',
        eurolab:'',
        pathLogo:'',
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
       //  path_logo:'/storage/Image_Ousent/',
       // pathLogoThin:'/images/Logo/Thinprep.jpg',
      }
    },
     methods:{
        formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY')}
    }
    }
}
</script>

