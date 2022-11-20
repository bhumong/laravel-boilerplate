import './bootstrap';
import '../css/app.css';

import Alpine from 'alpinejs';
import * as bootstrap from 'bootstrap';
import jQuery from 'jquery';
import dt from 'datatables.net';
import './adminKit';

window.Alpine = Alpine;

Alpine.start();

window.$ = jQuery;
window.bootstrap = bootstrap;
window.dt = dt;