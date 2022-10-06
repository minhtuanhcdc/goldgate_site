<template>
<!-- <div>{{getbilltests}}</div> -->
    <div class="m-0 p-0  w-full relative" v-for="(td,i) in getbilltests" :key="i">
          <div>
            <div class="col-span-2 py-0">
                  <img
                    class="max-h-24 w-full"
                    :src="pathImageTop"
                    :alt="LogoThin"
                  />
              </div>
          </div>
          <div class="grid grid-cols-8 mx-0 py-0">
                    <div class="col-span-6">
                      <div class="text-center pl-40">
                          <div class="font-bold text-lg font-sans-Timenew">PHIẾU XÉT NGHIỆM TẾ BÀO</div>
                          <span class="font-bold text-md font-sans-Timenew">PAP'S SMEAR - ThinPrep</span>
                      </div>
                    </div>
                    <div class="w-full col-span-2">
                      <div class="flex flex-col items-center justify-center">
                       <p class="-mt-1  flex justify-center">
                            <vue-barcode class="h-8 w-36" :value="td.thinprep_code" :options="{ displayValue: false }"></vue-barcode>
                        </p>
                      <span class="text-xs font-sans-Timenew font-bold -mt-1 w-full text-center">Số(No): {{td['thinprep_code']}}</span>
                      </div>
                  </div>
          </div>
      <!--==============--->
   <div class=" w-full">
    <div class="relative">
      <div class="absolute mt-4 flex justify-center w-full opacity-10">
            <img class="w-1/3 -mt-4" :src="pathLogoEurolab + eurolab.background_thin" alt="imagesGG">
          </div>
            <div class="grid grid-cols-4 leading-5 text-xs font-bold">
                <div class="col-span-2 font-sans-Timenew italic">Họ và tên (Name):<span class="ml-2 font-bold text-sm">{{td.custommer.name}}</span></div>
                <div class="  font-sans-Timenew italic">Tuổi (Age):<span class="pl-2 font-bold text-sm">{{td.custommer.birthday}}</span></div>
                <div class="  font-sans-Timenew italic">Para: <span class="pl-2 font-bold text-sm">{{td.para}}</span></div>
            </div>
            <div class="grid grid-cols-4 text-xs font-bold">
                <div class="col-span-3 font-sans-Timenew leading-5 italic">Đia chỉ(Address):<span class="pl-2 fontsizeName">{{td.custommer.address}}</span></div>
                <div class=" font-sans-Timenew leading-5 italic">Số điện thoại:<span class="pl-2 font-bold">{{td.custommer.phone}}</span></div>
            </div>

            <div class="font-sans-Timenew leading-5 italic text-xs font-bold">Đơn vị gửi(Custommer):<span class="pl-2 font-bold text-sm fontsizeName" >{{td.ousent.name}} </span></div>
            <div class="grid grid-cols-4 font-sans-Timenew leading-5 italic text-xs font-bold">
                <div class="">IUD (Intra-Uterine Devices) <i class="fa fa-square-o mt-2"></i></div>
                <div class=" text-center">Nội tiết (Hormone) <i class="fa fa-square-o mt-2"></i></div>
                <div class=" text-center">Xạ (Radiation) <i class="fa fa-square-o mt-2"></i></div>
                <div class=" text-center">Có thai (Pregnancy) <i class="fa fa-square-o mt-2"></i></div>
            </div>

            <div class="grid grid-cols-2 italic text-xs font-bold">
                <div class="font-sans-Timenew leading-5">Kinh chót(Last Menstrual Period):<span class="font-bold pl-2">{{td.kinhchot}}</span></div>
                <div class="text-center font-sans-Timenew leading-5">Ngày gửi (Date sent):<span class="font-bold text-sm">{{formatDate(td.date_receive)}}</span></div>
            </div>
              <div class="grid grid-cols-2 italic text-xs font-bold">
                <div class="font-sans-Timenew leading-5">Chẩn đoán lâm sàng(Clinical diagnose):<span class="font-bold pl-2 text-sm">{{td.diagnose}}</span></div>
                <div class="font-sans-Timenew leading-5">Bs. Chỉ định(Physician):<span class="font-bold pl-2 text-sm"> {{td.doctor_indi}}</span></div>
            </div>
    </div>
        <div>
              <div class="text-center font-bold text-md font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>

              <div class="grid grid-cols-5 font-sans-Timenew leading-6">
                <div class="font-bold italic col-span-2 text-sm">Đánh giá lam (Specimen evalueation)</div>
                  <div class="col-span-3 grid grid-cols-2 text-sm" >
                     <div class="" v-for="eg1 in testElements" :key="eg1.id">
                      <div class="font-bold fontsizeElement italic" v-if="eg1.element_group == 1"><span class="mr-1">{{eg1.name}}</span>
                          <span>
                            <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg1.id === x) !== -1" />
                          </span>
                      </div>
                    </div>
                  </div>
              </div>
               <div class="grid grid-cols-1 text-sm mt-0">
                    <div class="" v-for="eg2 in testElements" :key="eg2.id">
                      <div class="text-left font-bold text-sm  font-sans-Timenew text-blue-900" v-if="eg2.element_group ==2">{{eg2.name}}
                            <span >
                               <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg2.id === x) !== -1" />
                            </span>
                        </div>
                    </div>
                </div>
            <div class="flex flex-cols-5">
                <div class="" v-for="eg3 in testElements" :key="eg3.id">
                    <span class="text-left font-bold text-xs  font-sans-Timenew mr-3 " v-if="eg3.element_group == 3">+ {{eg3.name}}
                            <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg3.id === x) !== -1" />
                    </span>
                </div>
            </div>
             <div class="grid grid-cols-1">
                <div class="" v-for="eg4 in testElements" :key="eg4.id">
                    <span class="text-left text-sm  font-sans-Timenew text-blue-900" v-if="eg4.element_group == 4">- {{eg4.name}}
                    <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg4.id === x) !== -1" />
                    </span>
                </div>
            </div>

              <div class="col-span-2">
                    <span class=" font-sans-Timenew font-bold text-sm  text-blue-700">TẾ BÀO GAI (Squamuos cell)</span>
                    <div class="grid grid-cols-2 leading-5 italic">
                      <div class="flex flex-col">
                         <div v-for="(eg5, i) in testElements" :key="i">
                            <span class="ml-2 text-left  text-xs  font-sans-Timenew " v-if="eg5.element_group == 5">* <span>{{eg5.name}}</span>
                               <input type="checkbox" disabled class="form-checkbox text-blue-800 h-2 w-2" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg5.id === x) !== -1" />
                          </span>
                      </div>
                      </div>
                      <div class="flex flex-col">
                        <div class="" v-for="(eg6, i) in testElements" :key="i">
                          <span class="pl-2 text-left text-xs  font-sans-Timenew " v-if="eg6.element_group == 6">{{eg6.name}}
                                  <input type="checkbox" disabled class="form-checkbox text-blue-800 h-2 w-2" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg6.id === x) !== -1" />
                            </span>
                        </div>
                      </div>

                    </div>
                </div>
              <div class="grid grid-cols-1 mt-2">
                  <div>
                    <span class=" font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Tuyến</span>
                    <div class="flex flex-row leading-4 mt-0 pl-4">
                       <div v-for="eg7 in testElements" :key="eg7.id">
                         <div v-if="eg7.element_group == 7">
                          <span class="text-left font-bold text-xs  font-sans-Timenew mr-4" > <span class="mr-1">* {{eg7.name}}</span>
                                <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg7.id === x) !== -1" />
                            </span>
                          </div>
                  </div>
                    </div>
                  </div>
              </div>

              <div class=" font-sans-Timenew leading-4 italic mt-2">
                <div class="font-bold m-0 p-0">Đề nghị (Suggestions):</div>
                <div class="font-bold ">
                  <div class=" leading-4 flex pl-2">
                   <div  v-for="eg8 in testElements" :key="eg8.id">
                      <span class="font-bold text-xs w-full mr-2 fontsizeElement2" v-if="eg8.element_group ==8 && eg8.element_group !==null ">{{eg8.name}}
                             <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg8.id === x) !== -1" />
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
                        <div class="text-center flex justify-center">
                            <img
                              class="w-72 max-h-48 "
                              :src="pathThinRight+td.imageleft.thinRight"
                              :alt="LogoThin"/>
                        </div>
                </div>
              <div class="grid grid-cols-3">
                <div class="col-span-2">
                  <div class="grid grid-cols-1">
                      <span class="font-bold text-red-800 font-sans-Timenew text-sm underline underline-offset-2">KẾT LUẬN (Conclution):</span>
                        <div  v-for="eg9 in testElements" :key="eg9.id">
                            <span class="font-bold text-xs w-full mr-2" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                                  <span class="" style="line-heigh:30%">
                                    <span class=" font-sans-Timenew text-lg pl-2 m-0 fontsizeName" v-if="td.results.find((result) => result.element_id === '26')">
                                      <span v-if="td.results.find((result) => result.element_id === '26').result !== null">
                                          {{td.results.find((result) => result.element_id === "26").result}}
                                      </span>
                                    <span v-else>
                                      <span class="uppercase text-red-800 font-sans-Timenew text-sm pl-2 m-0 fontsizeName">- Không tổn thương trong biểu mô hay ung thư</span>
                                        <p class="pl-2 font-sans-Timenew text-lg leading-5 fontsizeName">- Tế bào cổ tử cung biến đổi do viêm</p>
                                      </span>
                                          </span>
                                  <span v-else>
                                      <span class="uppercase text-red-800 font-sans-Timenew text-sm pl-2 m-0 fontsizeName">- Không tổn thương trong biểu mô hay ung thư</span>
                                      <p class="pl-2 font-sans-Timenew text-lg leading-5 fontsizeName">-Tế bào cổ tử cung biến đổi do viêm</p>
                                  </span>
                                  </span>
                              </span>
                        </div>
                  </div>
                </div>
                <div class="grid grid-cols-1 text-center">
                  <span class="font-bold font-sans-Timenew text-xs">Ngày đọc kết quả: {{currentDate}}</span>
                  <span class="mb-16 font-bold font-sans-Timenew text-sm">BS/KTV đọc kết quả:</span>
                   <span class="font-bold font-sans-Timenew fontsizeName" v-if="td.doctorread">{{td.doctorread.title}}<span class="ml-1 uppercase fontsizeName"> {{td.doctorread.name}}</span></span>
                  <span class="font-bold font-sans-Timenew fontsizeName">KHOA GIẢI PHẨU BỆNH</span>
                  <span class="font-bold font-sans-Timenew fontsizeName">BỆNH VIỆN TỪ DŨ</span>
                </div>
              </div>
        </div>
      </div>
       <div class="py-0 mb-0 absolute page-footer" style="">
            <img
              class="max-h-12 w-full"
              :src="pathImageFooter"
              :alt="LogoThin"
              />
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
        selectedArray:'',
        testElements:'',
        pathImageLeft:"",
        pathThinLeft:'',
        pathThinRight:'',
        imageThinLeft:'',
        ketluan:'',
        currentDate:'',
        pathLogoEurolab:'',
        eurolab:'',

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

