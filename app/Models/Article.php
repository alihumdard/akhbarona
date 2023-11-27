<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps = false;
    protected $fillable = ["category_id", "user_id", "user_domain", "author", "title", "image","md5_file", "created", "last_edited", "body", "last_read", "times_read", "today_read", "status", "sefriendly", "link", "order_num", "show_poll", "show_comment", "rss_feed", "keywords", "description", "emailed", "vote_num", "vote_sum", "abstract", "image_caption", "member_submition"];
    public function countTag() {
        return $this->hasMany(ArticleTag::class,'article_id')->count();
    }
    public function countComment() {
        return $this->hasMany(Comment::class,'article_id')->count();
    }
    public function getVoteAverage($dec=2) {
        if (intval($this->vote_sum) > 0){
            $dec = intval($dec);
            return number_format(intval($this->vote_sum) / intval($this->vote_num), $dec);
        }
        return 0;
    }
    public function getTags() {
        return $this->hasMany(ArticleTag::class,'article_id')
            ->join('tags as t','t.id','=','articles_tags.tag_id')
            ->join('tags_groups as tg','tg.id','=','articles_tags.tags_group_id')
            ->selectRaw('t.*,tg.name as `group`,tg.id as group_id');
    }
    public function getGallery($order = 'DESC') {
        return $this->hasMany(ArticleImage::class,'article_id')->orderBy('order_number',$order)->get();
    }
    public function getAttachment($order = 'DESC') {
        return $this->hasMany(ArticleIAttachment::class,'article_id')->orderBy('order_number',$order)->get();
    }
}
