<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hero extends MY_Controller
{



    function __construct()
    {
        parent::__construct();
        $this->load->model('Hero_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $hero = $this->Hero_model->get_all();

        $data = array(
            'hero_data' => $hero
        );
        $this->load->view('header');
        $this->load->view('hero_list', $data);
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
        $fetch = $this->db->query("SELECT * from hero $where");
        $fetch2 = $this->db->query("SELECT * from hero ");
        foreach ($fetch->result() as $rows) {
            $button1 = "<a href=" . base_url('hero/read/' . $rows->id) . " class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
            $button2 = "<a href=" . base_url('hero/update/' . $rows->id) . " class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
            $button3 = "<a href=" . base_url('hero/delete/' . $rows->id) . " class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
            $sub_array = array();
            $sub_array[] = $index;
            $sub_array[] = $rows->heading;
            $sub_array[] = $rows->sub_heading;
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
        $row = $this->Hero_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'heading' => $row->heading,
                'sub_heading' => $row->sub_heading,
                'image' => $row->image,
            );
            $this->load->view('header');
            $this->load->view('hero_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hero'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('hero/create_action'),
            'id' => set_value('id'),
            'heading' => set_value('heading'),
            'sub_heading' => set_value('sub_heading'),
            'image' => set_value('image'),
        );

        $this->load->view('header');
        $this->load->view('hero_form', $data);
        $this->load->view('footer');
    }

    public function create_action()
    {

        $data = array(
            'heading' => $this->input->post('heading', TRUE),
            'sub_heading' => $this->input->post('sub_heading', TRUE),
            'image' => upload_gambar_biasa('hero', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'image'),
        );

        $this->Hero_model->insert($data);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('hero'));
    }

    public function update($id)
    {
        $row = $this->Hero_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('hero/update_action'),
                'id' => set_value('id', $row->id),
                'heading' => set_value('heading', $row->heading),
                'sub_heading' => set_value('sub_heading', $row->sub_heading),
                'image' => set_value('image', $row->image),
            );
            $this->load->view('header');
            $this->load->view('hero_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hero'));
        }
    }

    public function update_action()
    {
        $id = $this->input->post('id', TRUE);
        $row = $this->Hero_model->get_by_id($id);

        $data = array(
            'heading' => $this->input->post('heading', TRUE),
            'sub_heading' => $this->input->post('sub_heading', TRUE),
            'image' => $_FILES['image']['name'] == "" ? $row->image : upload_gambar_biasa('hero', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'image'),
        );

        $this->Hero_model->update($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('hero'));
    }

    public function delete($id)
    {
        $row = $this->Hero_model->get_by_id($id);

        if ($row) {
            $this->Hero_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hero'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hero'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('heading', 'heading', 'trim|required');
        $this->form_validation->set_rules('sub_heading', 'sub heading', 'trim|required');
        $this->form_validation->set_rules('image', 'image', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Hero.php */
/* Location: ./application/controllers/Hero.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-07 11:54:27 */
/* http://harviacode.com */