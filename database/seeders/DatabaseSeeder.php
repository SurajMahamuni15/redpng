<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\License;
use App\Models\Tag;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@redpng.com',
            'password' => bcrypt('admin123'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Create a regular user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_USER,
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Business', 'slug' => 'business', 'icon_url' => 'briefcase'],
            ['name' => 'Food', 'slug' => 'food', 'icon_url' => 'restaurant'],
            ['name' => 'Icons', 'slug' => 'icons', 'icon_url' => 'star'],
            ['name' => 'Technology', 'slug' => 'technology', 'icon_url' => 'computer'],
            ['name' => 'Nature', 'slug' => 'nature', 'icon_url' => 'forest'],
            ['name' => 'Abstract', 'slug' => 'abstract', 'icon_url' => 'blur_on'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Licenses
        $licenses = [
            ['name' => 'Personal Use', 'code' => 'PERSONAL', 'requires_credit' => false],
            ['name' => 'Commercial Use', 'code' => 'COMMERCIAL', 'requires_credit' => true],
        ];

        foreach ($licenses as $lic) {
            License::create($lic);
        }

        // Create Tags
        $tags = ['red', 'blue', 'green', '3d', 'flat', 'vector', 'transparent', 'dark', 'light'];
        foreach ($tags as $tag) {
            Tag::create(['name' => ucfirst($tag), 'slug' => $tag]);
        }

        // Create Images
        $imageUrls = [
            'https://lh3.googleusercontent.com/aida-public/AB6AXuDsnYkHDMohoe0O3fpaTikS-y4pj7cdtoXNzCk4B4iFPSvnH5jG8Q4oP2OSVnpbnLEErx5vthBtjz_VR13nwKTlcVwI_jcXI0qrOltSQOJtGSe-LkVkjqkOFvzoPl5NjTBcc0DHIIr79RL5bZmGwo9GyEX092yDps8b-i0TCB90RWXQKq8Q55B9_HqqTXhB0DUuJzWpBj1meMbUfEyzpZoYK75kYVWSDlC_Bd2Ns4HAAP6-sRRejWzCoPbzhlt6FN59xxEHCuaPpnFL',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuBhPBK3NOWBkeDF9cAmuXsmp1cTA77aLCTNMY8H-GBPVGs0BoDlCk3HQOpUlvlYfVnOl7Xshqn5qgw_6UeI1DoY_ys4z7ZCeWXVwi1CW1k_3C07246TBH9MPLPf44GPOOeky57WZKDKs4a2k5UORQypmmlbenYf00Jz_p2CeTSSc0HtcJ0y0jqhw449kbEzktz_7oHu01SU7P3eDixfbbW6HG1zb3p4PX7IeHUZOvE3nzgCj8G_BBhkyjPo6CY0vIL-Zt1kurn9XXA0',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuCASfuqNJSJ6eDM0iw2dTmr_XVuBYYX5rG5z3joWlnyLYT6Of_jxPVwwRNlOVtTcGFzUWCBQVVpD3PryUx5GXLGxs3uoL-OMXfWorndHGLBRRmnieVw5ch36A8_lGPxFMtDcVETM3SODjbDsa5hiyfuIDkDA1-Oa1FitIzJMyvO7kSvmPanWBUlFMpMZE6Ft7T1ZT3VMWwSdU1b-pVbRJJjEwPI-cGnOkArhofAYBH_CQkcj0W6L-wUTDdnsm3v7qPNdMFOYfPgUSpn',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuBX20om8h1YnpR0NUg-SnQnftg4rltpCtZQwnJCLksq3uWN2Nedk3VwjtLoq2IgV6GFQUb9P30iJA8uv428ALl9vLrr4XrXZzz_6rcEKc54_eX4QCBsS_muFVSuaGjuftFa4gdW44qQXCEYWMW0iOr83zIOnVcoQ4kintuehCI8551XbVXvvpZbcDcKECbDiYroPD2smFUGLyQ-NAvZH8kJrykZdPAAHkryPf1Yyxpkfi7wWYXelLxd-NwLT4S8e_lzbCSea00_6r5f',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuBAKwcMyWSdV0hQ_UMO3pTv3eEew7s98BIaqUNQctKcyKYMmqjGYRnc3j01pdkVeYxU_xZk0--D_qiIeiBmBBXLxbKZU5Xix-4P9tWA68P6nsVTGlKs4MP5EL-EX_Sq0_pGP7H2sKOZWUrLIXNHNfK2Fysnno4GVYbcY4SKPcR0FiJS3n-vKmfobrQfIxcLf7sA5DIKKf4Vq2F5-ur6s7OywW82vWDfvEMfPT-q0Q2F6rWeUTAAquwUkveoI1pKGqnNpN1v_LKxarve',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuAl2gOCrAUYypmbDxABYWzzGb_lYwncCPaL2ZrzXp96fZl1jElaVEnjSTYsGdaifhOzMRr9spiacFgBtUS2fMaj-NjpZpqZu-hC6QH2It2vdekP9iGuepKvm84tIHYgCUZEyJvEHLmQ4pa8M-NOck1VgmDEkmZ6h2B1fqv3BIV3dSvhll-oshdCxARaMOXkIpe69iYHHUPn9qVv-Rb6l64QrUjFipi75j4j6D7073lj20v4FEDDcyesxnsG0qrkyP63d9Iyf_kP9ToY',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuDyzZOeMFnzcjnw0L0w-uTffJmLVDTRFUczwE6yZ49F2SbFXQzs4sqHSXYuYWq8E2j65C2_g4NLucRyzbe1VYsVSG3wrWtGgtNdc6D5sr4kjxdWpm9XSbVwUAjA2Jlg9EOFtT04mq-jtD-V2PrL-HfQgpSWYZc7ByzGXcosHvX-WxS-IcP8ouzWZTpITYJUeXEDObW0sUDRKxZpd7dM-eDbIrP9Ox4qquqj5TOVTqOv9QJlpfxZaPIcsEJFby-C56TnYklFzPh9h5pC',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuCoroafZmPMoJkbagPzCkiysW-PykWxJZNpHfMgKuVEgetT-BOkhPYiZJK1rJMzyGQPAt_fcKAmFiFRmLulrdyYbp2IKpu1ofO6SFUG6O7htzOwjlanoHfe-SUpuDr8wHct25K0mR5a0uxC3KWeWKejF4k7gtZniPGtF8OnrlW86mSCj8Gk5M5R_EaInVstx-He-XLX-enCFf02tz3EkGuJOkzfo5otxGMHXyKNzj4ZMTqtGmOTu-bDwyQI0FgAMK4IaNWlCcv2-gYc',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuDtqpPwBzuy3A0UpDBy4p5-Gl-yxZJchvfyY-ncedE4FzlLffZ9l3xFOfttWzpssUNKqDvj4ZV5DHg7CIUDxACVmu40r2XFin3zhD8zyrJLPaCq771HHAaRMG6dDo7yyRXV1ga1vZKxidNHHqu3r8yBG1nc6zSinQgk7L9zo1nShhIbK9JejxqF38WHRBSTAig3vze3RO60YlmmNLwh6uMxzPDUKXMNRsD_1wMdogd_BmX2X17W3JuMVhb0n2y8Euv5_aPLX3V0MHyD',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuDPco0t5M9hNMU5KXWLIirdA6E7a1-RbIzkPj5gqOaCzmn_YTHJqeoAtHMHmLmsOSZM6HqqOmZM3teyXaUHVxuCI1mbGuEHj09KJGIS5-TkqEcSTirLgZMhl1kYanr3NDoYc25bJEgdcJs_9vFi0S66dqXktkWTQJgXN7wBdbTCE9Wio0GhZoDMotupXA_gc6wOyxH34MjE9TJcl--8Y1rN715KvkYoJBXjprUPMaBAk-moy2rbCIfWlMQ53Y3NbLn84ZtELRcfIU2-',
        ];

        $titles = [
            'Master Ball', 'Pizza Slice', 'Laughing Emoji', 'Blue Smoke', 'Cartoon Cat', 'Google Logo', 'Apple Logo', 'Red Apple', 'Facebook Logo', 'Desk Lamp'
        ];

        $cats = Category::all();
        $lics = License::all();
        $tags = Tag::all();

        for ($i = 0; $i < 20; $i++) {
            $index = $i % count($imageUrls);
            $img = Image::create([
                'title' => $titles[$index] . ' ' . ($i + 1),
                'slug' => \Illuminate\Support\Str::slug($titles[$index] . ' ' . ($i + 1)),
                'file_path' => $imageUrls[$index],
                'thumbnail_path' => $imageUrls[$index],
                'width' => 1024,
                'height' => 1024,
                'file_size_bytes' => 1024000,
                'category_id' => $cats->random()->id,
                'license_id' => $lics->random()->id,
                'uploader_id' => $user->id,
                'downloads_count' => rand(10, 1000),
                'views_count' => rand(100, 5000),
                'is_approved' => true, // Approve seeded images
            ]);

            $img->tags()->attach($tags->random(3));
        }
    }
}
