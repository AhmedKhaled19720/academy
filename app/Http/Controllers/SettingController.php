<?php

namespace App\Http\Controllers;

use App\Http\Requests\settingRequest;
use App\Model\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $settings = setting::all();
        return view('setting.home-setting', ['setting' => $settings]);
    }
    public function edit($id)
    {
        $settings = setting::findOrFail($id);
        return view('setting.crud.edit', ['setting' => $settings]);
    }
    public function saveupdate(settingRequest $request)
    {

        $old_id = $request->old_id;
        $settings = setting::findOrFail($old_id);

        if ($request->hasFile('discount_img')) {
            if (File::exists(public_path('setting/img/' . $settings->discount_img))) {
                File::delete(public_path('setting/img/' . $settings->discount_img));
            }
            $img = $request->discount_img;
            $imgname = rand(1, 1000) . time() . "." . $img->extension();
            $img->move(public_path('setting/img/'), $imgname);
        } else {
            $imgname = $settings->discount_img;
        }

        $settings->update([
            'title_banner_1' => $request->title_banner_1,
            'title_banner_2' => $request->title_banner_2,
            'title_banner_3' => $request->title_banner_3,
            'caption_banner' => $request->caption_banner,
            'instructor_title' => $request->instructor_title,
            'instructor_caption' => $request->instructor_caption,
            'instructor_become_title' => $request->instructor_become_title,
            'instructor_become_caption' => $request->instructor_become_caption,
            'discount_title_1' => $request->discount_title_1,
            'discount_title_2' => $request->discount_title_2,
            'discount_caption' => $request->discount_caption,
            'discount_percent' => $request->discount_percent,
            'discount_img' => $imgname,
            'footer_address_link' => $request->footer_address_link,
            'footer_address_iframe' => $request->footer_address_iframe,
            'footer_mail' => $request->footer_mail,
            'footer_phone_1' => $request->footer_phone_1,
            'footer_phone_2' => $request->footer_phone_2,
            'footer_facebook' => $request->footer_facebook,
            'footer_twitter' => $request->footer_twitter,
            'footer_instagram' => $request->footer_instagram,
            'footer_linkedin' => $request->footer_linkedin,
        ]);

        session()->flash('update');
        return redirect()->route('home-setting');
    }
}
