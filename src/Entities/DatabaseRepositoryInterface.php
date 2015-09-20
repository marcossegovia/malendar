<?php

namespace Malendar\Entities;

interface DatabaseRepositoryInterface
{
    public function find();
    public function update();
    public function remove();
}