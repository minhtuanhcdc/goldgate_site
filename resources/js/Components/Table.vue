<template class="table-responsive">
<div class="table-responsive">
      <table :class="tableClass" class="table table-responsive">
            <thead>
                <tr class="" :class="addClass" >
                    <th class=" z-50" v-for="(header,index) in headers" :key="`header-${index}`" :class="header.class || 'text-left'">
                     <span class="" v-html="header.name"></span>
                     </th>
                </tr>
            </thead>
                <tbody>
                    <slot></slot>
                </tbody>
        </table>
</div>
</template>
<script>
export default {
    props:{
        headers:{
            type:Array,
            required:true
        },
        tableClass:{
            type:String,
            required:true
        },
        addClass:{
            type:String,
            required:true
        }
    }

}

</script>

<style>
</style>