<?php

namespace _5balloons\LaravelSmartAds\Tests;

use Livewire\Livewire;
use _5balloons\LaravelSmartAds\Models\SmartAd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use _5balloons\LaravelSmartAds\Http\Livewire\SmartAdComponent;
use _5balloons\LaravelSmartAds\Tests\LaravelSmartAdsTestCase as TestCase;


class SmartAdComponentTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(SmartAdComponent::class);
 
        $component->assertStatus(200);
    }

    /** @test */
    public function it_asserts_component_renders_the_ad(){
        $smartAd = SmartAd::factory()->create(['name'=> 'test-ad', 'body' => '<span>Hello</span>']);

        $component = Livewire::test(SmartAdComponent::class, ['adName' => 'test-ad'])
                    ->assertSee('Hello');

    }

    
}