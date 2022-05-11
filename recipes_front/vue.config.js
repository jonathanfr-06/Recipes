const { defineConfig } = require('@vue/cli-service')



module.exports = defineConfig({
  transpileDependencies: true,
  devServer: {
    compress: true,
    proxy: {
      '^/api': {
        target: 'http://localhost:8000',
        changeOrigin: true
      },
    }
  }
})
