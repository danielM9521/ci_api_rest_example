<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/Rest_Controller.php';
require APPPATH . 'libraries/Format.php';
class Producto extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductoModel');
	}

	// Método para buscar todos los productos de la tabla, si recibe un parámetro lo busca por su id
	public function search_get($id_producto = null)
	{
		if ($id_producto == null || empty($id_producto)) {
			$pds = $this->ProductoModel->findAll();
			$this->response($pds, parent::HTTP_OK);
		} else {
			$pds = $this->ProductoModel->findById($id_producto);
			if ($pds != []) {
				$this->response($pds, parent::HTTP_OK);
			} else {
				// Validamos que el id del producto exista en la tabla
				$this->response($pds, parent::HTTP_NOT_FOUND);
			}
		}
	}

	// Método para guardar un registro en la tabla producto
	public function save_post()
	{
		// Obtenemos los datos a guardar
		$nombre = trim($this->post('nombre'));
		$cantidad = trim($this->post('cantidad'));
		$precio_unitario = trim($this->post('precio_unitario'));
		$estado = trim($this->post('estado'));

		// Validamos que los campos estén seteado para ingersar el registro
		if (!empty($nombre) || $nombre != null) {
			$data['nombre'] = $nombre;
		}
		if (!empty($cantidad) || $cantidad != null) {
			$data['cantidad'] = $cantidad;
		}
		if (!empty($precio_unitario) || $precio_unitario != null) {
			$data['precio_unitario'] = $precio_unitario;
		}
		if (!empty($estado) || $estado != null) {
			$data['estado'] = $estado;
		}
		//-----------------------------------------------------


		// Guardando el registro
		if ($this->ProductoModel->save($data)) {
			$this->response(['Mensaje' => 'Producto creado con éxito'], parent::HTTP_CREATED);
		} else {
			$this->response(['Mensaje' => 'No se pudo ingresar el registro, la cantidad de parámetros ingresados no coincide'], parent::HTTP_NOT_FOUND);
		}
	}

	// Método para actualizar un registro en la tabla producto, solo por parámetro en la url
	public function update_put($id_producto = null)
	{
		$data = array();
		// Obtenemos los posibles datos a actualizar
		$nombre = trim($this->put('nombre'));
		$cantidad = trim($this->put('cantidad'));
		$precio_unitario = trim($this->put('precio_unitario'));
		$estado = trim($this->put('estado'));
		//----------------------------------------

		// Si el id recibido como parámetro es null no podemos actualizar, asi que enviamos un mensaje de respuesta
		if ($id_producto == null || empty($id_producto)) {
			$this->response(['Mensaje' => 'Asegúrese de especificar el producto a actualizar'], parent::HTTP_NOT_FOUND);
		} else {

			// Validamos que campos se van a actualizar del registro
			if (!empty($nombre) || $nombre != null) {
				$data['nombre'] = $nombre;
			}
			if (!empty($cantidad) || $cantidad != null) {
				$data['cantidad'] = $cantidad;
			}
			if (!empty($precio_unitario) || $precio_unitario != null) {
				$data['precio_unitario'] = $precio_unitario;
			}
			if (!empty($estado) || $estado != null) {
				$data['estado'] = $estado;
			}
			//-----------------------------------------------------

			// Actualizando el registro
			if ($this->ProductoModel->update($data, $id_producto)) {
				$this->response(['Mensaje' => 'Producto actualizado con éxito'], parent::HTTP_OK);
			} else {
				$this->response(['Mensaje' => 'El registro no existe / no se pudo actualizar'], parent::HTTP_NOT_FOUND);
			}
			//------------------------
		}
	}

	public function delete_delete($id_producto = null)
	{
		// Si el id recibido como parámetro es null no podemos eliminar, asi que enviamos un mensaje de respuesta
		if ($id_producto == null || empty($id_producto)) {
			$this->response(['Mensaje' => 'No se puede eliminar el registro'], parent::HTTP_NOT_FOUND);
		} else {
			// Eliimnando el registro
			if ($this->ProductoModel->delete($id_producto)) {
				$this->response(['Mensaje' => 'Producto eliminado con éxito'], parent::HTTP_OK);
			} else {
				$this->response(['Mensaje' => 'El registro no existe / no se pudo eliminar el registro'], parent::HTTP_NOT_FOUND);
			}
			//----------------------
		}
	}
}
