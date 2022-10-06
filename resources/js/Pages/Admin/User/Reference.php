<template>
  <div id="app">
    <div class="example">
      <h3 id="example-1">#1 - Single select</h3>
      <div class="output">Data: {{ example1.value }}</div>
      <Multiselect v-model="example1.value" v-bind="example1"></Multiselect>
      <pre v-pre>
  &lt;Multiselect
    v-model="value"
    :options="['Batman', 'Robin', 'Joker']"
  />
</pre
      >
    </div>

    <div class="example">
      <h3 id="example-2">#2 - Multiselect with object options</h3>
      <div class="output">Data: {{ example2.value }}</div>
      <Multiselect v-model="example2.value" v-bind="example2"></Multiselect>
      <pre v-pre>
  &lt;Multiselect
    v-model="value"
    mode="multiple"
    :options="{
      batman: 'Batman',
      robin: 'Robin',
      joker: 'Joker'
    }"
  />
</pre
      >
    </div>

    <div class="example">
      <h3 id="example-3">#3 - Multiselect with disabled options</h3>
      <div class="output">Data: {{ example3.value }}</div>
      <Multiselect v-model="example3.value" v-bind="example3"></Multiselect>
      <pre v-pre>
  &lt;Multiselect
    v-model="value"
    mode="multiple"
    :options="[
      { value: 'batman', label: 'Batman' },
      { value: 'robin', label: 'Robin', disabled: true },
      { value: 'joker', label: 'Joker' },
    ]"
  />
</pre
      >
    </div>

    <div class="example">
      <h3 id="example-4">#4 - Tags with create, search and array of objects options</h3>
      <div class="output">Data: {{ example4.value }}</div>
      <Multiselect v-model="example4.value" v-bind="example4"></Multiselect>
      <pre v-pre>
  &lt;Multiselect
    v-model="value"
    mode="tags"
    :searchable="true"
    :createTag="true"
    :options="[
      { value: 'batman', label: 'Batman' },
      { value: 'robin', label: 'Robin' },
      { value: 'joker', label: 'Joker' },
    ]"
  />
</pre
      >
    </div>

    <div class="example">
      <h3 id="example-5">#5 - Autocomplete with async options</h3>
      <div class="output">Data: {{ example5.value }}</div>
      <Multiselect v-model="example5.value" v-bind="example5"></Multiselect>
      <pre v-pre>
  &lt;Multiselect
    v-model="value"
    placeholder="Choose a programming language"
    :filterResults="false"
    :minChars="1"
    :resolveOnLoad="false"
    :delay="0"
    :searchable="true"
    :options="async function(query) {
      return await fetchLanguages(query) // check JS block for implementation
    }"
  />
</pre
      >
    </div>

    <div class="example">
      <h3 id="example-6">#6 - Tags with async options</h3>
      <div class="output">Data: {{ example6.value }}</div>
      <Multiselect v-model="example6.value" v-bind="example6"></Multiselect>
      <pre v-pre>
  &lt;Multiselect
    v-model="value"
    mode="tags"
    placeholder="Choose your stack"
    :filterResults="false"
    :minChars="1"
    :resolveOnLoad="false"
    :delay="0"
    :searchable="true"
    :options="async function(query) {
      return await fetchLanguages(query) // check JS block for implementation
    }"
  />
</pre
      >
    </div>

    <div class="example">
      <h3 id="example-7">#7 - Select with custom options slot</h3>
      <div class="output">Data: {{ example7.value }}</div>
      <Multiselect v-model="example7.value" v-bind="example7">
        <template v-slot:singlelabel="{ value }">
          <div class="multiselect-single-label">
            <img class="character-label-icon" :src="value.icon" /> {{ value.name }}
          </div>
        </template>

        <template v-slot:option="{ option }">
          <img class="character-option-icon" :src="option.icon" /> {{ option.name }}
        </template>
      </Multiselect>
      <pre v-pre>
  &lt;Multiselect
    v-model="value"
    placeholder="Select your character"
    label="name"
    :options="[
      { value: 'captainamerica', name: 'Captain America', icon: 'https://cdn2.iconfinder.com/data/icons/avengers-filled/48/03_-_Captain_America_-_infinity_war_-_end_game_-_marvel_-_avengers_-_super_hero-512.png' },
      { value: 'spiderman', name: 'Spiderman', icon: 'https://cdn2.iconfinder.com/data/icons/avengers-filled/48/12_-_Spiderman_-_infinity_war_-_end_game_-_marvel_-_avengers_-_super_hero-512.png' },
      { value: 'ironman', name: 'Iron Man', icon: 'https://cdn2.iconfinder.com/data/icons/avengers-filled/48/02_-_IRONMAN_-_infinity_war_-_end_game_-_marvel_-_avengers_-_super_hero-512.png' },
    ]"
  >
    &lt;template v-slot:singlelabel="{ value }">
      &lt;div class="multiselect-single-label">
        &lt;img class="character-label-icon" :src="value.icon"> {{ value.name }}
      &lt;/div>
    &lt;/template>

    &lt;template v-slot:option="{ option }">
      &lt;img class="character-option-icon" :src="option.icon"> {{ option.name }}
    &lt;/template>
  &lt;/Multiselect>
</pre
      >
    </div>

    <div class="example">
      <h3 id="example-8">#8 - Multiselect with custom label slot</h3>
      <div class="output">Data: {{ example8.value }}</div>
      <Multiselect v-model="example8.value" v-bind="example8">
        <template v-slot:multiplelabel="{ values }">
          <div class="multiselect-multiple-label">
            {{ values.length }} characters selected
          </div>
        </template>
      </Multiselect>
      <pre v-pre>
  &lt;Multiselect
    v-model="value"
    mode="multiple"
    placeholder="Select your characters"
    :options="{
      batman: 'Batman',
      robin: 'Robin',
      joker: 'Joker'
    }"
  >
    &lt;template v-slot:multiplelabel="{ values }">
      &lt;div class="multiselect-multiple-label">
        {{ values.length }} characters selected
      &lt;/div>
    &lt;/template>
  &lt;/Multiselect>
</pre
      >
    </div>

    <div class="example">
      <h3 id="example-9">#9 - Tags with custom tags slot</h3>
      <div class="output">Data: {{ example9.value }}</div>
      <Multiselect v-model="example9.value" v-bind="example9">
        <template v-slot:tag="{ option, handleTagRemove, disabled }">
          <div class="multiselect-tag is-user">
            <img :src="option.image" />
            {{ option.name }}
            <i
              v-if="!disabled"
              @click.prevent
              @mousedown.prevent.stop="handleTagRemove(option, $event)"
            ></i>
          </div>
        </template>

        <template v-slot:option="{ option }">
          <img class="user-image" :src="option.image" /> {{ option.name }}
        </template>
      </Multiselect>
      <pre v-pre>
  &lt;template>
    &lt;Multiselect
      v-model="value"
      mode="tags"
      placeholder="Select employees"
      trackBy="name"
      label="name"
      :search="true"
      :options="[
        { value: 'judy', name: 'Judy', image: 'https://randomuser.me/api/portraits/med/women/1.jpg' },
        { value: 'jane', name: 'Jane', image: 'https://randomuser.me/api/portraits/med/women/2.jpg' },
        { value: 'john', name: 'John', image: 'https://randomuser.me/api/portraits/med/men/1.jpg' },
        { value: 'joe', name: 'Joe', image: 'https://randomuser.me/api/portraits/med/men/2.jpg' }
      ]"
    >
       &lt;template v-slot:tag="{ option, handleTagRemove, disabled }">
         &lt;div class="multiselect-tag is-user">
           &lt;img :src="option.image">
           {{ option.name }}
           &lt;i
             v-if="!disabled"
             @click.prevent
             @mousedown.prevent.stop="handleTagRemove(option, $event)"
           />
         &lt;/div>
       &lt;/template>
    &lt;/Multiselect>
  &lt;/template>
  
  &lt;style>
    .multiselect-tag.is-user {
      padding: 5px 8px;
      border-radius: 22px;
      background: #35495e;
      margin: 3px 3px 8px;
    }

    .multiselect-tag.is-user img {
      width: 18px;
      border-radius: 50%;
      height: 18px;
      margin-right: 8px;
      border: 2px solid #ffffffbf;
    }

    .multiselect-tag.is-user i:before {
      color: #ffffff;
      border-radius: 50%;;
    }

    .user-image {
      margin: 0 6px 0 0;
      border-radius: 50%;
      height: 22px;
    }
  &lt;/style>
</pre
      >
    </div>
  </div>
</template>
<style>
const app = Vue.createApp({
  data: () => ({
    example1: {
      value: 0,
      options: ['Batman', 'Robin', 'Joker']
    },
    example2: {
    	mode: 'multiple',
      value: ['robin'],
      options: {
        batman: 'Batman',
        robin: 'Robin',
        joker: 'Joker'
      }
    },
    example3: {
    	mode: 'multiple',
      value: [],
      options: [
        { value: 'batman', label: 'Batman' },
        { value: 'robin', label: 'Robin', disabled: true },
        { value: 'joker', label: 'Joker' },
      ]
    },
    example4: {
    	mode: 'tags',
      value: ['batman'],
      options: [
        { value: 'batman', label: 'Batman' },
        { value: 'robin', label: 'Robin' },
        { value: 'joker', label: 'Joker' },
      ],
      searchable: true,
      createTag: true
    },
    example5: {
      value: null,
      placeholder: 'Choose a programming language',
      filterResults: false,
      minChars: 1,
      resolveOnLoad: false,
      delay: 0,
      searchable: true,
      options: async (query) => {
        return await fetchLanguages(query)
      }
    },
    example6: {
    	mode: 'tags',
      value: [],
      placeholder: 'Choose your stack',
      filterResults: false,
      minChars: 1,
      resolveOnLoad: false,
      delay: 0,
      searchable: true,
      options: async (query) => {
        return await fetchLanguages(query)
      }
    },
    example7: {
      value: null,
      placeholder: 'Select your character',
      label: 'name',
			options: [
        { value: 'captainamerica', name: 'Captain America', icon: 'https://cdn2.iconfinder.com/data/icons/avengers-filled/48/03_-_Captain_America_-_infinity_war_-_end_game_-_marvel_-_avengers_-_super_hero-512.png' },
        { value: 'spiderman', name: 'Spiderman', icon: 'https://cdn2.iconfinder.com/data/icons/avengers-filled/48/12_-_Spiderman_-_infinity_war_-_end_game_-_marvel_-_avengers_-_super_hero-512.png' },
        { value: 'ironman', name: 'Iron Man', icon: 'https://cdn2.iconfinder.com/data/icons/avengers-filled/48/02_-_IRONMAN_-_infinity_war_-_end_game_-_marvel_-_avengers_-_super_hero-512.png' },
      ]
    },
    example8: {
    	mode: 'multiple',
      value: null,
      placeholder: 'Select your characters',
      options: {
        batman: 'Batman',
        robin: 'Robin',
        joker: 'Joker'
      }
    },
    example9: {
      mode: 'tags',
      value: [],
      placeholder: 'Select employees',
      search: true,
      trackBy: 'name',
      label: 'name',
      options: [
        { value: 'judy', name: 'Judy', image: 'https://randomuser.me/api/portraits/med/women/1.jpg' },
        { value: 'jane', name: 'Jane', image: 'https://randomuser.me/api/portraits/med/women/2.jpg' },
        { value: 'john', name: 'John', image: 'https://randomuser.me/api/portraits/med/men/1.jpg' },
        { value: 'joe', name: 'Joe', image: 'https://randomuser.me/api/portraits/med/men/2.jpg' },
      ]
    }
  })
})

const fetchLanguages = async (query) => {
  // From: https://www.back4app.com/database/paul-datasets/list-of-all-programming-languages/get-started/javascript/rest-api/fetch?objectClassSlug=dataset

  let where = ''

  if (query) {
    where = '&where=' + encodeURIComponent(JSON.stringify({
      "ProgrammingLanguage": {
        "$regex": `${query}|${query.toUpperCase()}|${query[0].toUpperCase() + query.slice(1)}`
      }
    }))
  }

  const response = await fetch(
    'https://parseapi.back4app.com/classes/All_Programming_Languages?order=ProgrammingLanguage&keys=ProgrammingLanguage' + where,
    {
      headers: {
        'X-Parse-Application-Id': 'XpRShKqJcxlqE5EQKs4bmSkozac44osKifZvLXCL', // This is the fake app's application id
        'X-Parse-Master-Key': 'Mr2UIBiCImScFbbCLndBv8qPRUKwBAq27plwXVuv', // This is the fake app's readonly master key
      }
    }
  );

  const data = await response.json(); // Here you have the data that you need

  return data.results.map((item) => {
    return { value: item.ProgrammingLanguage, label: item.ProgrammingLanguage }
  })
}

app.component('Multiselect', VueformMultiselect)
app.mount('#app')
</style>
