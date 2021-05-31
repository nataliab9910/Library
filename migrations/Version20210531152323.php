<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210531152323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE affiliate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE affiliates_books_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE author_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE card_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE genre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE publisher_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rental_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE affiliate (id INT NOT NULL, name VARCHAR(255) NOT NULL, webpage VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE affiliates_books (id INT NOT NULL, affiliate_id INT NOT NULL, book_id INT NOT NULL, quantity INT DEFAULT 1 NOT NULL, available_quantity INT DEFAULT 1 NOT NULL, orders INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_47EEA51C9F12C49A ON affiliates_books (affiliate_id)');
        $this->addSql('CREATE INDEX IDX_47EEA51C16A2B381 ON affiliates_books (book_id)');
        $this->addSql('CREATE TABLE author (id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE book_author (book_id INT NOT NULL, author_id INT NOT NULL, PRIMARY KEY(book_id, author_id))');
        $this->addSql('CREATE INDEX IDX_9478D34516A2B381 ON book_author (book_id)');
        $this->addSql('CREATE INDEX IDX_9478D345F675F31B ON book_author (author_id)');
        $this->addSql('CREATE TABLE card (id INT NOT NULL, barcode VARCHAR(20) NOT NULL, activated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_active BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_161498D397AE0266 ON card (barcode)');
        $this->addSql('CREATE TABLE genre (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE genre_book (genre_id INT NOT NULL, book_id INT NOT NULL, PRIMARY KEY(genre_id, book_id))');
        $this->addSql('CREATE INDEX IDX_70087AC14296D31F ON genre_book (genre_id)');
        $this->addSql('CREATE INDEX IDX_70087AC116A2B381 ON genre_book (book_id)');
        $this->addSql('CREATE TABLE publisher (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rental (id INT NOT NULL, reader_id INT NOT NULL, book_id INT NOT NULL, rent_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, exp_return_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, return_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1619C27D1717D737 ON rental (reader_id)');
        $this->addSql('CREATE INDEX IDX_1619C27D16A2B381 ON rental (book_id)');
        $this->addSql('ALTER TABLE affiliates_books ADD CONSTRAINT FK_47EEA51C9F12C49A FOREIGN KEY (affiliate_id) REFERENCES affiliate (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE affiliates_books ADD CONSTRAINT FK_47EEA51C16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE genre_book ADD CONSTRAINT FK_70087AC14296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE genre_book ADD CONSTRAINT FK_70087AC116A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D1717D737 FOREIGN KEY (reader_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book ADD publisher_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33140C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CBE5A33140C86FCE ON book (publisher_id)');
        $this->addSql('ALTER TABLE "user" ADD card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD status VARCHAR(255) DEFAULT \'waiting for approval\' NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6494ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6494ACC9A20 ON "user" (card_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE affiliates_books DROP CONSTRAINT FK_47EEA51C9F12C49A');
        $this->addSql('ALTER TABLE book_author DROP CONSTRAINT FK_9478D345F675F31B');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6494ACC9A20');
        $this->addSql('ALTER TABLE genre_book DROP CONSTRAINT FK_70087AC14296D31F');
        $this->addSql('ALTER TABLE book DROP CONSTRAINT FK_CBE5A33140C86FCE');
        $this->addSql('DROP SEQUENCE affiliate_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE affiliates_books_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE author_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE card_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE genre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE publisher_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rental_id_seq CASCADE');
        $this->addSql('DROP TABLE affiliate');
        $this->addSql('DROP TABLE affiliates_books');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE genre_book');
        $this->addSql('DROP TABLE publisher');
        $this->addSql('DROP TABLE rental');
        $this->addSql('DROP INDEX IDX_CBE5A33140C86FCE');
        $this->addSql('ALTER TABLE book DROP publisher_id');
        $this->addSql('DROP INDEX UNIQ_8D93D6494ACC9A20');
        $this->addSql('ALTER TABLE "user" DROP card_id');
        $this->addSql('ALTER TABLE "user" DROP status');
    }
}
