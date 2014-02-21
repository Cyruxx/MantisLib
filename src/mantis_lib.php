<?php
/**
 * MantisLib by Alexander Mahrt aka. Cyruxx
 *
 * MantisLib is a SoapConnector Class for Mantis Bugtracker
 * @version 1.0.0
 */
class mantis_lib
{
    private $MANTIS_CONNECT_URL = '';
    private $MANTIS_CONNECT_USER = '';
    private $MANTIS_CONNECT_PASS = '';

    public function __construct($params)
    {
        if (array_key_exists('url', $params) && array_key_exists('username', $params) && array_key_exists('password', $params)) {
            $this->MANTIS_CONNECT_URL = $params['url'];
            $this->MANTIS_CONNECT_USER = $params['username'];
            $this->MANTIS_CONNECT_PASS = $params['password'];
        } else {
            throw new Exception('Constructor did not receive correct arguments.<br> Required Arguments are: url, username, password    as    array keys!');
        }
    }

    private function make_soap_call($func, $params = array())
    {
        $args = array(
            'username' => $this->MANTIS_CONNECT_USER,
            'password' => $this->MANTIS_CONNECT_PASS
        );

        if (count($args) != 0) {
            //Check if username/password is given in parameters of function
            if (array_key_exists('username', $params) || array_key_exists('password', $params)) {
                $args = $params;
            } else {
                $args = array_merge(
                    $params,
                    $args
                );
            }
        }

        try {
            $client = new SoapClient($this->MANTIS_CONNECT_URL . '?wsdl');
            $result = $client->__soapCall($func, $args);
        } catch (SoapFault $e) {
            throw new Exception('MantisLib Error: ' . $e->faulstring);
        }
        return $result;
    }

    public function mc_version()
    {
        return $this->make_soap_call('mc_version');
    }

    public function mc_login($username, $password)
    {
        $args = array(
            'username' => $username,
            'password' => $password
        );
        return $this->make_soap_call('mc_login', $args);
    }

    public function enum_status()
    {
        return $this->make_soap_call('mc_enum_status');
    }

    public function enum_priorities()
    {
        return $this->make_soap_call('mc_enum_priorities');
    }

    public function enum_severities()
    {
        return $this->make_soap_call('mc_enum_severities');
    }

    public function enum_reproducibilities()
    {
        return $this->make_soap_call('mc_enum_reproducibilities');
    }

    public function enum_projections()
    {
        return $this->make_soap_call('mc_enum_projections');
    }

    public function enum_etas()
    {
        return $this->make_soap_call('mc_enum_etas');
    }

    public function enum_resolutions()
    {
        return $this->make_soap_call('mc_enum_resolutions');
    }

    public function enum_access_levels()
    {
        return $this->make_soap_call('mc_enum_access_levels');
    }

    public function enum_project_status()
    {
        return $this->make_soap_call('mc_enum_project_status');
    }

    public function enum_project_view_states()
    {
        return $this->make_soap_call('mc_enum_project_view_states');
    }

    public function enum_view_states()
    {
        return $this->make_soap_call('mc_enum_view_states');
    }

    public function enum_custom_field_types()
    {
        return $this->make_soap_call('mc_enum_custom_field_types');
    }

    public function enum_get($enumeration)
    {
        return $this->make_soap_call('mc_enum_get', array('enumeration' => $enumeration));
    }

    public function issue_exists($issue_id)
    {
        return $this->make_soap_call('mc_issue_exists', array('issue_id' => $issue_id));
    }

    public function issue_get($issue_id)
    {
        return $this->make_soap_call('mc_issue_get', array('issue_id' => $issue_id));
    }

    public function issue_get_biggest_id($project_id)
    {
        return $this->make_soap_call('mc_issue_get_biggest_id', array('project_id' => $project_id));
    }

    public function issue_get_id_from_summary($summary)
    {
        return $this->make_soap_call('mc_issue_get_id_from_summary', array('summary' => $summary));
    }

    public function issue_add($issue_data)
    {
        return $this->make_soap_call('mc_issue_add', array('issue' => $issue_data));
    }

    public function issue_update($issue_id, $issue_data)
    {
        return $this->make_soap_call('mc_issue_update', array('issueId' => $issue_id, 'issue' => $issue_data));
    }

    public function issue_set_tags($issue_id, $tags)
    {
        return $this->make_soap_call('mc_issue_set_tags', array('issue_id' => $issue_id, 'tags' => $tags));
    }

    public function issue_delete($issue_id)
    {
        return $this->make_soap_call('mc_issue_delete', array('issue_id' => $issue_id));
    }

    public function issue_note_add($issue_id, $note)
    {
        return $this->make_soap_call('mc_issue_note_add', array('issue_id' => $issue_id, 'note' => $note));
    }

    public function issue_note_delete($issue_note_id)
    {
        return $this->make_soap_call('mc_issue_note_delete', array('issue_note_id' => $issue_note_id));
    }

    public function issue_note_update($note)
    {
        return $this->make_soap_call('mc_issue_note_update', array('note' => $note));
    }

    public function issue_relationship_add($issue_id, $relationship)
    {
        return $this->make_soap_call('mc_issue_relationship_add', array('issue_id' => $issue_id, 'relationship' => $relationship));
    }

    public function issue_relationship_delete($issue_id, $relationship_id)
    {
        return $this->make_soap_call('mc_issue_relationship_delete', array('issue_id' => $issue_id, 'relationship_id' => $relationship_id));
    }

    public function issue_attachment_add($issue_id, $name, $file_type, $content)
    {
        return $this->make_soap_call('mc_issue_attachment_add', array('issue_id' => $issue_id, 'name' => $name, 'file_type' => $file_type, 'content' => $content));
    }

    public function issue_attachment_delete($issue_attachment_id)
    {
        return $this->make_soap_call('mc_issue_delete', array('issue_attachment_id' => $issue_attachment_id));
    }

    public function issue_attachment_get($issue_attachment_id)
    {
        return $this->make_soap_call('mc_issue_attachment_get', array('issue_attachment_id' => $issue_attachment_id));
    }

    public function project_add($project)
    {
        return $this->make_soap_call('mc_project_add', array('project' => $project));
    }

    public function project_delete($project_id)
    {
        return $this->make_soap_call('mc_project_delete', array('project_id' => $project_id));
    }

    public function project_update($project_id, $project)
    {
        return $this->make_soap_call('mc_project_update', array('project_id' => $project_id, 'project' => $project));
    }

    public function project_get_id_from_name($project_name)
    {
        return $this->make_soap_call('mc_project_get_id_from_name', array('project_name' => $project_name));
    }

    public function project_get_issues($project_id, $page_number, $per_page)
    {
        return $this->make_soap_call('mc_project_get_issues', array('project_id' => $project_id, 'page_number' => $page_number, 'per_page' => $per_page));
    }

    public function project_get_issue_headers($project_id, $page_number, $per_page)
    {
        return $this->make_soap_call('mc_project_get_issue_headers', array('project_id' => $project_id, 'page_number' => $page_number, 'per_page' => $per_page));
    }

    public function project_get_users($project_id, $access)
    {
        return $this->make_soap_call('mc_project_get_users', array('project_id' => $project_id, 'access' => $access));
    }

    public function project_get_users_accessible()
    {
        return $this->make_soap_call('mc_project_get_users_accessible');
    }

    public function project_get_categories($project_id)
    {
        return $this->make_soap_call('mc_project_get_categories', array('project_id' => $project_id));
    }

    public function project_add_category($project_id, $p_category_name)
    {
        return $this->make_soap_call('mc_project_add_category', array('project_id' => $project_id, 'p_category_name' => $p_category_name));
    }

    public function project_delete_category($project_id, $p_category_name)
    {
        return $this->make_soap_call('mc_project_delete_category', array('project_id' => $project_id, 'p_category_name' => $p_category_name));
    }

    public function project_rename_category_by_name($project_id, $p_category_name, $p_category_name_new, $p_assigned_to)
    {
        return $this->make_soap_call('mc_project_rename_category_by_name', array(
            'project_id' => $project_id,
            'p_category_name' => $p_category_name,
            'p_category_name_new' => $p_category_name_new,
            'p_assigned_to' => $p_assigned_to
        ));
    }

    public function project_get_versions($project_id)
    {
        return $this->make_soap_call('mc_project_get_versions', array('project_id' => $project_id));
    }

    public function project_version_add($version)
    {
        return $this->make_soap_call('mc_project_version_add', array('version' => $version));
    }

    public function project_version_update($version_id, $version)
    {
        return $this->make_soap_call('mc_project_version_update', array('version_id' => $version_id, 'version' => $version));
    }

    public function project_version_delete($version_id)
    {
        return $this->make_soap_call('mc_project_version_delete', array('verison_id' => $version_id));
    }

    public function project_get_released_versions($project_id)
    {
        return $this->make_soap_call('mc_project_get_released_versions', array('project_id' => $project_id));
    }

    public function project_get_unreleased_versions($project_id)
    {
        return $this->make_soap_call('mc_project_get_unreleased_versions', array('project_id' => $project_id));
    }

    public function project_get_attachments($project_id)
    {
        return $this->make_soap_call('mc_project_get_attachments', array('project_id' => $project_id));
    }

    public function project_get_custom_fields($project_id)
    {
        return $this->make_soap_call('mc_project_get_customs_fields', array('project_id' => $project_id));
    }

    public function project_attachment_get($project_attachment_id)
    {
        return $this->make_soap_call('mc_project_attachment_get', array('project_attachment_id' => $project_attachment_id));
    }

    public function project_attachment_add($project_id, $name, $title, $description, $file_type, $content)
    {
        return $this->make_soap_call('mc_project_attachment_add', array(
            'project_id' => $project_id,
            'name' => $name,
            'title' => $title,
            'description' => $description,
            'file_type' => $file_type,
            'content' => $content,
        ));
    }

    public function project_attachment_delete($project_attachment_id)
    {
        return $this->make_soap_call('mc_project_attachment_delete', array('project_attachment_id' => $project_attachment_id));
    }

    public function project_get_all_subprojects($project_id)
    {
        return $this->make_soap_call('mc_project_get_all_subprojects', array('project_id' => $project_id));
    }

    public function filter_get($project_id)
    {
        return $this->make_soap_call('mc_filter_get', array('project_id' => $project_id));
    }

    public function filter_get_issues($project_id, $filter_id, $page_number, $per_page)
    {
        return $this->make_soap_call('mc_filter_get_issues', array('project_id' => $project_id, 'filter_id' => $filter_id, 'page_number' => $page_number, 'per_page' => $per_page));
    }

    public function filter_get_issue_headers($project_id, $filter_id, $page_number, $per_page)
    {
        return $this->make_soap_call('mc_filter_get_issue_headers', array('project_id' => $project_id, 'filter_id' => $filter_id, 'page_number' => $page_number, 'per_page' => $per_page));
    }

    public function config_get_string($config_var)
    {
        return $this->make_soap_call('mc_config_get_string', array('config_var' => $config_var));
    }

    public function issue_checkin($issue_id, $comment, $fixed)
    {
        return $this->make_soap_call('mc_issue_checkin', array('issue_id' => $issue_id, 'comment' => $comment, 'fixed' => $fixed));
    }

    public function user_pref_get_pref($project_id, $pref_name)
    {
        return $this->make_soap_call('mc_user_pref_get_pref', array('project_id' => $project_id, 'pref_name' => $pref_name));
    }

    public function user_profiles_get_all($page_number, $per_page)
    {
        return $this->make_soap_call('mc_user_profiles_get_all', array('page_number' => $page_number, 'per_page' => $per_page));
    }

    public function tag_get_all($page_number, $per_page)
    {
        return $this->make_soap_call('mc_tag_get_all', array('page_number' => $page_number, 'per_page' => $per_page));
    }

    public function tag_add($tag)
    {
        return $this->make_soap_call('mc_tag_add', array('tag' => $tag));
    }

    public function tag_delete($tag_id)
    {
        return $this->make_soap_call('mc_tag_delete', array('tag_id' => $tag_id));
    }
} 