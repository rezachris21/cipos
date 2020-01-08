<?php
defined('BASEPATH') OR exit();
/**
* 
*/
class Barang extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();

		if($this->session->userdata('status') != "login")
		{
			redirect(base_url().'admin?pesan=belumlogin');
		}
		$this->load->model('My_model','m');
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index()
	{
		$idcabang = $this->session->userdata('idcabang');

		$data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 AND idcabang = '$idcabang'")->result();
		$data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 AND idcabang = '$idcabang'")->result();
		$data['barang'] = $this->db->query("SELECT * FROM tb_barang WHERE idcabang = '$idcabang' ")->result(); 

		$this->load->view('admin/header',$data1);
		$this->load->view('admin/barang/v_barang',$data);
		$this->load->view('admin/footer');
	}

	function tambahdata()
	{
		$idcabang = $this->session->userdata('idcabang');

		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$satuan = $this->input->post('satuan');
		$stok = $this->input->post('stok');
		$hbeli = $this->input->post('hbeli');
		$hjual = $this->input->post('hjual');
		$profit = $this->input->post('profit');
		

		if ($kode == '')
		{
			$result['pesan'] = "Kode Barang Harus di isi";
		}
		elseif ($nama == '')
		{
			$result['pesan'] = "Nama Barang Harus di isi";
		}
		elseif ($satuan == '')
		{
			$result['pesan'] = "Satuan Harus di isi";
		}
		elseif ($stok == '')
		{
			$result['pesan'] = "Stok Barang Harus di isi";
		}
		elseif ($hbeli == '')
		{
			$result['pesan'] = "Harga Beli Harus di isi";
		}
		elseif ($hjual == '')
		{
			$result['pesan'] = "Harga Jual Harus di isi";
		}
		elseif ($profit == '')
		{
			$result['pesan'] = "Profit Harus di isi";
		}
		else
		{
			$result['pesan'] = "";

			$data = array (
				'kode_barcode' => $kode,
				'nama_barang' => $nama,
				'satuan' => $satuan,
				'stok' => $stok,
				'harga_beli' => $hbeli,
				'harga_jual' => $hjual,
				'profit' => $profit,
				'idcabang' => $idcabang
			);

			$this->m->tambahdata($data,'tb_barang');
		}

		echo json_encode($result);
	}

	function ambilid()
	{
		$id = $this->input->post('id');
		$where = array (
			'id' => $id
		);
		$databarang = $this->m->ambilid('tb_barang',$where)->result();

		echo json_encode($databarang);
	}

	function tambahstok()
	{
		$id = $this->input->post('idd');
		$stokbaru = $this->input->post('stokbaru');

		if ( $stokbaru == "")
		{
			$result['pesan'] = "Stok Baru harus di isi";
		}
		else
		{
			$result['pesan'] = "";

			$where = array (
				'id' => $id
			);

			$data = array (
				'stok' => $stokbaru
			);

			$this->m->updatedata($where,$data,'tb_barang');
		}
		echo json_encode($result);
	}

	function editdata()
	{
		$id = $this->input->post('id');
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$satuan = $this->input->post('satuan');
		$stok = $this->input->post('stok');
		$hbeli = $this->input->post('hbeli');
		$hjual = $this->input->post('hjual');
		$profit = $this->input->post('profit');
		

		if ($kode == '')
		{
			$result['pesan'] = "Kode Barang Harus di isi";
		}
		elseif ($nama == '')
		{
			$result['pesan'] = "Nama Barang Harus di isi";
		}
		elseif ($satuan == '')
		{
			$result['pesan'] = "Satuan Harus di isi";
		}
		elseif ($stok == '')
		{
			$result['pesan'] = "Stok Barang Harus di isi";
		}
		elseif ($hbeli == '')
		{
			$result['pesan'] = "Harga Beli Harus di isi";
		}
		elseif ($hjual == '')
		{
			$result['pesan'] = "Harga Jual Harus di isi";
		}
		elseif ($profit == '')
		{
			$result['pesan'] = "Profit Harus di isi";
		}
		else
		{
			$result['pesan'] = "";

			$where = array (
				'id' => $id);

			$data = array (
				'kode_barcode' => $kode,
				'nama_barang' => $nama,
				'satuan' => $satuan,
				'stok' => $stok,
				'harga_beli' => $hbeli,
				'harga_jual' => $hjual,
				'profit' => $profit
			);

			$this->m->updatedata($where,$data,'tb_barang');
		}

		echo json_encode($result);
	}

	function hapusdata()
	{
		$id = $this->input->post('id');
		$where = array (
			'id' => $id
		);
		$this->m->hapusdata($where,'tb_barang');
	}

	function cetakbarang()
	{
		$this->load->library('dompdf_gen');
		

		$data['cetakbarang'] = $this->db->query ("SELECT * FROM tb_barang")->result();

		$this->load->view('admin/barang/v_cetak_barang',$data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();

		$this->dompdf->set_paper($paper_size,$orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_stokbarang_cozyvape ", array('Attachment' => 0));
	}

	function do_upload()
    {
      $config['upload_path'] = './assets/images/barang';
      $config['allowed_types'] = 'gif|jpg|png';
      //$config['encrypt_name'] = TRUE;

      $this->load->library('upload',$config);

      if ($this->upload->do_upload("file"))
      {
        $data = array ('upload_data' => $this->upload->data());

		$idcabang = $this->session->userdata('idcabang');

        $kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$satuan = $this->input->post('satuan');
		$stok = $this->input->post('stok');
		$hbeli = $this->input->post('hbeli');
		$hjual = $this->input->post('hjual');
		$profit = $this->input->post('profit');
        $image = $data['upload_data']['file_name'];

        $result = $this->m->simpan_barang($idcabang, $kode,$nama,$satuan,$stok,$hbeli,$hjual,$profit,$image);
        echo json_decode($result);

      }
    }
}
?>
