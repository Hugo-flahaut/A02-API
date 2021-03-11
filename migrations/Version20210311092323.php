<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311092323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE places (id INT AUTO_INCREMENT NOT NULL, rooms_id INT NOT NULL, orders_id INT DEFAULT NULL, place_number INT NOT NULL, is_reserved TINYINT(1) NOT NULL, INDEX IDX_FEAF6C558E2368AB (rooms_id), INDEX IDX_FEAF6C55CFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rooms (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE places ADD CONSTRAINT FK_FEAF6C558E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms (id)');
        $this->addSql('ALTER TABLE places ADD CONSTRAINT FK_FEAF6C55CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE places DROP FOREIGN KEY FK_FEAF6C55CFFE9AD6');
        $this->addSql('ALTER TABLE places DROP FOREIGN KEY FK_FEAF6C558E2368AB');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE places');
        $this->addSql('DROP TABLE rooms');
    }
}
