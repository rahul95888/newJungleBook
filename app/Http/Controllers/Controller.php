<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Commodity;
use App\Models\News;
use App\Models\Pop;
use App\Models\Equipment;
use App\Models\Gallery;
use App\Models\Feedback;
use App\Models\Section;
use App\Models\Service;
use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index(){
        $slider = Pop::all();
        $news = News::orderBy('id','DESC')->take(2)->get();
        $latestPackage = Equipment::orderBy('id','DESC')->take(3)->get();
        $Feedback = Feedback::orderBy('id','DESC')->get();
       
        $FeaturedPackage = Equipment::where(['status'=>'Featured'])->orderBy('id','DESC')->get();
        return view('web.home', compact('slider','news', 'latestPackage','FeaturedPackage','Feedback'));
    }


    public function contact(){
      return view('web.contact');
    }


    public function about(){
        return view('web.about');
    }

    public function services(){
        $Services = Service::orderBy('id','DESC')->get();
        return view('web.services', compact('Services'));

    }

    public function servicedetail($id){
        $data = Service::find($id);
        return view('web.servicedetails', compact('data'));
    }

    public function packages(){
        $data = Equipment::all();
        return view('web.packages',compact('data'));
        
    }

    public function staticpage($slug){
        
        

        $data = Section::where(['section_uid'=>$slug])->orderBy('id','DESC')->get();
        

        return view('web.page',compact('data'));
    }

    public function packagedetail($id){
        $data = Equipment::find($id);
        $gallery = Gallery::where(['property_id'=>$id])->get();
        return view('web.property',compact('data','gallery'));
    }


    public function blogs(){
       $category = Commodity::all();
       $news = News::all();
        return view('web.blogs', compact('category','news'));
    }

    public function blogdetail($id){
        
        $data = News::find($id);
         return view('web.blogdetail', compact('data'));
     }

     public function sendEnquiry(Request $request){
        
		 
       
       $data = array(
            'name'=>$_REQUEST['fullname'],
            'email'=>$_REQUEST['useremail'],
            'subject'=>'Enquiry',
            'phone'=>$_REQUEST['requirement'].'-'.$_REQUEST['mob'],
            'message1'=>$_REQUEST['message']);
       
       $headers = "MIME-Version: 1.0" . "\r\n"; 
       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
       if(isset($_REQUEST['req'])){
       	$msg="Name = ".$_REQUEST['fullname'].'<br/>'."Email = ".$_REQUEST['useremail']."<br/>"."Contact No.= ".$_REQUEST['requirement'].'-'.$_REQUEST['mob']."<br/>"."Message = ".$_REQUEST['message']."<br/>"."Requirement = ". $_REQUEST['req'];
       }else{
       $msg="Name = ".$_REQUEST['fullname'].'<br/>'."Email = ".$_REQUEST['useremail']."<br/>"."Contact No.= ".$_REQUEST['requirement'].'-'.$_REQUEST['mob']."<br/>"."Message = ".$_REQUEST['message'];
       }
       	
       	 mail("booking@junglebooktourism.com","My subject",$msg, $headers);
        
       /* try{
         

             Mail::send('web.send',$data,function($message){
                $message->to('abc@yopmail.com')->subject('Enquiry');
                $message->from('booking@junglebooktourism.com','Jungle Book Tourism');
            });


        }catch(\Exception $e){
            print_r($e);
            die;
        } */
        
        //echo json_encode(array('status'=>true,'message'=>'Your Enquiry has sucessfully submitted, we will get back to you as soon as possible'));
       
       
         return redirect()->back()->with('success', 'Thanks for your enquiry, We will get back to you.');   


     }

}