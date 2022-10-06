<template>
    <div class="px-4 pb-0">
                 <div class="grid grid-cols-4 leading-6">
                    <div class="col-span-2  font-sans-Timenew italic underline underline_offset-1">Họ và tên (Name): <span class="font-bold">  {{name}}</span></div>
                    <div class="  font-sans-Timenew italic underline underline-offset-1">Test Id:<span ref="" class="font-bold">{{test_id}}</span> </div>
                    <div class="  font-sans-Timenew italic underline underline-offset-1">Mã Thinpred:<span ref="span_thin" class="font-bold">{{thinprep_code}}</span> </div>
                  </div>
                    <hr>
                 <form
                    class="py-1 px-2 sm:p-1 sm:px-2 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveResult(form)">
                    <div>
                  <div class="text-center font-bold text-md font-sans-Timenew mt-1 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014 _Vigor</div>
                  <div class="grid grid-cols-5 font-sans-Timenew leading-6">
                  <div class="font-bold italic col-span-2">Đánh giá lam (Specimen evalueation)</div>
                  <div class="col-span-3 grid grid-cols-2" >
                    <div class="" v-for="eg1 in testElements" :key="eg1.id">
                      <span class="font-bold" v-if="eg1.element_group ==1">{{eg1.name}} - {{eg1.id}}
                        <input   type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg1.id" v-model="form.element_id"/>
                      </span>
                    </div>
                    </div>
                  </div>
                  <div class="grid grid-cols-1">
                    <div class="" v-for="eg2 in testElements" :key="eg2.id">
                        <span class="text-left font-bold text-md  font-sans-Timenew text-blue-900" v-if="eg2.element_group ==2">- {{eg2.name}}
                          <input  type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg2.id" v-model="form.element_id"/>
                        </span>
                    </div>
                  </div>

                <div class="flex flex-cols-5">
                  <div class="" v-for="eg3 in testElements" :key="eg3.id">
                    <span class="text-left font-bold text-xs  font-sans-Timenew mr-5 " v-if="eg3.element_group == 3">+ {{eg3.name}}
                          <input type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg3.id" v-model="form.element_id"/>
                    </span>
                </div>
                </div>
                <div class="grid grid-cols-1">
                  <div class="" v-for="eg4 in testElements" :key="eg4.id">
                    <span class="text-left font-bold text-md  font-sans-Timenew text-blue-900" v-if="eg4.element_group == 4">- {{eg4.name}}
                          <input  type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg4.id" v-model="form.element_id"/>
                    </span>
                </div>
                </div>
              <div class="col-span-2">
                  <span class=" font-sans-Timenew font-bold text-sm  text-blue-700">+ TẾ BÀO GAI (Squamuos cell)</span>
                    <div class="grid grid-cols-2 leading-5 italic">
                      <div class="flex flex-col">
                        <div v-for="(eg5, i) in testElements" :key="i">
                          <span class="ml-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg5.element_group == 5">{{eg5.name}}
                            <input type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg5.id" v-model="form.element_id"/>
                            </span>
                        </div>
                      </div>
                      <div class="flex flex-col">
                        <div class="" v-for="eg6 in testElements" :key="eg6.id">
                          <span class="pl-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg6.element_group == 6">{{eg6.name}}
                            <input type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg6.id" v-model="form.element_id"/>
                            </span>
                        </div>
                      </div>

                    </div>
              </div>

            <div class="grid grid-cols-1 mt-2">
                <div>
                  <span class=" font-sans-Timenew font-bold text-sm uppercase text-blue-700">+ Tế bào Tuyến (Glandular cell)</span>
                    <div class="grid grid-cols-1 leading-5 italic">
                      <div class="flex flex-cols-3 ">

                      <div v-for="eg7 in testElements" :key="eg7.id">
                        <span class="text-left font-bold text-xs  font-sans-Timenew mr-5" v-if="eg7.element_group == 7">{{eg7.name}}
                          <input type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg7.id" v-model="form.element_id"/>
                          </span>

                      </div>
                    </div>

                  </div>
                </div>
            </div>

           <div class="grid grid-cols-5 font-sans-Timenew leading-6 mt-3">
            <div class="font-bold italic">Đề nghị (Suggestions)</div>
          <div class="col-span-3" >
            <div class="grid grid-cols-2">
                <div  v-for="eg8 in testElements" :key="eg8.id">
                  <span class="font-bold text-xs" v-if="eg8.element_group ==8">{{eg8.name}}
                    <input type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg8.id" v-model="form.element_id"/>
                  </span>
                </div>
            </div>
            </div>
          </div>

         <div class="grid grid-cols-2 mt-2 text-center">
            <div  class="text-center">
              <img
                  class="w-56 max-h-40 "
                  :src="pathThinLeft"
                  :alt="LogoThin"/>
                </div>
            <div class="text-center">
              <img
                  class="w-56 max-h-40 "
                  :src="pathThinRight"
                  :alt="LogoThin"/>
              </div>

         </div>
         <div class="grid grid-cols-3">
           <div class="col-span-2">
              <div class="grid grid-cols-1">
                 <div  v-for="eg9 in testElements" :key="eg9.id">
                  <span class="font-bold text-xl" v-if="eg9.element_group ==9">{{eg9.name}}
                    <span v-if="eg9.id == 26">
                         <input  type="text" class="w-full rounded-md h-10" v-model="form.ketluan">
                    </span>

                  </span>
                </div>

          </div>
           </div>

           </div>
      </div>
            <div class="mt-4 text-center mb-1" >
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                             <button v-show="!editMode"  type="submit" class="bg-blue-900 text-white inline-flex justify-center w-20 rounded-md border border-gray-300 px-4 py-2  leading-6 font-medium  shadow-sm hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Save
                              </button>
                            </span>
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button"
                               class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                v-show="editMode" @click.prevent="updateResult(form)">
                                Update
                              </button>
                            </span>
                 </div>
                </form> -->
    </div>
</template>

<script>
export default {
    props:{
        testElements:Object,
        name:'',
        test_id:'',
        thinprep_code:'',
    }
}
</script>