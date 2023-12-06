<?php

namespace App\Models;

use CodeIgniter\Model;

class TagsProjectModel extends Model
{
  protected $table = 'project_tags';
  protected $primaryKey = 'id_project_tag';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
    'id_project_tag',
    'id_project',
    'id_tag'
  ];

  public function getTagsByProject($id_project)
  {
    $query = $this->db->query(
      "SELECT t.* FROM project_tags pt
      INNER JOIN tags t ON pt.id_tag = t.id_tag
      WHERE pt.id_project = $id_project"
    )->getResultArray();

    $tags = [];

    foreach ($query as $tag) {
      $tags[] = $tag['tag'];
    }

    return $tags;
  }

  public function projectHasTagType($id_project, $id_tag_type)
  {
    return count($this->db->query(
      "SELECT t.* FROM project_tags pt
      INNER JOIN tags t ON pt.id_tag = t.id_tag
      WHERE pt.id_project = $id_project AND t.id_tag_type = $id_tag_type"
    )->getResultArray()) > 0;
  }

  public function projectHasTag($id_project, $id_tag)
  {
    return count($this->db->query(
      "SELECT t.* FROM project_tags pt
      INNER JOIN tags t ON pt.id_tag = t.id_tag
      WHERE pt.id_project = $id_project AND t.id_tag = $id_tag"
    )->getResultArray()) > 0;
  }

  public function deleteByTypeAndProject($id_project, $id_type)
  {
    return $this->db->query(
      "DELETE pt FROM project_tags pt
      INNER JOIN tags t ON pt.id_tag = t.id_tag
      WHERE t.id_tag_type = $id_type AND pt.id_project = $id_project"
    );
  }

  public function deleteTagsProject($id_project)
  {
    return $this->db->query(
      "DELETE FROM project_tags
      WHERE id_project = $id_project"
    );
  }
}
