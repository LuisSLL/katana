<?php

namespace Migrations;

class CreatePostsTable
{
    public function up()
    {
        return "
            -- Escribe tu SQL aquí, por ejemplo:
            -- CREATE TABLE users (
            --     id INT AUTO_INCREMENT PRIMARY KEY,
            --     name VARCHAR(100),
            --     email VARCHAR(100),
            --     password VARCHAR(255),
            --     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            -- );
        ";
    }

    public function down()
    {
        return "
            -- DROP TABLE IF EXISTS users;
        ";
    }
}