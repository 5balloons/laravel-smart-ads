<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use _5balloons\LaravelSmartAds\Models\SmartAd;
use _5balloons\LaravelSmartAds\Tests\LaravelSmartAdsTestCase;

class CreateSmartAdTest extends LaravelSmartAdsTestCase
{

    /** @test */
    public function it_asserts_create_new_ad_page_works(){
        $this->get('/smart-ad-manager/ads/create')
            ->assertSee('Create New Ad');
    }

    /** @test */
    public function it_asserts_ad_name_is_required_to_create_new_ad(){
        $laravelAd = SmartAd::factory()->make(['name' => '']);
        $this->post('/smart-ad-manager/ads/store', $laravelAd->toArray())
            ->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function it_asserts_ad_name_is_unique(){
        $laravelAdExisting = SmartAd::factory()->create(['name' => 'ad-name']);
        $newLaravelAd = SmartAd::factory()->make(['name' => 'ad-name']);
        $this->post('/smart-ad-manager/ads/store', $newLaravelAd->toArray())
            ->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function it_asserts_ad_body_is_required_to_create_new_ad_if_ad_type_is_html(){
        $laravelAd = SmartAd::factory()->make(['body' => '', 'adType' => "HTML"]);
        $this->post('/smart-ad-manager/ads/store', $laravelAd->toArray())
            ->assertSessionHasErrors(['body']);
    }

    /** @test */
    public function it_asserts_ad_image_is_required_to_create_new_ad_if_ad_type_is_image(){
        $laravelAd = SmartAd::factory()->make(['image' => '', 'adType' => "IMAGE"]);
        $this->post('/smart-ad-manager/ads/store', $laravelAd->toArray())
            ->assertSessionHasErrors(['image']);
    }

    /** @test */
    public function it_asserts_user_can_create_html_ad(){
        $laravelAd = SmartAd::factory()->make();

        $this->post('/smart-ad-manager/ads/store', $laravelAd->toArray());

        $this->assertEquals(1,SmartAd::all()->count());
    }

    /** @test */
    public function it_asserts_user_can_create_image_ad(){
        $image = UploadedFile::fake()->create('test.png', $kilobytes = 0);
        $laravelAd = SmartAd::factory()->make([
                        'body'=> '',
                        'adType' => "IMAGE",
                        'image' => $image,
                        'imageAlt' => 'Alt Text',
                        'imageUrl' => 'http://www.google.com',
                    ]);
        $this->post('/smart-ad-manager/ads/store', $laravelAd->toArray());

        $this->assertDatabaseHas('smart_ads', [
            'imageAlt' => $laravelAd->imageAlt,
            'imageUrl' => $laravelAd->imageUrl,
        ]);
    }

    /** @test */
    public function it_asserts_image_url_is_a_valid_URL(){
        $image = UploadedFile::fake()->create('test.png', $kilobytes = 0);
        $laravelAd = SmartAd::factory()->make([
                        'body'=> '',
                        'adType' => "IMAGE",
                        'image' => $image,
                        'imageAlt' => 'Alt Text',
                        'imageUrl' => 'non-valid-url',
        ]);
        $this->post('/smart-ad-manager/ads/store', $laravelAd->toArray())
                ->assertSessionHasErrors(['imageUrl']);
    }


}
