<template>
      <table id="myTable">
            <thead>
                <tr class="text-left">
                    <th class="" v-for="(header,index) in headers" :key="`header-${index}`"
                        :class="header.class || 'text-left'"
                     >
                     <div class="flex">
                     <span>{{header.name}}</span>
                      <span class="text-gray-400 ml-1 cursor-pointer">
                      </span>
                     </div>
                     </th>                          
                </tr>
            </thead>
                <tbody>
                    <slot></slot>
                </tbody> 
        </table>
</template>

<script>
//var dt = require( 'datatables.net' )( window, $ );
import $ from "jquery";
import dt from "datatables.net-bs4"
export default {
    props:{
        headers:{
            type:Array,
            required:true
        }
    },
        mounted() {
              $("#myTable").DataTable({
                    "search": {                     
                        "search":'',
                        className:'text-red-900'
                    },
                    dom:"Bfrtip",
                         buttons: {
                             className:'text-yellow-600 text-bold text-2xl',
                            buttons: [
                                { extend: 'pageLength', className: 'rounded-md text-white bg-blue-600 py-1 px-3 mr-2' },
                                { extend: 'copy', className: 'rounded-md text-white bg-blue-600 py-1 px-3 mr-2'  },
                                { extend: 'print', className: 'rounded-md text-white bg-blue-600 py-1 px-3 mr-2' },
                               {
                                // text: '<i class="fa fa-lg fas-file-text-o"></i>',
                                text:'xuat file Excel',
                                    extend: 'csv',
                                    className: 'bordered-md bg-blue-600 py-1 px-3 mr-2',
                                    title: 'export_filename',
                                    extension: '.xls'
                                },
                            //     {
                            //     text: 'Excel',
                            //     extend: 'excel',
                            //     className: 'bordered-md bg-blue-600 py-1 px-3 mr-2',
                            //     title: 'export_filename',
                            //     extension: '.xls'
                            // }, 
                              
                            ],    
                                              
                    },
                     scrollY:480,                                        
                    lengthMenu: [
                        [ 5, 10, 25, 50, -1 ],
                        [ '5 rows','10 rows', '25 rows', '50 rows', 'All' ]
                    ],                              
                    });
               
                    //table.buttons( 'csv:name' ).disable();
        
        
        },

}
</script>
<style>
.dt-buttons{
left:2%;
margin-bottom: 4px;
}
.dataTables_filter input{
    border-radius: 5px;
    height: 30px;
      background-color: white;
   
}
div.dataTables_filter,
div.dataTables_length {
    margin-top: 0px;
     padding: 0px;
  
    float: right;
}

  .dataTables_wrapper .dataTables_info{
      color:blue;
      margin-right: 10px;
      display: inline-flex;
  }
  
.dataTables_wrapper .dataTables_paginate {
  margin: auto !important;
  text-align: center;
  float: right;


  }

</style>