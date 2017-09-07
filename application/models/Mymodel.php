<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model{

	public $table = 'user';
	
	public function create($data){
		$t = $this->table;
		$query = $this->db->insert($t,$data);
		return $query;
	}

    public function counts($t = '',$id){
                $query = $this->db->get_where($t, array('user_id' => $id))->num_rows();
        return $query;
    }

	public function read($limit='',$search=''){
		$t = $this->table;
        if ($limit != '') {
           $this->db->limit($limit);
        }
        if ($search != '') {
            $this->db->like('user.email', $search);
            $this->db->or_like('user.name', $search);
        }

		$this->db->order_by('id', 'DESC');

		$query = $this->db->get($t);
		return $query;
	}

        public function readChat($limit='',$search=''){
        $t = $this->table;
        if ($limit != '') {
           $this->db->limit($limit);
        }
        if ($search != '') {
            $this->db->like('title', $search);
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get($t);
        return $query;
    }

	public function read_by_id($field,$id){
		$t = $this->table;
    	$query = $this->db->get_where($t, array($field => $id));
    	return $query;
    }

	public function update($id, $data){
		$t = $this->table;

		$this->db->where('id',$id);
		$query = $this->db->update($t,$data);
		return $query;
	}

    public function delete($id){
    	$t = $this->table;

	    return $this->db->delete($t, array('id' => $id));
	}

	public function getPost($id = '',$category = '',$limit='',$search ='', $status = '', $by = ''){
        $this->db->select('post.*, category.name as category_name, category.icon as category_icon, user.name as user_name, user.avatar as user_avatar');
        $this->db->from('post');
        $this->db->join('category', 'category.id = post.category_id');
        $this->db->join('user', 'user.id = post.user_id');
        if ($id != '') {
	        $this->db->where('post.id',$id);
        }

        if ($by != '') {
            $this->db->where('post.user_id',$by);
        }

        if ($category != '') {
            $this->db->where('post.category_id',$category);
        }

        if ($search != '') {
            $this->db->like('post.description', $search);
            $this->db->or_like('user.name', $search);
        }

        if ($limit != '') {
           $this->db->limit($limit);
        }

        if ($status != '') {
            $this->db->where('post.status',$status);
        }

        $this->db->order_by('created_at', 'DESC');

        $query = $this->db->get();
        return $query;
    }

	public function search($q){
        $this->db->select('post.*, category.name as category_name, category.icon as category_icon, user.name as user_name, user.avatar as user_avatar');
        $this->db->from('post');
        $this->db->join('category', 'category.id = post.category_id');
        $this->db->join('user', 'user.id = post.user_id');
	    $this->db->like('post.description',$q);
        $query = $this->db->get();
        return $query;
    }

    public function getReport($search = '',$limit=''){
        $this->db->select('report.*, user.name, user.avatar');
        $this->db->from('report');
        $this->db->join('user', 'user.id = report.user_id');
        if ($search != '') {
            $this->db->like('report.message',$search);
            $this->db->or_like('user.name',$search);
        }
        if ($limit != '') {
           $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query;
    }

    public function getComment($limit='',$search = '',$id='', $by=''){
        $this->db->select('comment.*, user.name, user.avatar');
        $this->db->from('comment');
        $this->db->join('user', 'user.id = comment.user_id');

        if ($id != '') {
            $this->db->where('comment.post_id',$id);
        }

        if ($by != '') {
            $this->db->where('comment.user_id',$by);
        }

        if ($search != '') {
            $this->db->like('comment.message',$search);
	        $this->db->or_like('user.name',$search);
        }

        if ($limit != '') {
           $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query;
    }


    public function getActivity($id = ''){
        $this->db->select('comment.*, post.description, post.file_name');
        $this->db->from('comment');
        $this->db->join('post', 'post.id = comment.post_id');
        if ($id != '') {
	        $this->db->where('comment.user_id',$id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getChat($id='', $order =''){
        $this->db->select('chat.*, user.name, user.avatar, user.role');
        $this->db->from('chat');
        $this->db->join('user', 'user.id = chat.user_id');
        $this->db->where('chat.room_id',$id);
        if ($order != '') {
            $this->db->order_by('chat.created_at', $order);
        }
        $query = $this->db->get();
        return $query;
    }

    public function auth($token){
		$q = $this->db->get_where('user', array('token' => $token));
		return $q;
    }
    
    public function cek($u='', $p=''){
		$q = $this->db->get_where('user', array('email' => $u, 'password' => $p));
		if($q->num_rows() == 1){
			$id = $q->row()->id;
            $token = array('token' => hash('sha256',"sb-".$id."-".date("Y-m-d H:i:s")));
            $this->update($id, $token);
			return $this->db->get_where('user',array('id' => $id));
		}else{
			return false;
		}
	}
}
?>