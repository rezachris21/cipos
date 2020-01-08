<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('my_model');
	}

	public function index()
	{
		$this->load->view('v_login');

	}

	function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');

		if ($this->form_validation->run() != false )
		{
			$where = array (
				'username' => $username,
				'password' => md5($password)
			);

			$data = $this->my_model->edit_data($where,'tb_pengguna');
			$d = $this->my_model->edit_data($where,'tb_pengguna')->row();
			$cek = $data->num_rows();

			if ($cek > 0)
			{
				$session = array(
					'id' => $d->id,
					'nama' => $d->nama,
					'level' => $d->level,
					'foto' => $d->foto,
					'level' => $d->level,
					'idcabang' => $d->idcabang,
					'status' => 'login'
				);

				$this->session->set_userdata($session);
				if($d->idcabang == NULL)
				{
					redirect(base_url().'cabang');
				}
				else
				{
					redirect(base_url().'page');
				}
					
			}
			else
			{
				redirect(base_url().'admin?pesan=gagal');
			}
		}
		else
		{
			$this->load->view('v_login');
		}
	}

	function daftar()
	{
		$dnama = $this->input->post('dnama');
		$dusername = $this->input->post('dusername');
		$dpassword = $this->input->post('dpassword');
		$dlevel = $this->input->post('dlevel');

		$this->form_validation->set_rules('dnama','Nama','required');
		$this->form_validation->set_rules('dusername','Username','required');
		$this->form_validation->set_rules('dpassword','Password','required');
		$this->form_validation->set_rules('dpassword','Password','required');
		
		if ($this->form_validation->run() != false)
		{
			$data = array (
				'nama' => $dnama,
				'username' => $dusername,
				'password' => md5($dpassword),
				'level' => $dlevel
			);
			$this->my_model->tambahdata($data,'tb_pengguna');
			redirect(base_url().'admin?pesan=daftar');
		}
		else
		{
			redirect(base_url().'admin?pesan=daftargagal');
		}
	}
}
