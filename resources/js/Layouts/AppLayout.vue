<template>
  <div class="noPrint">
    <Head :title="title" />
    <jet-banner />
    <div class="min-h-screen bg-gray-100">
      <nav class="bg-gray-200 border-b border-gray-100 ">
        <!-- Primary Navigation Menu -->
        <div class="w-full mx-auto px-4 sm:px-18 lg:px-24">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="flex-shrink-0 flex items-center mr-2">
                <Link :href="route('dashboard')">
                  <jet-application-mark class="block h-9 w-auto" />
                </Link>

              </div>
                 <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-items-center">
                    <Link :href="route('articles.index')">
                        Article
                      </Link>
                  </div> -->
               <div class="">
                 <ul class="flex justify-between items-center mx-auto space-x-1 sm:ml-1 relative">
                   <li
                    class="group hover:bg-blue-700 "
                    v-for="(parentMenu, i) in $page.props.menuPermission.menuAccess"
                    :key="i"
                  >
                    <div class="menu_item" v-show="parentMenu.parent_id == 0">
                        <jet-nav-link
                            :href="
                              route(
                                `${parentMenu.Url !== null ? parentMenu.Url : 'dashboard'}`
                              )
                            "
                            class=""
                          >
                              <span class="text-base text-gray-800 hover:text-white text-center"> {{ parentMenu.menuName }}</span>
                          </jet-nav-link>

                    </div>
                    <ul class="sub_item bg-blue-700 hover:bg-blue-700 pl-0">
                       <li
                        class="w-full"
                        v-for="(chileMenu, i) in $page.props.menuPermission.menuAccess"
                        :key="i"
                      >
                        <div v-show="parentMenu.menuId == chileMenu.parent_id">
                          <jet-nav-link
                            :href="
                              route(
                                `${chileMenu.Url !== null ? chileMenu.Url : 'dashboard'}`
                              )
                            "
                            class="items"
                          >
                            <span class="pl-3"> {{ chileMenu.menuName }}</span>
                          </jet-nav-link>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>

<!-- menu Dropdown -->
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
              <!-- <div class="ml-3 relative">
                 Teams Dropdown
                <jet-dropdown
                  align="right"
                  width="60"
                  v-if="$page.props.jetstream.hasTeamFeatures"
                >
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
                      >
                        {{ $page.props.user.current_team.name }}
                        <svg
                          class="ml-2 -mr-0.5 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>
                </jet-dropdown>
              </div> -->
              <!-- Settings Dropdown -->
              <div class="ml-3 relative">
                <jet-dropdown align="right" width="48">
                  <template #trigger>
                    <button
                      v-if="$page.props.jetstream.managesProfilePhotos"
                      class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                    >
                      <img
                        class="h-14 w-14 rounded-full object-cover"
                        :src="pathImgUser + $page.props.user.profile_photo_path"
                        :alt="$page.props.user.name"
                      />
                    </button>
                    <span v-else class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                      >
                        {{ $page.props.user.name }}
                        <svg
                          class="ml-2 -mr-0.5 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>
                  <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                       {{ $page.props.user.name }}
                    </div>
                    <jet-dropdown-link :href="route('profile.show')">
                      Profile
                    </jet-dropdown-link>

                    <jet-dropdown-link
                      :href="route('api-tokens.index')"
                      v-if="$page.props.jetstream.hasApiFeatures"
                    >
                      API Tokens
                    </jet-dropdown-link>
                    <div class="border-t border-gray-100"></div>
                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <jet-dropdown-link as="button"> Log Out </jet-dropdown-link>
                    </form>
                  </template>
                </jet-dropdown>
              </div>
            </div>
            <!-- Hamburger -->
            <!-- <div class="-mr-2 flex items-center sm:hidden">
              <button
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
              >
                <svg
                  class="h-6 w-6"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    :class="{
                      hidden: showingNavigationDropdown,
                      'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{
                      hidden: !showingNavigationDropdown,
                      'inline-flex': showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div> -->
          </div>
        </div>
        <!-- Responsive Navigation Menu -->
        <div
          :class="{
            block: showingNavigationDropdown,
            hidden: !showingNavigationDropdown,
          }"
          class="sm:hidden"
        >
          <div class="pt-1 pb-1 space-y-1">
            <jet-responsive-nav-link
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Dashboard
            </jet-responsive-nav-link>
          </div>
          <div class="pt-1 pb-1 space-y-1">
            <jet-responsive-nav-link
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Dashboard 2
            </jet-responsive-nav-link>
          </div>
          <!-- Responsive Settings Options -->
          <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
              <div
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="flex-shrink-0 mr-3"
              >
                <img
                  class="h-10 w-10 rounded-full object-cover"
                  :src="$page.props.user.profile_photo_url"
                  :alt="$page.props.user.name"
                />
              </div>
              <div>
                <div class="font-medium text-base text-gray-800">
                  {{ $page.props.user.name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                  {{ $page.props.user.email }}
                </div>
              </div>
            </div>
            <div class="mt-3 space-y-1">
              <jet-responsive-nav-link
                :href="route('profile.show')"
                :active="route().current('profile.show')"
              >
                Profile
              </jet-responsive-nav-link>
              <jet-responsive-nav-link
                :href="route('api-tokens.index')"
                :active="route().current('api-tokens.index')"
                v-if="$page.props.jetstream.hasApiFeatures"
              >
                API Tokens
              </jet-responsive-nav-link>
              <!-- Authentication -->
              <form method="POST" @submit.prevent="logout">
                <jet-responsive-nav-link as="button"> Log Out</jet-responsive-nav-link>
              </form>

            </div>
          </div>
        </div>
        <!-- /Responsive Navigation Menu -->
      </nav>
      <!-- Page Heading -->
      <header class="bg-blue-700 shadow mt-2 text-white " v-if="$slots.header">
        <div class="w-full mx-auto py-2 px-4 sm:px-6 lg:px-8">
          <slot name="header"></slot>
        </div>
      </header>
      <!-- Page Content -->
      <main class="place-items-center items-center">
        <FlashMessage class="" />
        <slot></slot>
      </main>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

import FlashMessage from "@/Components/FlashMessage";

export default defineComponent({
  props: {
    title: String,
    view:Boolean
  },

  components: {
    Head,
    JetApplicationMark,
    JetBanner,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    JetResponsiveNavLink,
    Link,
    FlashMessage,
  },

  data() {
    return {
      pathImgUser:'/storage/Image_users/',
      showingNavigationDropdown: false,
    };
  },

  methods: {
    switchToTeam(team) {
      this.$inertia.put(
        route("current-team.update"),
        {
          team_id: team.id,
        },
        {
          preserveState: false,
        }
      );
    },

    logout() {
      this.$inertia.post(route("logout"));
    },
  },
});
</script>


