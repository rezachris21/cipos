<?php
defined('BASEPATH') OR exit();
/**
* 
*/
class My_model extends CI_Model
{
	function edit_data($where,$table)
	{
		return $this->db->get_where($table,$where);
	}
	
	function ambildata($table)
	{
		return $this->db->get($table);
	}
	
	function tambahdata($data,$table)
	{
		$this->db->insert($table,$data);
	}

	function ambilid($table,$where)
	{
		return $this->db->get_where($table,$where);
	}

	function updatedata($where,$data,$table)
	{
		$this->db->where ($where);
		$this->db->update($table,$data);
	}

	function hapusdata($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	function simpan_upload($idcabang,$nama,$username,$password,$level,$image)
	{
		$data = array (
          'nama' => $nama,
          'username' => $username,
          'password' => md5($password),
          'level' => $level,
		  'foto' => $image,
		  'idcabang' => $idcabang
        );
		$result= $this->db->insert('tb_pengguna',$data);
		return $result;
	}

	function simpan_upload_admin($idcabang,$nama,$username,$password,$cabang,$image)
	{
		$data = array (
          'nama' => $nama,
          'username' => $username,
          'password' => md5($password),
          'level' => 'admin',
		  'foto' => $image,
		  'idcabang' => $cabang
        );
		$result= $this->db->insert('tb_pengguna',$data);
		return $result;
	}

	function simpan_barang($idcabang,$kode,$nama,$satuan,$stok,$hbeli,$hjual,$profit,$image)
	{
		$data = array (
          'kode_barcode' => $kode,
          'nama_barang' => $nama,
		  'satuan' => $satuan,
		  'harga_beli' => $hbeli,
		  'stok' => $stok,
		  'harga_jual' => $hjual,
		  'profit' => $profit,
		  'image' => $image,
		  'idcabang' => $idcabang
        );
		$result= $this->db->insert('tb_barang',$data);
		return $result;
	}

	function update($id,$value,$modul,$update_profit,$update_total,$subtotal,$profit,$diskon){
		$this->db->where(array("id_penjualan"=>$id));
		if($value == 0){
			$this->db->update("tb_penjualan",
				array(
					$modul=>$value,
					'profit_penjualan' => $update_profit + $diskon,
					'total' => $subtotal,
				)
			);
		}else{
			$this->db->update("tb_penjualan",
				array(
					$modul=>$value,
					'profit_penjualan' => $update_profit,
					'total' => $update_total,
				)
			);
		}
		
	}

	function get_data_barcode_bykode($barcode,$idcabang){
		

		$hsl=$this->db->query("SELECT * FROM tb_barang WHERE kode_barcode= '$barcode' AND idcabang = '$idcabang' ");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'stok' => $data->stok,
					'harga_jual' => $data->harga_jual,
					'profit' => $data->profit,
					'id' => $data->id,
                );
            }
        }
        return $hasil;
	}
     
}
