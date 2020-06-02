<?php
// id int [pk, increment]
// user_id int [not null]
// nickname varchar(255) [not null]
// description varchar(255) [not null]
// Tarif integer(255) [not null]
// Type varchar(255) [not null]
// posted_time datetime [not null]
// }
namespace Entity;

use Entity\Type;
use Entity\User;
use ludk\Utils\Serializer;

class Post
{
    public int $id;
    public string $image;
    public string $title;
    public string $description;
    public string $price;
    public string $postedTime;
    public User $user;
    public Type $type;

    use Serializer;
}
