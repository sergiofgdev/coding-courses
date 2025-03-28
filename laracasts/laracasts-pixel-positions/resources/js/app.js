import './bootstrap';

// Esto me permite acceder a todas las imagenes en la carpeta imagenes en resources cuando haga npm run prod
import.meta.glob([
    '../images/**'
]);
