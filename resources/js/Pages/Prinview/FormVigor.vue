<template>
<div><h4>Form group 4</h4>
<!-- <div>{{getbilltests}}</div> -->
    <div class="relative" id="printMe" ref="printMe">
      <div class="bodyview">
          <div>
            <div class="col-span-2 py-0">
                  <img
                    class="max-h-24 w-full"
                    :src="pathImageTop"
                    :alt="LogoThin"
                  />
              </div>
          </div>
          <div class="grid grid-cols-9 justify-center">
              <div class="font-bold font-sans-Timenew w-full text-right col-span-6 fontsizeTitle">
                <span class="">PHIẾU XÉT NGHIỆM TẾ BÀO</span>
                <p class="leading-5 pr-10">PAP'S SMEAR - ThinPrep</p>
              </div>
              <div class="font-bold  font-sans-Timenew w-ful text-center col-span-3 text-sm">
                  <p class="text-center flex justify-center">
                    <vue-barcode class="h-8 w-36 text-center" :value="getbilltests['thinprep_code']" :options="{ displayValue: false }"></vue-barcode>
                  </p>
                  <span class=" font-sans-Timenew font-bold ml-5 -mt-1 text-center">Số(Number): {{getbilltests['thinprep_code']}}</span>
              </div>
          </div>

      <!--==============--->
      <div>
        <div class="relative">
          <div class="absolute -mt-8 flex justify-center w-full opacity-10">
          <img class="w-1/3 -mt-4" :src="pathLogoEuro+ eurolab.background_thin" alt="imagesGG">
        </div>
            <div class="grid grid-cols-4 leading-6 text-xl font-bold mt-2 fontsizeInfo">
                <div class="col-span-2 font-sans-Timenew italic">Họ và tên (Name):<span class="ml-2 font-bold">{{printCustommers['name']}}</span></div>
                <div class="  font-sans-Timenew italic">Tuổi (Age):<span class="pl-2 font-bold">{{printCustommers['birthday']}}</span></div>
                <div class="  font-sans-Timenew italic">Para: <span class="pl-2 font-bold">{{getbilltests['para']}}</span></div>
            </div>
            <div class="grid grid-cols-4 text-xl leading-8 font-bold fontsizeInfo">
                <div class="col-span-3 font-sans-Timenew  italic">Đia chỉ(Address):<span class="pl-2 font-bold">{{printCustommers['address']}}</span></div>
                <div class=" font-sans-Timenew  italic">Số điện thoại:<span class="pl-2 font-bold">{{printCustommers['phone']}}</span></div>
            </div>

            <div class="font-sans-Timenew leading-6 italic text-xl font-bold fontsizeInfo">Đơn vị gửi(Custommer):<span class="pl-2 font-bold" v-if="printOutsent">{{printOutsent['name']}} </span></div>
            <div class="grid grid-cols-4 font-sans-Timenew leading-8 italic text-lg">
                <div class="font-bold">IUD (Intra-Uterine Devices)  <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="getbilltests['intra']" ></div>
                <div class="font-bold text-center">Nội tiết (Hormone) <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="getbilltests['hormone']"  ></div>
                <div class="font-bold text-center">Xạ (Radiation) <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3"  :checked="getbilltests['radiation']" ></div>
                <div class="font-bold text-center">Có thai (Pregnancy) <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="getbilltests['preg']"  ></div>
            </div>

            <div class="grid grid-cols-2 italic text-xl leading-6 font-bold ">
                <div class="font-sans-Timenew ">Kinh chót(Last Menstrual Period):<span class="font-bold pl-2">{{getbilltests['kinhchot']}}</span></div>
                <div class="text-center font-sans-Timenew ">Ngày gửi (Date sent):<span class="font-bold">{{formatDate(getbilltests['date_sent'])}}</span></div>
            </div>
              <div class="grid grid-cols-2 italic text-xl leading-6 font-bold fontsizeInfo">
                <div class="font-sans-Timenew ">Chẩn đoán lâm sàng(Clinical diagnose):<span class="font-bold pl-2">{{getbilltests['diagnose']}}</span></div>
                <div class="font-sans-Timenew ">Bs. Chỉ định(Physician):<span class="font-bold pl-2"> {{getbilltests['doctor_indi']}}</span></div>
            </div>
        </div>
        <div>
              <div class="text-center font-bold text-2xl font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>

              <div class="grid grid-cols-5 font-sans-Timenew leading-6 fontsizeInfo">
                <div class="font-bold italic col-span-2">Đánh giá lam (Specimen evalueation)</div>
                  <div class="col-span-3 grid grid-cols-2" >

                     <div class="" v-for="eg1 in testElements" :key="eg1.id">
                      <div class="font-bold flex" v-if="eg1.element_group ==1">{{eg1.name}}

                        <span>
                          <input type="checkbox" checked  class="ml-1 my-2 form-checkbox h-4 w-4" :value="eg1.id" v-model="selectedArray"/>
                        </span>
                      </div>
                    </div>
            </div>
              </div>
               <div class="grid grid-cols-1 font-sans-Timenew fontsizeInfo">
                    <div class="text-xl" v-for="eg2 in testElements" :key="eg2.id">
                       <div class="font-bold flex text-blue-900" v-if="eg2.element_group ==2"> - {{eg2.name}}

                        <span>
                           <input type="checkbox" disabled class="form-checkbox text-blue-800 h-4 w-4" :value="eg2.id" v-model="selectedArray"/>
                        </span>

                      </div>
                    </div>
                </div>
            <div class="flex flex-cols-5 fontsizeInfo">
                <div class="" v-for="eg3 in testElements" :key="eg3.id">
                    <span class="text-left font-bold text-sm  font-sans-Timenew mr-5 " v-if="eg3.element_group == 3">+ {{eg3.name}}
                            <input type="checkbox" disabled  class="ml-1 my-2 form-checkbox text-blue-800 h-3 w-3" :value="eg3.id" v-model="selectedArray"/>
                    </span>
                </div>
            </div>
             <div class="grid grid-cols-1">
                <div class="" v-for="eg4 in testElements" :key="eg4.id">
                    <span class="text-left font-bold text-lg  font-sans-Timenew text-blue-900" v-if="eg4.element_group == 4">- {{eg4.name}}
                   <input type="checkbox" class="ml-1 my-2 form-checkbox text-blue-800 h-4 w-4" :value="eg4.id" v-model="selectedArray"/>
                    </span>
                </div>
            </div>

              <div class="col-span-2">
                    <span class=" font-sans-Timenew font-bold text-xl  text-blue-700">TẾ BÀO GAI (Squamuos cell)</span>
                    <div class="grid grid-cols-2 leading-4 italic fontsizeElement">
                      <div class="flex flex-col">
                         <div v-for="(eg5, i) in testElements" :key="i">
                            <span class="ml-2 text-left font-bold text-sm  font-sans-Timenew " v-if="eg5.element_group == 5"> {{eg5.name}}
                              <input type="checkbox" class="ml-1 my-2 form-checkbox text-blue-800 h-4 w-4" :value="eg5.id" v-model="selectedArray"/>
                        </span>
                  </div>
                      </div>
                      <div class="flex flex-col">
                        <div class="" v-for="(eg6, i) in testElements" :key="i">
                          <span class="pl-2 text-left font-bold text-sm  font-sans-Timenew " v-if="eg6.element_group == 6">{{eg6.name}}
                                 <input type="checkbox" class="ml-1 my-2 form-checkbox text-blue-800 h-4 w-4" :value="eg6.id" v-model="selectedArray"/>
                            </span>
                        </div>
                      </div>

                    </div>
                </div>

              <div class="grid grid-cols-1 mt-2">
                  <div>
                    <span class=" font-sans-Timenew font-bold text-xl uppercase text-blue-700">Tế bào Tuyến</span>
                    <div class="flex flex-row leading-5 fontsizeElement">
                       <div v-for="eg7 in testElements" :key="eg7.id">
                         <div v-if="eg7.element_group == 7">
                          <span class="text-left font-bold text-sm ml-4 mr-6  font-sans-Timenew" >{{eg7.name}}
                               <input type="checkbox" class="ml-1 my-2 form-checkbox text-blue-800 h-4 w-4" :value="eg7.id" v-model="selectedArray"/>
                            </span>
                          </div>
                  </div>
                    </div>
                  </div>
              </div>
              <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic mt-2">
                <div class="font-bold m-0 p-0 text-xl">Đề nghị (Suggestions):</div>
                <div class="font-bold col-span-3">
                  <div class="flex">
                   <div  v-for="eg8 in testElements" :key="eg8.id">
                      <span class="font-bold text-sm w-full mr-3" v-if="eg8.element_group ==8 && eg8.element_group !==null ">{{eg8.name}}
                             <input type="checkbox" class="ml-1 my-2 form-checkbox text-blue-800 h-4 w-3" :value="eg8.id" v-model="selectedArray"/>
                      </span>
                    </div>
                    </div>
                </div>
              </div>
                <div class="grid grid-cols-2 mt-2 text-center">
                                <div  class="text-center flex justify-center">
                                   <img v-if="getbilltests['thinprep_code']"
                                      class="w-96 max-h-64 "
                                      :src="pathThinLeft+imageThinLeft"
                                      :alt="imageThinLeft"/>

                                   <img v-else
                                      class="w-80 max-h-56 "
                                      :src="pathImageLeft"
                                      alt="imageThinLeft"/>
                                  </div>
                                <div class="text-center flex justify-center">
                                  <img  v-if="getbilltests['thinprep_code']"
                                      class="w-96 max-h-64 "
                                      :src="pathThinRight+imageThinRight"
                                      :alt="LogoThin"/>
                                  <img v-else
                                      class="w-80 max-h-56 "
                                      :src="pathImageLeft"
                                      alt="imageThinLeft"/>
                                </div>
                  </div>
              <div class="grid grid-cols-3">
                <div class="col-span-2">
                  <div class="grid grid-cols-1">
                      <span class="font-bold text-red-800 font-sans-Timenew text-xl underline underline-offset-2">KẾT LUẬN (Conclution):</span>
                        <div  v-for="eg9 in testElements" :key="eg9.id" class="text-lg">
                            <div class="font-bold  w-full mr-3" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                              <span v-if="ketluan" class="uppercase text-red-800 font-sans-Timenew pl-2" >- {{ketluan}}</span>
                              <span v-else  >
                                 <span class="uppercase text-red-800 font-sans-Timenew  pl-2">- KHÔNG TỔN THƯƠNG TRONG BIỂU MÔ HAY UNG THƯ</span>
                                  <p class="font-sans-Timenew  ml-2">-Tế bào cổ tử cung biến đổi do viêm</p>
                              </span>
                            </div>
                        </div>
                  </div>
                </div>
                <div class="grid grid-cols-1 text-center text-xl">
                  <span class="font-bold font-sans-Timenew ">Ngày đọc kết quả: {{currentDate}}</span>
                  <span class="mb-28 font-bold font-sans-Timenew ">BS/KTV đọc kết quả:</span>
                  <span class="font-bold font-sans-Timenew "  v-if="doctorread && getbilltests['asign_view']!=1">{{doctorread.title }} <span class="uppercase">{{doctorread.name}}</span></span>
                  <span class="font-bold font-sans-Timenew ">KHOA GIẢI PHẨU BỆNH</span>
                  <span class="font-bold font-sans-Timenew ">BỆNH VIỆN TỪ DŨ</span>
                </div>
              </div>
        </div>
      </div>
      </div>
       <div class=" flex justify-center py-0 footer" >
         <img
              class="max-h-18 w-full"
              :src="pathImageFooter"
              :alt="LogoThin"
            />
        </div>
    </div>
    <div class="page-break"></div>
    </div>
</template>

<script>
import { BeakerIcon } from '@heroicons/vue/solid'
import { CheckIcon } from '@heroicons/vue/solid'
import VueBarcode from '@chenfengyuan/vue-barcode';
import moment from 'moment';

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
        pathLogo:'',
        imagePathBackground:'',
        pathLogoEuro:'',
        eurolab:''
    },
    components:{
      BeakerIcon,
      CheckIcon,
      VueBarcode
    },
    data(){
      return{
        pathImageTop:'/images/Logo/vigor.jpg',
        pathImageFooter:'/images/Logo/vigorFooter.jpg',
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

