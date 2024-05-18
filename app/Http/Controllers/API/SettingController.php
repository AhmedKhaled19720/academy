<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Model\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SettingResource::collection(setting::all());
        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $settings,
        ];
        return response()->json($data);
    }
    public function update_setting(Request $request)
    {

        $old_id = $request->old_id;
        $settings = setting::find($old_id);

        $validateData = Validator($request->all(), [
            'id' =>  [
                Rule::unique('settings')->ignore($old_id),
            ],
            'title_banner_1' => 'required',
            'title_banner_2' => 'required',
            'title_banner_3' => 'required',
            'caption_banner' => 'required',
            'instructor_title' => 'required',
            'instructor_caption' => 'required',
            'instructor_become_title' => 'required',
            'instructor_become_caption' => 'required',
            'discount_title_1' => 'required',
            'discount_title_2' => 'required',
            'discount_caption' => 'required',
            'discount_percent' => 'required',
            'footer_address' => 'required',
            'footer_mail' => 'required',
            'footer_phone_1' => 'required',
            'footer_phone_2' => 'required',
            'footer_facebook' => 'required',
            'footer_twitter' => 'required',
            'footer_instagram' => 'required',
            'footer_linkedin' => 'required',
            'discount_img' => 'image',
        ]);

        if ($validateData->fails()) {

            $data = [
                "msg" => "No Valid Data",
                "status" => 203,
                "data" => $validateData->errors()
            ];
            return response()->json($data);
        }
        if (File::exists(public_path('setting/img/' . $settings->discount_img))) {
            File::delete(public_path('setting/img/' . $settings->discount_img));
        }
        if ($settings) {
            if ($request->hasFile('discount_img')) {
                $img = $request->discount_img;
                $imgname = rand(1, 1000) . time() . "." . $img->extension();
                $img->move(public_path('setting/img/'), $imgname);
            } else {
                $imgname = $settings->discount_img;
            }
            $settings->update([
                'id' => $request->id,
                'discount_img' => $imgname,
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
                'footer_address' => $request->footer_address,
                'footer_mail' => $request->footer_mail,
                'footer_phone_1' => $request->footer_phone_1,
                'footer_phone_2' => $request->footer_phone_2,
                'footer_facebook' => $request->footer_facebook,
                'footer_twitter' => $request->footer_twitter,
                'footer_instagram' => $request->footer_instagram,
                'footer_linkedin' => $request->footer_linkedin,
            ]);

            $data = [
                "msg" => "Updated Successfully",
                "status" => 200,
                "data" => $settings
            ];
            return response($data);
        } else {
            $data = [
                "msg" => "No Such Id",
                "status" => 401,
                "data" => $settings
            ];
            return response($data);
        }
    }
}
