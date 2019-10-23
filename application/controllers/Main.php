<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		/*Se carga la libreria TinyButStrong*/
        $this->load->library('MyTBS');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['main_content'] = 'main_form';
		$this->load->view('template/content',$data);
	}

	public function store()
	{
		//Seteo de las variables de formulario para colocar los valores enla plantilla
		$nombre = $this->input->post('exampleFirstName',TRUE);
		$apellidos = $this->input->post('exampleLastName',TRUE);
		$correo = $this->input->post('exampleInputEmail',TRUE);
		//Se setea el nombre completo
		$full_name = $nombre." ".$apellidos;
		/**
		 * Carga del plugin OPENTBS necesario para la manipulacion
		 * de archivos word con la clase TinyButStrong
		 */
		require_once(APPPATH.'third_party/tbs_us/plugins/tbs_plugin_opentbs.php');

		/**
		 * Este bloque es para guardar la firma que se recibo por $_POST
		 * como un archivo de imagen .png
		 */
		$data_uri = $this->input->post('txtsignature');
		$encoded_image = str_replace('data:image/png;base64,', '', $data_uri);
    	$encoded_image = str_replace(' ', '+', $encoded_image);
		$decoded_image = base64_decode($encoded_image);
		file_put_contents("./uploades_files/signature.png", $decoded_image);

		//Creacion de una nueva instancia de TBS y se carga el plugin OpenTBS
        $tbs = new clsTinyButStrong;
        //Se carga el plugin OPENTBS
        $tbs->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
        //Util para propositos de depuración. Muestra los errores
		$tbs->NoErr = false;
		
        //Seteo de la ruta donde se encuentar el archivo a usar como plantilla
        $ruta_plantilla = "./format_templates/plantilla_permiso.docx";
        //Se carga la plantilla en TBS
		$tbs->LoadTemplate($ruta_plantilla, OPENTBS_ALREADY_UTF8);
		
        /*Este es un array mutidimensional que contiene los nombres de los campos a ser
        reemplazados dentro de las plantillas*/
        $mergeFields['dt'] = [];
        $mergeFields['dt']['nombre_empleado'] = $full_name;
		
		//Bucle para realizar el reemplazo de los campos dentro de la plantilla
        foreach ($mergeFields as $fieldKey => $fieldValues) {
            $tbs->MergeField($fieldKey, $fieldValues);
		}
		//Esta line es para realizar el reemplazo de la imagen de la firma dentro de la plantilla
		$tbs->MergeField('b', array(
			'signature' => './uploades_files/signature.png'
		));
		//Nombre final del archivo de salida
        $nombre_archivo_salida = "./format_templates/sample_permiso.docx";
        // Output the result as a downloadable file (only streaming, no data saved in the server)
        //$tbs->Show(OPENTBS_DOWNLOAD, $nombre_archivo_salida); // Also merges all [onshow] automa
		$tbs->Show(OPENTBS_FILE, $nombre_archivo_salida);
		
		/**
		 * Bloque de codigo para realizar la conversion deun Archivo Word a PDF (Se pierde el formato y algunos elementos)
		 */
		// Make sure you have `dompdf/dompdf` in your composer dependencies.
		Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
		// Any writable directory here. It will be ignored.
		Settings::setPdfRendererPath('.');

		$phpWord = IOFactory::load($nombre_archivo_salida, 'Word2007');
		$phpWord->save('./format_templates/Ejemplo.pdf', 'PDF');

		Gears\Pdf::convert($nombre_archivo_salida, './format_templates/Otro_ejemplo.pdf');
		//shell_exec('libreoffice --headless --convert-to pdf $nombre_archivo_salida');
	}
}
