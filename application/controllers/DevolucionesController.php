<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DevolucionesController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('DevolucionesModel');

        #cargamos la libreria para validación de formularios de forma global
        #ya que varios métodos mandan llamar al mismo formulario
        $this->load->library('form_validation');
        $this->load->model('GlobalModel');

        #si el usuario no está autenticado, se redirecciona para que se registre
        if($this->session->logged_in<>"SI")
        {
             redirect('','refresh');
        }
    }


    /**************** PRUEBAS WEBSERVICE **********************/

    public function localWS($datos) {

        //$url="http://192.168.1.22/PickingWS/WebService1.asmx?wsdl";
        $url="http://localhost:6963/WebService1.asmx?wsdl";

        $client = new SoapClient($url);

        //$fcs = $client->__getFunctions();
        //var_dump($fcs);

        $res = new StdClass();

        /*
        $res = $client->SolicitarGuiasDevolucion(array('pIdAnomalia' => '3609',
                                                       'pTransportista' => 'EF',
                                                       'pOficina' => '1',
                                                       'pRemitente' => $this->usuaio;,
                                                       'pDireccion1' => 'Gregorio Ruiz Velazco',
                                                       'pDireccion2' => '201',
                                                       'pDireccion3' => 'Gregorio Ruiz Velazco',
                                                       'pCiudad' => 'Aguascalientes',
                                                       'pEstado' => 'Aguascalientes',
                                                       'pCp' => '20290',
                                                       'pPaquetes' => '1',
                                                       'pPeso' => '1',
                                                       'pAtencionA' => 'Rocio Puentes',
                                                       'pTel1' => '4491056610',
                                                       )
                                                );
        */

        $res = $client->SolicitarGuiasDevolucion($datos);

        if ($res)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**************** FIN PRUEBAS WEBSERVICE **********************/



    /**
     * Muestra el Listado de aquellas devoluciones registradas por el usuario que estan con alguno de los siguientes status
     * POR ENVIAR, CAPTURA, REV.VENDEDOR, REV.SUPERVISOR, REV.DIVISIONAL, REV.DIR.COMERCIAL
     */
    public function devolucionesPorUsuario() {
        $datos['titulo'] = 'Mis Devoluciones';

        $datos['devoluciones'] = $this->DevolucionesModel->obtenerDevolucionesPendientes($this->session->usuario);

        $datos['vista'] = 'devoluciones/devoluciones';

        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Ejecuta la eliminación del registro seleccionado
     */
    public function EliminarDevolucionCaptura($idDevolucion) {

        $respuesta = $this->DevolucionesModel->EliminarDevolucionCaptura($idDevolucion);

        if ($respuesta==1) {
            $this->devolucionesPorUsuario();
        }
        else{
            $datos['mensaje']="Ocurrio un error al tratar de eliminar devolución en captura.";
            $datos['vista'] = 'errors/error';
            $this->load->view('plantillas/master_page', $datos);
        }
    }

    /**
     * Busca la factura en la base de datos, en caso de que exista, llama al método que muestra los datos correspondientes,
     * caso contrario manda aviso
     */
    public function buscarFactura() {

        $factura=$this->input->post('txtBuscar');
        $usuario=$this->session->usuario;

        $datos_factura = $this->DevolucionesModel->obtenerDatosFactura($factura, $usuario);

        //contamos cuantos registros contiene el array de la consulta previa
        $count = count($datos_factura);

        //si existe al menos un registro, significa que se encontrontraon los datos de la factura como enviada mediante el SING
        if ($count>0)
        {
            $this->mostrarDatosFactura($factura, $datos_factura);
        }
        else
        {
            $datos['mensaje']="Número de facura: no encontrado, no pertenece a tu zona de ventas o aun no tiene fecha de acuse de recibo registrada. Favor de verificar.";
            $datos['vista'] = 'errors/aviso';
            $datos['link_regresar'] = 'devoluciones';
            $this->load->view('plantillas/master_page', $datos);
        }
    }

    /**
     * muestra los datos generales de la factura a la que se desea realizar la devolución, siempre y cuendo la factura
     * pertenezca al usuario logeado
     */
    private function mostrarDatosFactura($factura,$datos_factura) {
        $datos['titulo'] = 'Datos Factura';

        $datos['factura']=$factura;
        $datos['invcDate']=$datos_factura[0]['InvcDate'];
        $datos['referenciaEnviarJunto']=$datos_factura[0]['ReferenciaEnviarJunto'];
        $datos['fechaEnvio']=$datos_factura[0]['FechaEnvio'];
        $datos['custid']=$datos_factura[0]['CustID'];
        $datos['cliente']=$datos_factura[0]['Cliente'];
        $datos['transportista']=$datos_factura[0]['Transportista'];
        $datos['fechaAcuseRecibo']=$datos_factura[0]['FechaAcuseRecibo'];
        $datos['totPaquetes']=$datos_factura[0]['TotPaquetes'];
        $datos['pesoPaquetes']=$datos_factura[0]['PesoPaquetes'];
        $datos['monto']=$datos_factura[0]['Monto'];
        $datos['monto2']=$datos_factura[0]['Monto2'];

        $datos['vista'] = 'devoluciones/datos_factura';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * pendiente
     */
    private function mostrarDatosFacturaSL($factura,$datos_factura) {
        $datos['titulo'] = 'Datos Factura SL';

        $datos['factura']=$factura;
        $datos['shipperid']=$datos_factura[0]['ShipperID'];
        $datos['custid']=$datos_factura[0]['CustID'];
        $datos['cliente']=$datos_factura[0]['Cliente'];
        $datos['invcDate']=$datos_factura[0]['InvcDate'];
        $datos['zona']=$datos_factura[0]['SlsperID'];
        $datos['vendedor']=$datos_factura[0]['Vendedor'];
        $datos['monto']=$datos_factura[0]['TotMerch'];
        $datos['monto2']=$datos_factura[0]['TotTax'];

        //Si la zona de ventas es igual al usuario logeado, entonces mostramos los datos de la factura
        if(trim($datos['zona'])==trim($this->session->usuario))
        {
            $datos['vista'] = 'devoluciones/datos_factura_SL';
            $this->load->view('plantillas/master_page', $datos);
        }
        else {
            $datos['mensaje']="Esta factura no pertenece a tu zona de ventas.";
            $datos['vista'] = 'errors/aviso';
            $datos['link_regresar'] = 'devoluciones';
            $this->load->view('plantillas/master_page', $datos);
        }
    }


    /**
     * Guarda registro de devolución de la factura seleccionada en la base de datos y crea las variables se session
     * Devolucion y Factura, las cuales será usadas posteriormente
     */
    public function registrarDevolucion() {

        //Datos de entrada
        $factura = $this->input->post('factura');
        $emailFirmaCte = $this->input->post('emailConfirmacion');
        $EnAlma = true;
        $Usuario = $this->session->usuario;

        $parametrosDatosDevolucion=[$factura,
                                    $emailFirmaCte,
                                    $EnAlma,
                                    $Usuario
                                ];

        #ejecutamos query
        $respuesta=$this->DevolucionesModel->registrarDevolucion($parametrosDatosDevolucion);

        $folio=$respuesta[0]['NoAnomalia'];

        #Creamos las variables de sesión referentes a la devolución una vez registrada en la BD
        $_SESSION['devolucion']=$folio;
        $_SESSION['factura']=$factura;

        $noDevolucion=$folio;
        $factura=$factura;

        $this->mostrarDatosDevolucion($folio);
    }

    /**
     *  Muestra los datos generales (encabezado) del registro de la devolución a la factura correpondiente
     */
    public function mostrarDatosDevolucion($idAnomalia) {
        $datos['titulo'] = 'Datos Devolución';
        $datos['vista'] = 'devoluciones/captura_devolucion';

        $resp=$this->DevolucionesModel->obtenerDatosDevolucion($idAnomalia);

        $datos['anomalia'] = $idAnomalia;
        $datos['invcNbr']=$resp[0]['InvcNbr'];
        $datos['invcDate']=$resp[0]['InvcDate'];
        $datos['custid']=$resp[0]['CustID'];
        $datos['cliente']=$resp[0]['Cliente'];
        $datos['status']=$resp[0]['Status'];
        $datos['totIva']=$resp[0]['TotIva'];
        $datos['subTotal']=$resp[0]['SubTotal'];

        $datos['enAlma']=$resp[0]['EnAlma'];
        $datos['firmaCteAutorizaEnvio']=$resp[0]['FirmaCteAutorizaEnvio'];
        $datos['emailFirmaCteEnvio']=$resp[0]['EmailFirmaCteEnvio'];
        $datos['fechaSolGuias']=$resp[0]['FechaSolGuias'];

         #asignamos las variables de sesión referentes a la devolución previamente registrada en la BD
        $_SESSION['devolucion']=$datos['anomalia'];
        $_SESSION['factura']=$datos['invcNbr'];

        $datos['productos_devolucion'] =$this->DevolucionesModel->obtenerDetalleProductosDevolucion($this->session->devolucion);

        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Muestra los productos pertenecientes a la factura a devolver
     */
    public function agregarProductoParaDevolucion() {
        $datos['titulo'] = 'Agregar producto';
        $datos['vista'] = 'devoluciones/agregar_producto_devolucion';

        $datos['productos_factura'] =$this->DevolucionesModel->obtenerDatosProductosFactura($this->session->factura);

        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Muestra los productos asociados de la factura a devolver, quitando aquellos que fueron agregados previamente para devolución
     */
    public function mostrarDatosProductoDevolver($producto) {

        $factura=$this->session->factura;

        $datos['vista'] = 'devoluciones/agregar_producto_devolucion';
        $datos['producto'] =$this->DevolucionesModel->obtenerDatosProductoParaDevolucion($factura,$producto);
        $datos['articulo']=$datos['producto'][0]['InvtId'];//obtenemos el valor del campo artículo del registro 0 del arreglo datos
        $datos['cantidadSurtida']=$datos['producto'][0]['CantSurt'];//obtenemos el valor del campo cantidad surtida del registro 0 del arreglo datos

        $datos['productos_factura'] =$this->DevolucionesModel->obtenerDatosProductosFactura($this->session->factura);
        $datos['producto_especie'] =$this->DevolucionesModel->obtenerDatosProductoEspecieParaDevolucion($factura,$producto);
        $datos['listaNotasCredito']=$this->DevolucionesModel->obtenerCausasNotasCredito();

        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Guarda los datos generales del producto que será devuelto
     */
    public function registrarProductoDevolucion(){

        $idAnomalia=$this->session->devolucion;
        $factura = $this->session->factura;
        $producto = $this->input->post('articulo');
        $cantidad = $this->input->post('cantidad');
        $causa = $this->input->post('causa');
        $observaciones = $this->input->post('motivo');

        $datosProductoDevolucion=[
                     $idAnomalia,
                     $factura,
                     $producto,
                     $cantidad,
                     $causa,
                     $observaciones
                    ];

        #ejecutamos query para registrar los datos de entrada a la base de datos
        $respuesta=$this->DevolucionesModel->registrarProductoParaDevolucion($datosProductoDevolucion);

        if ($respuesta==1) {
            $this->agregarProductoParaDevolucion();
        }
        else{
            $datos['mensaje']="Ocurrio un error al tratar de registrar el producto para devolución.";
            $datos['vista'] = 'errors/error';
            $this->load->view('plantillas/master_page', $datos);
        }
    }

    /**
     * Cambia de status la solicitud para que pase a revisión por el supervisor y enviía notificación correspondiente por correo
     */
    public function cambiarStatus() {

        $devolucion=$this->session->devolucion;
        $usuario=$this->session->usuario;

        //Datos de entrada del formulario
        $status= $this->input->post('nuevoStatus');
        $observaciones= $this->input->post('observaciones');

        //ejecutamos query para cambiar de status y pase a revisión del supervisor
        $result=$this->DevolucionesModel->cambiarStatus($devolucion, $status, $observaciones, $usuario);

        $result=1;

        if ($result==1) {

            //obtenemos el email asignado al supervisor del usuario
            $emailSupervisor=$this->GlobalModel->obtenerEmailSupervisor($usuario);
            $correoSupervisor=$emailSupervisor[0]['Email'];

            //obtenemos el email del usuario
            $emailUsuario=$this->GlobalModel->obtenerEmailUsuario($usuario);
            $correoUsuario=$emailUsuario[1]['Email'];

            //obtenemos los destinatarios administrativos para notificación del envío
            //

            //obtenemos los datos registrados de la devolución para anexarlos como información al correo que se enviará
            $resp=$this->DevolucionesModel->obtenerDatosDevolucion($devolucion);
            $data['subTotal']=$resp[0]['SubTotal'];
            $data['custid']=$resp[0]['CustID'];;
            $data['cliente']=$resp[0]['Cliente'];;
            $data['observaciones']=$observaciones;

            $destinatarios = array('omar.flores@hecort.com'); //esto es para pruebas
            //$destinatarios = array($correoSupervisor, $correoUsuario);

            /* enviar email */
            $this->load->library('email'); // Note: no $config param needed
            $this->email->from('tecnologias@hecort.com');
            $this->email->to($destinatarios);
            $this->email->subject('Reclamacion/Devolución por autorizar, FOLIO: '.$this->session->devolucion);
            $this->email->message($this->load->view('plantillas/Devoluciones_aviso_supervisor', $data, true));
            $this->email->send();
            redirect('devoluciones');
        }
        else{
            $datos['mensaje']="Ocurrio un error al enviar al supervisor para autorización.";
            $datos['vista'] = 'errors/aviso';
            $datos['link_regresar'] = 'devoluciones';
            $this->load->view('plantillas/master_page', $datos);
        }
    }

    /**
     * Muestra los productos que se tienen registrados para devolucion
     */
    public function mostrarProductosDevolucion($status) {
        $datos['titulo'] = 'Productos para Devolución';
        $datos['vista'] = 'devoluciones/detalle_productos_devolucion';
        $datos['status'] =  $status;
        $datos['productos_devolucion'] =$this->DevolucionesModel->obtenerDetalleProductosDevolucion($this->session->devolucion);
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Muestra los productos que se surtieron en la factura a devolver
     */
    public function mostrarProductosFactura() {

        $datos['titulo'] = 'Productos Factura';
        $datos['vista'] = 'devoluciones/productos_factura_devolucion';
        $datos['productos_factura'] =$this->DevolucionesModel->obtenerDatosProductosFactura($this->session->factura);
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Elimina el producto registrado previamente para devolución, posteriormente vuelve a cargar los productos registrados
     * para devolucion ya sin  el producto eliminado
     */
    public function eliminarProductoParaDevolucion($idDetalleDevolucion) {

        $resp=$this->DevolucionesModel->eliminarProductoParaDevolucion($idDetalleDevolucion, $this->session->devolucion);

        $this->mostrarDatosDevolucion($this->session->devolucion);
    }

    /**
     * Se verifica en la base de datos si ya se cuenta previamente con un registro de  solicitud de guia, en caso de que si
     * se redirecciona a la vista para registro de envio, en caso contrario, se redirecciona a la vista para solicitar guias.
     */
    public function obtenerDatosEnvioAanomalia() {

        $devolucion=$this->session->devolucion;

        $respuesta = $this->DevolucionesModel->obtenerDatosEnvioAanomalia($devolucion);

        //contamos cuantos registros contiene el array de la consulta previa
        $count = count($respuesta);

        //si existe al menos un registro, significa que se encontrontraon los datos de la factura como enviada mediante el SING
        if ($count>0)
        {
            //obtenemos el transportista con el que se solicitaron las guias para la devolucion
            $transportista=$respuesta[0]['Transportista'];

            //guardamos el transportista en una varibale de session temporal, ya que solo se utilizara mientras se registran los paquetes
            //esto se hace asi porque no se pueden usar variables staticas privadas en la clase debido a que pierden el valor al cargar el controlador
            //$this->session->set_flashdata('item', $transportista);
            $_SESSION['guiasTransportista']=$transportista;

            // Ya existe un registro previo de solicitud de guias
            $this->mostrarPaquetesEnvio();
        }
        else
        {
            // No existe previamente un registro de solicitud de guias, por lo cual hay que realizar la solicitud primero
            $this->solicitarGuias();
        }
    }

    /**
     * Redirecciona al usuario a la vista para capturar una nueva solicitud de guias
     */
    public function solicitarGuias(){
            $datos['titulo'] = 'Solicitar Guias';
            $datos['vista'] = 'devoluciones/solicitar_guias';
            $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Muestra los paquetes registrados con guia para devolución
     */
    public function mostrarPaquetesEnvio() {

        $datos['vista'] = 'devoluciones/registrar_paquete';

        $paquetes= $this->DevolucionesModel->obtenerPaquetesParaEnvio($this->session->devolucion);
        $total_paquetes=count($paquetes);

        $datos['paquetes'] = $paquetes;
        $datos['total_paquetes'] = $total_paquetes;

        // estas variables sirven para limpiar los datos del formulario cada vez que se registre un paquete
        //$datos['guia'] = 0;
        //$datos['peso'] = 0;

        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Valida que los datos para la solicitud de guias sean correctos, en caso de que no, se muestra aviso correspondiente
     */
    public function registrarGuiaDevolucion() {

        $datos['vista'] = 'Devoluciones/solicitar_guias';

        #Establecemos las reglas de validación
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        //$this->form_validation->set_rules('remitente','Remitente', 'required');
        $this->form_validation->set_rules('transportista', 'Transportista', 'required');
        $this->form_validation->set_rules('oficina', 'Oficina', 'required|numeric');
        $this->form_validation->set_rules('calle', 'Calle', 'required');
        $this->form_validation->set_rules('numero', 'Número', 'required|numeric');
        $this->form_validation->set_rules('colonia', 'Colonia', 'required');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');
        $this->form_validation->set_rules('cp', 'CP', 'required|numeric|exact_length[5]');
        $this->form_validation->set_rules('paquetes', 'paquetes', 'required|is_natural_no_zero|max_length[2]');
        //$this->form_validation->set_rules('tel1', 'Teléfono', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('atencion', 'Atención a', 'required');

        #Validamos el formulario, si es igual a false, entonces algún campo no cumple con las reglas establecidas
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('plantillas/master_page', $datos);
        } else {

            $devolucion=$this->session->devolucion;
            $remitente =  $this->input->post('remitente');
            $oficina =  $this->input->post('oficina');
            $calle = $this->input->post('calle');
            $numero = $this->input->post('numero');
            $colonia = $this->input->post('colonia');
            $ciudad = $this->input->post('ciudad');
            $estado = $this->input->post('estado');
            $cp =  $this->input->post('cp');
            $transportista =  $this->input->post('transportista');
            $paquetes = $this->input->post('paquetes');
            $peso =  $this->input->post('peso');
            $tel1 =  $this->input->post('tel1');
            $atenacionA =  $this->input->post('atencion');

            $parametrosGuia=[
                                $devolucion,
                                $oficina,
                                $remitente,
                                $calle,
                                $numero,
                                $colonia,
                                $ciudad,
                                $estado,
                                $cp,
                                $transportista,
                                $paquetes,
                                $peso,
                                $atenacionA,
                                $tel1,
                                '0' //tel2
                            ];

            #ejecutamos query
            $respuesta=$this->DevolucionesModel->registrarGuiaDevolucion($parametrosGuia);

            //Se invoca al WebService para poder generar las guias y enviarlas por correo al usuario
            $datosGuia = array('pNoAnomalia' => $devolucion,
                               'pCveTransportista' => $transportista,
                               'pOficina' => $oficina,
                               'pCalle' => $calle,
                               'pNumero' => $numero,
                               'pColonia' => $colonia,
                               'pCiudad' => $ciudad,
                               'pEstado' => $estado,
                               'pCp' => $cp,
                               'pPaquetes' => $paquetes,
                               'pAtencionA' => $atenacionA,
                               );

            $respuestaWS=$this->localWS($datosGuia);

            if ($respuestaWS==1) {
                //Si se guardó corretamenete el registro, entonces redireccionamos al usuaerio a la sección de Devoluciones
                redirect('devoluciones');
            }
            else{
                $datos['mensaje']="Ocurrio un error al tratar de guardar los datos para generar la guia, intentar nuevamente en unos minutos más, en caso de volver a ocurrir reportarlo a Sistemas.";
                $datos['vista'] = 'errors/error';
                $this->load->view('plantillas/master_page', $datos);
            }
        }
    }

    /**
     * Permite registrar el número de guia y peso al paquete que se devolverá
     */
    public function registrarPaquete() {
        /*

        $datos['vista'] = 'Devoluciones/registrar_paquete';

        #Establecemos las reglas de validación
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('guia','Guia', 'required|alpha_numeric|min_length[3]');
        $this->form_validation->set_rules('peso', 'Peso', 'required|numeric');

        #Validamos el formulario, si es igual a false, entonces algún campo no cumple con las reglas establecidas
        if ($this->form_validation->run() == FALSE) {

            //si ocurre un error al validar los datos de entrada, mostramos nuevamente los  paquetes registrados al momento
            $paquetes= $this->DevolucionesModel->obtenerPaquetesParaEnvio($this->session->devolucion);
            $total_paquetes=count($paquetes);

            $datos['paquetes'] = $paquetes;
            $datos['total_paquetes'] = $total_paquetes;
            $datos['guia'] = 1;
            $datos['peso'] = 1;

            $this->load->view('plantillas/master_page', $datos);
        } else {

            $devolucion=$this->session->devolucion;
            $guia = $this->input->post('guia');
            $peso = $this->input->post('peso');

            //obtenemos el transportista almacenado en la variable de sessión temporal con el que se solicitaron las guias para la devolucion
            $transportista=$this->session->guiasTransportista;

            /*
            $parametrosPaquete=[
                                0,
                                $devolucion,
                                $guia,
                                $transportista,
                                $peso,
                                0,
                                1
                            ];
            **

            $parametrosPaquete=[
                                $devolucion,
                                $guia,
                                $transportista,
                                $peso,
                            ];

            #ejecutamos query
            $respuesta=$this->DevolucionesModel->registrarPaquete($parametrosPaquete);


            if ($respuesta==1) {
               $this->mostrarPaquetesEnvio();
            }
            else{
                $datos['mensaje']="Ocurrio un error al tratar de agregar el paquete.";
                $datos['vista'] = 'errors/error';
                $this->load->view('plantillas/master_page', $datos);
            }
        }
        */

            $devolucion=$this->session->devolucion;
            $guia = $this->input->post('guia');
            $peso = $this->input->post('peso');

            //obtenemos el transportista almacenado en la variable de sessión temporal con el que se solicitaron las guias para la devolucion
            $transportista=$this->session->guiasTransportista;

            $parametrosPaquete=[
                                $devolucion,
                                $guia,
                                $transportista,
                                $peso,
                            ];

            #ejecutamos query
            $respuesta=$this->DevolucionesModel->registrarPaquete($parametrosPaquete);

            if ($respuesta==1) {
               $this->mostrarPaquetesEnvio();
            }
            else{
                $datos['mensaje']="Ocurrio un error al tratar de agregar el paquete.";
                $datos['vista'] = 'errors/error';
                $this->load->view('plantillas/master_page', $datos);
            }
    }

    /**
     * Permite eliminar un paquete previamente registrado para devolucion
     */
    public function eliminarPaquete($idGuia) {

        $devolucion=$this->session->devolucion;
        //$guia = $this->input->post('guia');
        //$peso = $this->input->post('peso');

        /*
        $parametrosPaquete=[
                            $idGuia,
                            $devolucion,
                            'NA',
                            'NA',
                            0,
                            0,
                            3
                        ];
        */

        $parametrosPaquete=[
                            $idGuia,
                            $devolucion
                        ];

        #ejecutamos query
        $respuesta=$this->DevolucionesModel->eliminarPaquete($parametrosPaquete);

        if ($respuesta==1) {
           $this->mostrarPaquetesEnvio();
        }
        else{
                $datos['mensaje']="Ocurrio un error al tratar de eliminar el paquete.";
                $datos['vista'] = 'errors/error';
                $this->load->view('plantillas/master_page', $datos);
        }
    }

    /**
     * Permite direccionar a la vista correspondiente donde se confirma el envio de la devolución
     * @return [type] [description]
     */
    public function confirmarEnvioDevolucion() {
        $datos['vista'] = 'Devoluciones/registrar_envio';
        $this->load->view('plantillas/master_page', $datos);
    }

    /**
     * Permite cambiar el status de la devolución a ENVIADA y manda correos de notificación correspondientes
     */
    public function registrarEnvioDevolucion() {

        $devolucion=$this->session->devolucion;
        $autorizacion = $this->input->post('autorizacion');
        $motivo = $this->input->post('motivo');
        $usuario=$this->session->usuario;

        $parametrosEnvio=[
                            $devolucion,
                            $autorizacion,
                            $motivo,
                            $usuario
                        ];


        #ejecutamos query
        $respuesta=$this->DevolucionesModel->registrarEnvio($parametrosEnvio);

        //$respuesta=1;

        if ($respuesta==1) {

            // obtenemos el email asignado al supervisor del usuario
            $emailSupervisor=$this->GlobalModel->obtenerEmailSupervisor($usuario);
            $correoSupervisor=$emailSupervisor[0]['Email'];

            // obtenemos el email del usuario
            $emailUsuario=$this->GlobalModel->obtenerEmailUsuario($usuario);
            $correoUsuario=$emailUsuario[1]['Email'];

            // obtenemos el email de los usuarios administrativos para notificación
            $emailAdminitrativos=$this->GlobalModel->obtenerEmailAdministrativosNotificacionDevolucion("Devoluciones","ENVIADO");

            // preparamos la cadena con los correo de notificación
            $correoAdministrativos="";
            foreach ( $emailAdminitrativos as $registro ) {
                 $correoAdministrativos.=$registro['NotificarA'].',';
            }

            //obtenemos los paquetes registrados en la devolución para anexarlos como información al correo que se enviará
            $paquetes= $this->DevolucionesModel->obtenerPaquetesParaEnvio($this->session->devolucion);

            $data['paquetes']=$paquetes;
            $data['autorizacion']=$autorizacion;
            $data['motivo']=$motivo;

            // enviamos el correo de notificación email
            $this->load->library('email');
            $this->email->from('tecnologias@hecort.com');
            $this->email->to($correoAdministrativos);
            //$this->email->cc($correoUsuario); //habilitar en producción
            $this->email->bcc('omar.flores@hecort.com');
            $this->email->subject('Notificacion de confirmación de envio de devolucion, FOLIO: '.$this->session->devolucion);
            $this->email->message($this->load->view('plantillas/Notificacion_confirmacion_devolucion', $data, true));
            $this->email->send();

            redirect('devoluciones');
        }
        else{
            //echo "Ocurrio un error al registrar la devolución.";
            $datos['mensaje']="Ocurrio un error al tratar de registrar la devolucion.";
            $datos['vista'] = 'errors/error';
            $this->load->view('plantillas/master_page', $datos);
        }
    }




}

/* End of file ProspectosController.php */
/* Location: ./application/controllers/ProspectosController.php */