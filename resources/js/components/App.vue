<template>
    <div id="app">
      <HeaderComponent />
      <div class="main">
          <UrlComponent />
      </div>
    </div>
  </template>
  
  <script>
  import HeaderComponent from './HeaderComponent.vue';
  import UrlComponent from './UrlComponent.vue';
  
  export default {
    components: {
      HeaderComponent,
      UrlComponent
    },
    mounted() {
      console.log('Component mounted.');
    }
  };
  </script>
  
  <style>
  body, html, #app {
    margin: 0;
    padding: 0;
    height: 100%;
  }
  
  .main {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: calc(70vh - 120px);
  }
  </style>
  