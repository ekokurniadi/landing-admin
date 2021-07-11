<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Galery extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Galery_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $galery = $this->Galery_model->get_all();

        $data = array(
            'galery_data' => $galery
        );
        $this->load->view('header');
        $this->load->view('galery_list', $data);
        $this->load->view('footer');
    }

    public function fetch_data(){
    $starts       = $this->input->post("start");
    $length       = $this->input->post("length");
    $LIMIT        = "LIMIT $starts, $length ";
    $draw         = $this->input->post("draw");
    $search       = $this->input->post("search")["value"];
    $orders       = isset($_POST["order"]) ? $_POST["order"] : ''; 
    
    $where ="WHERE 1=1";
    $searchingColumn="";
    $result=array();
    if (isset($search)) {
      if ($search != '') {
         $searchingColumn = $search;
            $where .= " AND (image LIKE '%$search%'
                           
                            )";
          }
      }

    if (isset($orders)) {
        if ($orders != '') {
          $order = $orders;
          $order_column = ['id','image'];
          $order_clm  = $order_column[$order[0]['column']];
          $order_by   = $order[0]['dir'];
          $where .= " ORDER BY $order_clm $order_by ";
        } else {
          $where .= " ORDER BY id ASC ";
        }
      } else {
        $where .= " ORDER BY id ASC ";
      }
      if (isset($LIMIT)) {
        if ($LIMIT != '') {
          $where .= ' ' . $LIMIT;
        }
      }
    $index=1;
    $button="";
    $fetch = $this->db->query("SELECT * from galery $where");
    $fetch2 = $this->db->query("SELECT * from galery ");
    foreach($fetch->result() as $rows){
        $button1= "<a href=".base_url('galery/read/'.$rows->id)." class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
        $button2= "<a href=".base_url('galery/update/'.$rows->id)." class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
        $button3 = "<a href=".base_url('galery/delete/'.$rows->id)." class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
        $sub_array=array();
        $sub_array[]=$index;
        $sub_array[] = "<img src=" . base_url() . 'image/' . $rows->image . " class='img-fluid' width='80px'>";
        $sub_array[]=$button1." ".$button2." ".$button3;
        $result[]      = $sub_array;
        $index++;
    }
    $output = array(
      "draw"            =>     intval($this->input->post("draw")),
      "recordsFiltered" =>     $fetch2->num_rows(),
      "data"            =>     $result,
     
    );
    echo json_encode($output);

}

    public function read($id) 
    {
        $row = $this->Galery_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'image' => $row->image,
	    );
            $this->load->view('header');
            $this->load->view('galery_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('galery'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('galery/create_action'),
	    'id' => set_value('id'),
	    'image' => set_value('image'),
	);

        $this->load->view('header');
        $this->load->view('galery_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        
            $data = array(
		'image' => upload_gambar_biasa('galeri', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'image'),
	    );

            $this->Galery_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('galery'));
        
    }
    
    public function update($id) 
    {
        $row = $this->Galery_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('galery/update_action'),
		'id' => set_value('id', $row->id),
		'image' => set_value('image', $row->image),
	    );
            $this->load->view('header');
            $this->load->view('galery_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('galery'));
        }
    }
    
    public function update_action() 
    {
        $id = $this->input->post('id', TRUE);
        $row = $this->Galery_model->get_by_id($id);
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'image' => $_FILES['image']['name']=="" ? $row->image: upload_gambar_biasa('galeri', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'image'),
	    );

            $this->Galery_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('galery'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Galery_model->get_by_id($id);

        if ($row) {
            $this->Galery_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('galery'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('galery'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('image', 'image', 'trim');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Galery.php */
/* Location: ./application/controllers/Galery.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-07 11:54:27 */
/* http://harviacode.com */