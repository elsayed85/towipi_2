<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Settings\GeneralSettings;
use App\Http\Settings\SocialSettings;
use Illuminate\Http\Request;

class WebsiteSettingsController extends Controller
{
    public function settings()
    {
        return view('admin.website.settings');
    }

    public function ChangeSiteName(Request $request, GeneralSettings $settings)
    {
        $request->validate(['name' => ['required', 'min:3', 'max:50']]);
        $settings->site_name = $request->name;
        $settings->save();
        return back()->withSuccess("Site Name Updated to {$request->name} succfully");
    }

    public function changeLogos(Request $request, GeneralSettings $settings)
    {
        $footerLogo_name = "footer_logo";
        $navLogo_name = "nav_logo";

        $request->validate([
            $footerLogo_name => ['sometimes', 'image', 'mimes:png,jpg,jpeg'],
            $navLogo_name =>  ['sometimes', 'image', 'mimes:png,jpg,jpeg']
        ]);


        $footer_logo = $request->file($footerLogo_name);
        $nav_logo = $request->file($navLogo_name);

        $folder = config('filesystems.names.website_settings');

        if ($request->has($footerLogo_name)) {
            $footer_logo->storeAs("", "{$footerLogo_name}.png", ['disk' => 'site_settings']);
            $settings->footer_logo = $folder . "/" . $footerLogo_name . ".png";
        }

        if ($request->has($navLogo_name)) {
            $nav_logo->storeAs("", "{$navLogo_name}.png", ['disk' => 'site_settings']);
            $settings->nav_logo = $folder . "/" . $navLogo_name . ".png";
        }

        $settings->save();
        return back()->withSuccess("Site Logos Updated Succfully");
    }

    public function siteStatus(Request $request)
    {
        $request->validate([
            'status' => ['required', 'in:unlock,maintenance,vacation']
        ]);

        $status = $request->status;
        if ($status == "unlock") {
            unlockSite();
        } elseif ($status == "maintenance") {
            makeSiteInMaintenanceMode();
        } elseif ($status == "vacation") {
            makeSiteInVacationMode();
        }

        return back()->withSuccess("Site is in {$status} mode now");
    }

    public function socialLinks(Request $request, SocialSettings $settings)
    {
        $social = $request->validate([
            'facebook' => ['sometimes', 'nullable', 'url', 'max:500'],
            'instagram' => ['sometimes', 'nullable', 'url', 'max:500'],
            'youtube' => ['sometimes', 'nullable', 'url', 'max:500'],
            'pinterest' => ['sometimes', 'nullable', 'url', 'max:500'],
            'twitter' => ['sometimes', 'nullable', 'url', 'max:500'],
            'snapchat' => ['sometimes', 'nullable', 'url', 'max:500'],
            'tiktok' => ['sometimes', 'nullable', 'url', 'max:500'],
        ]);

        $settings->fill($social);
        $settings->save();
        return back()->withSuccess('Site Social Links Updated Succfully');
    }
}
