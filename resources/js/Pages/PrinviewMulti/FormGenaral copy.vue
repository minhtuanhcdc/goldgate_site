<template>
 <div class="pl-2" >Genaral
                      <!-- <div class="grid grid-cols-8 mx-0 py-0">
                          <div class="col-span-2 py-0">
                              <img v-if="logo"
                                class="w-36"
                                :src="pathLogo+logo"
                                :alt="LogoThin"
                              />
                              <img v-else
                                class="w-36"
                                :src="pathImageLeft"
                                :alt="LogoThin"
                              />
                          </div>
                          <div class="col-span-4 text-center mt-4">
                              <div class="pt-0 py-0 place-items-center flex flex-col">
                                    <span class="text-center font-bold text-2xl font-sans-Timenew ">PHIẾU XÉT NGHIỆM TẾ BÀO</span>
                                    <div>
                                      <span class="text-center font-bold text-2xl font-sans-Timenew ml-0 pl-0">PAP'S SMEAR - ThinPrep</span>
                                      <span class="align-top ml-0 p-0 text-md font-bold">&reg;</span>
                                    </div>
                                    <span class="text-center font-bold text-md font-sans-Timenew ">REQUEST FOR COLLECTION OF SPECIMEN</span>
                                </div>
                          </div>
                          <div class="col-span-2 text-left text-italy text-sm font-bold font-sans-Timenew  mt-8 w-full">
                                <span class="p-0 m-0 w-full text-xs">Số(Number): {{getbilltests['thinprep_code']}}</span>
                          </div>
                      </div>
                        <div class="grid grid-cols-4 leading-6 text-md">
                              <div class="col-span-2 font-sans-Timenew italic">Họ và tên (Name):<span class=" font-bold">{{printCustommers['name']}}</span></div>
                              <div class="  font-sans-Timenew italic">Tuổi (Age):<span class="pl-2 font-bold">{{printCustommers['birthday']}}</span></div>
                              <div class="  font-sans-Timenew italic">Para: <span class="pl-2 font-bold">{{getbilltests['para']}}</span></div>
                          </div>
                          <div class="grid grid-cols-4 text-md">
                              <div class="col-span-3 font-sans-Timenew leading-6 italic">Đia chỉ(Address):<span class="pl-2 font-bold">{{printCustommers['address']}}</span></div>
                              <div class=" font-sans-Timenew leading-6 italic">Số điện thoại:<span class="pl-2 font-bold">???</span></div>
                          </div>
                          <div class="font-sans-Timenew leading-6 italic text-md">Đơn vị gửi(Custommer):<span class="pl-2 font-bold">{{printOutsent['name']}} </span></div>

                            <div class="grid grid-cols-2 italic text-md">
                              <div class="font-sans-Timenew leading-6">Chẩn đoán lâm sàng(Clinical diagnose):<span class="font-bold pl-2">{{getbilltests['diagnose']}}</span></div>
                              <div class="font-sans-Timenew leading-6">Bs. Chỉ định(Physician):<span class="font-bold pl-2" v-if="printDoctor"> {{printDoctor['name']}}</span></div>
                          </div>
                      <div>
                            <div class="text-center font-bold text-xl font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>

                            <div class="grid grid-cols-5 font-sans-Timenew leading-6">
                              <div class="font-bold italic col-span-2">Đánh giá lam (Specimen evalueation)</div>
                                <div class="col-span-3 grid grid-cols-2" >
                                  <div class="" v-for="eg1 in testElements" :key="eg1.id">
                                    <span class="font-bold" v-if="eg1.element_group == 1">{{eg1.name}}
                                        <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg1.id" v-model="selectedArray"/>
                                      </span>
                                  </div>
                            </div>
                            </div>
                            <div class="grid grid-cols-1">
                                  <div class="" v-for="eg2 in testElements" :key="eg2.id">
                                      <span class="text-left font-bold text-md  font-sans-Timenew text-blue-900" v-if="eg2.element_group ==2">- {{eg2.name}}
                                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg2.id" v-model="selectedArray"/>
                                      </span>
                                  </div>
                              </div>
                          <div class="flex flex-cols-5">
                              <div class="" v-for="eg3 in testElements" :key="eg3.id">
                                  <span class="text-left font-bold text-xs  font-sans-Timenew mr-5 " v-if="eg3.element_group == 3">+ {{eg3.name}}
                                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg3.id" v-model="selectedArray"/>
                                  </span>
                              </div>
                          </div>
                          <div class="grid grid-cols-1">
                              <div class="" v-for="eg4 in testElements" :key="eg4.id">
                                  <span class="text-left font-bold text-xs  font-sans-Timenew mr-5 " v-if="eg4.element_group == 4">+ {{eg4.name}}
                                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg4.id" v-model="selectedArray"/>
                                  </span>
                              </div>
                          </div>

                            <div class="col-span-2">
                                  <span class=" font-sans-Timenew font-bold text-sm  text-blue-700">TẾ BÀO GAI (Squamuos cell)</span>
                                  <div class="grid grid-cols-2 leading-5 italic">
                                    <div class="flex flex-col">
                                       <div class="" v-for="eg5 in testElements" :key="eg5.id">
                                      <span class="ml-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg5.element_group == 5">{{eg5.name}}
                                          <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg5.id" v-model="selectedArray"/>
                                        </span>
                                </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="" v-for="eg6 in testElements" :key="eg6.id">
                                        <span class="pl-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg6.element_group == 6">{{eg6.name}}
                                          <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg6.id" v-model="selectedArray"/>
                                        </span>
                                    </div>
                                    </div>

                                  </div>
                              </div>

                            <div class="grid grid-cols-1 mt-2">
                                <div>
                                  <span class=" font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Tuyến</span>
                                  <div class="flex flex-row leading-5">
                                    <div v-for="eg7 in testElements" :key="eg7.id">
                                      <div v-if="eg7.element_group == 7">
                                        <span class="text-left font-bold text-xs ml-4 mr-6  font-sans-Timenew" >{{eg7.name}}
                                          <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg7.id" v-model="selectedArray"/>
                                          </span>
                                        </div>
                                </div>
                                  </div>
                                </div>
                            </div>
                  <div class="font-bold mt-2 p-0 font-sans-Timenew">Đề nghị (Suggestions):</div>
                            <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic mt-0">
                              <div class="font-bold col-span-4">
                                <div class="flex flex-rows-2">
                                <div  v-for="eg8 in testElements" :key="eg8.id">
                                    <span class="font-bold text-xs w-full mr-3" v-if="eg8.element_group ==8 && eg8.element_group !==null ">{{eg8.name}}
                                      <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg8.id" v-model="selectedArray"/>
                                    </span>
                                  </div>
                                  </div>
                              </div>
                            </div>
                            <div class="grid grid-cols-2 mt-2 text-center">
                                <div  class="text-center flex justify-center">
                                  <img v-if="getbilltests['thinprep_code']"
                                      class="w-80 max-h-52 "
                                      :src="pathThinLeft+imageThinLeft"
                                      :alt="imageThinLeft"/>

                                   <img v-else
                                      class="w-80 max-h-52 "
                                      :src="pathImageLeft"
                                      alt="imageThinLeft"/>

                                  </div>
                                <div class="text-center flex justify-center">
                                  <img  v-if="getbilltests['thinprep_code']"
                                      class="w-80 max-h-52 "
                                      :src="pathThinRight+imageThinRight"
                                      :alt="LogoThin"/>
                                  <img v-else
                                      class="w-80 max-h-52 "
                                      :src="pathImageLeft"
                                      alt="imageThinRight"/>

                                  </div>
                            </div>
                            <div class="grid grid-cols-3">
                              <div class="col-span-2">
                                <div class="grid grid-cols-1">
                                  <span class="font-bold text-red-800 font-sans-Timenew text-md underline underline-offset-2">KẾT LUẬN (Conclution):</span>
                                 <div  v-for="eg9 in testElements" :key="eg9.id">
                                    <span class="font-bold text-xs w-full mr-3" v-if="eg9.element_group ==9 && eg9.element_group !==null ">

                                         <p v-if="ketluan" class="uppercase text-red-800 font-sans-Timenew text-lg pl-2" >- {{ketluan}}</p>

                                    </span>
                                  </div>
                                </div>
                              </div>

                              <div class="grid grid-cols-1 text-center">
                                <span class="font-bold font-sans-Timenew text-md">Ngày đọc kết quả: {{currentDate}}</span>
                                <span class="mb-16 font-bold font-sans-Timenew text-md" style="margin-bottom:100px">BS/KTV đọc kết quả:</span>
                                <span class="font-bold font-sans-Timenew text-md" v-if="printDoctor">{{printDoctor['name']}}</span>

                              </div>
                            </div>
                        </div> -->
  </div>
  <div class="page-break"></div>
</template>

<script>
import { CheckIcon } from '@heroicons/vue/solid'
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
        imageThinRight:'',
        ketluan:'',
        logo:'',
        pathLogo:'',
        currentDate:'',


    },
    components:{
      CheckIcon
    }
}
</script>