<template>
    <v-card class="skeleton-loader">
      <v-container fill-height>
        <v-row align="center" justify="center">
          <v-avatar size="200" class="mx-auto">
            <div class="skeleton-avatar"></div>
          </v-avatar>
        </v-row>
      </v-container>
      <v-card-title class="skeleton-title"></v-card-title>
      <v-card-subtitle class="skeleton-subtitle"></v-card-subtitle>
      <v-card-actions class="justify-center">
        <div class="skeleton-button"></div>
      </v-card-actions>
    </v-card>
  </template>
  
  <script>
  export default {
    name: 'SkeletonLoader',
  };
  </script>
  
  <style scoped>
  .skeleton-loader {
    margin-bottom: 20px;
    padding: 6%;
    background: rgba(10, 20, 10, 0.90);
    border-radius: 8px;
    color: rgb(0 255 0 / 90%);
    box-shadow: 0 8px 10px -5px rgba(0, 0, 0, 0.2), 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12);
  }
  
  .skeleton-avatar {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
    animation: shimmer 1.5s infinite;
  }
  
  .skeleton-title {
    width: 80%;
    height: 20px;
    margin: 10px auto;
    background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
    animation: shimmer 1.5s infinite;
  }
  
  .skeleton-subtitle {
    width: 60%;
    height: 15px;
    margin: 5px auto;
    background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
    animation: shimmer 1.5s infinite;
  }
  
  .skeleton-button {
    width: 50%;
    height: 30px;
    margin: 10px auto;
    background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
    animation: shimmer 1.5s infinite;
  }
  
  @keyframes shimmer {
    0% {
      background-position: -200px 0;
    }
    100% {
      background-position: 200px 0;
    }
  }
  </style>