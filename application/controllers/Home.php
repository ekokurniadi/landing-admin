<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array();
        $data['header'] = $this->Home_model->getHeader();
        $data['hero'] = $this->Home_model->getHero();
        $data['about'] = $this->Home_model->getAbout();
        $data['about_detail'] = $this->Home_model->getAboutDetails();
        $data['galery'] = $this->Home_model->getGalery();
        $data['serviceRate'] = $this->Home_model->getServiceRate();
        $data['feature'] = $this->Home_model->getFeature();
        $data['service'] = $this->Home_model->getService();
        $data['testimonials'] = $this->Home_model->getTestimonials();
        $data['team'] = $this->Home_model->getTeam();
        $data['prices'] = $this->Home_model->getPrice();
        $data['faq'] = $this->Home_model->getFAQ();
        $data['address'] = $this->Home_model->getAdd();
        $this->load->view('template/index', $data);
    }

    public function saveMessage()
    {
        $name =  $this->input->post('name');
        $email = $this->input->post('email');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $save = $this->db->insert('message',array('name'=>$name,'email'=>$email,'subject'=>$subject,'message'=>$message));
        if($save){
            echo json_encode(array(
                "status"=>200,
                "message"=>"You're message has been submit, thank you.",
            ));
            alert_biasa("test","warning");
        }else{
            echo json_encode(array(
                "status"=>500,
                "message"=>"Something went wrong, please try again."
            ));
        }
    }
}
