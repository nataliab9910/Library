<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607211121 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental DROP CONSTRAINT FK_1619C27D16A2B381');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rental DROP CONSTRAINT fk_1619c27d16a2b381');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT fk_1619c27d16a2b381 FOREIGN KEY (book_id) REFERENCES affiliates_books (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
