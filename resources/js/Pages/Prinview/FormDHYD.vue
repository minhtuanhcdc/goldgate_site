<template>
<div><h4>Form group 6_update</h4>
    <div id="printMe" ref="printMe" class="px-0">
      <div class="">
        <div class="flex justify-between mx-0 py-0">
          <div class="py-0 flex">
            <div class="mx-4">
              <span v-if="printOutsent.logo_view">
                <span v-if="printOutsent.logo">
                  <img
                    class="object-contain h-16 pt-0 mt-0"
                    :src="pathLogo+printOutsent.logo"
                    :alt="printOutsent.logo"
                  />
                </span>
                <span v-else></span>
              </span>
                <span v-else >
                  <img
                  class="object-contain h-16 w-48 pt -0 mt-0"
                  :src="imageGGSqure"
                  :alt="LogoThin"
                  />
                </span>
            </div>
            <div class="mt-0 p-0 ml-2" v-if="printOutsent.address_view">
              <span class="" v-if="printOutsent.address_view">
                <p class="font-bold font-sans-Timenew uppercase"> {{printOutsent.name}}</p>
                  <span class="">
                    <span class="grid grid-cols-7 flex-row font-sans-Timenew">
                      <span class="font-bold">Địa chỉ:</span>
                      <span class=" col-span-6"> {{printOutsent.address}}</span>
                    </span>
                    <p><span class="font-bold font-sans-Timenew mr-2">Điện thoại:</span>{{printOutsent.phoneSG}}</p>
                    <p v-if="printOutsent.website"><span class="font-bold font-sans-Timenew mr-2">Website:</span>{{printOutsent.website}}</p>
                  </span>
              </span>
              <span class="leading-5" v-else>
                <p class="font-bold font-sans-Timenew uppercase"> {{eurolab.name}}</p>
                <span class="">
                  <span class="flex flex-row font-sans-Timenew">
                    <span class="font-bold mr-4">Địa chỉ:</span>
                    <span class="w-3/4"> {{eurolab.addressSG}}</span>
                  </span>
                  <p><span class="font-bold font-sans-Timenew mr-2">Điện thoại:</span>{{eurolab.phoneSG}}</p>
                  <p><span class="font-bold font-sans-Timenew mr-2">Website:</span>{{eurolab.website}}</p>
                </span>
              </span>
            </div>
          </div>
          <div class="text-left text-italy fontsizeElement font-bold font-sans-Timenew">
            <div class="col-span-1 text-left font-sans-Timenew leading-5 fontsizeElement">
              <span class="p-0 w-40  font-bold">Mã y tế:</span>
              <p class="-mt-1  flex justify-left">
                <vue-barcode class="h-8 w-36" :value="getbilltests['thinprep_code']" :options="{ displayValue: false }"></vue-barcode>
              </p>
              <p class="p-0 w-40  font-bold">STT: {{getbilltests['thinprep_code']}}</p>
            </div>
          </div>
        </div>
        <div class="w-full place-items-center mt-1">
          <div class="text-center font-bold fontsizeTitle font-sans-Timenew col-span-6">
            <span class="underline text-blue-700">PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG</span>
          </div>
        </div>
      </div>
        <!--==============--->
        <div class="font-bold text-blue-800 font-sans-Timenew text-xl underline">THÔNG TIN BỆNH NHÂN</div>
      <div class="relative">
          <div class="absolute -mt-8 flex justify-center w-full opacity-10">
            <img class="w-1/3 -mt-4" :src="pathLogoEuro + eurolab.background_thin" alt="imagesGG">
          </div>
        <div class="grid grid-cols-4 leading-5 fontsizeInfo font-bold">
          <div class="col-span-2  font-sans-Timenew">Họ tên: <span class="font-bold"> {{printCustommers['name']}}</span></div>
          <div class=" text-md font-sans-Timenew">Năm sinh: <span class="font-bold"> {{printCustommers['birthday']}}</span></div>
          <div class=" font-sans-Timenew ">Para: <span class="font-bold"> {{getbilltests['para']}}</span></div>
        </div>
        <div class=" font-sans-Timenew leading-5 font-bold fontsizeInfo">Đia chỉ: <span class="font-bold"> {{printCustommers['address']}}</span></div>
        <div class=" font-sans-Timenew leading-5 fontsizeInfo font-bold">Chẩn đoán lâm sàng: <span class="font-bold"> {{getbilltests['diagnose']}}</span></div>
        <div class="grid grid-cols-3 font-sans-Timenew leading-6 fontsizeInfo font-bold">
          <div class=" col-span-2">Bác sỹ lấy mẫu: <span class="font-bold" > {{getbilltests['doctor_indi']}}</span></div>
          <div class="fontsizeInfo">Ngày lấy mẫu:
            <span class="font-bold">
              {{formatDate(getbilltests['date_receive'])}}
            </span>
          </div>
        </div>
      </div>
          <!--/==============--->
          <!--==============--->
      <div class="text-center font-bold fontsizeKQ underline underline-offset-2 font-sans-Timenew mt-1 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG (BETHESDA 2014)</div>
      <div class="text-left font-bold text-xl  font-sans-Timenew mt-2 text-blue-800">LOAI BỆNH PHẨM <span class="pl-5 text-red-600 mr-0 pr-0">Tế bào học nhúng dịch ThinPrep</span>
        <span class="text-red-600 align-top ml-0 p-0">&reg;</span>
      </div>
      <div class="grid grid-cols-5">
        <div class=" col-span-2  text-left font-bold text-xl  font-sans-Timenew mt-0 text-blue-800">TÍNH CHẤT BỆNH PHẨM </div>
        <div class="col-span-3 flex flex-row" >
          <div class="" v-for="eg11 in testElements" :key="eg11.id">
            <div class="font-bold pr-4" v-if="eg11.element_group ==11">
              <span>
                  <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg11.id" v-model="selectedArray"/>
              </span>
              <span class=" text-middle ml-1  font-sans-Timenew">{{eg11.name}}</span>
            </div>
          </div>
        </div>
      </div>
      <!--/==============--->
      <!--==============--->
      <div class="font-bold text-blue-800 font-sans-Timenew text-xl mt-0">KẾT QUẢ</div>
      <div class="flex flex-wrap">
        <div class="" v-for="(eg12,i) in testElements" :key="i">
          <div class="font-bold pr-4 fontsizeInfo pl-2 leading-5" v-if="eg12.element_group ==12">
            <span>
              <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 leading-5" :value="eg12.id" v-model="selectedArray"/>
            </span>
            <span class=" text-middle ml-1 uppercase text-blue-800  font-sans-Timenew leading-5">{{eg12.name}}</span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 mt-1">
        <div>
          <span class="underline underline-offset-1 font-sans-Timenew font-bold text-xl uppercase text-blue-700">Tế bào do vi sinh</span>
          <div class="fontsizeElement " v-for="eg13 in testElements" :key="eg13.id">
            <span class="flex flex-row font-bold pl-2 fontsizeElement" v-if="eg13.element_group ==13">
              <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 mt-1" :value="eg13.id" v-model="selectedArray"/>
              <span class="text-middle ml-1 italic py-1  font-sans-Timenew leading-3">{{eg13.name}}</span>
            </span>
          </div>
        </div>
        <div class="col-span-2">
          <span class="underline underline-offset-1 font-sans-Timenew font-bold text-xl uppercase text-blue-700">Tế bào Gai</span>
          <div class="fontsizeElement" v-for="eg14 in testElements" :key="eg14.id">
            <span class="flex flex-row font-bold pl-2" v-if="eg14.element_group ==14">
              <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 mt-1" :value="eg14.id" v-model="selectedArray"/>
              <span class="text-middle py-1 ml-1 font-sans-Timenew leading-3">{{eg14.name}}</span>
            </span>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 mt-1">
        <div class="text-xs">
          <span class="underline underline-offset-1 font-sans-Timenew font-bold text-xl uppercase text-blue-700">Biến đổi tế bào khác</span>
          <div class="flex flex-col">
            <div class="fontsizeElement" v-for="eg15 in testElements" :key="eg15.id">
              <span class="flex flex-row font-bold pl-2 align-items-middle" v-if="eg15.element_group ==15">
                <input
                type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 mt-1" :value="eg15.id" v-model="selectedArray"/>
                <span class="align-middle font-sans-Timenew ml-1 py-1 leading-3">{{eg15.name}}</span>
              </span>
            </div>
          </div>
        </div>
        <div class="col-span-2">
          <span class="underline underline-offset-1 font-sans-Timenew font-bold text-xl uppercase text-blue-700">Tế bào tuyến</span>
          <div class="flex flex-col leading-5 fontsizeElement">
            <div class="" v-for="eg16 in testElements" :key="eg16.id">
              <span class="flex flex-row font-bold pl-2" v-if="eg16.element_group ==16">
                <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 mt-1" :value="eg16.id" v-model="selectedArray"/>
                <span class="text-middle font-sans-Timenew ml-1 leading-2">{{eg16.name}}</span>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2 mt-2 mb-2">
        <div  class="text-center flex justify-center">
          <img v-if="getbilltests['thinprep_code']"
                class="w-96 max-h-64 "
                :src="pathThinLeft+imageThinLeft"
                :alt="imageThinLeft"/>
          <img v-else
                class="w-80 max-h-64 "
                :src="pathImageLeft"
                alt="imageThinLeft"/>
        </div>
        <div class="text-center">
          <img  v-if="getbilltests['thinprep_code']"
                class="w-96 max-h-64 "
                :src="pathThinRight+imageThinRight"
                :alt="LogoThin"/>
          <img v-else
              class="w-80 max-h-52 "
              :src="pathImageLeft"
              alt="imageThinLeft"/>
        </div>

      </div>
      <div class="flex justify-between">
        <div class="flex flex-col">
          <div class="grid grid-cols-1">
            <span class="font-bold text-red-800 font-sans-Timenew text-xl underline underline-offset-2">KẾT LUẬN (Conclution):</span>
            <div  v-for="eg9 in testElements" :key="eg9.id">
              <span class="font-bold text-xs w-full mr-3" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                <!-- <span v-if="kl!==null" class="uppercase text-red-800 font-sans-Timenew text-lg pl-2">- {{ketluan}}</span> -->
                <span v-if="ketluan" class="uppercase text-red-800 font-sans-Timenew text-lg pl-2">- {{ketluan}}</span>
                <span v-else >
                  <span class="uppercase text-red-800 font-sans-Timenew text-lg pl-2">- KHÔNG TỔN THƯƠNG TRONG BIỂU MÔ HAY UNG THƯ</span>
                  <p class="  font-sans-Timenew text-lg pl-2">- Tế bào trong giới hạn bình thường</p>
                </span>
              </span>
            </div>
          </div>
          <div class="font-bold text-blue-800 font-sans-Timenew text-lg "><span class="underline underline-offset-2">ĐỀ NGHỊ</span>: {{getbilltests['note']}}</div>
        </div>
        <div class="flex flex-col text-center fontsizeBottom">
          <span class="font-bold font-sans-Timenew ">Ngày đọc kết quả: {{currentDate}}</span>
          <span class=" font-bold font-sans-Timenew ">BÁC SĨ ĐỌC KẾT QUẢ</span>
           <div v-if="getbilltests['asign_hide'] == 1" class="py-10" ></div>
             <div v-else>
            <span class="py-2" v-if="printOutsent.asign_view == 1">
              <span v-if="doctorread">
              <img class="h-14" :src="path_asign +doctorread.asign"/>
              </span>
              <p v-else class="py-10"></p>
            </span>
            <p v-else  class="py-10"></p>
            <span class="font-bold font-sans-Timenew " v-if="doctorread">{{doctorread.title }}<span class="ml-2">{{doctorread.name}}</span></span>
            <span v-else></span>
          </div>
        </div>
      </div>
    </div>
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
    pathLogoEuro:'',
    path_asign:'',
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

<style media="print">
@media print {
  .bodyview111{
  position:relative;
  }
  @page{
     margin: 0.5mm 0.5mm 0.5mm 0.5mm;
  }

  .fontsizeInfo{
    font-size: 14pt;
    line-height: 1.5;
  }
  .fontsizeElement{
    font-size: 12pt;
  }
  .fontsizeTitle{
    font-size: 20pt;
  }
  .fontsizeKQ{
    font-size: 18pt;
  }
  .fontsizeBottom{
    font-size: 16pt;
  }

 .page-footer {
    position:fixed !important;

    bottom: 0;

  }
}

</style>
