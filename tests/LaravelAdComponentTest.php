<?php

namespace _5balloons\LaravelAdManager\Tests;

use Livewire\Livewire;
use _5balloons\LaravelAdManager\Models\LaravelAd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use _5balloons\LaravelAdManager\Http\Livewire\LaravelAdComponent;
use _5balloons\LaravelAdManager\Tests\LaravelAdManagerTestCase as TestCase;


class LaravelAdComponentTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(LaravelAdComponent::class);
 
        $component->assertStatus(200);
    }

    /** @test */
    public function it_asserts_component_renders_the_ad(){
        $laravelAd = LaravelAd::factory()->create(['name'=> 'test-ad', 'body' => '<span>Hello</span>']);

        $component = Livewire::test(LaravelAdComponent::class, ['adName' => 'test-ad'])
                    ->assertSee('Hello');

    }

    
}