<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\News;

echo "Checking News thumbnails:\n";
$news = News::all();

foreach ($news as $item) {
    echo "ID: {$item->id}, Title: {$item->title}, Thumbnail: {$item->thumbnail}\n";
    
    if ($item->thumbnail) {
        $filePath = storage_path('app/public/thumbnails/' . $item->thumbnail);
        if (file_exists($filePath)) {
            echo "  ✓ File exists: {$filePath}\n";
        } else {
            echo "  ✗ File missing: {$filePath}\n";
        }
    }
} 