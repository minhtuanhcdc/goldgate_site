<template>
<div><h4>Form group 2</h4>
  <div id="printMe" ref="printMe" class="px-0">
    <div class="">
              <div class="flex justify-between py-0">
                    <div class="flex justify-center">
                        <img v-if="getbilltests.ousent.logo"
                            class="w-38 h-24 object-cover"
                            :src="path_logo+getbilltests.ousent.logo"
                              :alt="LogoThin"
                          />
                    </div>
                  <div class="col-span-1 text-left font-sans-Timenew leading-5 fontsizeElement">
                      <span class="p-0 w-40  font-bold">Mã y tế:</span>
                      <p class="-mt-1  flex justify-left">
                        <vue-barcode class="h-8 w-36" :value="getbilltests['thinprep_code']" :options="{ displayValue: false }"></vue-barcode>
                      </p>
                       <p class="p-0 w-40  font-bold pl-2">STT: {{getbilltests['thinprep_code']}}</p>
                  </div>
              </div>
          <div class="g w-full place-items-center -mt-2">
            <div class="text-center font-bold fontsizeKQ underline underline-offset-2 font-sans-Timenew mt-1 text-blue-800 text-xl">PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG</div>
          </div>
    </div>
      <!--==============--->
    <div class="font-bold text-blue-800 font-sans-Timenew text-xl underline">THÔNG TIN BỆNH NHÂN</div>
    <div class="relative">
      <div class="absolute -mt-8 flex justify-center w-full opacity-10">
        <img class="w-1/3 -mt-4" :src="pathLogoEuro + eurolab.background_thin" alt="imagesGG">
      </div>
      <div class="grid grid-cols-4 leading-5 fontsizeInfo font-bold">
        <div class="col-span-2  font-sans-Timenew">Họ tên: <span class="font-bold text-lg"> {{printCustommers['name']}}</span></div>
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
    <div class="text-center font-bold fontsizeKQ underline underline-offset-2 font-sans-Timenew mt-1 text-red-600 text-xl">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG (BETHESDA 2014)</div>
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
              <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 mt-1" :value="eg15.id" v-model="selectedArray"/>
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
        <span v-else></span>
      </div>
      <div class="text-center">
        <img  v-if="getbilltests['thinprep_code']"
              class="w-96 max-h-64 "
              :src="pathThinRight+imageThinRight"
              :alt="LogoThin"/>
        <span v-else></span>
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
                <p class="  font-sans-Timenew text-lg pl-2">- Tế bào cổ tử cung biến đổi do viêm</p>
              </span>
            </span>
          </div>
      </div>
      <div class="font-bold text-blue-800 font-sans-Timenew text-lg underline underline-offset-2">ĐỀ NGHỊ:</div>
    </div>
    <div class="flex flex-col text-center fontsizeBottom">
      <span class="font-bold font-sans-Timenew ">Ngày đọc kết quả: {{currentDate}}</span>
      <span class=" font-bold font-sans-Timenew ">BÁC SĨ ĐỌC KẾT QUẢ</span>
       <div v-if="getbilltests['asign_hide'] == 1" class="py-10"></div>
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

      <span class="font-bold font-sans-Timenew ">KHOA GIẢI PHẨU BỆNH</span>
      <span class="font-bold font-sans-Timenew ">BỆNH VIỆN TỪ DŨ</span>
    </div>
    </div>
    <div class="grid grid-cols-3 -mt-8" >
      <div class="col-span-2">
        <div class="w-full flex flex-col font-bold">
          <span class="font-sans-Timenew text-sm">{{getbilltests.ousent.address}}</span>
          <span class="font-sans-Timenew text-sm">Tel: {{getbilltests.ousent.phone_contact}}* W: {{getbilltests.ousent.website}}</span>
          </div>
      </div>
      <div></div>
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
        pathLogoEuro:'',
        eurolab:'',
        path_asign:'',


    },
    components:{
      BeakerIcon,
      CheckIcon,
      VueBarcode
    },
    data(){
      return{
         path_logo:'/storage/Image_Ousent/',
        pathLogoThin:'/images/Logo/Thinprep.jpg',
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
     margin: 10mm 0.5mm 10mm 0.55mm;
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
