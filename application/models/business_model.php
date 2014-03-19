<?php

class Business_model extends Model {
	
function hasPhotos($businessID) {
	$busid = $businessID;
	$this->db->select('*');
	$query = $this->db->get_where('photos',array('busid'=>$busid));
	return $query->result();
}

function hasVideos($businessID) {
	$busid = $businessID;
	$this->db->select('*');
	$query = $this->db->get_where('video',array('busid'=>busid));
	return $query->result();
}

function categoryList() {
	$this->db->select('*');
	$this->db->from('category');
	$this->db->order_by("catname", "asc");
	return $this->db->get();
}

function getCatPageName($id) {
	$this->db->select('*');
	$this->db->from('category');
	$this->db->where('cid', $id);
	return $this->db->get();
}

function getSpecials($id) {
	$this->db->select('*');
	$this->db->from ('specials as s');
	$this->db->where('s.busid', $id);
	return $this->db->get();
}



function categoryPageList($id) {
	$this->db->select('b.id, b.busname, b.busowner, b.webaddress, p.thumb, v.title, c.catname, s.specname, p.thumb, c.cid');
	$this->db->from ('business AS b');
	$this->db->where('b.category', $id);
	$this->db->join('photos AS p', 'p.busid = b.id', 'left');
	$this->db->join('video AS v', 'v.busid = b.id', 'left');
	$this->db->join('specials AS s', 's.busid = b.id', 'left');
	$this->db->join('category As c', 'b.category = c.cid', 'left');
	$this->db->group_by("b.id");
	return $this->db->get();
}

function frontPageList() {
	$this->db->select('b.id, b.busname, b.busowner, b.webaddress, b.category, p.thumb, v.title, c.catname, c.cid, s.specname');
	$this->db->from ('business AS b');
	$this->db->where('b.featured', '1');
	$this->db->join('photos AS p', 'p.busid = b.id', 'left');
	$this->db->join('video AS v', 'v.busid = b.id', 'left');
	$this->db->join('specials AS s', 's.busid = b.id', 'left');
	$this->db->join('category As c', 'b.category = c.cid', 'left');
	$this->db->group_by("b.id"); 
	return $this->db->get();	
}

function businessQuery($id) {
	$this->db->select('b.id, b.busname, b.busowner, b.webaddress, b.buscity, b.buszip, b.busphone, b.busaddress, b.description');
	$this->db->from('business AS b');
	$this->db->where('b.id', $id);
	return $this->db->get();
}

function addressForMap($id) {
	$this->db->select('b.id, b.busaddress, b.buscity, b.buszip');
	$this->db->from('business as b');
	$this->db->where('b.id', $id);
// add a limit
    $this->db->limit(1);

    // get the results.. cha-ching
    $q = $this->db->get();

    // any results?
    if($q->num_rows() !== 1)
    {
        return FALSE;
    }

    return $q->row();
}


}