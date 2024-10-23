// import './bootstrap';
// import './config.js';
// import '../scss/app.scss';
// import * as jQuery from 'jquery';
// window.$ = window.jQuery
// window.jQuery = window.jQuery
// import * as bootstrap from 'bootstrap'
// import './jquery.js';
// import * as bootstrap from './bootstrap.js'
import '../vendor/fonts/boxicons.css';
import '../vendor/css/core.css';
import '../vendor/css/theme-default.css';
import '../css/demo.css';
import '../vendor/libs/perfect-scrollbar/perfect-scrollbar.css';
import '../vendor/css/pages/page-auth.css';
import '../vendor/libs/apex-charts/apex-charts.css';
import '../css/cropper.min.css';
import '../css/jquery.dataTables.min.css';
// import './popper.js';
import './helpers.js';
import './perfect-scrollbar.js';
import './menu.js';
import './echo.js'
// import './apexcharts.js';
// import './main.js';
// import './dashboards-analytics.js';
// import './masonry.js';
// import * as jqueryExports from "jquery";
// window.$ = jqueryExports.default;
// window.bootstrap = bootstrap;
import Cropper from 'cropperjs';
window.Cropper = Cropper;
const config = {
    colors: {
      primary: '#696cff',
      secondary: '#8592a3',
      success: '#71dd37',
      info: '#03c3ec',
      warning: '#ffab00',
      danger: '#ff3e1d',
      dark: '#233446',
      black: '#000',
      white: '#fff',
      body: '#f4f5fb',
      headingColor: '#566a7f',
      axisColor: '#a1acb8',
      borderColor: '#eceef1'
    }
  };
window.config = config;
