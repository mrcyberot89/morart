import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './routes/routes'

function initializeApp() {
  const container = document.getElementById('app')
  
  // Unmount existing app jika ada
  if (container && container.__vue_app__) {
    container.__vue_app__.unmount()
  }
  
  // Create dan mount app baru
  const app = createApp(App)
  app.use(router)
  app.mount('#app')
  
  return app
}
initializeApp();
