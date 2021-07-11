<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model
{

    public function getHeader()
    {
        return $this->db->get('header');
    }
    public function getHero()
    {
        return $this->db->get('hero');
    }
    public function getAbout()
    {
        return $this->db->get('about');
    }
    public function getAboutDetails()
    {
        return $this->db->get('about_detail');
    }
    public function getGalery()
    {
        return $this->db->get('galery');
    }
    public function getServiceRate()
    {
        return $this->db->get('service_rate');
    }
    public function getFeature()
    {
        return $this->db->get('feature');
    }
    public function getService()
    {
        return $this->db->get('service');
    }
    public function getTestimonials()
    {
        return $this->db->get('testimoni');
    }
    public function getTeam()
    {
        return $this->db->get('team');
    }
    public function getPrice()
    {
        return $this->db->get('pricing');
    }
    public function getFAQ()
    {
        return $this->db->get('frequently_asked_questions');
    }
    public function getAdd()
    {
        return $this->db->get('contact');
    }
}
