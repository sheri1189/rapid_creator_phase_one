<?php
// app/Jobs/ProcessImages.php

namespace App\Jobs;

use App\Models\Design_Images;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; // Import Log facade
use Intervention\Image\Facades\Image;

class ProcessImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $image;

    /**
     * Create a new job instance.
     *
     * @param Design_Images $image
     */
    public function __construct(Design_Images $image)
    {
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $image_path = public_path($this->image->design_file_path);

        try {
            $im = Image::make($image_path);
            $watermark_image_path = public_path('assets/images/background/watermark.png');
            $stamp = Image::make($watermark_image_path)->resize($im->width(), $im->height());
            $im->insert($stamp, 'top-left', 0, 0)->encode('png');
            $base64Image = $im->encode('data-url')->getEncoded();
        } catch (\Exception $e) {
            Log::error('Image processing error for image ID ' . $this->image->id . ': ' . $e->getMessage());
        }
    }
}
