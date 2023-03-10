<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Program_model extends CI_Model
{

	public function getProgram()
	{
		return $this->db->get('programs')->result_array();
	}
	public function getProgramWithJoin()
	{
		$q = "SELECT * FROM `programs` 
		JOIN `program_types` ON `programs`.`program_type_id`=`program_types`.`id_program_type`
		JOIN `program_paths` ON `programs`.`id_program`=`program_paths`.`program_id`
		JOIN `paths` ON `program_paths`.`path_id`=`paths`.`id_path`
		";
		return $this->db->query($q)->result_array();

		// return $this->db->get('programs')->result_array();
	}
	public function getProgramById($id_program)
	{
		return $this->db->get_where('programs', ['id_program' => $id_program])->row_array();
	}
	public function getProgramByProgramTypeName($type_name)
	{
		$this->db->select('*');
		$this->db->from('programs');
		$this->db->join('program_types', 'programs.program_type_id = program_types.id_program_type');
		$this->db->like('program_type_name', $type_name);
		return $this->db->get()->result_array();
	}
	public function getProgramByProgramTypeId($program_type_id)
	{

		$this->db->join('program_types', 'programs.program_type_id = program_types.id_program_type');
		return $this->db->get_where('programs', ['program_type_id' => $program_type_id])->result_array();
	}

	public function getProgramBySlug($slug)
	{
		return $this->db->get_where('programs', ['slug' => $slug])->row_array();
	}

	public function countProgram()
	{
		return $this->db->get('programs')->num_rows();
	}
	public function countProgramPengabdianForHome()
	{
		$q = "SELECT * FROM `programs` JOIN `program_types` ON `programs`.`program_type_id`=`program_types`.`id_program_type` WHERE `program_types`.`program_type_name`='Pengabdian' ";
		return $this->db->query($q)->num_rows();
	}
	public function countProgramCSRForHome()
	{
		$q = "SELECT * FROM `programs` JOIN `program_types` ON `programs`.`program_type_id`=`program_types`.`id_program_type` WHERE `program_types`.`program_type_name`='CSR' ";
		return $this->db->query($q)->num_rows();
	}
	public function storeProgram()
	{
		$start = $this->input->post('start', true) . ' ';
		$start .= $this->input->post('start_time', true) . ':00';

		$end = $this->input->post('end', true) . ' ';
		$end .= $this->input->post('end_time', true) . ':00';

		$deadline = $this->input->post('deadline', true) . ' ';
		$deadline .= $this->input->post('deadline_time', true) . ':00';

		$data = [
			"title" => $this->input->post('title', true),
			"guide_book_link" => $this->input->post('guide_book_link', true),
			"video" => $this->input->post('video', true),
			"location" => $this->input->post('location', true),
			"start" => $start,
			"end" => $end,
			"deadline" => $deadline,
			"work_method" => $this->input->post('work_method', true),
			"program_description" => $this->input->post('program_description', true),
			"delegation_requirement" => $this->input->post('delegation_requirement', true),
			"program_type_id" => $this->input->post('program_type_id', true),
			"program_activity" => $this->input->post('program_activity', true)
		];


		$data += [
			"slug" => url_title($data['title'], 'dash', true),
			"created_at" => time(),
			"is_active" => 'y'
		];


		$upload_image = (@$_FILES['image']['name']) ? true : false;

		if ($upload_image == true) {
			$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/program/image/';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$new_image = $this->upload->data('file_name');
				// $this->db->set('image', $new_image);
				$data += [
					"image" => $new_image
				];
			} else {
				echo $this->upload->display_errors();
			}
		}

		$upload_banner = (@$_FILES['banner']['name']) ? true : false;

		if ($upload_banner == true) {
			$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/program/banner/';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('banner')) {
				$new_banner = $this->upload->data('file_name');
				// $this->db->set('banner', $new_banner);
				$data += [
					"banner" => $new_banner
				];
			} else {
				echo $this->upload->display_errors();
			}
		}

		$upload_logo = (@$_FILES['logo']['name']) ? true : false;

		if ($upload_logo == true) {
			$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/program/logo/';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('logo')) {
				$new_logo = $this->upload->data('file_name');
				// $this->db->set('logo', $new_logo);
				$data += [
					"logo" => $new_logo
				];
			} else {
				echo $this->upload->display_errors();
			}
		}

		// $upload_video = (@$_FILES['video']['name']) ? true : false;

		// if ($upload_video == true) {
		// 	$config['allowed_types'] = 'webm|mpg|mp2|mpeg|mpe|mpv|ogg|mp4|m4p|m4v|avi|wmv|mov|qt|flv|swf|WEBM|MPG|MP2|MPEG|MPE|MPV|OGG|MP4|M4P|M4V|AVI|WMV|MOV|QT|FLV|SWF';
		// 	$config['max_size']     = '51200'; //50MB
		// 	$config['upload_path'] = './assets/video/program/video_preview/';
		// 	$config['encrypt_name'] = TRUE;
		// 	$this->load->library('upload', $config);

		// 	if ($this->upload->do_upload('video')) {
		// 		$new_video = $this->upload->data('file_name');
		// 		// $this->db->set('video', $new_video);
		// 		$data += [
		// 			"video" => $new_video
		// 		];
		// 	} else {
		// 		echo $this->upload->display_errors();
		// 	}
		// }

		return $this->db->insert('programs', $data);
	}

	public function updateProgram()
	{

		$start = $this->input->post('start', true) . ' ';
		$start .= $this->input->post('start_time', true) . ':00';

		$end = $this->input->post('end', true) . ' ';
		$end .= $this->input->post('end_time', true) . ':00';

		$deadline = $this->input->post('deadline', true) . ' ';
		$deadline .= $this->input->post('deadline_time', true) . ':00';

		$data = [
			"title" => $this->input->post('title', true),
			"guide_book_link" => $this->input->post('guide_book_link', true),
			"video" => $this->input->post('video', true),
			"location" => $this->input->post('location', true),
			"start" => $start,
			"end" => $end,
			"deadline" => $deadline,
			"work_method" => $this->input->post('work_method', true),
			"program_description" => $this->input->post('program_description', true),
			"delegation_requirement" => $this->input->post('delegation_requirement', true),
			"program_type_id" => $this->input->post('program_type_id', true),
			"program_activity" => $this->input->post('program_activity', true)
		];

		$data += [
			"slug" => url_title($data['title'], 'dash', true),
			"updated_at" => time(),
			"is_active" => 'y'
		];


		$upload_image = (@$_FILES['image']['name']) ? true : false;

		if ($upload_image == true) {
			$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/program/image/';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {

				$new_image = $this->upload->data('file_name');
				$data += [
					"image" => $new_image
				];
			} else {
				echo $this->upload->display_errors();
			}
		}

		$upload_banner = (@$_FILES['banner']['name']) ? true : false;

		if ($upload_banner == true) {
			$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/program/banner/';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('banner')) {
				$new_banner = $this->upload->data('file_name');
				$data += [
					"banner" => $new_banner
				];
			} else {
				echo $this->upload->display_errors();
			}
		}

		$upload_logo = (@$_FILES['logo']['name']) ? true : false;

		if ($upload_logo == true) {
			$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
			$config['max_size']     = '2048';
			$config['upload_path'] = './assets/img/program/logo/';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('logo')) {
				$new_logo = $this->upload->data('file_name');
				$data += [
					"logo" => $new_logo
				];
			} else {
				echo $this->upload->display_errors();
			}
		}

		// $upload_video = (@$_FILES['video']['name']) ? true : false;

		// if ($upload_video == true) {
		// 	$config['allowed_types'] = 'webm|mpg|mp2|mpeg|mpe|mpv|ogg|mp4|m4p|m4v|avi|wmv|mov|qt|flv|swf|WEBM|MPG|MP2|MPEG|MPE|MPV|OGG|MP4|M4P|M4V|AVI|WMV|MOV|QT|FLV|SWF';
		// 	$config['max_size']     = '51200'; //50MB
		// 	$config['upload_path'] = './assets/video/program/video_preview/';
		// 	$config['encrypt_name'] = TRUE;
		// 	$this->load->library('upload', $config);

		// 	if ($this->upload->do_upload('video')) {
		// 		$new_video = $this->upload->data('file_name');
		// 		$data += [
		// 			"video" => $new_video
		// 		];
		// 	} else {
		// 		echo $this->upload->display_errors();
		// 	}
		// }

		$this->db->where('id_program', $this->input->post('id_program'));

		$result = $this->db->update('programs', $data);

		if ($result == true) {
			$exImage = (@$data['image']) ? true : false;
			$exBanner = (@$data['banner']) ? true : false;
			$exLogo = (@$data['logo']) ? true : false;

			if ($exImage == true) {
				// delete old asset
				$old_image = $this->input->post('old_image', true);
				if ($old_image != 'default.jpg') {
					unlink(FCPATH . 'assets/img/program/image/' . $old_image);
				}
			}
			if ($exBanner == true) {
				$old_banner = $this->input->post('old_banner', true);
				if ($old_banner != 'default.jpg') {
					unlink(FCPATH . 'assets/img/program/banner/' . $old_banner);
				}
			}
			if ($exLogo == true) {
				$old_logo = $this->input->post('old_logo', true);
				if ($old_logo != 'default.jpg') {
					unlink(FCPATH . 'assets/img/program/logo/' . $old_logo);
				}
			}
		}

		return $result;
	}

	public function deleteProgram($id_program)
	{
		return $this->db->delete('programs', ['id_program' => $id_program]);
	}
}

/* End of file Program_model.php */
/* Location: ./application/models/Program_model.php */
