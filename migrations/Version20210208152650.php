<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208152650 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movies (id INT AUTO_INCREMENT NOT NULL, rooms_id INT DEFAULT NULL, title VARCHAR(150) NOT NULL, duration VARCHAR(150) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(150) NOT NULL, image VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C61EED308E2368AB (rooms_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE places (id INT AUTO_INCREMENT NOT NULL, rooms_id INT NOT NULL, is_reserved TINYINT(1) NOT NULL, place_number INT NOT NULL, INDEX IDX_FEAF6C558E2368AB (rooms_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rooms (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movies ADD CONSTRAINT FK_C61EED308E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms (id)');
        $this->addSql('ALTER TABLE places ADD CONSTRAINT FK_FEAF6C558E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movies DROP FOREIGN KEY FK_C61EED308E2368AB');
        $this->addSql('ALTER TABLE places DROP FOREIGN KEY FK_FEAF6C558E2368AB');
        $this->addSql('DROP TABLE movies');
        $this->addSql('DROP TABLE places');
        $this->addSql('DROP TABLE rooms');
    }
}
