<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Service_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $service = $this->Service_model->get_all();

        $data = array(
            'service_data' => $service
        );
        $this->load->view('header');
        $this->load->view('service_list', $data);
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
            $where .= " AND (title LIKE '%$search%'
                            OR subtitle LIKE '%$search%'
                            )";
          }
      }

    if (isset($orders)) {
        if ($orders != '') {
          $order = $orders;
          $order_column = ['title','subtitle'];
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
    $fetch = $this->db->query("SELECT * from service $where");
    $fetch2 = $this->db->query("SELECT * from service ");
    foreach($fetch->result() as $rows){
        $button1= "<a href=".base_url('service/read/'.$rows->id)." class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
        $button2= "<a href=".base_url('service/update/'.$rows->id)." class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
        $button3 = "<a href=".base_url('service/delete/'.$rows->id)." class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
        $sub_array=array();
        $sub_array[]=$index;
        $sub_array[]=$rows->title;
        $sub_array[]=$rows->subtitle;
        $sub_array[] = "<img src=" . base_url() . 'image/' . $rows->image . " class='img-fluid' width='80px'>";
        $sub_array[] = $button1 . " " . $button2 . " " . $button3;
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
        $row = $this->Service_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'title' => $row->title,
		'subtitle' => $row->subtitle,
		'image' => $row->image,
	    );
            $this->load->view('header');
            $this->load->view('service_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('service'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('service/create_action'),
	    'id' => set_value('id'),
	    'title' => set_value('title'),
	    'subtitle' => set_value('subtitle'),
	    'image' => set_value('image'),
	);

        $this->load->view('header');
        $this->load->view('service_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'title' => $this->input->post('title',TRUE),
		'subtitle' => $this->input->post('subtitle',TRUE),
		'image' => upload_gambar_biasa('service', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'image'),
	    );

            $this->Service_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('service'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Service_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('service/update_action'),
		'id' => set_value('id', $row->id),
		'title' => set_value('title', $row->title),
		'subtitle' => set_value('subtitle', $row->subtitle),
		'image' => set_value('image', $row->image),
	    );
            $this->load->view('header');
            $this->load->view('service_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('service'));
        }
    }
    
    public function update_action() 
    {
        $id = $this->input->post('id', TRUE);
        $row = $this->About_model->get_by_id($id);
            $data = array(
		'title' => $this->input->post('title',TRUE),
		'subtitle' => $this->input->post('subtitle',TRUE),
		'image' => $_FILES['image']['name'] == "" ? $row->image : upload_gambar_biasa('service', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'image'),
	    );

            $this->Service_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('service'));
        
    }
    
    public function delete($id) 
    {
        $row = $this->Service_model->get_by_id($id);

        if ($row) {
            $this->Service_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('service'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('service'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('title', 'title', 'trim|required');
	$this->form_validation->set_rules('subtitle', 'subtitle', 'trim|required');
	$this->form_validation->set_rules('image', 'image', 'trim');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Service.php */
/* Location: ./application/controllers/Service.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-07 11:54:27 */
/* http://harviacode.com */