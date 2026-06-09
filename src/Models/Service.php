<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Service extends Model
{
    protected static string $table = 'portefolio_service';
}

class Foundation extends Model
{
    protected static string $table = 'portefolio_foundation';

    public static function getFirst(): ?static
    {
        return static::query('SELECT * FROM ' . static::table() . ' ORDER BY id ASC LIMIT 1')[0] ?? null;
    }
}

class Award extends Model
{
    protected static string $table = 'portefolio_award';
}

class Partner extends Model
{
    protected static string $table = 'portefolio_partner';
}

class Testimonial extends Model
{
    protected static string $table = 'portefolio_testimonial';
}

class Category extends Model
{
    protected static string $table = 'portefolio_category';
}

class Blog extends Model
{
    protected static string $table = 'portefolio_blog';
}

class BlogComment extends Model
{
    protected static string $table = 'portefolio_blogcomment';
}
