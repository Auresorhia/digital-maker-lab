<?php

namespace Models\Bot;

class Profile
{
    private string $key;
    private string $title;
    private string $description;

    public function __construct(string $key, string $title, string $description)
    {
        $this->key = $key;
        $this->title = $title;
        $this->description = $description;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}