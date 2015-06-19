<?php
class Login_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function get_officer($officerID = FALSE)
    {
        if ($officerID === FALSE)
        {
            $query = $this->db->get('security_officer');
            return $query->result_array();
        }

        $query = $this->db->get_where('security_officer', array('officer_id' => $officerID));
        return $query->row_array();
    }

    // public function set_news()
    // {
    //     $this->load->helper('url');

    //     $slug = url_title($this->input->post('title'), 'dash', TRUE);

    //     $data = array(
    //         'title' => $this->input->post('title'),
    //         'slug' => $slug,
    //         'text' => $this->input->post('text')
    //     );

    //     return $this->db->insert('news', $data);
    // }
}
?>