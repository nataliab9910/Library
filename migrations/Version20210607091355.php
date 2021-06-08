<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607091355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental ADD status VARCHAR(255) DEFAULT \'ordered\' NOT NULL');
        $this->addSql('ALTER TABLE rental ADD order_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE rental ALTER rent_date DROP NOT NULL');
        $this->addSql('ALTER TABLE rental ALTER exp_return_date DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rental DROP status');
        $this->addSql('ALTER TABLE rental DROP order_date');
        $this->addSql('ALTER TABLE rental ALTER rent_date SET NOT NULL');
        $this->addSql('ALTER TABLE rental ALTER exp_return_date SET NOT NULL');
    }
}
