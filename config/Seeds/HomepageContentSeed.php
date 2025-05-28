<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class HomepageContentSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            // Hero Section pieces
            [
                'parent' => 'home',
                'label' => 'Hero Title',
                'description' => 'Main headline for hero section',
                'slug' => 'hero-title',
                'type' => 'text',
                'value' => '30% OFF RUSTIC RANGE'
            ],
            [
                'parent' => 'home',
                'label' => 'Hero Subtitle',
                'description' => 'Subtitle text for hero section',
                'slug' => 'hero-subtitle',
                'type' => 'text',
                'value' => 'Create a wonderful rustic experience with our range'
            ],
            [
                'parent' => 'home',
                'label' => 'Hero Button Text',
                'description' => 'Text on the hero section button',
                'slug' => 'hero-button-text',
                'type' => 'text',
                'value' => 'SHOP NOW'
            ],
            [
                'parent' => 'home',
                'label' => 'Hero Image URL',
                'description' => 'Image URL for hero section',
                'slug' => 'hero-image-url',
                'type' => 'text',
                'value' => '/img/hero-section.jpg'
            ],

            // Categories Section pieces
            [
                'parent' => 'home',
                'label' => 'Categories Title',
                'description' => 'Title for categories section',
                'slug' => 'categories-title',
                'type' => 'text',
                'value' => 'Categories'
            ],
            [
                'parent' => 'home',
                'label' => 'Categories Description',
                'description' => 'Description text for categories section',
                'slug' => 'categories-description',
                'type' => 'text',
                'value' => 'GleamAndGrace designs the best decor and Jewellery with unparalleled craftsmanship and signature.'
            ],

            // Category 1
            [
                'parent' => 'home',
                'label' => 'Category 1 Name',
                'description' => 'Name of category 1',
                'slug' => 'category1-name',
                'type' => 'text',
                'value' => 'Jewellery'
            ],
            [
                'parent' => 'home',
                'label' => 'Category 1 Link',
                'description' => 'Link URL for category 1',
                'slug' => 'category1-link',
                'type' => 'text',
                'value' => '/products?category=jewellery'
            ],
            [
                'parent' => 'home',
                'label' => 'Category 1 Image URL',
                'description' => 'Image URL for category 1',
                'slug' => 'category1-image-url',
                'type' => 'text',
                'value' => '/img/landing-page/categories-section/emerald_ring.png'
            ],

            // Category 2
            [
                'parent' => 'home',
                'label' => 'Category 2 Name',
                'description' => 'Name of category 2',
                'slug' => 'category2-name',
                'type' => 'text',
                'value' => 'Home Decor'
            ],
            [
                'parent' => 'home',
                'label' => 'Category 2 Link',
                'description' => 'Link URL for category 2',
                'slug' => 'category2-link',
                'type' => 'text',
                'value' => '/products?category=home-decor'
            ],
            [
                'parent' => 'home',
                'label' => 'Category 2 Image URL',
                'description' => 'Image URL for category 2',
                'slug' => 'category2-image-url',
                'type' => 'text',
                'value' => '/img/landing-page/categories-section/cozy_house.jpeg'
            ],

            // Category 3
            [
                'parent' => 'home',
                'label' => 'Category 3 Name',
                'description' => 'Name of category 3',
                'slug' => 'category3-name',
                'type' => 'text',
                'value' => 'Clearance'
            ],
            [
                'parent' => 'home',
                'label' => 'Category 3 Link',
                'description' => 'Link URL for category 3',
                'slug' => 'category3-link',
                'type' => 'text',
                'value' => '/products?category=clearance'
            ],
            [
                'parent' => 'home',
                'label' => 'Category 3 Image URL',
                'description' => 'Image URL for category 3',
                'slug' => 'category3-image-url',
                'type' => 'text',
                'value' => '/img/landing-page/categories-section/nice_chair.jpeg'
            ],

            // Category 4
            [
                'parent' => 'home',
                'label' => 'Category 4 Name',
                'description' => 'Name of category 4',
                'slug' => 'category4-name',
                'type' => 'text',
                'value' => 'Gifts'
            ],
            [
                'parent' => 'home',
                'label' => 'Category 4 Link',
                'description' => 'Link URL for category 4',
                'slug' => 'category4-link',
                'type' => 'text',
                'value' => '/products?category=gifts'
            ],
            [
                'parent' => 'home',
                'label' => 'Category 4 Image URL',
                'description' => 'Image URL for category 4',
                'slug' => 'category4-image-url',
                'type' => 'text',
                'value' => '/img/landing-page/categories-section/gold_ring.jpeg'
            ],
            // About Us Section pieces
            [
                'parent' => 'home',
                'label' => 'About Us Title',
                'description' => 'Title for About Us section',
                'slug' => 'about-us-title',
                'type' => 'text',
                'value' => 'About Us'
            ],
            [
                'parent' => 'home',
                'label' => 'About Us Paragraph 1',
                'description' => 'First paragraph of About Us',
                'slug' => 'about-us-paragraph-1',
                'type' => 'text',
                'value' => 'Welcome to Gleam & Grace, where we transform houses into homes and spaces into serene sanctuaries.'
            ],
            [
                'parent' => 'home',
                'label' => 'About Us Paragraph 2',
                'description' => 'Second paragraph of About Us',
                'slug' => 'about-us-paragraph-2',
                'type' => 'text',
                'value' => 'Our thoughtfully curated collection of homewares, bed linens, and décor is designed to bring elegance, comfort, and style into every corner of your home.'
            ],
            [
                'parent' => 'home',
                'label' => 'About Us Paragraph 3',
                'description' => 'Third paragraph of About Us',
                'slug' => 'about-us-paragraph-3',
                'type' => 'text',
                'value' => 'We have sought out the finest materials, premium fabrics, and the latest trends—both locally and globally—ensuring that every product embodies the perfect balance of quality and sophistication.'
            ],
            [
                'parent' => 'home',
                'label' => 'About Us Paragraph 4',
                'description' => 'Fourth paragraph of About Us',
                'slug' => 'about-us-paragraph-4',
                'type' => 'text',
                'value' => 'Whether you’re looking for luxurious bedding, timeless furniture, or charming decorative accents, we are here to help you create a space that reflects your unique style.'
            ],
            [
                'parent' => 'home',
                'label' => 'About Us Paragraph 5',
                'description' => 'Fifth paragraph of About Us',
                'slug' => 'about-us-paragraph-5',
                'type' => 'text',
                'value' => 'At Gleam & Grace, we believe that comfort is an experience, not just a feeling. From plush cushions to cozy quilts, our expert-curated selections cater to every season, sleep style, and lifestyle.'
            ],
            [
                'parent' => 'home',
                'label' => 'About Us Paragraph 6',
                'description' => 'Sixth paragraph of About Us',
                'slug' => 'about-us-paragraph-6',
                'type' => 'text',
                'value' => 'No matter where you are in Australia, we have your comfort covered.'
            ],
            [
                'parent' => 'home',
                'label' => 'About Us Paragraph 7',
                'description' => 'Seventh paragraph of About Us',
                'slug' => 'about-us-paragraph-7',
                'type' => 'text',
                'value' => 'Discover inspiration through our exclusive collections, style guides, and expert tips—because at Gleam & Grace, we believe that every home should be as beautiful as it is comfortable.'
            ],

        ];

        $this->table('content_blocks')->insert($data)->save();
    }
}
