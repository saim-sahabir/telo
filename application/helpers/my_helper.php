<?php

function getDesignationName($id){
    $CI = & get_instance();
    $designation_information = $CI->db->query("SELECT * FROM tbl_designations where `id`='$id'")->row(); 

    return $designation_information->designation_name;
}

function dateFormatForPHP(){
    $CI = & get_instance();
    $org_info = $CI->db->query("SELECT * FROM tbl_organization where `id`=1")->row(); 

    return $org_info->date_format; 
}

function dateFormatForJS(){
    $CI = & get_instance();
    $org_info = $CI->db->query("SELECT * FROM tbl_organization where `id`=1")->row(); 
 

    if ($org_info->date_format == 'd/m/Y') {
    	$date_format = 'dd/mm/yyyy';
    }elseif ($org_info->date_format == 'm/d/Y') {
    	$date_format = 'mm/dd/yyyy';
    }elseif ($org_info->date_format == 'Y/m/d') {
    	$date_format = 'yyyy/mm/dd';
    }

    return $date_format; 
}

function getProjectName($project_id){
	$CI = & get_instance();
    $project_information = $CI->db->query("SELECT * FROM tbl_projects where `id`='$project_id'")->row(); 

    return $project_information->project_name;
}

function getMembersActivity($date, $team_member_id){
    $CI = & get_instance();
    $activity_info = $CI->db->query("SELECT * FROM tbl_activities where `user_id`='$team_member_id' and `date`='$date'")->result(); 

    return $activity_info;
}

function getMembersActivityHours($date, $team_member_id){
    $CI = & get_instance();
    $activity_info = $CI->db->query("SELECT SUM(hour_spent) as hour_spent FROM tbl_activities where `user_id`='$team_member_id' and `date`='$date'")->row(); 

    return $activity_info;
}

function getProjectsActivity($date, $project_id){
    $CI = & get_instance();
    $project_activity = $CI->db->query("SELECT * FROM tbl_activities where `project_id`='$project_id' and `date`='$date'")->result(); 

    return $project_activity;
}

function getUserName($id){
    $CI = & get_instance();
    $user_info = $CI->db->query("SELECT * FROM tbl_users where `id`='$id'")->row(); 

    return $user_info->first_name." ".$user_info->last_name;
}
 

function getProjectsActivityHours($date, $project_id){
    $CI = & get_instance();
    $activity_info = $CI->db->query("SELECT SUM(hour_spent) as hour_spent FROM tbl_activities where `project_id`='$project_id' and `date`='$date'")->row(); 

    return $activity_info;
}

function getAllByTable($tabl_name){
    $CI = & get_instance();
    $projects = $CI->db->query("SELECT * FROM $tabl_name where del_status='Live'")->result(); 

    return $projects;
}

function getProjectHours($project_id){
    $CI = & get_instance();
    $projects_hours = $CI->db->query("SELECT SUM(hour_spent) as project_hours FROM tbl_activities where project_id='$project_id' and del_status='Live'")->row(); 

    return $projects_hours;
}

function getUserHours($user_id){
    $CI = & get_instance();
    $users_hours = $CI->db->query("SELECT SUM(hour_spent) as user_hours FROM tbl_activities where user_id='$user_id' and del_status='Live'")->row(); 

    return $users_hours;
}

 