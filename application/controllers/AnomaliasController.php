<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnomaliasController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('AnomaliasModel');

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

    /**
     * Función que invoca al WebService local de Hecort, se hace uso del método
     * de solicitud de guias para el envío de la anomalia
     */
    private function wsHecort($parametros) {

        //Web service de producción
        $url="http://192.168.1.22:80/PickingWS/WebService1.asmx?wsdl";

        //Web service de pruebas
        //$url="http://localhost:6963/WebService1.asmx?wsdl";

        //Para verificar respuesta del WS
        //$client = new SoapClient($url);
        //$fcs = $client->__getFunctions();
        //var_dump($fcs);

        //instanciamos el webservice
        $ws = new SoapClient($url);

        //consumimos el método para la solicitud de las guias
        $resp = $ws->SolicitarGuiasDevolucion($parametros);

        if ($resp)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    /**
     * Muestra el Listado de aquellas devoluciones registradas por el usuario que estan con alguno de los siguientes status
     * POR ENVIAR, CAPTURA, REV.VENDEDOR, REV.SUPERVISOR, REV.DIVISIONAL, REV.DIR.COMERCIAL
     */
    public function obtenerAnomaliasPorUsuario() {
        $datos['titulo'] = 'Anomalias';
        $datos['anomalias'] = $this->AnomaliasModel->obtenerAnomaliasPendientes($this->session->usuario);
        $datos['vista'] = 'anomalias/tablero_anomalias';
        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * Ejecuta la eliminación del registro seleccionado
     */
    public function eliminarAnomalia($idDevolucion) {
        //$respuesta = $this->AnomaliasModel->EliminarAnomaliaCaptura($idDevolucion);
        $respuesta = $this->AnomaliasModel->EliminarAnomalia($idDevolucion);
        if ($respuesta==1) {
            $this->obtenerAnomaliasPorUsuario();
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

        $datos_factura = $this->AnomaliasModel->obtenerDatosFactura($factura, $usuario);

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
            $datos['link_regresar'] = 'anomalias';
            $this->load->view('plantillas/master_page', $datos);
        }
    }


    /**
     * Muestra en pantalla los datos generales correspondientes a la facturas del cliente seleccionada para devolución
     */
    public function seleccionarFactura($factura) {
        $usuario=$this->session->usuario;
        $datos_factura = $this->AnomaliasModel->obtenerDatosFactura($factura, $usuario);

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
            $datos['link_regresar'] = 'anomalias';
            $this->load->view('plantillas/master_page', $datos);
        }
    }


    /**
     * Obtiene las facturas del cliente del último año, para ser mostradas en pantalla y se elija en la que se desea
     * realizar la devolución
     * @return [null]
     */
    public function obtenerFacturasPorCliente() {
        $cliente = $this->input->get('codigo');
        $usuario = $this->session->usuario;
        $result = $this->AnomaliasModel->ObtenerFacturasCliente($cliente, $usuario);
        echo json_encode($this->utf8_converter($result));
    }


    /**
     * Obtienes aquellas facturas del cliente en las cuales haya comprado el producto especificado, éste método es
     * llamado un por un script ajax (ver archivo anomalias.js)
     */
    public function obtenerFacturasPorProductoCliente() {
        $cliente = $this->input->get('pCliente');
        $producto = $this->input->get('pProducto');
        $usuario = $this->session->usuario;

        $resp = $this->AnomaliasModel->ObtenerFacturasPorProductoCliente($cliente, $producto, $usuario);

        //Encabezado de la tabla html
        $html ="<thead><tr><td>Factura</td><td>Fecha</td><td>Cantidad</td></tr></thead><tbody>";

        //(cuepo de la tabla html) recorremos cada uno de los registros de la respuesta para concatenarlos a la varibale html
        foreach($resp as $registro){
             $html .= " <tr><td> <a href=AnomaliasController/seleccionarFactura/".$registro['InvcNbr'].">".$registro['InvcNbr']."</a></td> ";
             $html .= " <td> ".$registro['InvcDate']." </td> ";
             $html .= " <td> ".$registro['CantSol']." </td></tr> ";
            }

        //pie de la tabla html
        $html .= " </tbody> ";

        //regresamoa la tabla hmtl completa
        echo $html;

    }


    /**
     * Esta función permite cargar de manera dinámica los valores a un elemento select, y dependiendo el valor
     * del parametro de entrada (tipo), se ejecutará el método correspondiente. La respuesta será concatenada
     * en una variable html la cual será regresada a la solicitud ajax que la mandó llamar
     */
    public function obtenerCausasAnomalia() {

        $causas = $this->AnomaliasModel->obtenerCausasAnomalia();

        //variable que será utilizada para concatenar dinámicamente cada uno de los registros de consulta en forma de html
        $html = "<option value=''> Seleccione una casusa </option>";

        //recorremos cada uno de los registros de la respuesta para concatenarlos a la varibale html
        foreach($causas as $causa){
            $html .= "<option value='".$causa['IdCausaNota']."'>".$causa['Causa']."</option>";
        }

        //regresamos como respuesta la variable en forma de html
        echo ($html);
    }



    /**
     * muestra los datos generales de la factura a la que se desea realizar la devolución, siempre y cuendo la factura
     * pertenezca al usuario logeado
     */
    private function mostrarDatosFactura($factura,$datos_factura) {
        $datos['titulo'] = 'Anomalias';
        $datos['vista'] = 'anomalias/datos_factura';

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

        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * obsoleto
     */
    private function mostrarDatosFacturaSL($factura,$datos_factura) {
        $datos['titulo'] = 'Anomalias';
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
            $datos['vista'] = 'anomalias/datos_factura_SL';
            $this->load->view('plantillas/master_page', $datos);
        }
        else {
            $datos['mensaje']="Esta factura no pertenece a tu zona de ventas.";
            $datos['vista'] = 'errors/aviso';
            $datos['link_regresar'] = 'anomalias';
            $this->load->view('plantillas/master_page', $datos);
        }
    }


    /**
     * Guarda registro de anomalia de la factura seleccionada en la base de datos y crea las variables se session
     * id_anomalia, tipo_anomalia y factura, las cuales será usadas posteriormente
     */
    public function registrarAnomalia() {
        //Datos de entrada
        $factura = $this->input->post('factura');
        $tipoAnomalia = "D"; //$this->input->post('tipoAnomalia');
        $causaAnomalia =  $this->input->post('causaAnomalia');
        $EnAlma = true;
        $Usuario = $this->session->usuario;

        $parametros=[
                        $factura,
                        $tipoAnomalia,
                        $causaAnomalia,
                        $EnAlma,
                        $Usuario
                    ];

        //ejecutamos query
        $respuesta=$this->AnomaliasModel->registrarAnomalia($parametros);

        //creamos las variables de sessión  necesarias para el registro de la anomalía
        $_SESSION['id_anomalia']=$respuesta[0]['NoAnomalia'];
        $_SESSION['tipo_anomalia']=$tipoAnomalia;
        $_SESSION['factura']=$factura;

        $this->mostrarDatosAnomalia($this->session->id_anomalia);
    }


    /**
     *  Muestra los datos generales (encabezado) del registro de la devolución a la factura correpondiente
     */
    public function mostrarDatosAnomalia($idAnomalia) {
        $datos['titulo'] = 'Anomalias';
        $datos['vista'] = 'anomalias/captura_anomalia';

        $resp=$this->AnomaliasModel->obtenerDatosAnomalia($idAnomalia);

        $datos['anomalia'] = $idAnomalia;
        $datos['tipoAnomalia'] = $resp[0]['IdTipo'];
        $datos['invcNbr']=$resp[0]['InvcNbr'];
        $datos['invcDate']=$resp[0]['InvcDate'];
        $datos['custid']=$resp[0]['CustID'];
        $datos['cliente']=$resp[0]['Cliente'];
        $datos['status']=$resp[0]['Status'];
        $datos['totIva']=$resp[0]['TotIva'];
        $datos['subTotal']=$resp[0]['SubTotal'];
        $datos['enAlma']=$resp[0]['EnAlma'];
        $datos['causa']=$resp[0]['Causa'];

        //asignamos las variables de sesión referentes a la devolución previamente registrada en la BD
        $_SESSION['id_anomalia']=$datos['anomalia'];
        $_SESSION['tipo_anomalia']=$datos['tipoAnomalia'];
        $_SESSION['factura']=$datos['invcNbr'];

        $datos['productos_devolucion'] =$this->AnomaliasModel->obtenerDetalleProductosAnomalia($this->session->id_anomalia);
        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * Muestra los productos pertenecientes a la factura a devolver
     */
    public function agregarProductoParaDevolucion() {
        $datos['titulo'] = 'Anomalias';
        $datos['vista'] = 'anomalias/agregar_producto_anomalia';

        $factura=$this->session->factura;
        $idAnomalia=$this->session->id_anomalia;

        //asigmanos la respuesta que nos regresa la consulta a la variable productos_factura
        $datos['productos_factura']=$this->AnomaliasModel->obtenerDatosProductosFactura($factura,$idAnomalia);

        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * Muestra los productos asociados de la factura a devolver, quitando aquellos que fueron agregados previamente para devolución
     */
    public function mostrarDatosProductoDevolver($producto) {

        $datos['vista'] = 'anomalias/agregar_producto_anomalia';
        $datos['mensaje'] ='';

        $factura=$this->session->factura;
        $idAnomalia=$this->session->id_anomalia;

        $datos['producto'] =$this->AnomaliasModel->obtenerDatosProductoParaDevolucion($factura,$producto);
        $datos['articulo']=$datos['producto'][0]['InvtId'];//obtenemos el valor del campo artículo del registro 0 del arreglo datos
        $datos['cantidadSurtida']=$datos['producto'][0]['CantSurt'];//obtenemos el valor del campo cantidad surtida del registro 0 del arreglo datos

        //asigmanos la respuesta que nos regresa la consulta a la variable productos_factura
        $datos['productos_factura']=$this->AnomaliasModel->obtenerDatosProductosFactura($factura,$idAnomalia);

        $datos['producto_especie'] =$this->AnomaliasModel->obtenerDatosProductoEspecieParaDevolucion($factura,$producto);

        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * Guarda los datos generales del producto que será devuelto
     */
    public function registrarProductoAnomalia(){
        $idAnomalia=$this->session->id_anomalia;
        $factura = $this->session->factura;
        $producto = $this->input->post('articulo');
        $cantidad = $this->input->post('cantidad');
        $observaciones = $this->input->post('motivo');

        $datosProducto=[
                     $idAnomalia,
                     $factura,
                     $producto,
                     $cantidad,
                     $observaciones
                    ];

        //ejecutamos query para registrar los datos de entrada a la base de datos
        $respuesta=$this->AnomaliasModel->registrarProductoAnomalia($datosProducto);

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
     * Regiatra en la base de datos todos los productos disponibles para devolución
     */
    public function registrarProductosAnomalia(){

        $idAnomalia=$this->session->id_anomalia;
        $factura = $this->session->factura;
        $motivo = $this->input->post('motivo');

        $datosProductos=[
                     $idAnomalia,
                     $factura,
                     $motivo
                    ];

        //ejecutamos query
        $respuesta=$this->AnomaliasModel->registrarProductosAnomalia($datosProductos);
        if ($respuesta==1) {
            $this->mostrarDatosAnomalia($idAnomalia);
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
        $anomalia=$this->session->id_anomalia;
        $usuario=$this->session->usuario;

        //Datos de entrada del formulario
        $status= $this->input->post('nuevoStatus');
        $observaciones= $this->input->post('observaciones');

        //ejecutamos query para cambiar de status y pase a revisión del supervisor
        $result=$this->AnomaliasModel->cambiarStatus($anomalia, $status, $observaciones, $usuario);
        $result=1;
        if ($result==1) {
            //obtenemos el email asignado al supervisor del usuario
            $emailSupervisor=$this->GlobalModel->obtenerEmailSupervisor($usuario);
            $correoSupervisor=$emailSupervisor[0]['Email'];

            //obtenemos el email del usuario
            $emailUsuario=$this->GlobalModel->obtenerEmailUsuario($usuario);
            $correoUsuario=$emailUsuario[1]['Email'];

            //obtenemos los datos registrados de la devolución para anexarlos como información al correo que se enviará
            $resp=$this->AnomaliasModel->obtenerDatosAnomalia($anomalia);
            $data['subTotal']=$resp[0]['SubTotal'];
            $data['custid']=$resp[0]['CustID'];;
            $data['cliente']=$resp[0]['Cliente'];;
            $data['observaciones']=$observaciones;

            //$destinatarios = array('omar.flores@hecort.com'); //esto es para pruebas
            //$destinatarios = array($correoSupervisor, $correoUsuario);
            $destinatarios = array($correoSupervisor);
            /* enviar email */
            $this->load->library('email'); // Note: no $config param needed
            $this->email->from('tecnologias@hecort.com');
            $this->email->to($destinatarios);
            //$this->email->bcc('omar.flores@hecort.com');
            $this->email->subject('Reclamacion/Devolución por autorizar, FOLIO: '.$this->session->id_anomalia);
            $this->email->message($this->load->view('plantillas/Devoluciones_aviso_supervisor', $data, true));
            $this->email->send();
            redirect('anomalias');
        }
        else{
            $datos['mensaje']="Ocurrio un error al enviar al supervisor para autorización.";
            $datos['vista'] = 'errors/aviso';
            $datos['link_regresar'] = 'anomalias';
            $this->load->view('plantillas/master_page', $datos);
        }
    }


    /**
     * Muestra los productos que se tienen registrados para devolucion
     */
    public function mostrarProductosDevolucion($status) {
        $datos['titulo'] = 'Anomalias';
        $datos['vista'] = 'anomalias/detalle_productos_devolucion';
        $datos['status'] =  $status;
        $datos['productos_devolucion'] =$this->AnomaliasModel->obtenerDetalleProductosAnomalia($this->session->id_anomalia);
        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * Muestra los productos que se surtieron en la factura a devolver
     */
    public function mostrarProductosFactura() {
        $datos['titulo'] = 'Anomalias';
        $datos['vista'] = 'anomalias/productos_factura_devolucion';
        $datos['productos_factura'] =$this->AnomaliasModel->obtenerDatosProductosFactura($this->session->factura);
        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * Elimina el producto registrado previamente para devolución, posteriormente vuelve a cargar los productos registrados
     * para devolucion ya sin  el producto eliminado
     */
    public function eliminarProductoParaDevolucion($idDetalleDevolucion) {
        $resp=$this->AnomaliasModel->eliminarProductoParaDevolucion($idDetalleDevolucion, $this->session->id_anomalia);
        $this->mostrarDatosAnomalia($this->session->id_anomalia);
    }


    /**
     * Se verifica en la base de datos si ya se cuenta previamente con un registro de  solicitud de guia, en caso de que si
     * se redirecciona a la vista para registro de envio, en caso contrario, se redirecciona a la vista para solicitar guias.
     */
    public function obtenerDatosEnvioAnomalia() {
        $anomalia=$this->session->id_anomalia;
        $respuesta = $this->AnomaliasModel->obtenerDatosEnvioAnomalia($anomalia);
        //contamos cuantos registros contiene el array de la consulta previa
        $count = count($respuesta);
        //si existe al menos un registro, significa que se encontrontraon los datos de la factura como enviada mediante el SING
        if ($count>0)
        {
            //obtenemos el transportista con el que se solicitaron las guias para la devolucion
            $transportista=$respuesta[0]['Transportista'];
            //guardamos el transportista en una varibale de session temporal, ya que solo se utilizara mientras se registran los paquetes
            //esto se hace asi porque no se pueden usar variables staticas privadas en la clase debido a que pierden el valor al cargar el controlador
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
    public function solicitarGuias() {
            $datos['titulo'] = 'Anomalias';
            $datos['vista'] = 'anomalias/solicitar_guias';
            $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * Muestra los paquetes registrados con guia para devolución
     */
    public function mostrarPaquetesEnvio() {
        $datos['vista'] = 'anomalias/registrar_paquete';
        $paquetes= $this->AnomaliasModel->obtenerPaquetesParaEnvio($this->session->id_anomalia);
        $total_paquetes=count($paquetes);
        $datos['paquetes'] = $paquetes;
        $datos['total_paquetes'] = $total_paquetes;
        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * Valida que los datos para la solicitud de guias sean correctos, en caso de que no, se muestra aviso correspondiente
     */
    public function registrarGuia() {
        $datos['vista'] = 'anomalias/solicitar_guias';

        //Establecemos las reglas de validación
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('transportista', 'Transportista', 'required');
        $this->form_validation->set_rules('oficina', 'Oficina', 'required|numeric');
        $this->form_validation->set_rules('calle', 'Calle', 'required');
        $this->form_validation->set_rules('numero', 'Número', 'required|numeric');
        $this->form_validation->set_rules('colonia', 'Colonia', 'required');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');
        $this->form_validation->set_rules('cp', 'CP', 'required|numeric|exact_length[5]');
        $this->form_validation->set_rules('paquetes', 'paquetes', 'required|is_natural_no_zero|max_length[2]');
        $this->form_validation->set_rules('atencion', 'Atención a', 'required');

        //Validamos el formulario, si es igual a false, entonces algún campo no cumple con las reglas establecidas
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('plantillas/master_page', $datos);
        } else {
            $usuario=$this->session->usuario;
            $anomalia=$this->session->id_anomalia;
            $transportista =  $this->input->post('transportista');
            $oficina =  $this->input->post('oficina');
            $calle = $this->input->post('calle');
            $numero = $this->input->post('numero');
            $colonia = $this->input->post('colonia');
            $ciudad = $this->input->post('ciudad');
            $estado = $this->input->post('estado');
            $cp =  $this->input->post('cp');
            $paquetes = $this->input->post('paquetes');
            $atenacionA =  $this->input->post('atencion');

            $parametrosGuia=[
                                $anomalia,
                                $transportista,
                                $oficina,
                                $calle,
                                $numero,
                                $colonia,
                                $ciudad,
                                $estado,
                                $cp,
                                $paquetes,
                                $atenacionA
                            ];

            //ejecutamos query
            $respuesta=$this->AnomaliasModel->registrarGuia($parametrosGuia);

            //creamos un array con la información que será enviada al webservice para la solicitud de las guias
            $datosGuia = array('pNoAnomalia' => $anomalia,
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


            //Se invoca al WebService para poder generar las guias y enviarlas por correo al usuario
            $respuestaWS=$this->wsHecort($datosGuia);
            if ($respuestaWS==1) {
                //Si se guardó corretamenete el registro, entonces redireccionamos al usuario a la sección de Devoluciones
                redirect('anomalias');
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
        $anomalia=$this->session->id_anomalia;
        $guia = $this->input->post('guia');
        $peso = $this->input->post('peso');

        //obtenemos el transportista almacenado en la variable de sessión temporal con el que se solicitaron las guias para la devolucion
        $transportista=$this->session->guiasTransportista;

        $parametros=[
                        $anomalia,
                        $guia,
                        $transportista,
                        $peso,
                    ];

        //ejecutamos query
        $respuesta=$this->AnomaliasModel->registrarPaquete($parametros);
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
        $anomalia=$this->session->id_anomalia;

        $parametrosPaquete=[
                            $idGuia,
                            $anomalia
                        ];

        //ejecutamos query
        $respuesta=$this->AnomaliasModel->eliminarPaquete($parametrosPaquete);
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
        $datos['vista'] = 'anomalias/registrar_envio';
        $this->load->view('plantillas/master_page', $datos);
    }


    /**
     * Permite cambiar el status de la devolución a ENVIADA y manda correos de notificación correspondientes
     */
    public function registrarEnvioDevolucion() {
        $anomalia=$this->session->id_anomalia;
        $autorizacion = $this->input->post('autorizacion');
        $motivo = $this->input->post('motivo');
        $usuario=$this->session->usuario;

        $parametrosEnvio=[
                            $anomalia,
                            $autorizacion,
                            $motivo,
                            $usuario
                        ];
        //ejecutamos query
        $respuesta=$this->AnomaliasModel->registrarEnvio($parametrosEnvio);

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
            $paquetes= $this->AnomaliasModel->obtenerPaquetesParaEnvio($this->session->id_anomalia);
            $data['paquetes']=$paquetes;
            $data['autorizacion']=$autorizacion;
            $data['motivo']=$motivo;
            // enviamos el correo de notificación email
            $this->load->library('email');
            $this->email->from('tecnologias@hecort.com');
            $this->email->to($correoAdministrativos);
            //$this->email->cc($correoUsuario); //habilitar en producción
            $this->email->bcc('omar.flores@hecort.com');
            $this->email->subject('Notificacion de confirmación de envio de devolucion, FOLIO: '.$this->session->id_anomalia);
            $this->email->message($this->load->view('plantillas/Notificacion_confirmacion_devolucion', $data, true));
            $this->email->send();
            redirect('anomalias');
        }
        else{
            //echo "Ocurrio un error al registrar la devolución.";
            $datos['mensaje']="Ocurrio un error al tratar de registrar la devolucion.";
            $datos['vista'] = 'errors/error';
            $this->load->view('plantillas/master_page', $datos);
        }
    }


    /**
     * permite convertir recursivamente todos los valores de un array al formato UTF8
     * @param  [array] $array [arreglo de datos que se desea convertir]
     * @return [array]        [mismo arreglo convertido a formato UTF8]
     */
    private function utf8_converter($array) {
        array_walk_recursive($array, function(&$item, $key){
            //la función mb_detect_encoding revisa si el valor ya esta en formato UTF8
            if(!mb_detect_encoding($item, 'utf-8', true)){
                    $item = utf8_encode($item);
                }
            });
        return $array;
    }


}
/* End of file ProspectosController.php */
/* Location: ./application/controllers/ProspectosController.php */