<?php
defined('BASEPATH') OR exit();
/**
  * 
  */

  class User extends CI_Controller
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
			if($idcabang == "")
			{
				$data['user'] = $this->db->query("SELECT * FROM tb_pengguna WHERE idcabang IS NULL ")->result();
			}
			else
			{
				$data['user'] = $this->db->query("SELECT * FROM tb_pengguna WHERE idcabang ='$idcabang'")->result();
			}

  		
      $data1['barang'] = $this->db->query("SELECT id,nama_barang,stok FROM tb_barang WHERE stok <= 2 ")->result();
      $data1['jumlah'] = $this->db->query("SELECT id,count(harga_jual) AS jumlah FROM tb_barang WHERE stok <= 2 ")->result();

  		$this->load->view('admin/header',$data1);
  		$this->load->view('admin/user/v_user',$data);
  		$this->load->view('admin/footer');
  	}

    /*function tambahdata()
    {
      $config['upload_path'] = "./assets/images";
      $config['allowed_type'] = 'gif|jpg|png';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload',$config);

      if ($this->upload->do_upload("file"))
      {
        $data = array('upload_data' => $this->upload->data());

        $image = $data['upload_data']['file_name'];
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $upassword = $this->input->post('upassword');
        $level = $this->input->post('level');
  

      

        $data = array (
          'nama' => $nama,
          'username' => $username,
          'password' => md5($password),
          'level' => $level,
          'foto' => $image
        );

        $this->m->tambahdata($data,'tb_pengguna');
      }
      echo json_encode($result);
    }*/

    function ambilid()
    {
      $id = $this->input->post('id');
      $where = array (
        'id' => $id
      );

      $datauser = $this->m->ambilid('tb_pengguna',$where)->result();
      echo json_encode($datauser);
    }

    function editdata()
    {
      $id = $this->input->post('id');
      $nama = $this->input->post('nama');
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $upassword = $this->input->post('upassword');
      $level = $this->input->post('level');

      if ($nama == '')
      {
        $result['pesan'] = "Nama harus di isi";
      }
      elseif ($username == '')
      {
        $result['pesan'] = "Username harus di isi";
      }
      elseif ($password == '') 
      {
        $result['pesan'] = "Password harus di isi";  
      }
      elseif ($upassword == '') 
      {
        $result['pesan'] = "Ulangi Password harus di isi";  
      }
      elseif ($password != $upassword) 
      {
        $result['pesan'] = "Password harus Sama";  
      }
      elseif ($level == '')
      {
        $result['pesan'] = "Level harus di isi";
      }
      else
      {
        $result['pesan'] = "";

        $where = array(
          'id' => $id
        );

        $data = array(
          'nama' => $nama,
          'username' => $username,
          'password' => md5($password),
          'level' => $level
        );

        $this->m->updatedata($where,$data,'tb_pengguna');

      }
      echo json_encode($result);
    }

    function hapusdata()
    {
      $id = $this->input->post('id');
      $where = array (
        'id' => $id
      );
      $this->m->hapusdata($where,'tb_pengguna');
    }

    function do_upload()
    {
      $config['upload_path'] = './assets/images';
      $config['allowed_types'] = 'gif|jpg|png';
      //$config['encrypt_name'] = TRUE;

      $this->load->library('upload',$config);

      if ($this->upload->do_upload("file"))
      {
        $data = array ('upload_data' => $this->upload->data());

				$idcabang = $this->session->userdata('idcabang');

        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $upassword = $this->input->post('upassword');
        $level = $this->input->post('level');
        $image = $data['upload_data']['file_name'];

        $result = $this->m->simpan_upload($idcabang,$nama,$username,$password,$level,$image);
        echo json_decode($result);

      }
    }
  }  
?>
