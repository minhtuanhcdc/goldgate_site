 <template>
    <h4 class="font-semibold tex-xl text-white">
        <span v-for="(item, index) in items" :key="index">
            <jet-nav-link v-if="item.url" :href="item.url" class="text-red-600 text-xl" >
                    <span >{{item.label}}</span>
                </jet-nav-link>
                <span  v-else class="text-white shadow-xl" :class="item.class || 'text-white'">{{item.label}}</span>
                <span v-if="index < (items.length-1)" class="mx-2 text-white">&gt;</span>       
        </span>
    </h4>
</template>

<script>
import JetNavLink from '@/Jetstream/NavLink.vue'
export default {
    components:{
        JetNavLink
    },
    props:{
        items:{
            type:Array,
            require:true
        }
    }
}
</script>

<style>

</style>