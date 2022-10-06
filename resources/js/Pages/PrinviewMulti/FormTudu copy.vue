<template>

 <div class="m-0 p-0" v-for="(td,i) in getbilltests" :key="i">
    <div class="" >
                      <div class="flex justify-between mx-0 py-0">
                          <div class="py-0">
                              <img
                                class="h-32"
                                 :src="pathLogo + td.ousent.logo"
                                :alt="LogoThin"
                              />

                          </div>
                          <div class="text-center text-italy fontsizeElement font-bold font-sans-Timenew">
                                <span class="">Mã số:{{getbilltests['thinprep_code']}}</span>
                                 <p class="-mt-1  flex justify-center">
                                  <vue-barcode class="h-8 w-36" :value="getbilltests['thinprep_code']" :options="{ displayValue: false }"></vue-barcode>
                                </p>
                          </div>

                      </div>
                      <div class=" text-center -mt-4 mb-2">
                              <div class="pt-0 py-0 place-items-center flex flex-col">
                                    <span class="text-center font-bold fontsizeTitle font-sans-Timenew text-blue-800">PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG</span>
                                </div>
                          </div>
                        <div class="grid grid-cols-4 leading-8 fontsizeInfo font-bold">
                              <div class="col-span-2 font-sans-Timenew italic">Họ và tên (Name):<span class=" font-bold infoText">{{printCustommers['name']}}</span></div>
                              <div class="  font-sans-Timenew italic">Tuổi (Age):<span class="pl-2 font-bold infoText">{{printCustommers['birthday']}}</span></div>
                              <div class="  font-sans-Timenew italic">Para: <span class="pl-2 font-bold">{{getbilltests['para']}}</span></div>
                          </div>
                          <div class="grid grid-cols-4 fontsizeInfo font-bold">
                              <div class="col-span-3 font-sans-Timenew leading-8 italic fontsizeInfo">Đia chỉ(Address):<span class="pl-2 font-bold">{{printCustommers['address']}}</span></div>
                              <div class=" font-sans-Timenew leading-8 italic fontsizeInfo">Số điện thoại:<span class="pl-2 font-bold">{{printCustommers['phone']}}</span></div>
                          </div>
                          <div class="font-sans-Timenew leading-8 italic fontsizeInfo font-bold">Khoa/Phòng:<span class="pl-2 font-bold">{{getbilltests['department']}} </span></div>

                          <div class="grid grid-cols-2 italic fontsizeInfo font-bold">
                            <div class="font-sans-Timenew leading-8">Chẩn đoán lâm sàng:<span class="font-bold pl-2">{{getbilltests['diagnose']}}</span></div>

                          </div>
                            <div class="grid grid-cols-2 italic fontsizeInfo">
                                <div class=" font-sans-Timenew font-bold leading-8">Ngày lấy mẫu:<span class="font-bold">{{formatDate(getbilltests['date_receive'])}}</span></div>
                              <div class="font-sans-Timenew leading-8 font-bold">Bác sỹ lấy mẫu:<span class="font-bold pl-2 infoText"> {{getbilltests['doctor_indi']}}</span></div>
                          </div>

                      <div>
                            <div class="text-center font-bold fontsizeKQ font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG (BETHESDA 2014)</div>
                         <div class="text-left font-bold fontsizeInfo  font-sans-Timenew mt-2 text-blue-800">LOAI BỆNH PHẨM
                          <span class="pl-5 text-blue-600 mr-0 pr-0 fontsizeInfo">Tế bào học nhúng dịch ThinPrep</span><span class="text-blue-600 align-top ml-0 p-0">&reg;</span></div>
                  <div class="grid grid-cols-5 mt-2 fontsizeInfo">
                            <div class=" col-span-2  text-left font-bold  font-sans-Timenew mt-0 text-blue-800">TÍNH CHẤT BỆNH PHẨM </div>
                            <div class="col-span-3 flex flex-row" >
                                <div class="" v-for="eg11 in testElements" :key="eg11.id">
                                  <div class="font-bold pr-8" v-if="eg11.element_group ==11">
                                    <span v-if="eg11.id == 27">
                                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="getbilltests.results.map(({result})=> result)[0] !=='27'"/>
                                    </span>
                                    <span v-else>
                                        <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg11.id" v-model="selectedArray"/>
                                    </span>
                                    <span class=" text-middle ml-1  font-sans-Timenew">{{eg11.name}}</span>
                                  </div>
                                </div>
                              </div>
                    </div>
                            <div class="grid grid-cols-2 mt-2 text-center">
                                <div  class="flex justify-center text-center">
                                  <img v-if="getbilltests['thinprep_code'] === imageThinLeft.slice(0,-4)"
                                      class="w-96 max-h-80 "
                                      :src="pathThinLeft+imageThinLeft"
                                      :alt="imageThinLeft"/>

                                   <img v-else
                                      class="w-80 max-h-52 "
                                      :src="pathImageLeft"
                                      alt="imageThinLeft"/>

                                  </div>
                                <div class="flex justify-center text-center">
                                  <img  v-if="getbilltests['thinprep_code'] === imageThinRight.slice(0,-5)"
                                      class="w-96 max-h-80 "
                                      :src="pathThinRight+imageThinRight"
                                      :alt="LogoThin"/>
                                  <img v-else
                                      class="w-80 max-h-72 "
                                      :src="pathImageLeft"
                                      alt="imageThinLeft"/>
                                  </div>
                            </div>
                            <div class="grid grid-cols-3 mt-2">
                              <div class="col-span-2">
                                <div class="grid grid-cols-1">
                                  <span class="font-bold text-blue-800 font-sans-Timenew text-lg underline underline-offset-2">KẾT LUẬN:</span>
                                 <div  v-for="eg9 in testElements" :key="eg9.id">
                                   <span class="font-bold fontsizeInfo w-full mr-3" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                                        <span v-if="ketluan" class="uppercase text-red-800 font-sans-Timenew text-lg pl-2">- {{ketluan}}</span>
                                        <span v-else >
                                          <span class="uppercase text-red-800 font-sans-Timenew  pl-2">- KHÔNG TỔN THƯƠNG TRONG BIỂU MÔ HAY UNG THƯ</span>
                                          <p class="  font-sans-Timenew  pl-2">- Tế bào cổ tử cung biến đổi do viêm</p>
                                        </span>
                                    </span>
                                  </div>
                                </div>
                          <div class="font-bold text-blue-800 font-sans-Timenew text-lg underline underline-offset-2">ĐỀ NGHỊ:</div>
                            <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic mt-0">
                            </div>
                              </div>
                              <div class="grid grid-cols-1 text-center fontsizeBottom">
                                <span class="font-bold font-sans-Timenew ">Ngày đọc kết quả: {{currentDate}}</span>
                                <span class="mb-16 font-bold font-sans-Timenew " style="margin-bottom:100px">BS/KTV đọc kết quả:</span>
                                <span class="font-bold font-sans-Timenew" v-if="doctorread">{{doctorread.title }}<span class="ml-2">{{doctorread.name}}</span></span>

                              </div>
                            </div>
                        </div>
    </div>
    <div class="page-break"></div>
  </div>

</template>

<script>
import { CheckIcon } from '@heroicons/vue/solid'
import moment from 'moment'
export default {
    props:{
        getbilltests:Object,
        printCustommers:Object,
        printAddress:'',
        printOutsent:'',
        printDoctor:'',
        selectedArray:'',
        testElements:'',
        ImageThin:"",
        pathThinLeft:'',
        pathThinRight:'',
        imageThinLeft:'',
        ketluan:'',
        currentDate:'',
    },
    components:{
      CheckIcon
    },
    data(){
      return{
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