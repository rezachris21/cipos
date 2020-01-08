<?php
defined('BASEPATH')OR exit();
/**
* 
*/
class Penjualan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') != 'login')
		{
			redirect(base_url().'admin?pesan=belumlogin');
		}

		$this->load->model('My_model','m');

	}

	function index()
	{	
		$kode = $_GET['kodepj'];
		$idcabang = $this->session->userdata('idcabang');

		$data['kustomer'] = $this->db->query("SELECT * FROM tb_kustomer WHERE idcabang = '$idcabang' ORDER BY nama ASC")->result();
		$data['barang'] = $this->db->query("SELECT * FROM tb_barang WHERE idcabang = '$idcabang' ORDER by nama_barang ASC")->result();
		$data['penjualan'] = $this->db->query("SELECT * FROM tb_penjualan,tb_barang WHERE tb_barang.kode_barcode = tb_penjualan.kode_barcode AND kode_penjualan = '$kode' AND idcabang = '$idcabang'")->result();

		$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 AND idcabang = '$idcabang'")->result();
		$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 AND idcabang = '$idcabang'")->result();

		

		$this->load->view('admin/header',$data1);
		$this->load->view('admin/penjualan/v_penjualan',$data);
		$this->load->view('admin/footer');
	}

	
	function tambahdata()
	{

		$kodepenjualan = $this->input->post('kodepenjualan');
		$namakustomer = $this->input->post('namakustomer');
		$namabarang = $this->input->post('namabarang');
		$qty = $this->input->post('qty');
		$hargajual = $this->input->post('hargajual');
		$profit = $this->input->post('profit');
		$diskon = $this->input->post('diskon');

		$subtotal = $qty*$hargajual;
		$total = $subtotal-$diskon;
		$totalprofit = $profit*$qty-$diskon;

		if ($kodepenjualan == '')
		{
			$result['pesan'] = "Kode penjualan Harus di isi";
		}
		elseif ($namakustomer == '')
		{
			$result['pesan'] = "Sub Total Harus di isi";
		}
		elseif ($namabarang == '')
		{
			$result['pesan'] = "Diskon Harus di isi";
		}
		elseif ($qty == '')
		{
			$result['pesan'] = "Total Harus di isi";
		}
		elseif ($hargajual == '')
		{
			$result['pesan'] = "Total bayar Harus di isi";
		}
		elseif ($profit == '')
		{
			$result['pesan'] = "Kembali Harus di isi";
		}
		else
		{

			$result['pesan'] = "";
		

		

			$data = array (
				'kode_penjualan' => $kodepenjualan,
				'id_pelanggan' => $namakustomer,
				'kode_barcode' => $namabarang,
				'jumlah' => $qty,
				'diskon' => $diskon,
				'total' => $total,
				'subtotal' => $subtotal,
				'tgl_penjualan' => date('Y-m-d'),
				'profit' => $totalprofit
			);

			$this->m->tambahdata($data,'tb_penjualan');
		}
		

		echo json_encode($result);
	
	}

	function simpan()
	{

		$kodepenjualan = $this->input->post('kodepenjualan');
		$subtotal = $this->input->post('subtotal');
		$totaldiskon = $this->input->post('totaldiskon');
		$totalsemua = $this->input->post('totalsemua');
		$bayar = $this->input->post('bayar');
		$kembali = $this->input->post('kembali');

		if ($kodepenjualan == '')
		{
			$result['pesan'] = "Kode penjualan Harus di isi";
		}
		elseif ($subtotal == '')
		{
			$result['pesan'] = "Sub Total Harus di isi";
		}
		elseif ($totaldiskon == '')
		{
			$result['pesan'] = "Diskon Harus di isi";
		}
		elseif ($totalsemua == '')
		{
			$result['pesan'] = "Total Harus di isi";
		}
		elseif ($bayar == '')
		{
			$result['pesan'] = "Total bayar Harus di isi";
		}
		elseif ($kembali == '')
		{
			$result['pesan'] = "Kembali Harus di isi";
		}
		else
		{

			$result['pesan'] = "";
		
			$data = array (
				'kode_penjualan' => $kodepenjualan,
				'sub_total' => $subtotal,
				'total_diskon' => $totaldiskon,
				'total_all' => $totalsemua,
				'total_bayar' => $bayar,
				'total_kembali' => $kembali
			);

			$where = array (
				'kode_penjualan' => $kodepenjualan
			);
			$data1 = array (
				'status' => 1
			);

			$this->m->tambahdata($data,'tb_penjualan_detail');
			$this->m->updatedata($where,$data1,'tb_penjualan');
		}
		

		echo json_encode($result);
	
	}

	function hapusdata()
	{
		$id = $this->input->post('id');
		$kode_barcode = $this->input->post('kode_barcode');
		$jumlah = $this->input->post('jumlah');
		$stok = $this->input->post('stok');
		$result = $jumlah+$stok;

		$where = array (
			'id_penjualan' => $id
		);

		$where1 = array (
			'kode_barcode' =>$kode_barcode
		);

		$data = array (
			'stok' => $result
		);

		

		$this->m->updatedata($where1,$data,'tb_barang');
		$this->m->hapusdata($where,'tb_penjualan');
	}

	function struk()
	{
		$kodepenjualan = $this->input->get('kodepj');

		$data['struk'] = $this->db->query("SELECT * FROM tb_penjualan,tb_barang,tb_penjualan_detail WHERE tb_barang.kode_barcode = tb_penjualan.kode_barcode AND tb_penjualan.kode_penjualan = tb_penjualan_detail.kode_penjualan AND tb_penjualan.kode_penjualan='$kodepenjualan'")->result();
		$this->load->view('admin/penjualan/v_struk',$data);
	}
}
?>
