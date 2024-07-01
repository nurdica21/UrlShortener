<template>
    <div id="formContainer">
      <form @submit.prevent="shortenUrl">
        <label for="url">Enter URL:</label>
        <input type="text" id="url" v-model="url" required>
        <button type="submit">Shorten URL</button>
      </form>
      <div class="textPosition" v-if="shortUrl">
        <p>Shortened URL: <a :href="shortUrl">{{ shortUrl }}</a></p>
      </div>
      <div class="textPosition" style="color: red;" v-if="error">
            Error: {{ error }}
        </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    name: 'UrlComponent',
    data() {
      return {
        url: '',
        shortUrl: '',
        error:''
      };
    },
    methods: {
      
      async shortenUrl() {
            try {
                const response = await axios.post('/api/shorten', { url: this.url });
                this.shortUrl = response.data.short_url;
                this.error = '';
                this.url = ''
            } catch (error) {
                if (error.response.status === 400) {
                    this.error = error.response.data.error;
                } else {
                    this.error = 'An error occurred while shortening the URL.';
                }
                this.shortUrl = '';
            }
        }
    }
  };
  </script>
  
  <style scoped>
  form {
    margin: 20px 0;
  }
  
  label {
    display: block;
    margin-bottom: 8px;
  }
  
  input {
    width: 400px;
    padding: 8px;
    margin-right: 10px;
  }
  
  button {
    padding: 8px 12px;
  }
  
  div {
    margin-top: 20px;
  }
  
  a {
    color: #3498db;
    text-decoration: none;
  }

  .transparent{
    opacity: 0;
  }

  .textPosition{
    position: absolute;
    top: 100px;
  }

  #formContainer{
    position: relative;
  }

  </style>
  