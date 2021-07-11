<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class About extends MY_Controller
{



    function __construct()
    {
        parent::__construct();
        $this->load->model('About_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $about = $this->About_model->get_all();

        $data = array(
            'about_data' => $about
        );
        $this->load->view('header');
        $this->load->view('about_list', $data);
        $this->load->view('footer');
    }

    public function fetch_data()
    {
        $starts       = $this->input->post("start");
        $length       = $this->input->post("length");
        $LIMIT        = "LIMIT $starts, $length ";
        $draw         = $this->input->post("draw");
        $search       = $this->input->post("search")["value"];
        $orders       = isset($_POST["order"]) ? $_POST["order"] : '';

        $where = "WHERE 1=1";
        $searchingColumn = "";
        $result = array();
        if (isset($search)) {
            if ($search != '') {
                $searchingColumn = $search;
                $where .= " AND (heading LIKE '%$search%'
                               OR sub_heading LIKE '%$search'
                               
                                )";
            }
        }

        if (isset($orders)) {
            if ($orders != '') {
                $order = $orders;
                $order_column = ['heading', 'sub_heading'];
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
        $index = 1;
        $button = "";
        $fetch = $this->db->query("SELECT * from about $where");
        $fetch2 = $this->db->query("SELECT * from about ");
        foreach ($fetch->result() as $rows) {
            $button1 = "<a href=" . base_url('about/read/' . $rows->id) . " class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
            $button2 = "<a href=" . base_url('about/update/' . $rows->id) . " class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
            $button3 = "<a href=" . base_url('about/delete/' . $rows->id) . " class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
            $sub_array = array();
            $sub_array[] = $index;
            $sub_array[] = $rows->heading;
            $sub_array[] = $rows->sub_heading;
            $sub_array[] = "<img src=" . base_url() . 'image/' . $rows->image . " class='img-fluid' width='80px'>";
            $sub_array[] = $rows->video;
           
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
        $row = $this->About_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'heading' => $row->heading,
                'sub_heading' => $row->sub_heading,
                'image' => $row->image,
                'video' => $row->video,
            );
            $this->load->view('header');
            $this->load->view('about_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('about'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('about/create_action'),
            'id' => set_value('id'),
            'heading' => set_value('heading'),
            'sub_heading' => set_value('sub_heading'),
            'image' => set_value('image'),
            'video' => set_value('video'),
        );

        $this->load->view('header');
        $this->load->view('about_form', $data);
        $this->load->view('footer');
    }

    public function create_action()
    {

        $data = array(
            'heading' => $this->input->post('heading', TRUE),
            'sub_heading' => $this->input->post('sub_heading', TRUE),
            'image' => upload_gambar_biasa('about', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'image'),
            'video' =>$this->input->post('video', TRUE),
        );

        $this->About_model->insert($data);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('about'));
    }

    public function update($id)
    {
        $row = $this->About_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('about/update_action'),
                'id' => set_value('id', $row->id),
                'heading' => set_value('heading', $row->heading),
                'sub_heading' => set_value('sub_heading', $row->sub_heading),
                'image' => set_value('image', $row->image),
                'video' => set_value('video', $row->video),
            );
            $this->load->view('header');
            $this->load->view('about_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('about'));
        }
    }

    public function update_action()
    {
        $id = $this->input->post('id', TRUE);
        $row = $this->About_model->get_by_id($id);
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'heading' => $this->input->post('heading', TRUE),
                'sub_heading' => $this->input->post('sub_heading', TRUE),
                'image' => $_FILES['image']['name']=="" ? $row->image: upload_gambar_biasa('about', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'image'),
                'video' => $this->input->post('video', TRUE),
            );

            $this->About_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('about'));
        }
    }

    public function delete($id)
    {
        $row = $this->About_model->get_by_id($id);

        if ($row) {
            $this->About_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('about'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('about'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('heading', 'heading', 'trim|required');
        $this->form_validation->set_rules('sub_heading', 'sub heading', 'trim|required');
        $this->form_validation->set_rules('image', 'image', '');
        $this->form_validation->set_rules('video', 'video', '');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-07 11:54:26 */
/* http://harviacode.com */