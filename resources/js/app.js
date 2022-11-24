import './bootstrap';
import '../css/app.css';

import Alpine from 'alpinejs';
import jQuery from 'jquery';
import dt from 'datatables.net';
import 'admin-lte/node_modules/bootstrap/dist/js/bootstrap.bundle'
import 'admin-lte';

window.Alpine = Alpine;

Alpine.start();

window.$ = jQuery;
window.dt = dt;