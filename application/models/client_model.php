<?php

class Client_model extends Model {
	
function categoryPageList($catID) {
	$this->db->select('b.busname, p.photoname, v.title, c.catname, c.id');
	$this->db->from ('business AS b');
	$this->db->where('b.category', $catID);
	$this->db->join('photos AS p', 'p.busid = b.id', 'left');
	$this->db->join('video AS v', 'v.busid = b.id', 'left');
	$this->db->join('specials AS s', 's.busid = b.id', 'left');
	$this->db->join('category As c', 'b.category = c.id', 'left');
	return $this->db->get();
}

function businessQueryByUser() {
	$userid = $this->tank_auth->get_user_id();
	$this->db->select('*');
	$this->db->from('business AS b');
	$this->db->where('b.userid', $userid);
	return $this->db->get();
}

function clientWelcome() {
	$userid = $this->tank_auth->get_user_id();
	$this->db->select('b.id,b.busname');
	$this->db->from ('business as b');
	$this->db->where('b.userid', $userid);
	return $this->db->get();
}

function profile_get_specials($id) {
	$userid = $this->tank_auth->get_user_id();
	$this->db->select('*');
	$this->db->from('specials as s');
	$this->db->where('s.userid', $userid);
	return $this->db->get();
}

function get_bus_id() {
        $userid = $this->tank_auth->get_user_id();
        $this->db->select('b.id');
        $this->db->from ('business AS b');
        $this->db->where ('b.userid', $userid);
        $query = $this->db->get();
            if ($query->num_rows() > 0) {
              // RESULT ARRAY RETURN A MULTIDIMENSIONAL ARRAY e.g. ARRAY OF DB RECORDS
              // ( ROWS ), SO IT DOENS'T FIT
              //return $query->result_array();
              // THE CORRECT METHOD IS row_array(), THAT RETURN THE FIRST ROW OF THE
              // RECORDSET
              return $query->row_array();
            }
        }
		
function updateProfile($businessname, $owner, $address, $city, $zip, $phone, $web, $category, $description, $redirect, $userid, $busid) {
	
	$this->db->select('b.id');
	$this->db->from ('business AS b');
	$this->db->where ('b.userid', $userid);
	$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			$data = array(
				'busname' => $businessname,
				'busowner' => $owner,
				'busaddress' => $address,
				'buscity' => $city,
				'busstate' => 'AZ',
				'buszip' => $zip,
				'busphone' => $phone,
				'webaddress' => $web,
				'category' => $category,
				'description' => $description,
				'userid' => $userid,
				);
			$this->db->select('b.id');
			$this->db->from ('business AS b');
			$this->db->where('id',$busid);
			$this->db->update('business', $data);
		}
		
		else {
			$data = array(
				'busname' => $businessname,
				'busowner' => $owner,
				'busaddress' => $address,
				'buscity' => $city,
				'busstate' => 'AZ',
				'buszip' => $zip,
				'busphone' => $phone,
				'webaddress' => $web,
				'category' => $category,
				'description' => $description,
				'featured' => 1,
				'userid' => $userid,
				);
			$this->db->insert('business', $data);
			
		}
	
	$goback = $redirect . '/' . $userid;
	
	redirect($goback);
}

function updateSpecial($name, $description, $redirect, $userid, $busid) {
	
	$this->db->select('s.sid');
	$this->db->from ('specials AS s');
	$this->db->where ('s.userid', $userid);
	$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			$data = array(
				'specname' => $name,
				'specdesc' => $description,
				'busid' => $busid,
				'userid' => $userid,
				);
			$this->db->select('s.sid');
			$this->db->from ('specials AS s');
			$this->db->where('id',$busid);
			$this->db->update('specials', $data);
		}
		
		else {
			$data = array(
				'specname' => $name,
				'specdesc' => $description,
				'busid' => $busid,
				'userid' => $userid,
				);
			$this->db->insert('specials', $data);
			
		}
	
	$goback = $redirect . '/' . $userid;
	
	redirect($goback);
}


}