<template>
<div><h4>Form group 3</h4>
    <head>
      <meta charset="utf-8">
    </head>
    <div id="printMe" ref="printMe" class="px-0">
      <div class="flex justify-between mx-0 py-0">
        <div class="flex">
          <div class="">
            <span v-if="printOutsent.logo_view">
              <span v-if="printOutsent.logo">
                <img
                  class="object-contain h-20 w-auto pt -0 mt-0"
                  :src="pathLogo+printOutsent.logo"
                  :alt="printOutsent.logo"
                />
              </span>
              <span v-else></span>
            </span>
            <span v-else ></span>
          </div>
          <div class="flex-1" v-if="printOutsent.address_view">
            <span class="font-bold font-sans-Timenew " v-if="printOutsent.address_view">
              <p class="uppercase text-xl font-bold"> {{printOutsent.name}}</p>
              <span class="leading-5">
                <span class="grid grid-cols-7 flex-row font-sans-Timenew">
                      <!-- <span class="font-bold">Địa chỉ:</span> -->
                    <span class=" col-span-7 font-bold"> {{printOutsent.address}}</span>
                </span>
                <p v-if="printOutsent.phone_contact"><span class="mr-2">Điện thoại:</span>{{printOutsent.phone_contact}}</p>
                <p v-if="printOutsent.website"><span class="mr-2">Website:</span>{{printOutsent.website}}</p>
              </span>
            </span>
              <span class="leading-5 pl-1" v-else>
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
            <p class="-mt-1  flex justify-left">
              <vue-barcode class="h-10 w-36" :value="getbilltests['thinprep_code']" :options="{ displayValue: false }"></vue-barcode>
            </p>
            <p class="p-0 w-40  font-bold">Mã số: {{getbilltests['thinprep_code']}}</p>
          </div>
        </div>
      </div>
        <!--==============--->
      <div class="pt-0 py-0 place-items-center flex flex-col">
          <span class="text-center text-2xl underline uppercase"  style="font-weight:900; font-family:Sán-serif">phiếu xét nghiệm tế bào cổ tử cung</span>
          <div>
            (<span class="text-center font-bold text-2xl font-sans-Timenew ml-0 pl-0">CÔNG NGHỆ ThinPrep</span>
            <span class="align-top ml-0 p-0 text-md font-bold">&reg;</span>)
          </div>
      </div>
        <!--==============--->
      <div class="font-bold text-blue-800 font-sans-Timenew text-xl underline">THÔNG TIN BỆNH NHÂN</div>
      <div class="">
        <div class="grid grid-cols-4 fontsizeInfo font-bold">
            <div class="col-span-2  font-sans-Timenew leading-5">Họ tên: <span class="font-bold left-5"> {{printCustommers['name']}}</span></div>
            <div class=" text-md font-sans-Timenew leading-5">Năm sinh: <span class="font-bold leading-5"> {{printCustommers['birthday']}}</span></div>
            <div class=" font-sans-Timenew leading-5">Para: <span class="font-bold leading-5"> {{getbilltests['para']}}</span></div>
        </div>
        <div class="grid grid-cols-4  fontsizeInfo mt-2">
            <div class="col-span-2 font-bold  font-sans-Timenew leading-5">Địa chỉ: <span class="font-bold"> {{printCustommers['address']}}</span></div>
            <div class=" text-md font-sans-Timenew leading-5">Số ĐT: <span class="font-bold"> {{printCustommers['birthday']}}</span></div>
            <div class=" font-sans-Timenew leading-5">Số HS: <span class="font-bold"> </span></div>
        </div>
        <div class=" font-sans-Timenew leading-5 fontsizeInfo font-bold">Chẩn đoán lâm sàng: <span class="font-bold leading-5"> {{getbilltests['diagnose']}}</span></div>
        <div class="grid grid-cols-3 font-sans-Timenew leading-5 fontsizeInfo font-bold">
              <span class="font-bold leading-5"> Ngày lấy mẫu:
              {{formatDate(getbilltests['date_sent'])}}
              </span>

          <div class=" col-span-2 leading-5">Bác sỹ lấy mẫu: <span class="font-bold" > {{getbilltests['doctor_indi']}}</span></div>
        </div>
      </div>
        <!--/==============--->
          <!--==============--->
      <div class="text-center font-bold fontsizeKQ underline underline-offset-2 font-sans-Timenew mt-1 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG (BETHESDA 2014)</div>
      <div class="relative">
        <div class="absolute  flex justify-center w-full opacity-20">
          <img class="-mt-10 w-3/4" :src="pathLogoEuro + eurolab.background_thin" alt="imagesGG">
        </div>
        <div class="text-left font-bold text-xl  font-sans-Timenew mt-2 text-blue-800">LOAI BỆNH PHẨM <span class="pl-5 text-red-600 mr-0 pr-0">Tế bào học nhúng dịch ThinPrep</span>
        <span class="text-red-600 align-top ml-0 p-0">&reg;</span>
        </div>
        <div class="flex">
          <div class="text-left font-bold text-xl  font-sans-Timenew text-blue-800">TÍNH CHẤT BỆNH PHẨM </div>
          <div class=" ml-2 flex flex-col" >
              <div class="" v-for="eg11 in testElements" :key="eg11.id">
                <div class="font-bold pr-4" v-if="eg11.element_group ==11">
                  <!-- <span v-if="eg11.id == 27">
                    <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="getbilltests.results.map(({result})=> result)[0] !=='27'"/>
                  </span> -->
                  <span>
                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg11.id" v-model="selectedArray"/>
                  </span>
                  <span class=" text-middle ml-1   font-sans-Timenew">{{eg11.name}}</span>
                </div>
              </div>
            </div>
        </div>
        <!--/==============--->
        <!--==============--->
        <div class="font-bold text-blue-800 font-sans-Timenew text-xl mt-0">KẾT QUẢ</div>
            <div class="flex flex-wrap">
              <div class="" v-for="(eg12,i) in testElements" :key="i">
                    <div class="font-bold pr-4  -mt-2" v-if="eg12.element_group ==12">
                            <span class="ml-2">
                              <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 leading-5" :value="eg12.id" v-model="selectedArray"/>
                            </span>
                            <span class=" text-middle ml-1 uppercase text-blue-800 font-sans-Timenew text-lg  font-bold">{{eg12.name}}</span>
                    </div>
                </div>
        </div>

        <div class="grid grid-cols-3 mt-1">
            <div>
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-xl uppercase text-blue-700">Tế bào do vi sinh</span>
              <div class="fontsizeElement " v-for="eg13 in testElements" :key="eg13.id">
                      <span class="flex flex-row font-bold mt-1 pl-2 fontsizeElement" v-if="eg13.element_group ==13">
                          <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 mt-1" :value="eg13.id" v-model="selectedArray"/>
                          <span class="text-middle ml-1 italic py-1  font-bold leading-3 text-lg">{{eg13.name}}</span>
                      </span>
              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-xl uppercase text-blue-700">Tế bào Gai</span>
              <div class="fontsizeElement" v-for="eg14 in testElements" :key="eg14.id">
                      <span class="flex flex-row font-bold mt-1 pl-2" v-if="eg14.element_group ==14">
                          <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 mt-1" :value="eg14.id" v-model="selectedArray"/>
                            <span class="text-middle py-1 ml-1 font-bold leading-3 text-lg">{{eg14.name}}</span>
                      </span>
              </div>
            </div>
        </div>
        <div class="grid grid-cols-3 mt-1">
            <div class="text-xs">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-xl uppercase text-blue-700">Biến đổi tế bào khác</span>
              <div class="flex flex-col">
              <div class="fontsizeElement" v-for="eg15 in testElements" :key="eg15.id">
                      <span class="flex flex-row font-bold pl-2 mt-1 align-items-middle" v-if="eg15.element_group ==15">
                          <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 mt-1" :value="eg15.id" v-model="selectedArray"/>
                            <span class="align-middle font-bold ml-1 py-1 leading-3 text-lg">{{eg15.name}}</span>
                      </span>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-xl uppercase text-blue-700">Tế bào tuyến</span>
              <div class="flex flex-col leading-5 fontsizeElement">
                <div class="" v-for="eg16 in testElements" :key="eg16.id">
                        <span class="flex flex-row font-bold pl-2 align-items-middle mt-1" v-if="eg16.element_group ==16">
                          <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3 mt-1" :value="eg16.id" v-model="selectedArray"/>
                            <span class="align-middle font-bold ml-1 py-1 leading-3 text-lg">{{eg16.name}}</span>
                      </span>
                </div>
              </div>
            </div>
        </div>

        <div class="grid grid-cols-2 mt-2 mb-2">
            <div  class="text-center flex justify-center">
                <img v-if="getbilltests['thinprep_code']"
                      class="w-96 max-h-68 "
                      :src="pathThinLeft+imageThinLeft"
                      :alt="imageThinLeft"/>
                  <span v-else></span>
                </div>
            <div class="text-center">
                <img  v-if="getbilltests['thinprep_code']"
                      class="w-96 max-h-68 "
                      :src="pathThinRight+imageThinRight"
                      :alt="LogoThin"/>
                <span v-else></span>
              </div>

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
                      <span class="font-bold  font-sans-Timenew text-xl pl-2">Biến đổi tế bào phản ứng do viêm</span>
                      </span>
                  </span>
              </div>
          </div>
          <div class="font-bold text-blue-800 font-sans-Timenew text-lg "><span class="underline underline-offset-2">ĐỀ NGHỊ: </span>{{getbilltests['note']}}</div>
          <p class="font-bold mt-4">Ngày nhận mẫu:  {{formatDate(getbilltests['date_receive'])}}</p>
        </div>
        <div class="flex flex-col text-center fontsizeBottom">
          <span class="font-bold font-sans-Timenew ">Ngày đọc kết quả: {{currentDate}}</span>
          <span class=" font-bold font-sans-Timenew " style="margin-bottom:2px">Bác sĩ đọc kết quả</span>
          <div v-if="getbilltests['diagnose']"></div>
          <div v-else>
            <span class="py-2 flex justify-center" v-if="printOutsent.asign_view">
              <img :src="path_asign +doctorread.asign"/>
            </span>
            <span class="py-10" v-else></span>
            <span class="font-bold font-sans-Timenew ">{{doctorread.title }}<span class="ml-2">{{doctorread.name}}</span></span>
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
    //pathLogo:'',
    pathLogo:'',
    imageGGSqure:'',
    imagePathBackground:'',
    eurolab:'',
    pathLogoEuro:'',
    path_asign:''
  },
  components:{
    BeakerIcon,
    CheckIcon,
    VueBarcode
  },
  data(){
    return{
      //   path_logo:'/storage/Image_Ousent/',
      //   path_asign:'/storage/Image_Ouread/',
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
<!--
<style media="print">
@media print {
  .bodyview111{
  position:relative;
  }
  .page_leading{
    line-height:0.5pt;
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
-->
