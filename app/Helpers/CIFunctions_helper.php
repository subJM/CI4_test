<?php

use App\Libraries\CIAuth;
use App\Models\User;
use App\Models\Setting;
use App\Models\SocialMedia;

if(!function_exists('get_user')){
    function get_user(){
        if(CIAuth::check()){
            $user = new User();
            return $user->asObject()->where('id', CIAuth::id())->first();
        }else{
            return NULL;
        }
    }
}

if(!function_exists('get_settings') ){
    function get_settings(){
        $settings = new Setting();
        $settings_data = $settings->asObject()->first();

        if(!$settings_data){
            $data = array(
                'blog_title'=> 'CI4Blog',
                'blog_email'=> 'info@ci4blog.test',
                'blog_phone'=> null,
                'blog_meta_keywords'=>null,
                'blog_meta_description'=>null,
                'blog_logo'=>null,
                'blog_favicon'=>null,
            );
            $settings->save($data);
            $new_settings_data = $settings->asObject()->first();
            return $new_settings_data;
        }else{
            return $settings_data;
        }
    }
}


if(!function_exists('get_social_media') ){
    function get_social_media(){
        $result = null;
        $social_media = new SocialMedia;
        $social_media_data = $social_media->asObject()->first();

        if(!$social_media_data){
            $data= array(
                'facebook_url'  => null ,
                'twitter_url'   => null ,
                'instagram_url' => null ,
                'youtube_url'   => null ,
                'github_url'    => null ,
                'linkedin_url'  => null ,
            );
            $social_media->save($data);
            $new_social_media_data = $social_media->asObject()->first();
            $result = $new_social_media_data;
        }else{
            $result = $social_media_data;
        }
        return $result;
    }
}
if(!function_exists('fn_log')){
    function fn_log($msg, $title=''){

        if(!empty($title)){
            log_message('debug' , '<====================== '.$title.' ======================>');
        }
        log_message('debug', $msg);
        
    }

}
if(!function_exists('current_route_name')){
    function current_route_name(){
        $router = \CodeIgniter\Config\Services::router();
        $route_name = $router->getMatchedRouteOptions()['as'];
        return $route_name;
    }
}
