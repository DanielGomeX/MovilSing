<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


#$route['default_controller'] = 'principal';
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logout']='principal/logout';

#Plan Ruta
$route['planruta']='PlanRutaController/index';
$route['cliente']='PlanRutaController/mostrarDatosCliente';
$route['visitas']='PlanRutaController/mostrarVisitas';
$route['entregas']='PlanRutaController/mostrarEntregas';
$route['saldos']='PlanRutaController/mostrarSaldos';
$route['cobranza']='PlanRutaController/mostrarCobranza';
$route['registrar_cobranza']='PlanRutaController/registrarCobranza';
$route['pedidos']='PlanRutaController/pedidosCliente';
$route['pedido']='PlanRutaController/nuevo';
$route['agregar']='PlanRutaController/agregarPartida';
$route['partidas']='PlanRutaController/mostrarPartidas';
$route['eliminar/(:num)']='PlanRutaController/eliminarPartida/$1';
$route['buscar']='PlanRutaController/buscarProducto';
$route['resumen']='PlanRutaController/ResumenPedido';
$route['consignaciones']='PlanRutaController/mostrarConsignaciones';
$route['retomar/(:any)']='PlanRutaController/retomarPedido/$1';

#Prospectos
$route['prospectos']='ProspectosController/index';
$route['prospectoCaptura']='ProspectosController/nuevoProspecto';
$route['registrarProspecto']='ProspectosController/registrarProspecto';
$route['actualizarProspecto']='ProspectosController/actualizarProspecto';
$route['prospectoDatos/(:num)']='ProspectosController/mostrarDatosProspecto/$1';
$route['eliminarProspecto/(:num)']='ProspectosController/eliminarProspecto/$1';


#Reportes
$route['liberados']='ReportesController/pedidosLiberados';
$route['retenidos']='ReportesController/pedidosRetenidos';
$route['pendientes']='ReportesController/pedidosPendientes';
$route['visitas_periodo']='ReportesController/visitasPeriodo';
$route['cobranza_periodo']='ReportesController/cobranzaPeriodo';
$route['back_order']='ReportesController/backOrder';

#Devoluciones
#$route['devoluciones']='DevolucionesController/index';
$route['devoluciones']='DevolucionesController/devolucionesPorUsuario';
$route['devolucionCaptura']='DevolucionesController/factura';
$route['devolucionEditar/(:any)']='DevolucionesController/mostrarDatosDevolucion/$1';
$route['devolucionEliminar/(:any)']='DevolucionesController/eliminarDevolucionCaptura/$1';
$route['datosFactura/(:any)']='DevolucionesController/mostrarDatosFactura/$1';


#otros
#$route['ajax']='PlanRutaController/coordeneas';
#$route['ajax/(:any)']='ProspectosController/asentamientos/$1';