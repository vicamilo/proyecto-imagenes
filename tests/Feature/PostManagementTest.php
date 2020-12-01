<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\File;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class PostManagementTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function a_post_can_be_created()
    {

        $this->withoutExceptionHandling();

        $response = $this->files('admin/files/create',[
            'user_id' => 1,
            'url' => 'ruta',
            'ancho' => '1000',
            'largo' => '500'

        ]);

        $response->assertOk();
        $this->assertCount(1,Files::all());

        $files = Files::first();

        $this->assertEquals($post->user_id, 1);
        $this->assertEquals($post->url, 'ruta');
        $this->assertEquals($post->user_id, '1000');
        $this->assertEquals($post->user_id, '500');
    }
}
