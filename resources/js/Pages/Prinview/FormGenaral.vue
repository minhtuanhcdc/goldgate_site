<template>
<div><h4>Form group Chung</h4>
 <div class="pl-2" ref="printMe" id="printMe" >
    <div class="flex justify-between mx-0 py-0 mb-2">
      <div class="flex justify-center">
          <span v-if="printOutsent['logo_view']" class=" w-44 flex justify-end">
            <img v-if="eurolab.logo"
              class="h-24"
              :src="pathLogo+printOutsent['logo']"
              :alt="logo"
              />
          </span>
          <span v-else  class="w-56">
            <img v-if="eurolab.logo"
                class=""
                :src="pathLogoEuro+eurolab.logo"
                :alt="LogoThin"
              />
          </span>
      </div>
      <div class="">
          <div class="flex flex-col">
            <span class="text-center font-bold text-xl font-sans-Timenew ">PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG</span>
            <div class="text-center">
              <span class="text-center font-bold text-xl font-sans-Timenew ml-0 pl-0">PAP'S SMEAR - ThinPrep</span>
              <span class="align-top ml-0 p-0 text-md font-bold">&reg;</span>
            </div>
            <span class="text-center font-bold text-md font-sans-Timenew ">REQUEST FOR COLLECTION OF SPECIMEN</span>
        </div>
      </div>
      <div class=" text-right text-italy text-sm font-bold font-sans-Timenew">
        <p class="-mt-1  flex justify-end">
            <vue-barcode class="h-8 w-36" :value="getbilltests['thinprep_code']" :options="{ displayValue: false }"></vue-barcode>
          </p>
            <span class="p-0 m-0 w-full text-xs -mt-1">Số(Number): {{getbilltests['thinprep_code']}}</span>
      </div>
    </div>
    <div class="relative">
      <div class="absolute mt-8 flex justify-center w-full opacity-10">
          <img class="w-1/3 -mt-4" :src="pathLogoEuro + eurolab.background_thin" alt="imagesGG">
        </div>
      <div class="grid grid-cols-4 leading-6 text-md">
            <div class="col-span-2 font-sans-Timenew italic">Họ và tên (Name):<span class=" font-bold">{{printCustommers['name']}}</span></div>
            <div class="  font-sans-Timenew italic">Tuổi (Age):<span class="pl-2 font-bold">{{printCustommers['birthday']}}</span></div>
            <div class="  font-sans-Timenew italic">Para: <span class="pl-2 font-bold">{{getbilltests['para']}}</span></div>
        </div>
        <div class="grid grid-cols-4 text-md">
            <div class="col-span-3 font-sans-Timenew leading-6 italic">Đia chỉ(Address):<span class="pl-2 font-bold">{{printCustommers['address']}}</span></div>
            <div class=" font-sans-Timenew leading-6 italic">Số điện thoại:<span class="pl-2 font-bold">{{printCustommers['phone']}}</span></div>
        </div>
        <div class="font-sans-Timenew leading-6 italic text-md">Đơn vị gửi(Custommer):<span class="pl-2 font-bold">{{printOutsent['name']}} </span></div>

          <div class="grid grid-cols-2 italic text-md">
            <div class="font-sans-Timenew leading-6">Chẩn đoán lâm sàng(Clinical diagnose):<span class="font-bold pl-2">{{getbilltests['diagnose']}}</span></div>
            <div class="font-sans-Timenew leading-6">Bs. Chỉ định(Physician):<span class="font-bold pl-2" v-if="printDoctor"> {{printDoctor['name']}}</span></div>
        </div>
      </div>
    <div>
      <div class="text-center font-bold text-xl font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>
      <div class="grid grid-cols-5 font-sans-Timenew leading-6">
        <div class="font-bold italic col-span-2">Đánh giá lam (Specimen evalueation)</div>
          <div class="col-span-3 grid grid-cols-2" >
            <div class="" v-for="eg1 in testElements" :key="eg1.id">
              <div class="font-bold" v-if="eg1.element_group == 1">{{eg1.name}}
                    <span>
                        <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg1.id" v-model="selectedArray"/>
                    </span>
                </div>
            </div>
      </div>
      </div>
      <div class="grid grid-cols-1 font-sans-Timenew">
            <div class="" v-for="eg2 in testElements" :key="eg2.id">
                <div class="font-bold" v-if="eg2.element_group == 2">{{eg2.name}}
                    <span>
                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :value="eg2.id" v-model="selectedArray"/>
                    </span>
                </div>
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
              class="w-96 max-h-64 object-cover "

              :src="pathThinLeft+imageThinLeft"
              :alt="imageThinLeft"/>

            <img v-else
              class="w-96 max-h-64 "
              :src="pathImageLeft"
              alt="imageThinLeft"/>


        </div>
        <div class="text-center flex justify-center">
          <img  v-if="getbilltests['thinprep_code']"
              class="w-96 max-h-64 object-cover "
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
          <div class="flex flex-col">
            <span class="font-bold text-red-800 font-sans-Timenew text-md underline underline-offset-2">KẾT LUẬN (Conclution):</span>
            <div  v-for="eg9 in testElements" :key="eg9.id">
              <span class="font-bold text-xs w-full mr-3" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                <span v-if="ketluan" class="uppercase text-red-800 font-sans-Timenew text-lg pl-2">- {{ketluan}}</span>
                <span v-else >
                  <span class="uppercase text-red-800 font-sans-Timenew text-lg pl-2">- KHÔNG TỔN THƯƠNG TRONG BIỂU MÔ HAY UNG THƯ</span>
                  <p class="  font-sans-Timenew text-lg pl-2">- Tế bào cổ tử cung biến đổi do viêm</p>
                  </span>
              </span>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-1 text-center">
          <span class="font-bold font-sans-Timenew text-md">Ngày đọc kết quả: {{currentDate}}</span>
          <span class=" font-bold font-sans-Timenew text-md">BS/KTV đọc kết quả:</span>
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
          <span class="font-bold font-sans-Timenew text-md">KHOA GIẢI PHẨU BỆNH</span>
          <span class="font-bold font-sans-Timenew text-md">BỆNH VIỆN TỪ DŨ</span>
        </div>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
import { CheckIcon } from '@heroicons/vue/solid'
import AppImageView from "@/Components/ImageView";
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
        logo:'',
        pathLogoEuro:'',
        eurolab:'',
        currentDate:'',
        pathLogo:'',
        path_asign:''


    },
    components:{
      CheckIcon,
      AppImageView,
      VueBarcode
    }
}
</script>
<style>
@media print {
         body{font-size:14pt}
      }

</style>