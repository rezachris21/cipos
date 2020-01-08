<?php
defined('BASEPATH') OR exit();
/**
* 
*/
class Page extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();

		if($this->session->userdata('status') != "login"){
			redirect(base_url().'admin?pesan=belumlogin');
		}

		$this->load->model('My_model','m');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	function index()
	{
		$idcabang = $this->session->userdata('idcabang');
		
		$date = date('Y-m-d');

		$data['penjualan'] = $this->db->query("SELECT sum(tb_penjualan.total)as totalpenjualan,sum(tb_penjualan.profit_penjualan)as totalprofit FROM tb_penjualan WHERE tgl_penjualan ='$date' AND idcabang = '$idcabang'")->result();

		$data['pending'] = $this->db->query("SELECT sum(tb_penjualan.total)as totalpending FROM tb_penjualan WHERE status=0 AND idcabang = '$idcabang'")->result();

		$data['tanggal'] = $this->db->query("SELECT tgl_penjualan,status FROM tb_penjualan WHERE status='1' AND idcabang = '$idcabang' group by tgl_penjualan asc")->result();

		$data['penjualan1'] = $this->db->query("SELECT tb_penjualan.kode_penjualan,tb_barang.kode_barcode, tb_penjualan.tgl_penjualan,tb_barang.nama_barang,sum(tb_penjualan.jumlah) as totjum,sum(tb_penjualan.subtotal) as subtotal,sum(tb_penjualan.diskon) as totdiskon, sum(tb_penjualan.total) as totjual,sum(tb_penjualan.profit_penjualan) as totprofit from tb_barang, tb_penjualan where tb_barang.kode_barcode = tb_penjualan.kode_barcode and status='1' AND tb_penjualan.idcabang = '$idcabang' group by tgl_penjualan DESC LIMIT 30")->result();

		$data['topteen'] = $this->db->query("SELECT nama_barang,tb_penjualan.kode_barcode, sum(jumlah) AS jumlah FROM tb_penjualan,tb_barang WHERE tb_penjualan.kode_barcode=tb_barang.kode_barcode AND tb_penjualan.idcabang = '$idcabang' GROUP BY kode_barcode ORDER BY jumlah DESC LIMIT 10")->result();

		$data['topkustomer'] = $this->db->query("SELECT tb_kustomer.nama,sum(tb_penjualan.total) AS total FROM tb_penjualan,tb_kustomer WHERE tb_penjualan.id_pelanggan=tb_kustomer.id   AND tb_penjualan.idcabang = '$idcabang' GROUP BY id_pelanggan ORDER BY total DESC LIMIT 10")->result();

		$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2  AND idcabang = '$idcabang' ")->result();
		$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 AND idcabang = '$idcabang'")->result();
		
		

		
		$this->load->view('admin/header',$data1);
		$this->load->view('admin/index',$data);
		$this->load->view('admin/footer');
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'admin?pesan=logout');
	}

	
}
?>
