<?php


class User
{
    public $name;
    public $phone;
    public $address;
    public $image;
    public $id;

    public function __construct($name, $phone, $address, $image)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
        $this->image = $image;
    }
}