<?php

declare(strict_types=1);

class Book
{
    private string $name;
    private float $price;
    private string $bookshelfNumber;
    private int $pages;
    private string $editor;

    function initialize(string $name, float $price, string $bookshelfNumber, int $pages, string $editor)
    {
        $this->name = $name;
        $this->price = $price;
        $this->bookshelfNumber = $bookshelfNumber;
        $this->pages = $pages;
        $this->editor = $editor;
    }

    function show()
    {
        return "Name: $this->name <br> Price: $this->price <br> Bookshelf Number: $this->bookshelfNumber <br> Pages: $this->pages <br> Editor: $this->editor <br>";
    }

    function applyDiscount()
    {
        $discount = ($this->price * 10) / 100;
        $this->price -= $discount;
    }

    function getName(): string
    {
        return $this->name;
    }

    function getPrice(): float
    {
        return $this->price;
    }

    function getBookshelfNumber(): string
    {
        return $this->bookshelfNumber;
    }

    function getPages(): int
    {
        return $this->pages;
    }

    function getEditor(): string
    {
        return $this->editor;
    }

    function setName(string $name)
    {
        $this->name = $name;
    }

    function setPrice(float $price)
    {
        $this->price = $price;
    }

    function setBookshelfNumber(string $bookshelfNumber)
    {
        $this->bookshelfNumber = $bookshelfNumber;
    }

    function setPages(int $pages)
    {
        $this->pages = $pages;
    }

    function setEditor(string $editor)
    {
        $this->editor = $editor;
    }
}
