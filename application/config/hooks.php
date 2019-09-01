<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_system'][] = array(
                                'function' => 'pre_system',
                                'filename' => 'common.php',
                                'filepath' => 'hooks'
                                );

$hook['post_controller_constructor'][] = array(
                                'function' => 'hook_is_mobile',
                                'filename' => 'common.php',
                                'filepath' => 'hooks'
                                );


$hook['post_controller_constructor'][] = array(
                                'function' => 'hook_get_alrim',
                                'filename' => 'chat_hook.php',
                                'filepath' => 'hooks'
                                );

$hook['post_controller_constructor'][] = array(
                                'function' => 'hook_get_chat',
                                'filename' => 'chat_hook.php',
                                'filepath' => 'hooks'
                                );

$hook['post_controller_constructor'][] = array(
                                'function' => 'hook_get_chat_first_load',
                                'filename' => 'chat_hook.php',
                                'filepath' => 'hooks'
                                );

$hook['post_controller_constructor'][] = array(
                                'function' => 'hook_get_alrim_chat_list',
                                'filename' => 'chat_hook.php',
                                'filepath' => 'hooks'
                                );

$hook['post_controller_constructor'][] = array(
                                'function' => 'hook_get_alrim_msg_list',
                                'filename' => 'chat_hook.php',
                                'filepath' => 'hooks'
                                );

$hook['post_controller_constructor'][] = array(
                                'function' => 'hook_get_alrim_joy_list',
                                'filename' => 'chat_hook.php',
                                'filepath' => 'hooks'
                                );

$hook['post_controller_constructor'][] = array(
                                'function' => 'hook_is_login',
                                'filename' => 'common.php',
                                'filepath' => 'hooks'
                                );

$hook['post_controller_constructor'][] = array(
                                'function' => 'hook_auto_check',
                                'filename' => 'common.php',
                                'filepath' => 'hooks'
                                );

$hook['post_controller_constructor'][] = array(
                                'function' => 'hook_is_https',
                                'filename' => 'common.php',
                                'filepath' => 'hooks'
                                );


/* End of file hooks.php */
/* Location: ./application/config/hooks.php */