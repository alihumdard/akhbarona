<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\ArticleIAttachment;
use App\Models\ArticleImage;
use App\Models\ArticleTag;
use App\Models\AssetFile;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserFilter;
use App\Repositories\File\EloquentFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Psy\Util\Str;

class MediaController extends Controller
{
    
    public function __construct()
    {
		
    }
	public function pickvideo(){
		            $ftp_host   = env('FTP_HOST');
					$ftp_server = env('FTP_SERVER');
					$ftpurl     = $ftp_host.env('VIDEO_FOLDER').'/';
					$ftp_conn   = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
					$login = ftp_login($ftp_conn,env('FTP_USER'),env('FTP_PASSWORD'));
					ftp_pasv($ftp_conn, true);
	                $files = ftp_nlist($ftp_conn,env('VIDEO_FOLDER_PATH'));
                    $resource = 'No file found';
                    if(!empty($files)){
					$resource = '<div class=""><input type="hidden" id="copyfield" value=""><div class="row">';
					foreach($files as $k=>$v){
						
						if(ltrim(basename($v),'.')!=''){
						$videourl = $ftpurl.ltrim(basename($v),'.');
						$resource .='<div class="col-lg-6">
						<video width="100%" height="120" controls><source src="'.$videourl.'" type="video/mp4"></video>
						<span class="d-block text-center mb-1">'.ltrim(basename($v),'.').'</span>
						<span class="d-block text-center mb-3"><a href="javascript::void(1);" class="copylink btn btn-primary" data-src="'.$videourl.'" >Copy Link</a></span>
						</div>';
						}
					}
					$resource .= '</div></div>';
					}
					echo $resource;
					die;
	}
    public function uploadmedia(Request $request) {
                    $ftp_host   = env('FTP_HOST');
					$ftp_server = env('FTP_SERVER');
					$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
					$login = ftp_login($ftp_conn,env('FTP_USER'),env('FTP_PASSWORD'));
                    $filename =  $request->file('mediafile')->getClientOriginalName();
                    $request->file('mediafile')->move(public_path('videojs/'), $filename);
					ftp_pasv($ftp_conn, true);
					ftp_put($ftp_conn,env('VIDEO_FOLDER_PATH').$filename, public_path('videojs/'.$filename), FTP_BINARY);
					unlink(public_path('videojs/'.$filename));
					echo $ftp_host.env('VIDEO_FOLDER').'/'.$filename;
	}
    
}
