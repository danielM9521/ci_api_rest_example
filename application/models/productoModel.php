<?php
class ProductoModel extends CI_Model
{

	//Método para buscar todos los registros de la tabla producto
	public function findAll()
	{
		$data = $this->db->get('producto')->result();
		return $data;
	}

	//Método para buscar un registro de la tabla producto por su id
	public function findById($id_producto)
	{
		$data = $this->db->get_where('producto', ['id_producto' => $id_producto])->result();
		return $data;
	}

	//Método para guardar un registro en la tabla producto
	public function save($data)
	{
		if (count($data) != 4) {
			return false;
		} else {
			if ($this->db->insert('producto', $data)) {
				return true;
			} else {
				return false;
			}
		}
	}

	//Método para actualizar un registro en la tabla producto
	public function update($data, $id_producto)
	{
		if ($this->db->update('producto', $data, array('id_producto' => $id_producto))) {
			if ($this->db->affected_rows() == 1) {
				return true;
			} else {
				return false;
			}
		}
	}

	//Método para eliminar un registro en la tabla producto
	public function delete($id_producto)
	{
		if ($this->db->delete('producto', array('id_producto' => $id_producto))) {
			if ($this->db->affected_rows() == 1) {
				return true;
			} else {
				return false;
			}
		}
	}
}
