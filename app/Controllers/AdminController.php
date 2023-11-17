<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CIAuth;
use App\Models\User;

class AdminController extends BaseController
{
    protected $helpers =['url', 'form' , 'CIMail', 'CIFunctions'];
    public function index()
    {
        $data = [
            'pageTitle' => 'Dashboard',
        ];
        return view('backend/pages/home', $data);
    }

    public function logoutHandler(){
        CIAuth::forget();
        return redirect()->route('admin.login.form')->with('fail','You are logged out!');
    }

    public function profile(){
        $data = [
            'pageTitle' => 'Profile',
        ];
        return view('backend/pages/profile', $data);
    }

    public function updatePersonalDetails(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $user_id = CIAuth::id();
        if($request->isAJAX() ){
            $this->validate([
                'name' => [
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Full name is required'
                    ]
                ],
                'username'=>[
                    'rules'=>'required|min_length[4]|is_unique[users.username,id,'.$user_id.']',
                    'errors'=>[
                        'required'=>'Username is required',
                        'min_length'=>'Username must have minimum of 4 characters',
                        'is_unique'=>'Username is already taken!'
                    ],
                ]
            ]);
     
            if($validation->run() == FALSE){
                $errors = $validation->getErrors();
                return json_encode(['status'=>0,'error'=>$errors]);
            }else{
                $user = new User();
                $update = $user->where('id',$user_id)
                    ->set([
                        'name'=>$request->getVar('name'),
                        'username'=>request()->getVar('username'),
                        'bio'=> $request->getVar('bio'),
                    ])->update();
                
                if($update){
                    $user_info = $user->find($user_id);
                    return json_encode(['status'=> 1 , 'user_info'=> $user_info, 'msg'=>'Your personal details have been successfully updated.']);
                }else{
                    return json_encode(['status'=> 0 , 'msg'=>'Something went wrong.']);
                }
            }

        }
    }

    public function updateProfilePicture(){
        $request = \Config\Services::request();
        $user_id = CIAuth::id();
        $user = new User();
        $user_info = $user->asObject()->where('id',$user_id)->first();

        $path = 'images/users/';
        $file = $request->getFile('user_profile_file');
        $old_picture = $user_info->picture;
        $new_filename = 'UIMG_'.$user_id.$file->getRandomName();

        // if($file->move($path, $new_filename)){
        //     if($old_picture != null && file_exists($path.$old_picture)){
        //         unlink($path.$old_picture);
        //     }
        //     $user->where('id', $user_info->id)
        //     ->set(['picture'=> $new_filename])
        //     ->update();

        //     echo json_encode(['status'=> 1 , 'msg'=>'Done!, Your profile picture has been successfully updated.']);
        // }else{
        //     echo json_encode(['status'=>0 , 'msg'=> 'Something went wrong.']);
        // }

        //Image manipulation
        $upload_image = \Config\Services::image()
                        ->withFile($file)
                        ->resize(450,450,true,'height')
                        ->save($path.$new_filename);

        if($upload_image){
            if($old_picture != null && file_exists($path.$old_picture)){
                unlink($path.$old_picture);
            }
            $user->where('id', $user_info->id)
            ->set(['picture'=> $new_filename])
            ->update();

            echo json_encode(['status'=> 1 , 'msg'=>'Done!, Your profile picture has been successfully updated.']);
        }else{
            echo json_encode(['status'=> 0 , 'msg'=> 'Something went wrong.']);
        }

    }

}
