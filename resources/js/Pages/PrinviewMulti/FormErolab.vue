<template>

 <div class="m-0 p-0" v-for="(td,i) in getbilltests" :key="i">

    <div>
        <div class="grid grid-cols-8 mx-0 py-0">
                          <div class="col-span-2 py-0">
                            <div class="flex justify-center">
                              <span v-if="td.ousent.logo" class="">
                              <img
                                class="w-48"
                                :src="pathLogo + td.ousent.logo"
                                :alt="pathLogo"
                              />
                              </span>
                              <span v-else></span>

                            </div>
                          </div>
                          <div class="col-span-4">
                              <div class="pt-0 py-0 flex flex-col pl-2">
                                    <span class="font-bold text-lg font-sans-Timenew fontsizeName leading-5">{{eurolab.name}}</span>
                                    <div class="my-0 py-0">
                                      <div class=" text-sm font-sans-Timenew ml-0 pl-0 flex fontsizeElement leading-4">
                                        <span class="font-bold w-14">Địa chỉ:</span>
                                        <span class="col-span-4 pl-0">{{eurolab.addressSG}}</span>
                                      </div>
                                      <div class=" text-sm font-sans-Timenew ml-0 pl-0 fontsizeElement leading-4"><span class="font-bold pr-1">Hostline:</span>{{eurolab.phoneSG}}</div>
                                    </div>

                                </div>
                          </div>
                          <div class="col-span-2 text-italy text-center mt-1 font-bold font-sans-Timenew w-full text-xs">
                              <p class="mt-0  flex justify-center">
                                <vue-barcode class="h-8 w-36 " :value="td.thinprep_code" :options="{ displayValue: false }"></vue-barcode>
                              </p>
                              <span class="p-0 -mt-1 w-full text-center">Số(Number): {{td.thinprep_code}}</span>
                          </div>
        </div>
        <div class="grid grid-cols-2">
            <div></div>
            <div class="pt-0 py-0 place-items-center flex flex-col text-blue-800 text-lg">
                <span class="text-center font-bold  font-sans-Timenew leading-3 fontsizeTitle">PHIẾU XÉT NGHIỆM TẾ BÀO</span>
                    <div class="">
                        <span class="text-center font-bold font-sans-Timenew ml-0 pl-0 text-lg fontsizeInfo" style="">PAP'S SMEAR - ThinPrep</span>
                        <span class="align-top ml-0 p-0  font-bold">&reg;</span>
                    </div>
            </div>
        </div>
        <div class="mt-2 text-blue-700 fontsizeInfo">
          <div class="text-red-800"><span class="text-sm uppercase underline text-red-800 font-bold font-sans-Timenew fontsizeInfo">THÔNG TIN BỆNH NHÂN</span> <span class="font-sans-Timenew font-bold" >(Patient Information)</span></div>
            <div class="grid grid-cols-4 leading-5  font-sans-Timenew">
                <div class="col-span-2 font-sans-Timenew italic fontsizeName"><span class="font-bold">Họ và tên</span> (Name):<span class=" font-bold">{{td.custommer.name}}</span></div>
                <div class="  font-sans-Timenew italic fontsizeName"><span class="font-bold">Năm sinh</span> (Age):<span class="pl-2">{{td.custommer.birthday}}</span></div>
                <div class="  font-sans-Timenew italic font-bold fontsizeName">Para: <span class="pl-2 font-bold">{{td.para}}</span></div>
            </div>
            <div class="font-sans-Timenew text-sm fontsizeName">
                <span class="leading-5 italic font-bold">Đia chỉ</span> <span>(Address):</span><span class="ml-2 ">{{td.custommer.address}}</span>
            </div>
             <div class="grid grid-cols-4 font-sans-Timenew leading-5 italic text-xs fontsizeElement">
                <div class="font-bold">IUD (Intra-Uterine Devices)  <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.intra" ></div>
                <div class="font-bold text-center">Nội tiết (Hormone) <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.hormone"  ></div>
                <div class="font-bold text-center">Xạ (Radiation) <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3"  :checked="td.radiation" ></div>
                <div class="font-bold text-center">Có thai (Pregnancy) <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.preg"  ></div>
            </div>
            <div class="font-sans-Timenew leading-5 italic text-sm flex justify-between fontsizeName">
              <div>
                <span class="font-bold">Ngày kinh chót</span>(Last Menstual Periad):<span class="pl-2 font-bold">{{td.kinhchot}} </span>
              </div>
              <div>
                <span class="font-bold">Ngày gửi</span>(Date sent):<span class="pl-2 font-bold">{{ formatDate(td.date_sent)}} </span>
              </div>
            </div>
            <div class="grid grid-cols-2 italic text-sm mb-2 fontsizeName">
                <div class="font-sans-Timenew leading-6"><span class="font-bold">Chẩn đoán lâm sàng</span>(Clinical diagnose):<span class="font-bold pl-2">{{td.diagnose}}</span></div>
            </div>
        </div>
       <div>
          <div class="grid grid-cols-2">
            <div>
                 <div  class="text-center flex justify-center" v-if="td.imageleft">
                      <img
                          class="w-80 max-h-56 object-cover "
                          :src="pathThinLeft+td.imageleft.thinLeft"
                        :alt="imageThinLeft"/>
                  </div>
            </div>
            <div class="text-blue-700 text-sm pl-2">
              <div class="font-sans-Timenew leading-6 mb-2"><span class="font-bold">Bs. Chỉ định </span>(Physician):<span class="font-bold pl-2 text-lg fontsizeName"> {{td.doctor_indi}}</span></div>
              <div class="font-bold italic col-span-2 font-sans-Timenew ">Đánh giá lam (Specimen evalueation)</div>
              <div class="flex  font-sans-Timenew text-xs" >
                  <div class="" v-for="eg1 in testElements" :key="eg1.id">
                        <div class="font-bold mr-4" v-if="eg1.element_group == 1"><span class="mr-1">{{eg1.name}}</span>
                                        <span v-if="eg1.id == 1" >
                                          <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map(({result }) =>result)[0] !=='2'" />
                                        </span>
                                        <span v-else>
                                          <input type="checkbox"   class=" form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map(({result }) =>result)[0] ==='2'" />
                                        </span>
                                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class=" font-bold text-smS font-sans-Timenew mt-1 text-red-600 py-0">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>
          <div class="border-2 border-black pl-2 pr-1 py-2 text-blue-700 ">
              <div class="grid grid-cols-1 font-sans-Timenew">
                  <div class="text-sm" v-for="(eg2,i) in testElements" :key="i">
                      <div class="font-bold text-green-700 " v-if="eg2.element_group == 2">{{i-1}}. {{eg2.name}}
                                        <span v-if="eg2.id == 4" >
                                             <span v-if="td.results.find((result) => result.element_id === '26')">
                                                <span v-if="td.results.find((result) => result.element_id === '26').result === null">
                                                       <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map(({result }) =>result)[0] !=='3'" />
                                                </span>
                                                <span v-else>
                                                     <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3"/>
                                                </span>

                                            </span>
                                            <span v-else>
                                                <input type="checkbox" checked class="ml-1 my-2 form-checkbox text-blue-800 h-3 w-3"/>
                                            </span>
                                        </span>
                                        <span v-else>
                                             <input type="checkbox"   class="ml-1 my-2 form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map(({result }) =>result)[0] ==='3'" />
                                          </span>

                      </div>
                  </div>
              </div>
              <div class="flex flex-cols-5 text-xs">
                              <div class="" v-for="eg3 in testElements" :key="eg3.id">
                                  <span class="text-left font-bold text-xs  font-sans-Timenew mr-4 fontsizeElement" v-if="eg3.element_group == 3">+ {{eg3.name}}
                                     <input type="checkbox" disabled class="text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg3.id === x) !== -1"/>
                                  </span>
                              </div>
              </div>
              <div class="grid grid-cols-1 text-sm">
                              <div class="" v-for="eg4 in testElements" :key="eg4.id">
                                  <span class="text-left font-bold  font-sans-Timenew mr-5 text-green-700 fontsizeElement" v-if="eg4.element_group == 4">3. {{eg4.name}}
                                       <input type="checkbox" disabled class="text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg4.id === x) !== -1"/>
                                  </span>
                              </div>
              </div>

              <div class="col-span-2">
                  <span class=" font-sans-Timenew font-bold text-sm   text-red-700 pl-3">+ TẾ BÀO GAI (Squamuos cell)</span>
                  <div class="grid grid-cols-9 leading-4 italic text-xs fontsizeElement">
                      <div class="col-span-5">
                        <div class="" v-for="eg5 in testElements" :key="eg5.id">
                          <span class="text-left font-bold   font-sans-Timenew " v-if="eg5.element_group == 5"><span class="text-black">&lowast;</span>{{eg5.name}}
                              <input type="checkbox" disabled class="text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg5.id === x) !== -1"/>
                          </span>
                        </div>
                      </div>
                      <div class="col-span-4">
                        <div class="" v-for="eg6 in testElements" :key="eg6.id">
                          <span class=" text-left font-bold  font-sans-Timenew " v-if="eg6.element_group == 6"><span class="text-black">&lowast;</span>{{eg6.name}}
                               <input type="checkbox" disabled class="text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg6.id === x) !== -1"/>
                          </span>
                        </div>
                      </div>
                  </div>
              </div>
                            <div class="grid grid-cols-1 mt-1">
                                <div>
                                  <span class=" font-sans-Timenew font-bold text-sm uppercase text-red-700 pl-3"> + Tế bào Tuyến</span>
                                  <div class="grid grid-cols-2 leading-5 fontsizeElement">
                                    <div v-for="eg21 in testElements" :key="eg21.id">
                                      <div v-if="eg21.element_group == 21">
                                        <span class="text-left font-bold fontsizeElement ml-2 mr-4 text-sm font-sans-Timenew" >- {{eg21.name}}
                                           <input type="checkbox" disabled class="text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg21.id === x) !== -1"/>
                                          </span>
                                        </div>
                                </div>
                                  </div>
                                </div>
                            </div>

                            <div class="flex font-sans-Timenew leading-5 italic mt-0 text-sm font-bold fontsizeInfo"><span class="mr-2">Đề nghị (Suggestions):</span>
                                <div class="text-xs mt-1"  v-for="eg18 in testElements" :key="eg18.id">
                                    <span class=" fontsizeElement w-full mr-4 flex items-center" v-if="eg18.element_group ==18 && eg18.element_group !==null "><span class="mr-1">{{eg18.name}}</span>
                                       <input type="checkbox" disabled class="text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg18.id === x) !== -1"/>
                                    </span>
                                </div>
                            </div>
                   <div class="font-bold mt-2 p-0 font-sans-Timenew">Ghi chú (Notes):{{td.note}}</div>
          </div>
              <div class="grid grid-cols-5">
                              <div class="col-span-3">
                                <div class="grid grid-cols-1">
                                  <span class="font-bold text-red-800 font-sans-Timenew text-sm underline underline-offset-2">KẾT LUẬN (Conclution):</span>
                                 <div  v-for="eg9 in testElements" :key="eg9.id">
                                    <span class="font-bold text-xs w-full " v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                                       <div class="" style="line-heigh:30%" v-if="td.results.find((result) => result.element_id === '26')">
                                             <span class="uppercase text-red-800 font-sans-Timenew text-sm pl-0 m-0 ml-4 fontsizeName" v-if="td.results.find((result) => result.element_id === '26').result !== null">
                                                  - {{td.results.find((result) => result.element_id === "26").result}}
                                            </span>
                                            <span v-else>
                                               <span class="uppercase text-red-800 font-sans-Timenew text-sm pl-2 m-0 fontsizeName">- Không tổn thương trong biểu mô hay ung thư</span>
                                               <p class="pl-2 font-sans-Timenew text-lg leading-6 fontsizeName">-Tế bào cổ tử cung biến đổi do viêm</p>
                                            </span>
                                        </div>
                                        <span v-else >
                                          <span class="  font-sans-Timenew text-sm pl-2 font-bold fontsizeName">Biến đổi tế bào lành tính (Benign change)</span>
                                          </span>
                                    </span>
                                  </div>
                                </div>
                              </div>
                               <div class="col-span-2 text-center text-sm w-full">
                                  <div class="flex flex-col justify-center">
                                    <span class="font-bold font-sans-Timenew fontsizeName">Ngày đọc kết quả: {{currentDate}}</span>
                                    <span class="mb-14 font-bold font-sans-Timenew fontsizeName">BS GPBL - TB</span>
                                  <span class="font-bold font-sans-Timenew text-lg fontsizeInfo mt-8" v-if="td.doctorread && td.asign_view != 1">{{td.doctorread.title}}<span class="ml-1 uppercase"> {{td.doctorread.name}}</span></span>
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
        ImageThin:"",
        pathThinLeft:'',
        pathThinRight:'',
        imageThinLeft:'',
        ketluan:'',
        currentDate:'',
        pathLogo:'',
        eurolab:''

    },
    components:{
      CheckIcon,
      VueBarcode
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


