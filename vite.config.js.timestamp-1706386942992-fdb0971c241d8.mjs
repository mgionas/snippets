// vite.config.js
import { defineConfig } from "file:///var/www/snippets.testtheweb.page/node_modules/vite/dist/node/index.js";
import laravel from "file:///var/www/snippets.testtheweb.page/node_modules/laravel-vite-plugin/dist/index.js";
import vue from "file:///var/www/snippets.testtheweb.page/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import fs from "fs";
var host = "snippets.testtheweb.page";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/app.css",
        "resources/js/app.js"
      ],
      refresh: true
    }),
    vue({
      template: {
        base: null,
        includeAbsolute: false
      }
    })
  ],
  server: {
    host,
    hmr: { host },
    https: {
      key: fs.readFileSync(`/etc/ssl/testtheweb/private.key`),
      cert: fs.readFileSync(`/etc/ssl/testtheweb/certificate.crt`)
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCIvdmFyL3d3dy9zbmlwcGV0cy50ZXN0dGhld2ViLnBhZ2VcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIi92YXIvd3d3L3NuaXBwZXRzLnRlc3R0aGV3ZWIucGFnZS92aXRlLmNvbmZpZy5qc1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vdmFyL3d3dy9zbmlwcGV0cy50ZXN0dGhld2ViLnBhZ2Uvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tICd2aXRlJztcbmltcG9ydCBsYXJhdmVsIGZyb20gJ2xhcmF2ZWwtdml0ZS1wbHVnaW4nO1xuaW1wb3J0IHZ1ZSBmcm9tICdAdml0ZWpzL3BsdWdpbi12dWUnXG5pbXBvcnQgZnMgZnJvbSAnZnMnO1xuXG5cbmNvbnN0IGhvc3QgPSAnc25pcHBldHMudGVzdHRoZXdlYi5wYWdlJztcblxuXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoe1xuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogW1xuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvY3NzL2FwcC5jc3MnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvanMvYXBwLmpzJ1xuICAgICAgICAgICAgXSxcbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgICAgIH0pLFxuICAgICAgICB2dWUoe1xuICAgICAgICAgICAgdGVtcGxhdGU6e1xuICAgICAgICAgICAgICAgIGJhc2U6IG51bGwsXG4gICAgICAgICAgICAgICAgaW5jbHVkZUFic29sdXRlOiBmYWxzZVxuICAgICAgICAgICAgfVxuICAgICAgICB9KVxuICAgIF0sXG4gICAgc2VydmVyOiB7XG4gICAgICAgIGhvc3QsXG4gICAgICAgIGhtcjogeyBob3N0IH0sXG4gICAgICAgIGh0dHBzOiB7XG4gICAgICAgICAgICBrZXk6IGZzLnJlYWRGaWxlU3luYyhgL2V0Yy9zc2wvdGVzdHRoZXdlYi9wcml2YXRlLmtleWApLFxuICAgICAgICAgICAgY2VydDogZnMucmVhZEZpbGVTeW5jKGAvZXRjL3NzbC90ZXN0dGhld2ViL2NlcnRpZmljYXRlLmNydGApLFxuICAgICAgICB9XG4gICAgfVxufSk7XG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQXFSLFNBQVMsb0JBQW9CO0FBQ2xULE9BQU8sYUFBYTtBQUNwQixPQUFPLFNBQVM7QUFDaEIsT0FBTyxRQUFRO0FBR2YsSUFBTSxPQUFPO0FBR2IsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDeEIsU0FBUztBQUFBLElBQ0wsUUFBUTtBQUFBLE1BQ0osT0FBTztBQUFBLFFBQ0g7QUFBQSxRQUNBO0FBQUEsTUFDSjtBQUFBLE1BQ0EsU0FBUztBQUFBLElBQ2IsQ0FBQztBQUFBLElBQ0QsSUFBSTtBQUFBLE1BQ0EsVUFBUztBQUFBLFFBQ0wsTUFBTTtBQUFBLFFBQ04saUJBQWlCO0FBQUEsTUFDckI7QUFBQSxJQUNKLENBQUM7QUFBQSxFQUNMO0FBQUEsRUFDQSxRQUFRO0FBQUEsSUFDSjtBQUFBLElBQ0EsS0FBSyxFQUFFLEtBQUs7QUFBQSxJQUNaLE9BQU87QUFBQSxNQUNILEtBQUssR0FBRyxhQUFhLGlDQUFpQztBQUFBLE1BQ3RELE1BQU0sR0FBRyxhQUFhLHFDQUFxQztBQUFBLElBQy9EO0FBQUEsRUFDSjtBQUNKLENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
