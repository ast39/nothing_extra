<?php


/**
 * Created by PhpStorm.
 * User: Alexandr Statut
 * Date: 23.09.2019
 * Time: 13:31
 */

namespace admin\langs\en;

use framework\classes\Lang;


class Main extends Lang {

    protected $main_title = 'Admin Panel';

    protected $menu_lic = 'License';
    protected $menu_logs = 'Logs';
    protected $menu_logs_errors = 'Error logs';
    protected $menu_logs_visits = 'Visit logs';
    protected $menu_manage = 'Management';
    protected $menu_manage_robots = 'Search Rules';
    protected $menu_manage_sitemap = 'Site map';
    protected $menu_manage_htaccess = 'Web Server';
    protected $menu_manage_status = 'Site Status';
    protected $menu_redactor = 'Editor';
    protected $menu_image = 'Images';
    protected $menu_project = 'Project';
    protected $menu_competition = 'Competition';
    protected $menu_manual = 'Manual';
    protected $menu_logout = 'Logout';

    protected $login_name = 'User';
    protected $login_pass = 'Password';
    protected $login_auth = 'Auth';
    protected $login_default_data = 'You using the default login and / or insecure password. Please, change parameters 
                                      "admin_login" and "admin_password" in the file "Settings.php" and try to log in again.';
    protected $login_wrong_data = 'Wrong data';

    protected $lic_head_1 = 'License Agreement';
    protected $lic_head_2 = '# NothingExtra License Agreement';

    protected $errorlog_head = 'Weekly error logs';
    protected $errorlog_err_1 = 'No logs';
    protected $errorlog_t1 = 'Time';
    protected $errorlog_t2 = 'IP';
    protected $errorlog_t3 = 'Error';
    protected $errorlog_t4 = 'URL';

    protected $visitlog_head = 'Weekly Visit Logs';
    protected $visitlog_err_1 = 'No logs';
    protected $visitlog_t1 = 'Time';
    protected $visitlog_t2 = 'Visitor';
    protected $visitlog_t3 = 'Browser';
    protected $visitlog_t4 = 'OS';
    protected $visitlog_t5 = 'IP';
    protected $visitlog_t6 = 'URL';

    protected $redactor_head = 'File manager';
    protected $redactor_path = 'Current path: ';
    protected $redactor_stepback = 'Step back';
    protected $redactor_ask_dir = 'Do you want to delete the directory permanently?';
    protected $redactor_ask_file = 'Do you want to delete the file permanently?';
    protected $redactor_new_file = 'Create a file in the current directory';
    protected $redactor_new_dir = 'Create a directory in the current directory';
    protected $redactor_err_1 = 'Access is denied to the selected directory';
    protected $redactor_err_2 = 'It is forbidden to create a file in this directory';
    protected $redactor_err_3 = 'It is forbidden to create directories in this directory';
    protected $redactor_err_4 = 'You did not specify a name for the new directory';
    protected $redactor_err_5 = 'Error! Removal failed; Code 404 ';
    protected $redactor_err_6 = 'Error! There are files in the catalog ';
    protected $redactor_err_7 = 'Error! Removal failed; Code 500 ';
    protected $redactor_err_8 = 'Error! It is forbidden to edit this file ';
    protected $redactor_err_9 = 'Error! Editing failed; Code 404 ';
    protected $redactor_err_10 = 'Error! Editing failed; Code 500 ';
    protected $redactor_scs_1 = 'File created successfully: ';
    protected $redactor_scs_2 = 'The directory was created successfully: ';
    protected $redactor_scs_3 = 'File deleted successfully';
    protected $redactor_scs_4 = 'Directory deleted successfully';
    protected $redactor_scs_5 = 'File edited successfully';
    protected $redactor_add_dir = 'Add new directory';
    protected $redactor_add_file = 'Add new file';
    protected $redactor_edit_file = 'File Code Editor';
    protected $redactor_edit_form = 'Code editing window';
    protected $redactor_file_name = 'File Name';
    protected $redactor_dir_name = 'Directory name';
    protected $redactor_add = 'Add';
    protected $redactor_save = 'Save';
    protected $redactor_cancel = 'Cancel';

    protected $images_head = 'Images upload';
    protected $images_path = 'Directory to save';
    protected $images_d_general = 'General';
    protected $images_d_project = 'Project';
    protected $images_d_ico     = 'Icons';
    protected $images_d_gallery = 'Gallery';
    protected $images_filename = 'Server file name';
    protected $images_uploadfile = 'Upload file';
    protected $images_upload = 'Upload';
    protected $images_err_1 = 'Error uploading file';
    protected $images_err_2 = 'File must not exceed size in ';
    protected $images_err_3 = 'Only type files (jpg / jpeg / png / gif) can be uploaded';
    protected $images_err_4 = 'Unfortunately, the file could not be uploaded to the server';
    protected $images_scs = 'File uploaded. Link for insertion: (img src = "[IMG]';

    protected $manage_robots_head = 'Indexing Settings Editor';
    protected $manage_sitemap_head = 'Site Map Editor';
    protected $manage_htaccess_head = 'Web Server Settings Editor';
    protected $manage_status_head = 'On / Off access to the site';
    protected $manage_scs_1 = 'File updated successfully';
    protected $manage_scs_2 = 'Site status has been successfully changed';
    protected $manage_err_1 = 'Error saving file';
    protected $manage_err_2 = 'You have selected the current status';
    protected $manage_err_3 = 'Template not found ';
    protected $manage_edit = 'Editing';
    protected $manage_save = 'Save';
    protected $manage_clean = 'Clear';
    protected $manage_for_all = 'Website is available to users';
    protected $manage_for_admin = 'The site is accessible only to administrators';

}