<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    protected $fillable = [
        'title_banner_1',
        'title_banner_2',
        'title_banner_3',
        'caption_banner',
        'instructor_title',
        'instructor_caption',
        'instructor_become_title',
        'instructor_become_caption',
        'discount_title_1',
        'discount_title_2',
        'discount_caption',
        'discount_img',
        'discount_percent',
        'footer_address',
        'footer_mail',
        'footer_phone_1',
        'footer_phone_2',
        'footer_facebook',
        'footer_twitter',
        'footer_instagram',
        'footer_linkedin'
    ];
}
