<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'GAGE', 'group' => 'general', 'type' => 'text', 'label' => 'Site Name'],
            ['key' => 'site_tagline', 'value' => 'Security & Safety Solutions Maldives', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => null, 'group' => 'general', 'type' => 'image'],

            // Contact
            ['key' => 'contact_email', 'value' => 'info@gage.com.mv', 'group' => 'general', 'type' => 'text'],
            ['key' => 'contact_phone', 'value' => '+960 330 4055', 'group' => 'general', 'type' => 'text'],
            ['key' => 'contact_address', 'value' => 'H. Noomuraka, 1st Floor, Hadheebee Magu, Malé, Republic of Maldives', 'group' => 'general', 'type' => 'textarea'],

            // Social
            ['key' => 'social_facebook', 'value' => '', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => '', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => '', 'group' => 'social'],

            // SEO
            ['key' => 'seo_default_title', 'value' => 'GAGE – Security & Safety Solutions Maldives', 'group' => 'seo'],
            ['key' => 'seo_default_description', 'value' => 'A family of companies dedicated to protecting the Maldives.', 'group' => 'seo', 'type' => 'textarea'],
            ['key' => 'seo_og_image', 'value' => null, 'group' => 'seo', 'type' => 'image'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }
    }
}