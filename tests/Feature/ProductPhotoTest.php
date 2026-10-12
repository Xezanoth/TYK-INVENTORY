<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

function productPhotoPayload(Category $category): array
{
    return [
        'name' => 'Trail Bike',
        'sku' => 'TRAIL-001',
        'category_id' => $category->id,
        'price' => 1200,
        'cost' => 850,
        'stock_quantity' => 4,
    ];
}

function fakeProductPhoto(): UploadedFile
{
    $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=', true);

    return UploadedFile::fake()->createWithContent('bike.png', $png);
}

test('product photos can be uploaded and stored', function () {
    Storage::fake('public');
    $user = User::factory()->create(['role' => 'admin']);
    $category = Category::create(['name' => 'Bicycles', 'slug' => 'bicycles']);

    $response = $this->actingAs($user)->post(route('products.store'), [
        ...productPhotoPayload($category),
        'image' => fakeProductPhoto(),
    ]);

    $response->assertRedirect(route('products.index'));

    $product = Product::where('sku', 'TRAIL-001')->firstOrFail();

    expect($product->image_path)->not->toBeNull();
    Storage::disk('public')->assertExists($product->image_path);
});

test('product photos can be replaced and removed', function () {
    Storage::fake('public');
    $user = User::factory()->create(['role' => 'admin']);
    $category = Category::create(['name' => 'Bicycles', 'slug' => 'bicycles']);
    $oldImagePath = 'products/old-bike.jpg';
    Storage::disk('public')->put($oldImagePath, 'old image');

    $product = Product::create([
        ...productPhotoPayload($category),
        'image_path' => $oldImagePath,
    ]);

    $this->actingAs($user)->put(route('products.update', $product), productPhotoPayload($category))
        ->assertRedirect(route('products.index'));

    expect($product->fresh()->image_path)->toBe($oldImagePath);
    Storage::disk('public')->assertExists($oldImagePath);

    $this->actingAs($user)->put(route('products.update', $product), [
        ...productPhotoPayload($category),
        'image' => fakeProductPhoto(),
    ])->assertRedirect(route('products.index'));

    $newImagePath = $product->fresh()->image_path;
    expect($newImagePath)->not->toBe($oldImagePath);
    Storage::disk('public')->assertExists($newImagePath);
    Storage::disk('public')->assertMissing($oldImagePath);

    $this->put(route('products.update', $product), [
        ...productPhotoPayload($category),
        'remove_image' => '1',
    ])->assertRedirect(route('products.index'));

    expect($product->fresh()->image_path)->toBeNull();
    Storage::disk('public')->assertMissing($newImagePath);
});

test('deleting a product removes its photo', function () {
    Storage::fake('public');
    $user = User::factory()->create(['role' => 'admin']);
    $category = Category::create(['name' => 'Bicycles', 'slug' => 'bicycles']);
    $imagePath = 'products/trail-bike.png';
    Storage::disk('public')->put($imagePath, 'image');
    $product = Product::create([
        ...productPhotoPayload($category),
        'image_path' => $imagePath,
    ]);

    $this->actingAs($user)->delete(route('products.destroy', $product))
        ->assertRedirect(route('products.index'));

    $this->assertDatabaseMissing('products', ['id' => $product->id]);
    Storage::disk('public')->assertMissing($imagePath);
});

test('product photo uploads must be images', function () {
    Storage::fake('public');
    $user = User::factory()->create(['role' => 'admin']);
    $category = Category::create(['name' => 'Bicycles', 'slug' => 'bicycles']);

    $response = $this->actingAs($user)->post(route('products.store'), [
        ...productPhotoPayload($category),
        'image' => UploadedFile::fake()->create('notes.txt', 10, 'text/plain'),
    ]);

    $response->assertInvalid(['image']);
    $this->assertDatabaseMissing('products', ['sku' => 'TRAIL-001']);
    Storage::disk('public')->assertDirectoryEmpty('products');
});
